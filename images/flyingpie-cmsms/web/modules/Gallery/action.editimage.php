<?php

if( !$gCms ) exit();

if( !$this->CheckPermission('Use Gallery') ) 
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

$themeObject =& $gCms->variables['admintheme'];


// check parameters
if( !isset($params['fid']) || !isset($params['mode']) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
	return;
}

//$params['origaction'] = $params['action'];

$file = $this->_Getimagebyid($params['fid']);

if( $params['mode'] == 'edit' )
{
	$trueimage = $themeObject->DisplayImage('icons/system/true.gif', $this->Lang('setfalse'),'','','systemicon');
	$falseimage = $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('settrue'),'','','systemicon');
	$falseimage2 = $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('noalbumcover'),'','','systemicon');


	$onerow = new stdClass();

	$onerow->fileid = $file['fileid'];
	$onerow->file = '../' . DEFAULT_GALLERY_PATH . str_replace('%2F','/',rawurlencode((empty($file['filepath']) ? '' : $file['filepath'] . '/') . $file['filename']));
	$params['multiaction'] = 'switchactive';
	$onerow->activelink = $this->CreateLink($id, 'multiaction', $returnid, ($file['active'] ? $trueimage : $falseimage), $params);
	unset($params['multiaction']);

	$onerow->thumburl = '../' . DEFAULT_GALLERY_PATH . str_replace('%2F','/',rawurlencode((empty($file['filepath']) ? '' : $file['filepath'] . '/') . IM_PREFIX . $file['filename']));
	$onerow->thumb = '<img src="' . $onerow->thumburl . '" alt="' . $file['filename'] . '" />';
	//$onerow->filename = $file['filename'];
	$onerow->filename_input = $file['filename'];
	//$onerow->title = $file['title'];
	$onerow->title_input = $this->CreateInputText($id, 'filetitle', $file['title'], 30, 100);
	//$onerow->titlename = empty($file['title']) ? $file['filename'] : $file['title'];
	$onerow->comment = $file['comment'];
	$onerow->comment_input = $this->CreateTextArea(0, $id, $file['comment'], 'filecomment', 'fake" style="height:4em;', '', '', '', '40', '4');  // class filled with fake and style-info to overrule the theme-css
	//$onerow->filedate = $file['filedate'];
	if ( $this->GetPreference('editfiledates') )
	{
		$onerow->filedate_input = $this->CreateInputText( $id, 'filedate', substr($file['filedate'], 0, 10), 10, 10 );
	}
	else
	{
		$onerow->filedate_input = $file['filedate'];
	}

	if ( !file_exists('../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . IM_PREFIX . $file['filename']) )
	{
		$this->_CreateThumbnail('../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . IM_PREFIX . $file['filename'],
								'../' . DEFAULT_GALLERY_PATH . $file['filepath'] . '/' . $file['filename'],
								IM_THUMBWIDTH, IM_THUMBHEIGHT, 'sc');
	}

	$onerow->deletelink = $this->CreateLink($id, 'multiaction', $returnid,
			$gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'),
			array ('multiaction' => 'delete', 'fid' => $file['fileid'], 'origaction' => 'editgallery'), $this->Lang ('areyousure'));

	$onerow->fields = $this->_Getcustomfields($params['fid'], 0, $id);


	$smarty->assign('image', $onerow);
	$smarty->assign('file', $this->Lang('item'));
	$smarty->assign('title', $this->Lang('title'));
	$smarty->assign('comment', $this->Lang('comment'));
	$smarty->assign('filedate', $this->Lang('date'));
	$smarty->assign('cover', $this->Lang('albumcover'));
	$smarty->assign('active', $this->Lang('active'));

	$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_editimage', $returnid, 'post', '', false, '', $params));

}

$smarty->assign('pagetitle', $this->Lang('editimage'));
$smarty->assign('hidden', $this->CreateInputHidden($id, 'fid', $file['fileid']) . $this->CreateInputHidden($id, 'gid', $file['galleryid']));
$smarty->assign('submit', $this->CreateInputSubmit($id, 'submitbutton', $this->Lang ('submit')));
$smarty->assign('apply', $params['mode'] == 'add' ? '' : $this->CreateInputSubmit($id, 'applybutton', $this->Lang('apply')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang ('cancel')));
$smarty->assign('formend', $this->CreateFormEnd());


echo $this->ProcessTemplate('editimage.tpl');

?>