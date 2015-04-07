<?php
if( !isset( $gCms ) ) exit();


if( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if ( empty($params['singleimg_template']) || empty($params['singleimg_template_html']) )
{
	$params = array('module_error' => lang('missingparams'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
	return;
}

$this->SetPreference("singleimg_template", $params['singleimg_template']);
$this->SetPreference("singleimg_template_html", $params['singleimg_template_html']);

$this->Redirect($id, 'defaultadmin' , $returnid, array('tab_message' => 'templateupdated', 'active_tab' => 'templates'));
?>