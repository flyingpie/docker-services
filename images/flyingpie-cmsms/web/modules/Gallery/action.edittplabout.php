<?php
if( !$gCms ) exit();

if( isset($params['cancel']) )
{
	$params = array('active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
}

if( ! $this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if( !isset($params['mode']) || !isset($params['template']) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
	return;
}

$templateprops = $this->_GetTemplateprops($params['template']);

if( $params['mode'] == 'show' )
{
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'edittplabout',$returnid,'post','', false, '', array('template'=>$params['template'], 'mode'=>"edit")));
	$smarty->assign('templatename', $params['template']);
	$smarty->assign('version', $templateprops['version']);
	$smarty->assign('about', $templateprops['about']);
	$smarty->assign('submit',$this->CreateInputSubmit ($id, 'editbutton', $this->Lang('edit')));
}
elseif ( $params['mode'] == 'edit' )
{
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'edittplabout',$returnid,'post','', false, '', array('template'=>$params['template'], 'mode'=>"do_edit")));
	$smarty->assign('templatename', $params['template']);
	$smarty->assign('version', $this->CreateInputText( $id, 'version', $templateprops['version'], 10, 20 ));
	$smarty->assign('about', $this->CreateTextArea(true, $id, $templateprops['about'], 'about', '', '', '', '', '80', '15'));
	$smarty->assign('submit',$this->CreateInputSubmit ($id, 'submitbutton', $this->Lang('submit')));
}
else
{
	// do_edit
	$query = "UPDATE " . cms_db_prefix() . "module_gallery_templateprops
						SET version=?, about=?
						WHERE template=?";
	$result = $db->Execute($query, array($params['version'],$params['about'],$params['template']));
	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}
	$this->Redirect($id, 'edittplabout', '', array('template'=>$params['template'], 'mode'=>"show", 'module_message'=>$this->Lang('templateupdated')));
	exit();
}

$smarty->assign('title',$this->Lang('prompt_about'));
$smarty->assign('prompt_templatename',$this->Lang('prompt_templatename'));
$smarty->assign('prompt_version',$this->Lang('prompt_version'));
$smarty->assign('prompt_about',$this->Lang('prompt_about'));

$smarty->assign('cancel',$this->CreateInputSubmit ($id, 'cancel', $this->Lang('cancel')));

$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('edittplabout.tpl');

?>