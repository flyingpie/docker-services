<?php

if( !$gCms ) exit();

if( !$this->CheckPermission('Use Gallery') ) 
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

$themeObject =& $gCms->variables['admintheme'];


// check parameters
if( !isset($params['gid']) || !isset($params['mode']) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
	return;
}

$params['origaction'] = $params['action'];

$galleryinfo = $this->_Getgalleryinfobyid($params['gid']);
$defaulttemplate = $this->GetPreference('current_template');
if ( $galleryinfo['templateid'] == 0 )
{
	// override template settings with default template
	$templateprops = $this->_GetTemplateprops($defaulttemplate);
	$galleryinfo['thumbwidth'] = $templateprops['thumbwidth'];
	$galleryinfo['sortitems'] = $templateprops['sortitems'];
}
$gallerypath = abs($params['gid']) == 1 ? '' : trim($galleryinfo['filepath'] . '/' . $galleryinfo['filename'],'/');

$totaloffileorder = 0;
$numberofimages = 0;
if( $params['mode'] == 'add' )
{
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_editgallery',$returnid,'post','', false, '', $params));

	$smarty->assign('prompt_directoryname', $this->Lang('directoryname'));
	$smarty->assign('directoryname', $this->CreateInputText( $id, 'directoryname', "", 40, 100 ));
	$smarty->assign('gallerytitle', $this->CreateInputText( $id, 'gallerytitle', "", 40, 100 ));
	$smarty->assign('gallerycomment', $this->CreateTextArea($this->GetPreference('use_comment_wysiwyg',1), $id, "", 'gallerycomment', 'fake" style="height:6em;', '', '', '', '80', '3'));
	if ( $this->GetPreference('editdirdates') )
	{
		$smarty->assign('gallerydate', $this->CreateInputText( $id, 'gallerydate', Date('Y-m-d'), 10, 10 ));
	}
	else
	{
		$smarty->assign('gallerydate', "");
	}
	$smarty->assign('hideparentlink', $this->CreateInputCheckbox($id, 'hideparentlink', '1'));

	$smarty->assign('addgallery', '');
	$smarty->assign('addimages', '');
}
else 
{
	$this->_UpdateGalleryDB($gallerypath,$params['gid']);
	$gallery = $this->_Getgalleryfiles($gallerypath);
	$folderpath = $this->GetPreference('be_folderpath');

	$showgallery = array();
	$trueimage = $themeObject->DisplayImage('icons/system/true.gif', $this->Lang('setfalse'),'','','systemicon');
	$falseimage = $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('settrue'),'','','systemicon');
	$falseimage2 = $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('noalbumcover'),'','','systemicon');

	// SWFUpload settings
	$ext = explode(',', $this->GetPreference('allowed_extensions',''));
	$filetypes = '*.' . implode(';*.', $ext);
	$filedesc = ' Images: ' . implode('; ', $ext);
	$filesize = str_replace('M',' MB',get_cfg_var('post_max_size'));
	$smarty->assign('file_size_limit', $filesize);
	$smarty->assign('file_types', $filetypes);
	$smarty->assign('file_types_description', $filedesc);
	$smarty->assign('msg_complete', '&' . $id . 'module_message=' . rawurlencode($this->Lang('galleryupdated')));


	foreach ($gallery as $file)
	{
		$onerow = new stdClass();

		$params['fid'] = $file['fileid'];

		$onerow->fileid = $file['fileid'];
		$onerow->fileorder = $file['fileorder'];
		$totaloffileorder += $file['fileorder'];
		$onerow->file = $file['filename'];

		$params['multiaction'] = 'switchactive';
		$onerow->active = $this->CreateInputHidden($id, 'fileactive[' . $file['fileid'] . ']', $file['active']);
		$onerow->activelink = $this->CreateLink($id, 'multiaction', $returnid, ($file['active'] ? $trueimage : $falseimage), $params);
		unset($params['multiaction']);

		if ( substr($file['filename'],-1) == "/" )
		{
			// record is a directory
			$onerow->thumburl = '../' . $folderpath;
			$onerow->thumb = '<img src="' . $onerow->thumburl . '" alt="' . $file['filename'] . '" />';
			$onerow->filename = $file['filename'];
			$onerow->filename_input = '';
			$onerow->title = $file['title'];
			$onerow->title_input = $this->CreateLink($id, 'editgallery', $returnid, $file['filename'], array('gid' => $file['fileid'] ,'mode' => 'edit')) . $this->CreateInputHidden($id, 'filetitle[' . $file['fileid'] . ']', '#dir');
			$onerow->titlename = empty($file['title']) ? $file['filename'] : $file['title'];
			$onerow->comment = $file['comment'];
			$onerow->comment_input = "";
			$onerow->filedate = $file['filedate'];
			$onerow->filedate_input = $this->GetPreference('editdirdates') ? substr($file['filedate'], 0, 10) : "";
			if ( $file['defaultfile'] == 0 )
			{
				$onerow->defaultlink = $falseimage2;
			}
			elseif ( $file['defaultfile'] == $galleryinfo['defaultfile'] )
			{
				$params['fid'] = 0;
				$onerow->defaultlink = $this->CreateLink($id, 'switchdefault', $returnid, $trueimage, $params);
			}
			else
			{
				$params['fid'] = $file['defaultfile'];
				$onerow->defaultlink = $this->CreateLink($id, 'switchdefault', $returnid, $falseimage, $params);
			}
			$onerow->isdir = 1;
			$onerow->editlink = $this->CreateLink($id, 'editgallery', $returnid,
				$gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang ('edit'), '', '', 'systemicon'),
				array('gid' => $file['fileid'] ,'mode' => 'edit'));
			$onerow->editurl = $this->CreateLink($id, 'editgallery', $returnid, '',
				array('gid' => $file['fileid'] ,'mode' => 'edit'), '', true);
			$onerow->edittext = $this->Lang ('edit');
		}
		else
		{
			$numberofimages++;
			$onerow->thumburl = '../' . DEFAULT_GALLERY_PATH . str_replace('%2F','/',rawurlencode((empty($file['filepath']) ? '' : $file['filepath'] . '/') . IM_PREFIX . $file['filename']));
			$onerow->thumb = '<img src="' . $onerow->thumburl . '" alt="' . $file['filename'] . '" />';
			$onerow->filename = $file['filename'];
			$onerow->filename_input = $file['filename'];
			$onerow->title = $file['title'];
			$onerow->title_input = $this->CreateInputText($id, 'filetitle[' . $file['fileid'] . ']', $file['title'], 30, 100);
			$onerow->titlename = empty($file['title']) ? $file['filename'] : $file['title'];
			$onerow->comment = $file['comment'];
			$onerow->comment_input = $this->CreateTextArea(0, $id, $file['comment'], 'filecomment[' . $file['fileid'] . ']', 'fake" style="width:400px; height:4em;', '', '', '', '40', '4');  // class filled with fake and style-info to overrule the theme-css
			$onerow->filedate = $file['filedate'];
			if ( $this->GetPreference('editfiledates') )
			{
				$onerow->filedate_input = $this->CreateInputText( $id, 'filedate[' . $file['fileid'] . ']', substr($file['filedate'], 0, 10), 10, 10 );
			}
			else
			{
				$onerow->filedate_input = $file['filedate'];
			}
			if ( $file['fileid'] == $galleryinfo['defaultfile'] )
			{
				$params['fid'] = 0;
				$onerow->defaultlink = $this->CreateLink($id, 'switchdefault', $returnid, $trueimage, $params);
			}
			else
			{
				$onerow->defaultlink = $this->CreateLink($id, 'switchdefault', $returnid, $falseimage, $params);
			}
			$onerow->isdir = 0;
			if ( !file_exists('../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . IM_PREFIX . $file['filename']) )
			{
				$this->_CreateThumbnail('../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . IM_PREFIX . $file['filename'],
										'../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . $file['filename'],
										IM_THUMBWIDTH, IM_THUMBHEIGHT, 'sc');
			}
			$onerow->editlink = $this->CreateLink($id, 'editimage', $returnid,
				$gCms->variables['admintheme']->DisplayImage('icons/system/edit.gif', $this->Lang ('editimage'), '', '', 'systemicon'),
				array('fid' => $file['fileid'] ,'mode' => 'edit'));
			$onerow->editurl = $this->CreateLink($id, 'editimage', $returnid, '',
				array('fid' => $file['fileid'] ,'mode' => 'edit'), '', true);
			$onerow->edittext = $this->Lang ('editimage');
		}

		$onerow->deletelink = $this->CreateLink($id, 'multiaction', $returnid,
				$gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'),
				array ('multiaction' => 'delete', 'fid' => $file['fileid'], 'origaction' => 'editgallery'), $this->Lang ('areyousure'));
		$onerow->imgselect = $this->CreateInputCheckbox($id, 'imgselect[' . $file['fileid'] . ']', 1);

		if ( $file['fileid'] != 1 )
		{
			array_push($showgallery, $onerow);
		}
	}

	$sortarray = explode('/','n+fileorder/'.$galleryinfo['sortitems']);
	$showgallery = $this->_ArraySort($showgallery, $sortarray, false);

	$smarty->assign_by_ref('items', $showgallery);
	$smarty->assign('itemcount', count($showgallery));
	$smarty->assign('item', $this->Lang('item'));
	$smarty->assign('title', $this->Lang('title'));
	$smarty->assign('comment', $this->Lang('comment'));
	$smarty->assign('filedate', $this->Lang('date'));
	$smarty->assign('cover', $this->Lang('albumcover'));
	$smarty->assign('active', $this->Lang('active'));

	$smarty->assign('nofilestext', $this->lang("nofilestext"));
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_editgallery',$returnid,'post','', false, '', $params));

	$smarty->assign('gallerytitle', $this->CreateInputText( $id, 'gallerytitle', $galleryinfo['title'], 40, 100 ));
	$smarty->assign('gallerycomment', $this->CreateTextArea($this->GetPreference('use_comment_wysiwyg',1), $id, $galleryinfo['comment'], 'gallerycomment', 'fake" style="height:6em;', '', '', '', '80', '3'));
	if ( $this->GetPreference('editdirdates') )
	{
		$smarty->assign('gallerydate', $this->CreateInputText( $id, 'gallerydate', substr($galleryinfo['filedate'], 0, 10), 10, 10 ));
	}
	else
	{
		$smarty->assign('gallerydate', "");
	}
	$smarty->assign('hideparentlink', $this->CreateInputCheckbox($id, 'hideparentlink', '1', $galleryinfo['hideparentlink'], $params['gid'] == 1 ? 'disabled="disabled' : ''));

	$smarty->assign('addgallery',
		$this->CreateLink($id, 'editgallery', $returnid,
						$themeObject->DisplayImage('icons/system/newfolder.gif', $this->Lang('addsubgallery'),'','','systemicon'),
						array('gid' => $params['gid'], 'mode' => 'add')) . ' ' .
		$this->CreateLink($id, 'editgallery', $returnid,
						$this->Lang('addsubgallery'),
						array('gid' => $params['gid'], 'mode' => 'add')));
	$smarty->assign('addimages',
		$this->CreateLink($id, 'editgallery', $returnid,
						$themeObject->DisplayImage('icons/system/newobject.gif', $this->Lang('addimages'),'','','systemicon'),
						array('gid' => $params['gid'], 'mode' => 'edit')) . ' ' .
		$this->CreateLink($id, 'editgallery', $returnid,
						$this->Lang('addimages'),
						array('gid' => $params['gid'], 'mode' => 'edit')) . ' (' . $filesize . ' max)');

	$smarty->assign('sessionid',session_id());
	$smarty->assign('maximagewidth',$this->GetPreference('maximagewidth',800));
	$smarty->assign('maximageheight',$this->GetPreference('maximageheight',800));
	$_SESSION['uploaddir'] = trim(DEFAULT_GALLERY_PATH . ($params['gid'] == 1 ? '' : trim($galleryinfo['filepath'] . '/' . $galleryinfo['filename'],'/')),'/');
	$_SESSION['rootpath'] = str_replace('\\', '/', $config['root_path']) . '/';
}

