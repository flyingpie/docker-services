<?php
if (!isset($gCms)) exit;

// Check permissions
if( !$this->CheckPermission('Use Gallery') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

$file_id = isset($params['fid']) ? $params['fid'] : '';
$gallery = isset($params['gid']) ? $params['gid'] : '';

$galleryinfo = $this->_Getgalleryinfobyid($gallery);

$query = "UPDATE " . cms_db_prefix() . "module_gallery SET defaultfile = ? WHERE fileid = ?";
$db->Execute($query, array($file_id,$gallery));

// Also change albumcovers of parentgalleries
if ( $galleryinfo['defaultfile'] != 0 )
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery SET defaultfile = ? WHERE defaultfile = ? AND fileid < ?";
	$db->Execute($query, array($file_id,$galleryinfo['defaultfile'],$gallery));
}

$this->Redirect($id, 'editgallery' , $returnid, $params);

?>