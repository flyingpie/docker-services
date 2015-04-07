<?php
if( !isset( $gCms ) ) exit();


if( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if( !isset( $params['template'] ) )
{
	$params = array('module_error' => lang('missingparams'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin' , $returnid, $params);
	return;
}

$this->SetPreference('current_template',$params['template']);
$this->Redirect($id, 'defaultadmin' , $returnid, array('active_tab' => 'templates'));
?>