if ( abs($params['gid']) == 1 )
{
	$smarty->assign('pagetitle', $this->CreateLink($id, 'defaultadmin', $returnid, $this->Lang('list')) );
}
else
{
	$gallerypatharr = explode('/', $galleryinfo['filepath']);
	$path = '';
	$breadcrumbs = $this->CreateLink($id, 'defaultadmin', $returnid, $this->Lang('list'));
	$breadcrumbs .= ' / ' . $this->CreateLink($id, 'editgallery', $returnid, 'Gallery', array('gid'=>1,'mode'=>"edit"));
	foreach ($gallerypatharr as $item)
	{
		if ( !empty($item) )
		{
			$path .= '/' . $item ;
			$galinfo = $this->_Getgalleryinfo($path);
			$breadcrumbs .= ' / ' . $this->CreateLink($id, 'editgallery', $returnid, $item, array('gid'=>$galinfo['fileid'],'mode'=>"edit"));
		}
	}
	$breadcrumbs .= ' / ' . trim($galleryinfo['filename'],'/');
	$smarty->assign('pagetitle', $breadcrumbs );
}

$smarty->assign('prompt_gallerytitle', $this->Lang('gallerytitle'));
$smarty->assign('prompt_comment',$this->Lang('comment'));
$smarty->assign('prompt_date',$this->Lang('date'));
$smarty->assign('customfields', $this->_Getcustomfields($params['gid'], 1, $id));

