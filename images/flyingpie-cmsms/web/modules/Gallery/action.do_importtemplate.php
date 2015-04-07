<?php
if( !isset( $gCms ) ) exit();


if( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

$fieldName = $id . "importxml";
if ( !isset($_FILES[$fieldName]) || !isset($_FILES) || !is_array($_FILES[$fieldName]) || !$_FILES[$fieldName]['name'])
{
	$params = array('module_error' => lang('missingparams'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin' , $returnid, $params);
	return;
}
else
{
	// normalize the file variable
	$file = $_FILES[$fieldName];

	// $file['tmp_name'] is the file we have to parse
	$xml = file_get_contents($file['tmp_name']);
	$fn = '';

	require_once 'function.importtemplate.php';
	
	$this->Redirect($id, 'defaultadmin' , $returnid, array('active_tab' => 'templates'));
}
?>