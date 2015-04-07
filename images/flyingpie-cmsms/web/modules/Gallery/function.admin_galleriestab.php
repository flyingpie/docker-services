<?php
$themeObject =& $gCms->variables['admintheme'];
$this->_UpdateGalleryDB('',1);
$galleries = $this->_GetGalleries();

$showgalleries = array();
if ( empty($galleries) )
{
	$smarty->assign('nogalleriestext', $this->lang("nogalleriestext"));
} 
else 
{
	foreach ($galleries as $gallery) 
	{
		$onerow = new stdClass();

		$onerow->id = $gallery['fileid'];
		$onerow->gidclass = $gallery['galleryid'] > 1 ? ' child-of-node-' . $gallery['galleryid'] : '';

		$onerow->file = $this->CreateLink($id, 'editgallery', $returnid, $gallery['filename'], array('gid'=>$gallery['fileid'],'mode'=>"edit"));
		$onerow->dirtag = '{Gallery' . ($gallery['filename'] == 'Gallery/' ? '}' : ' dir=\'' . substr((empty($gallery['filepath']) ? '' : $gallery['filepath'] . '/') . $gallery['filename'], 0, -1) . '\'}');

		if ( $gallery['active'] ) 
    {
			$activeimage = $themeObject->DisplayImage('icons/system/true.gif', $this->Lang('setfalse'),'','','systemicon');
		} 
    else 
    {
			$activeimage = $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('settrue'),'','','systemicon');
		}
		$onerow->activelink = $this->CreateLink($id, 'multiaction', $returnid, $activeimage, array('multiaction' => 'switchactive', 'fid' => $gallery['fileid'], 'origaction' => 'defaultadmin'));

		$onerow->editlink = $this->CreateLink($id, 'editgallery', $returnid,
		$themeObject->DisplayImage('icons/system/edit.gif', $this->Lang('editgallery'),'','','systemicon'),
		array('gid' => $gallery['fileid'],'mode'=>"edit"));

		$onerow->deletelink = $this->CreateLink($id, 'multiaction', $returnid,
				$gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'),
				array ('multiaction' => 'delete', 'fid' => $gallery['fileid'], 'origaction' => 'defaultadmin'), $this->Lang ('areyousure'));

		$onerow->imgselect = $this->CreateInputCheckbox($id, 'imgselect[' . $gallery['fileid'] . ']', 1);

		if ( is_dir('../' . DEFAULT_GALLERY_PATH . (empty($gallery['filepath']) ? '' : $gallery['filepath'] . '/') . $gallery['filename']) || $gallery['fileid'] == 1 )
		{
			array_push($showgalleries, $onerow);
		}
		else
		{
			// delete directory and all of its contents from the database
			$this->_DeleteGalleryDB((empty($gallery['filepath']) ? '' : $gallery['filepath'] . '/') . $gallery['filename'], $gallery['fileid']);
		}
	}

}

$smarty->assign_by_ref('items', $showgalleries);
$smarty->assign('itemcount', count($showgalleries));

$smarty->assign('formstart', $this->CreateFormStart ($id, 'multiaction',$returnid,'post','', false, '', array('origaction' => 'defaultadmin')));
$smarty->assign('formend', $this->CreateFormEnd());

$multiactionlist = array($this->Lang('delete') => 'delete', $this->Lang('active') => 'active', $this->Lang('inactive') => 'inactive');
$smarty->assign('prompt_multiaction', $this->Lang('withselected'));
$smarty->assign('multiaction', $this->CreateInputDropdown($id, 'multiaction', $multiactionlist, -1) . ' ' . $this->CreateInputSubmit($id, 'multiactionsubmit', $this->Lang('apply'), '', '', $this->Lang('areyousuremulti')) );

$smarty->assign('gallerypath', $this->Lang('gallerypath'));
$smarty->assign('dirtag', $this->Lang('dirtag'));
$smarty->assign('active', $this->Lang('active'));

$smarty->assign('addgallery',
	$this->CreateLink($id, 'editgallery', $returnid,
					$themeObject->DisplayImage('icons/system/newfolder.gif', $this->Lang('addsubgallery'),'','','systemicon'),
					array('gid' => -1, 'mode' => 'add')) . ' ' .
	$this->CreateLink($id, 'editgallery', $returnid,
					$this->Lang('addsubgallery'),
					array('gid' => -1, 'mode' => 'add')));


// Display the populated template
echo $this->ProcessTemplate ('admingalleries.tpl');

?>