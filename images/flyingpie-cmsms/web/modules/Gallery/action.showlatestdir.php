<?php
if (!isset($gCms)) exit;

$params['dir'] = isset($params['dir']) ? rawurldecode(cms_html_entity_decode(trim(trim($params['dir'],"*"),"/"))) : '';
$number = (isset($params['number']) && is_numeric($params['number'])) ? $params['number'] : 6;
$show = (isset($params['show']) && in_array($params['show'], array('active','inactive','all'))) ? $params['show'] : 'active';

$imgcount = 0;
$itemcount = 0;
$images = array();
$template = $this->GetPreference('current_template');
$urlprefix = $this->GetPreference('urlprefix', 'gallery');

if ( is_dir(DEFAULT_GALLERY_PATH . $params['dir']) )
{
	$smarty->assign('gallerytitle', htmlspecialchars(trim(substr($params['dir'], strrpos($params['dir'], '/')),"/")));
	$smarty->assign('galleryid', '');

	// get latest gallery
	$db =& $this->GetDB();
	$query = "SELECT
							g.fileid
						FROM
							" . cms_db_prefix() . "module_gallery g
						WHERE
							g.filename LIKE '%/'
							AND g.filepath LIKE ?";
	Switch ($show)
	{
		Case 'active':
			$query .= " AND g.active=1";
			break;
		Case 'inactive':
			$query .= " AND g.active=0";
			break;
	}
	$query .= "
						ORDER BY
							g.filedate DESC
						LIMIT 0,1";
	$result = $db->Execute($query, array((empty($params['dir']) ? '%' : $params['dir'] . "/%")));
	if ( $result && $result->RecordCount() > 0 )
	{
	  $output = array();
	  $row = $result->FetchRow();
		$latestgalleryid = $row['fileid'];

		// get gallery info
		$galleryinfo = $this->_Getgalleryinfobyid($latestgalleryid);

		if ( isset($params['template']) )
		{
			// override template settings with param template
			$templateprops = $this->_GetTemplateprops($params['template']);
			$galleryinfo['templateid'] = $templateprops['templateid'];
			$galleryinfo['template'] = $templateprops['template'];
			$galleryinfo['thumbwidth'] = $templateprops['thumbwidth'];
			$galleryinfo['thumbheight'] = $templateprops['thumbheight'];
			$galleryinfo['resizemethod'] = $templateprops['resizemethod'];
		}
		if ( empty($galleryinfo['templateid']) )
		{
			// override template settings with default template
			$templateprops = $this->_GetTemplateprops($template);
			$galleryinfo['templateid'] = $templateprops['templateid'];
			$galleryinfo['template'] = $templateprops['template'];
			$galleryinfo['thumbwidth'] = $templateprops['thumbwidth'];
			$galleryinfo['thumbheight'] = $templateprops['thumbheight'];
			$galleryinfo['resizemethod'] = $templateprops['resizemethod'];
		}
		$template = $galleryinfo['template'];

		if ( $galleryinfo['active'] == 1 )
		{
			if ( !empty($galleryinfo['title']) )
			{
				$smarty->assign('gallerytitle', $galleryinfo['title']);
			}
			$smarty->assign('gallerycomment', $galleryinfo['comment']);
			$smarty->assign('parentlink', '');
			$smarty->assign('galleryid', $galleryinfo['fileid']);
		}

		$targetpage = '';
		if (isset($params['targetpage']))
		{
			$manager =& $gCms->GetHierarchyManager();
			$node =& $manager->sureGetNodeByAlias($params['targetpage']);
			if (isset($node))
			{
				$targetpage = $node->getID();
				$id = 'cntnt01';
			}
			else
			{
				$node =& $manager->sureGetNodeById($params['targetpage']);
				if (isset($node))
				{
					$targetpage = $params['targetpage'];
					$id = 'cntnt01';
				}
			}
		}

		// build gallery with random images
		$query = "SELECT
								g1.*, g2.active
							FROM
								" . cms_db_prefix() . "module_gallery g1
							LEFT JOIN
								" . cms_db_prefix() . "module_gallery g2
							ON
								g1.galleryid = g2.fileid
							WHERE
								g1.filename NOT LIKE '%/'
								AND g1.galleryid=?";
		Switch ($show)
		{
			Case 'active':
				$query .= " AND g1.active=1 AND g2.active=1";
				break;
			Case 'inactive':
				$query .= " AND g1.active=0";
				break;
		}
		$query .= "
							ORDER BY
								RAND()
							LIMIT 0,?";
		$result = $db->Execute($query, array($latestgalleryid, $number));
		if ( $result && $result->RecordCount() > 0 )
		{
			$output = array();
			while ( $row=$result->FetchRow() )
			{
				$output[trim($row['filepath'] . '/' . $row['filename'],'/')] = $row;

			// create a new object for every record that we retrieve
			$rec = new stdClass();
			$rec->fileid = $row['fileid'];
			$rec->file = DEFAULT_GALLERY_PATH . trim($row['filepath'] . '/' . $row['filename'],'/'); //str_replace('%2F','/',rawurlencode(trim($row['filepath'] . '/' . $row['filename'],'/')));
			$rec->filedate = $row['filedate'];
			$rec->filename = $row['filename'];
			$rec->title = $row['title'];
			$rec->titlename = empty($row['title']) ? $row['filename'] : $row['title'];
			$rec->comment = $row['comment'];
			$rec->active = $row['active'];
			if ( $galleryinfo['thumbwidth'] > 0 )
			{
				$rec->thumb = DEFAULT_GALLERYTHUMBS_PATH . $row['fileid'] . '-' . $galleryinfo['templateid'] . substr($row['filename'], strrpos($row['filename'], '.')) ;
			}
			else
			{
				$rec->thumb = DEFAULT_GALLERY_PATH . (empty($row['filepath']) ? '' : $row['filepath'] . '/') . IM_PREFIX . $row['filename'];
			}
			$rec->isdir = false;
			$paramslink['dir'] = str_replace('%2F','/',rawurlencode($row['filepath']));
			$prettyurl = $urlprefix . '/' . $paramslink['dir'] . '/' . ($targetpage!=''?$targetpage:$returnid);
			$rec->galleryid = $row['galleryid'];
			$rec->gallery_url = $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default',
					'', $paramslink, '', true, true, '', false, $prettyurl );
			$rec->fields = $this->_Getcustomfields($rec->fileid, $rec->isdir, '', 1);

			$itemcount++;
			$imgcount++;

			$this->_CreateThumbnail($rec->thumb,
															DEFAULT_GALLERY_PATH . trim($row['filepath'] . '/' . $row['filename'],'/'),
															($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['thumbwidth'] : IM_THUMBWIDTH,
															($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['thumbheight'] : IM_THUMBHEIGHT,
															($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['resizemethod'] : 'sc');
			array_push($images,$rec);
			}
		}
	}
}
else
{
	$params['module_message'] = $this->Lang('message_wrongdir', htmlspecialchars($params['dir']));
	$smarty->assign('hideparentlink', true);
}


// Expose the list to smarty. Use "by_ref" to save memory.
$smarty->assign_by_ref('images',$images);

// and a count of records
$smarty->assign('imagecount', $imgcount . ' ' . ($imgcount == 1 ? $this->Lang('image') : $this->Lang('images')));
$smarty->assign('itemcount', $itemcount);
$smarty->assign('numimages', $imgcount);
$smarty->assign('numdirs', $itemcount - $imgcount);
$smarty->assign('pages', 1);

// navigationlinks not nescesary, but define smarty variables for templates that use them
$smarty->assign('prevpage', '');
$smarty->assign('prevpage_url', '');
$smarty->assign('prevpage_txt', '');
$smarty->assign('nextpage', '');
$smarty->assign('nextpage_url', '');
$smarty->assign('nextpage_txt', '');
$smarty->assign('pagelinks', '');


if (isset($params['module_message']))
{
	$smarty->assign('module_message',$params['module_message']);
}
else
{
	$smarty->assign('module_message','');
}


// Display template
echo $this->ProcessTemplateFromDatabase($template);


// pass data to head section.

// get template-specific JavaScript and echo
$templatecode = $this->GetTemplate($template);
$templatecodearr = explode(TEMPLATE_SEPARATOR, $templatecode);
$template_metadata = '
<!-- Gallery/' . $template . ' -->
';

// check if a css file exists and echo
if ( file_exists("modules/Gallery/templates/css/" . $template . ".css") )
{
	$template_metadata .= '<link rel="stylesheet" href="modules/Gallery/templates/css/' . $template . '.css" type="text/css" media="screen" />
';
}
$template_metadata .= substr($templatecodearr[2],0,-2);

// make sure to add Metadata just once.
if ( empty($this->GalleryMetadata) )
{
	$this->GalleryMetadata = $template_metadata;
}
elseif ( stripos($this->GalleryMetadata,'<!-- Gallery/' . $template . ' -->') === FALSE )
{
	$this->GalleryMetadata .= $template_metadata;
}
?>