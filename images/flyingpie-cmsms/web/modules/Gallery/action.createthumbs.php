<?php

if( !$gCms ) exit();

if( !$this->CheckPermission('Use Gallery') ) 
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

if( !isset($params['gid']) )
  {
    $params['module_error'] = lang('missingparams');
    $this->Redirect($id,'defaultadmin','',$params);
    return;
  }

$galleryinfo = $this->_Getgalleryinfobyid($params['gid']);
$gallerypath = $params['gid'] == 1 ? '' : trim($galleryinfo['filepath'] . '/' . $galleryinfo['filename'],'/');

$gallery = $this->_Getgalleryfiles($gallerypath);
foreach ($gallery as $file) 
{
	if( substr($file['filename'],-1) != '/' )
	{
		$thumbname = '../' . DEFAULT_GALLERYTHUMB_PATH . $file['fileid'] . '-' . $params['templateid'] . substr($file['filename'], strrpos($file['filename'], '.')) ;

		$this->_CreateThumbnail($thumbname, 
		                        '../' . DEFAULT_GALLERY_PATH . (empty($file['filepath']) ? '' : $file['filepath'] . '/') . $file['filename'], 
		                        $galleryinfo['thumbwidth'], 
		                        $galleryinfo['thumbheight'], 
		                        $galleryinfo['resizemethod']);
	}
}

$this->Redirect($id,'editgallery','',array('gid'=>$params['gid'],'mode'=>"edit",'module_message'=>$this->Lang('thumbscreated')));

?>