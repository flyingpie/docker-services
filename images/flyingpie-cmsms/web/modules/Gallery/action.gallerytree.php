<?php
if (!isset($gCms)) exit;

$params['dir'] = isset($params['dir']) ? rawurldecode(cms_html_entity_decode(trim(trim($params['dir'],"*"),"/"))) : '';
$show = (isset($params['show']) && in_array($params['show'], array('active','inactive','all'))) ? $params['show'] : 'active';
$start = (isset($params['start']) && is_numeric($params['start'])) ? $params['start'] : 1;
$number = (isset($params['number']) && is_numeric($params['number'])) ? $params['number'] : 10000;
$urlprefix = $this->GetPreference('urlprefix', 'gallery');
$folderpath = $this->GetPreference('fe_folderpath');

$targetpage = '';
$id = 'cntnt01';
if (isset($params['targetpage']))
{
	$manager =& $gCms->GetHierarchyManager();
	$node =& $manager->sureGetNodeByAlias($params['targetpage']);
	if (isset($node))
	{
		$targetpage = $node->getID();
	}
	else
	{
		$node =& $manager->sureGetNodeById($params['targetpage']);
		if (isset($node))
		{
			$targetpage = $params['targetpage'];
		}
	}
}

Switch ($show)
{
	Case 'active':
		$showactive = " AND g1.active=1";
		break;
	Case 'inactive':
		$showactive = " AND g1.active=0";
		break;
	Default:
		$showactive = "";
		break;
}

$templateprops = $this->_GetTemplateprops('gallerytree');
if ( !$templateprops )
{
	$template = $this->GetPreference('current_template');
	$templateprops = $this->_GetTemplateprops($template);
}
if ( isset($params['template']) )
{
	// override template settings with param template
	$templateprops = $this->_GetTemplateprops($params['template']);
}
$template = $templateprops['template'];
$defaultsortitems = $templateprops['sortitems'];



if ( is_dir(DEFAULT_GALLERY_PATH . $params['dir']) )
{
	// we need to split up to get the parent dir
	$pos = strrpos($params['dir'], '/');
	if( $pos === FALSE )
	{
		$path = '';
		$file = empty($params['dir']) ? 'Gallery/' : $params['dir'] . '/';
	}
	else
	{
		$path = substr($params['dir'], 0, $pos-1);
		$file = substr($params['dir'], $pos) . '/';
	}

	$db =& $this->GetDB();

	$query = "SELECT
				g1.*, CONCAT(g2.filepath,?,g2.filename) AS thumb, gtp.sortitems
			FROM
				" . cms_db_prefix() . "module_gallery g1
			JOIN
				" . cms_db_prefix() . "module_gallery_props gp
			ON
				g1.fileid = gp.fileid
			LEFT JOIN
				" . cms_db_prefix() . "module_gallery_templateprops gtp
			ON
				gp.templateid = gtp.templateid
			LEFT JOIN
				" . cms_db_prefix() . "module_gallery g2
			ON
				g1.defaultfile = g2.fileid
			WHERE
				g1.filename LIKE '%/'
				AND ((g1.filename = ? AND g1.filepath = ?)
				OR (g1.filepath = ? OR g1.filepath LIKE ?))" . $showactive . "
			ORDER BY
				IF(g1.fileid=1,0,1) ASC,
				CONCAT(g1.filepath,CAST(IF(g1.filepath='','','/') AS BINARY),g1.filename) ASC";
		$result = $db->Execute($query, array('/'.IM_PREFIX, $file, $path, $params['dir'], empty($params['dir']) ? '%' : $params['dir'] .'/%'));
		
		$galleries = array();
		
		if ( $result && $result->RecordCount() > 0 )
		{
			while ( $row=$result->FetchRow() )
			{
				// create a new object for every record that we retrieve
				$rec = new stdClass();
				$rec->fileid = $row['fileid'];
				$file = trim($row['filepath'] . '/' . $row['filename'],'/');
				$rec->file = DEFAULT_GALLERY_PATH . $file;
				$rec->filedate = $row['filedate'];
				$rec->filename = $row['filename'];
				$rec->title = $row['title'];
				$rec->titlename = empty($row['title']) ? $row['filename'] : $row['title'];
				$rec->comment = $row['comment'];
				$rec->gid = $row['galleryid'];
				$rec->isdir = true;
				$rec->sortitems = $row['sortitems'] == NULL ? $defaultsortitems : $row['sortitems'];
				$rec->fileorder = $row['fileorder'];
				$rec->depth = substr_count($file, '/') - substr_count($params['dir'], '/') + 1;
				
				if ( empty($row['thumb']) || !file_exists(DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$row['thumb'])) )
				{
					$rec->thumb = $folderpath;
				}
				elseif ( $templateprops['thumbwidth'] > 0 )
				{
					$rec->thumb = DEFAULT_GALLERYTHUMBS_PATH . $row['defaultfile'] . '-' . $templateprops['templateid'] . substr($row['thumb'], strrpos($row['thumb'], '.'));
					$originalimage = DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$row['thumb']);
				}
				else
				{
					$rec->thumb = DEFAULT_GALLERY_PATH . $row['thumb'];
					$originalimage = DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$row['thumb']);
				}
				$paramslink['dir'] = str_replace('%2F','/', rawurlencode($file));
				$prettyurl = $urlprefix . '/' . $paramslink['dir'] . '/' .
						(isset($params['start']) ? $params['start'] . '-' . $params['number'] . '-' : '') .
						(isset($params['show']) ? $params['show'] . '-' : '') .
						($targetpage!=''?$targetpage:$returnid);
				$rec->file = $this->CreateFrontendLink($id, ($targetpage!='' ? $targetpage : $returnid), 'default',
					'', $paramslink, '', true, true, '', false, $prettyurl );

				// add object to galleries-array
				$galleries['gid'.$row['galleryid']][] = $rec;
			}
		}

		$parentgallery = array_shift($galleries);

		function GetGallerytree($subgallery, $sortitems, &$output, &$galleries)
		{
			global $gCms;
			$mod = $gCms->modules['Gallery']['object'];
			$sortarray = explode('/','n+fileorder/'.$sortitems);
			$subgalleries = $mod->_ArraySort($subgallery, $sortarray, false);
			foreach ( $subgalleries as $key => $subgallery )
			{
				$output[] = $subgallery;
				if( array_key_exists('gid'.$subgallery->fileid, $galleries) )
				{
					GetGallerytree($galleries['gid'.$subgallery->fileid], $subgallery->sortitems, $output, $galleries);
				}
			}
		}


		GetGallerytree($parentgallery, $parentgallery[0]->sortitems, $output, $galleries);
		array_shift($output); // we don't need the first one
}
else
{
	$params['module_message'] = $this->Lang('message_wrongdir', htmlspecialchars($params['dir']));
	$smarty->assign('hideparentlink', true);
}


// Expose the list to smarty. Use "by_ref" to save memory.
$smarty->assign_by_ref('images',$output);

// and a count of records
$smarty->assign('imagecount', '');
$smarty->assign('itemcount', '');
$smarty->assign('numimages', '');
$smarty->assign('numdirs', '');
$smarty->assign('pages', 1);

// navigationlinks not nescesary, but define smarty variables for templates that use them
$smarty->assign('hideparentlink', true);
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