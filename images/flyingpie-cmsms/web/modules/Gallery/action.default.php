<?php
if (!isset($gCms)) exit;

$urlprefix = $this->GetPreference('urlprefix', 'gallery');
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

if ( isset($params['img']) )
{
	// display single image
	$template = $this->GetPreference('singleimg_template');
	$templatehtml = $this->GetPreference('singleimg_template_html');
	$templateprops = $this->_GetTemplateprops($template);

	$imginfo = $this->_Getimagebyid($params['img']);
	if( $imginfo )
	{
		$filepath = (empty($imginfo['filepath']) ? '' : $imginfo['filepath'] . '/');
		$file = $filepath . $imginfo['filename'];
		$rec = new stdClass();
		$rec->fileid = $imginfo['fileid'];
		$rec->file = DEFAULT_GALLERY_PATH . $file;
		$rec->filedate = $imginfo['filedate'];
		$rec->filename = trim($imginfo['filename'],"/");
		$rec->title = $imginfo['title'];
		$rec->titlename = empty($imginfo['title']) ? $imginfo['filename'] : $imginfo['title'];
		$rec->comment = $imginfo['comment'];
		$rec->fileorder = $imginfo['fileorder'];
		$rec->active = $imginfo['active'];
		$rec->isdir = false;
		$paramslink['dir'] = str_replace('%2F','/',rawurlencode($filepath));
		$prettyurl = $urlprefix . '/' . $paramslink['dir'] . '/' . ($targetpage!=''?$targetpage:$returnid);
		$rec->galleryid = $imginfo['galleryid'];
		$rec->gallery_url = $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default',
				'', $paramslink, '', true, true, '', false, $prettyurl );
		$rec->fields = $this->_Getcustomfields($imginfo['fileid'], 0, '', 1);
		
		$originalimage = DEFAULT_GALLERY_PATH . $file;
		if ( $templateprops['thumbwidth'] > 0 )
		{
			$rec->thumb = DEFAULT_GALLERYTHUMBS_PATH . $rec->fileid . '-' . $templateprops['templateid'] . substr($imginfo['filename'], strrpos($imginfo['filename'], '.'));
			$this->_CreateThumbnail($rec->thumb, $originalimage, $templateprops['thumbwidth'], $templateprops['thumbheight'], $templateprops['resizemethod']);
		}
		else
		{
			$rec->thumb = DEFAULT_GALLERY_PATH . (empty($imginfo['filepath']) ? '' : $imginfo['filepath'] . '/') . IM_PREFIX . $imginfo['filename'];
			$this->_CreateThumbnail($rec->thumb, $originalimage, IM_THUMBWIDTH, IM_THUMBHEIGHT, 'sc');
		}

		$smarty->assign_by_ref('image',$rec);
		echo $this->ProcessTemplateFromData($templatehtml) . "\n";
	}
}
else
{
	// display gallery
	$params['dir'] = isset($params['dir']) ? rawurldecode(cms_html_entity_decode(trim($params['dir'],"/"))) : '';
	$start = (isset($params['start']) && is_numeric($params['start'])) ? $params['start'] : 1;
	$number = (isset($params['number']) && is_numeric($params['number'])) ? $params['number'] : 1000;
	$show = (isset($params['show']) && in_array($params['show'], array('active','inactive','all'))) ? $params['show'] : 'active';
	$folderpath = $this->GetPreference('fe_folderpath');

	$imgcount = 0;
	$itemcount = 0;
	$images = array();
	$template = $this->GetPreference('current_template');

	if ( is_dir(DEFAULT_GALLERY_PATH . $params['dir']) )
	{
		$smarty->assign('gallerytitle', htmlspecialchars(trim(substr($params['dir'], strrpos($params['dir'], '/')),"/")));
		$smarty->assign('galleryid', '');

		// get gallery info
		$galleryinfo = $this->_Getgalleryinfo($params['dir']);

		if ( isset($params['template']) )
		{
			// override template settings with param template
			$templateprops = $this->_GetTemplateprops($params['template']);
			$galleryinfo['templateid'] = $templateprops['templateid'];
			$galleryinfo['template'] = $templateprops['template'];
			$galleryinfo['thumbwidth'] = $templateprops['thumbwidth'];
			$galleryinfo['thumbheight'] = $templateprops['thumbheight'];
			$galleryinfo['resizemethod'] = $templateprops['resizemethod'];
			$galleryinfo['maxnumber'] = $templateprops['maxnumber'];
			$galleryinfo['sortitems'] = $templateprops['sortitems'];
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
			$galleryinfo['maxnumber'] = $templateprops['maxnumber'];
			$galleryinfo['sortitems'] = $templateprops['sortitems'];
		}
		//params['number'] override $number
		if ( $number == 1000 && !empty($galleryinfo['maxnumber']) )
		{
			$number = $galleryinfo['maxnumber'];
			$params['number'] = $number;
		}
		$template = $galleryinfo['template'];

		$paramslink = array();
		if ( isset($params['start']) || isset($params['number']) )
		{
			$paramslink['start'] = 1;
			$paramslink['number'] = $number;
		}
		if ( isset($params['show']) )
		{
			$paramslink['show'] = $params['show'];
		}

		if ( array_key_exists('fileid',$galleryinfo) )
		{
			if ( !empty($galleryinfo['title']) )
			{
				$smarty->assign('gallerytitle', $galleryinfo['title']);
			}
			$smarty->assign('gallerycomment', array_key_exists('comment',$galleryinfo) ? $galleryinfo['comment'] : '');
			$smarty->assign('galleryid', $galleryinfo['fileid']);
		}
		else
		{
			$filepath = strpos($params['dir'],"/") === FALSE ? '' : substr($params['dir'], 0, strrpos($params['dir'], '/'));
			$filename = strpos($params['dir'],"/") === FALSE ? $params['dir'] . '/' : substr($params['dir'], strrpos($params['dir'], '/') + 1) . '/';
			$parentinfo = $this->_Getgalleryinfo($filepath);
			$galleryinfo['fileid'] = $this->_AddFileToDB($filename, $filepath, date("Y-m-d H:i:s"), $parentinfo ? $parentinfo['fileid'] : 0);
			$galleryinfo['hideparentlink'] = 0;
			$smarty->assign('galleryid', $galleryinfo['fileid']);
		}

		$paramslink['dir'] = strpos($params['dir'], '/') === FALSE ? '' : '/' . str_replace('%2F','/',rawurlencode(preg_replace('/^(.*)(\/.+)$/', '$1', $params['dir'])));
		$prettyurl = $urlprefix . $paramslink['dir'] . '/' .
					(isset($paramslink['start']) ? $paramslink['start'] . '-' . $paramslink['number'] . '-' : '') .
					(isset($paramslink['show']) ? $paramslink['show'] . '-' : '') .
					($targetpage!=''?$targetpage:$returnid);
		$smarty->assign('parentlink', empty($params['dir']) ? '' : $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', $this->Lang('parent'), $paramslink, '', false, true, '', false, $prettyurl));
		$smarty->assign('parent_url', empty($params['dir']) ? '' : $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', '', $paramslink, '', true, true, '', false, $prettyurl));
		$smarty->assign('parent_txt', $this->Lang('parent'));
		$smarty->assign('hideparentlink', $galleryinfo['hideparentlink']);

		// get the public custom fields related to this gallery
		$smarty->assign('fields', $this->_Getcustomfields($galleryinfo['fileid'], 1, '', 1));

		// build gallery
		$dirfiles = $this->_Getdirfiles($params['dir'],FALSE);
		$galeryfiles = $this->_Getgalleryfiles($params['dir']);

		// Walk through all items found in the directory, because they don't nescesarily exist in the database
		foreach($dirfiles as $key=>$item)
		{
			if ( !$galeryfiles || !array_key_exists($key, $galeryfiles) || $show == 'all' || ($show == 'active' && $galeryfiles[$key]['active'] != 0) || ($show == 'inactive' && $galeryfiles[$key]['active'] == 0) )
			{
				// create a new object for every record that we retrieve
				$rec = new stdClass();
				$rec->fileid = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['fileid'] : $this->_AddFileToDB($item['filename'],$item['filepath'],$item['filemdate'],$galleryinfo['fileid']);
				$rec->file = DEFAULT_GALLERY_PATH . $key; //str_replace('%2F','/',rawurlencode($key));
				$rec->filedate = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['filedate'] : '';
				$rec->filename = trim($item['filename'],"/");
				$rec->title = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['title'] : '';
				$rec->titlename = ($galeryfiles && array_key_exists($key, $galeryfiles) && !empty($galeryfiles[$key]['title'])) ? $galeryfiles[$key]['title'] : trim($item['filename'],"/");
				$rec->comment = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['comment'] : '';
				$rec->fileorder = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['fileorder'] : 1000;
				$rec->active = ($galeryfiles && array_key_exists($key, $galeryfiles)) ? $galeryfiles[$key]['active'] : 1;
				$rec->isdir = false;
				$paramslink['dir'] = str_replace('%2F','/',rawurlencode($item['filepath']));
				$prettyurl = $urlprefix . '/' . $paramslink['dir'] . '/' . ($targetpage!=''?$targetpage:$returnid);
				$rec->galleryid = $galleryinfo['fileid'];
				$rec->gallery_url = $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default',
						'', $paramslink, '', true, true, '', false, $prettyurl );
				if ( is_dir(DEFAULT_GALLERY_PATH . $key) )
				{
					if ( !$galeryfiles || !array_key_exists($key, $galeryfiles) || empty($galeryfiles[$key]['thumb']) || !file_exists(DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$galeryfiles[$key]['thumb'])) )
					{
						$rec->thumb = $folderpath;
					}
					elseif ( $galleryinfo['thumbwidth'] > 0 )
					{
						$rec->thumb = DEFAULT_GALLERYTHUMBS_PATH . $galeryfiles[$key]['defaultfile'] . '-' . $galleryinfo['templateid'] . substr($galeryfiles[$key]['thumb'], strrpos($galeryfiles[$key]['thumb'], '.'));
						$originalimage = DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$galeryfiles[$key]['thumb']);
					}
					else
					{
						$rec->thumb = DEFAULT_GALLERY_PATH . $galeryfiles[$key]['thumb'];
						$originalimage = DEFAULT_GALLERY_PATH . str_replace(IM_PREFIX,'',$galeryfiles[$key]['thumb']);
					}
					$paramslink['dir'] = str_replace('%2F','/',rawurlencode($key));
					$prettyurl = $urlprefix . '/' . $paramslink['dir'] . '/' .
							(isset($paramslink['start']) ? $paramslink['start'] . '-' . $paramslink['number'] . '-' : '') .
							(isset($paramslink['show']) ? $paramslink['show'] . '-' : '') .
							($targetpage!=''?$targetpage:$returnid);
					$rec->file = $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default',
						'', $paramslink, '', true, true, '', false, $prettyurl );
					$rec->isdir = true;
				}
				elseif ( $galleryinfo['thumbwidth'] > 0 )
				{
					$rec->thumb = DEFAULT_GALLERYTHUMBS_PATH . $rec->fileid . '-' . $galleryinfo['templateid'] . substr($item['filename'], strrpos($item['filename'], '.'));
					$originalimage = DEFAULT_GALLERY_PATH . $key;
					$imgcount++;
				}
				else
				{
					$rec->thumb = DEFAULT_GALLERY_PATH . (empty($item['filepath']) ? '' : $item['filepath'] . '/') . IM_PREFIX . $item['filename'];
					$originalimage = DEFAULT_GALLERY_PATH . $key;
					$imgcount++;
				}
				// get the public custom fields for this item
				$rec->fields = $this->_Getcustomfields($rec->fileid, $rec->isdir, '', 1);

				if ( $rec->thumb != $folderpath )
				{
					$this->_CreateThumbnail($rec->thumb,
											$originalimage,
											($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['thumbwidth'] : IM_THUMBWIDTH,
											($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['thumbheight'] : IM_THUMBHEIGHT,
											($galleryinfo['thumbwidth'] > 0) ? $galleryinfo['resizemethod'] : 'sc');
				}
				array_push($images,$rec);
			}
		}

		// Sort array $images
		// second parameter of _ArraySort is an array of strings, which contains:
		// n for number, s for string
		// + for ascending, - for descending
		// fieldname
		$sortarray = explode('/','n+fileorder/'.$galleryinfo['sortitems']);
		$images = $this->_ArraySort($images, $sortarray, false);
		$itemcount = count($images);

		// Get the images we want
		$images = array_splice($images, $start-1, $number);
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
	$smarty->assign('number', $number);
	$smarty->assign('pages', ceil($itemcount/$number));
	$smarty->assign('currentpage', ceil($start/$number));

	// pagenavigation
	$paramslink['dir'] = empty($params['dir']) ? '' : '/' . str_replace('%2F','/',rawurlencode($params['dir']));
	$paramslink['start'] = $start - $number;
	$prettyurl = $urlprefix . $paramslink['dir'] . '/' .
						(isset($paramslink['number']) ? $paramslink['start'] . '-' . $paramslink['number'] . '-' : '') .
						(isset($paramslink['show']) ? $paramslink['show'] . '-' : '') .
						($targetpage!=''?$targetpage:$returnid);
	$smarty->assign('prevpage', ($paramslink['start'] >= 1 ? $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', $this->Lang('prevpage'), $paramslink, '', false, true, '', false, $prettyurl) : ('<em>' . $this->Lang('prevpage') . '</em>')));
	$smarty->assign('prevpage_url', ($paramslink['start'] >= 1 ? $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', '', $paramslink, '', true, true, '', false, $prettyurl) : ''));
	$smarty->assign('prevpage_txt', $this->Lang('prevpage'));

	$paramslink['start'] = $start + $number;
	$prettyurl = $urlprefix . $paramslink['dir'] . '/' .
						(isset($paramslink['number']) ? $paramslink['start'] . '-' . $paramslink['number'] . '-' : '') .
						(isset($paramslink['show']) ? $paramslink['show'] . '-' : '') .
						($targetpage!=''?$targetpage:$returnid);
	$smarty->assign('nextpage', ($itemcount >= $paramslink['start'] ? $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', $this->Lang('nextpage'), $paramslink, '', false, true, '', false, $prettyurl) : ('<em>' . $this->Lang('nextpage') . '</em>')));
	$smarty->assign('nextpage_url', ($itemcount >= $paramslink['start'] ? $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', '', $paramslink, '', true, true, '', false, $prettyurl) : ''));
	$smarty->assign('nextpage_txt', $this->Lang('nextpage'));

	$pagelinks = '';
	for ($i = 0; $i < ceil($itemcount/$number); $i++)
	{
		$paramslink['start'] = ($i * $number) + 1;
		$prettyurl = $urlprefix . $paramslink['dir'] . '/' .
							(isset($paramslink['number']) ? $paramslink['start'] . '-' . $paramslink['number'] . '-' : '') .
							(isset($paramslink['show']) ? $paramslink['show'] . '-' : '') .
							($targetpage!=''?$targetpage:$returnid);
		$pagelinks .= ($paramslink['start'] != $start ? $this->CreateFrontendLink($id, ($targetpage!=''?$targetpage:$returnid), 'default', $i + 1, $paramslink, '', false, true, '', false, $prettyurl) : ('<em>' . ($i + 1) . '</em>'));
	}
	$smarty->assign('pagelinks', $pagelinks);


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
}


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