$templatelist = array('- ' . $this->Lang('usedefault') . ' -'=>0);
$query = "SELECT templateid, template FROM ".cms_db_prefix()."module_gallery_templateprops " . ($this->CheckPermission('Modify Templates') ? "" : "WHERE visible=1 ") . "ORDER BY template ASC";
$result = $db->Execute($query);
while ($result && $row = $result->FetchRow())
{
	$templatelist[$row['template']] = $row['templateid'];
}
if ( count($templatelist) == 1 
			|| (count($templatelist) == 2 && array_key_exists($defaulttemplate, $templatelist))
			|| isset($galleryinfo['templateid']) && !in_array($galleryinfo['templateid'], $templatelist))
{
	$smarty->assign('prompt_template', '');
	$smarty->assign('template', $this->CreateInputHidden($id, 'templateid', $galleryinfo['templateid']));
}
else
{
	$smarty->assign('prompt_template', $this->Lang('template'));
	$smarty->assign('template', $this->CreateInputDropdown($id, 'templateid', $templatelist, -1, isset($galleryinfo['templateid']) ? $galleryinfo['templateid'] : 0));
}

$multiactionlist = array($this->Lang('delete') => 'delete', $this->Lang('active') => 'active', $this->Lang('inactive') => 'inactive', $this->Lang('moveto') => 'move');
$galleries = $this->_GetGalleries();
foreach ($galleries as $gallery) 
{
	$gallerieslist[(empty($gallery['filepath']) ? '' : $gallery['filepath'] . '/') . $gallery['filename']] = $gallery['fileid'];
}
$smarty->assign('prompt_multiaction', $this->Lang('withselected'));
$smarty->assign('multiaction', $this->CreateInputDropdown($id, 'multiaction', $multiactionlist, -1, '', 'id="multiaction"'));
$smarty->assign('moveto', $this->CreateInputDropdown($id, 'moveto', $gallerieslist, -1, $params['gid'], 'id="moveto"'));
$smarty->assign('multiactionsubmit', $this->CreateInputSubmit($id, 'multiactionsubmit', $this->Lang('apply'), '', '', $this->Lang('areyousuremulti')));

$smarty->assign('prompt_parent', $this->Lang('parentgallery'));
$smarty->assign('prompt_hideparentlink', $this->Lang('hideparentlink'));

$smarty->assign('hidden', $this->CreateInputHidden($id, 'sort', '') . $this->CreateInputHidden($id, 'active', isset($galleryinfo['active']) ? $galleryinfo['active'] : 1));

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submitbutton', $this->Lang ('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang ('cancel')));
$smarty->assign('unsort', $totaloffileorder > 0 ? $this->CreateInputSubmit($id, 'unsortbutton', $this->Lang('sortbysettings'), '', '', $this->Lang('sureunsort')) : '');
$smarty->assign('updatethumbs', $numberofimages > 0 ? $this->CreateInputSubmit($id, 'updatethumbsbutton', $this->Lang ('updatethumbs'), '', '', $this->Lang('sureupdatethumbs')."\\n".$this->Lang('thumbsrecreated')) : '');
$smarty->assign('formend', $this->CreateFormEnd());


echo $this->ProcessTemplate('editgallery.tpl');

?>