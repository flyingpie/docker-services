<?php

$falseimage1 = $themeObject->DisplayImage('icons/system/false.gif',$this->Lang ('settrue'),'','','systemicon');
$trueimage1 = $themeObject->DisplayImage('icons/system/true.gif',$this->Lang ('default'),'','','systemicon');
$falseimage2 = $themeObject->DisplayImage('icons/system/false.gif',$this->Lang ('makevisible'),'','','systemicon');
$trueimage2 = $themeObject->DisplayImage('icons/system/true.gif',$this->Lang ('makeinvisible'),'','','systemicon');

$alltemplates = $this->ListTemplates();
$current_template = $this->GetPreference('current_template');
$singleimg_template = $this->GetPreference('singleimg_template');
$rowarray = array();
$rowclass = 'row1';

foreach( $alltemplates as $tpl )
{
	$tplprops = $this->_GetTemplateprops($tpl);
	$row = new StdClass();
	$row->name = $this->CreateLink($id, 'edittemplate', $returnid, $tpl, array('template' => $tpl, 'mode'=>'edit'));
	$row->version = $tplprops['version'];
	$row->about = $this->CreateLink($id, 'edittplabout', $returnid, $this->Lang('prompt_about'), array('template' => $tpl, 'mode'=>'show'));
	$row->rowclass = $rowclass;
	
	if( $tpl == $current_template )
	{
		$row->default = $trueimage1;
	}
	else
	{
		$row->default = $this->CreateLink($id, 'switchdefaulttemplate', $returnid,
				       $falseimage1,
				       array('template'=>$tpl));
	}

	$row->visible = $this->CreateLink($id, 'edittemplate', $returnid,
				    ($tplprops['visible'] ? $trueimage2 : $falseimage2),
				    array('mode' => 'switchactive', 'templateid'=>$tplprops['templateid']));

	$row->editlink = $this->CreateLink($id, 'edittemplate', $returnid,
				    $gCms->variables['admintheme']->DisplayImage ('icons/system/edit.gif', $this->Lang ('edit'), '', '', 'systemicon'),
				    array ('template' => $tpl, 'mode'=>'edit'));
	
	$row->copylink = $this->CreateLink($id, 'edittemplate', $returnid,
				    $gCms->variables['admintheme']->DisplayImage ('icons/system/copy.gif', $this->Lang ('copy'), '', '', 'systemicon'),
				    array ('template' => $tpl, 'mode'=>'add'));
	
	if( $tpl == $current_template || $tpl == $singleimg_template )
	{
		$row->deletelink = '&nbsp;';
	}
	else
	{
		$row->deletelink = $this->CreateLink($id, 'deletetemplate', $returnid,
					  $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'),
					  array ('template' => $tpl), $this->Lang ('areyousure'));
	}

	$row->export = $this->CreateLink($id, 'do_exporttemplate', $returnid,
				    '<img src="../images/cms/xml_rss.gif" alt="XML" />',
				    array('template' => $tpl));

	array_push ($rowarray, $row);
	($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
}

$smarty->assign('items', $rowarray );
$smarty->assign('nameprompt', $this->Lang('prompt_name'));
$smarty->assign('versionprompt', $this->Lang('prompt_version'));
$smarty->assign('aboutprompt', $this->Lang('prompt_about'));
$smarty->assign('defaultprompt', $this->Lang('prompt_default'));
$smarty->assign('visibleprompt', $this->Lang('prompt_visible'));

$smarty->assign('newtemplatelink',
	  $this->CreateLink($id, 'edittemplate', $returnid,
			     $gCms->variables['admintheme']->DisplayImage('icons/system/newobject.gif', $this->Lang('prompt_newtemplate'),'','','systemicon'),
			     array('mode' => 'add', 'defaulttemplatepref' => 'default_template_contents'), '', false, false, '').' '.

	  $this->CreateLink($id, 'edittemplate', $returnid,
			     $this->Lang('prompt_newtemplate'),
			     array('mode' => 'add', 'defaulttemplatepref' => 'default_template_contents')));



$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_importtemplate', $returnid, 'post', 'multipart/form-data', false));
$smarty->assign('formend',$this->CreateFormEnd());

$smarty->assign('title_importxml',$this->Lang('title_importxml'));
$smarty->assign('importxmlnote',nl2br($this->Lang('importxmlnote')));
$smarty->assign('prompt_importxml',$this->Lang('importxml'));
$smarty->assign('importxml', $this->CreateInputFile( $id, 'importxml', 'text/xml', 30));
$smarty->assign('prompt_overwrite',$this->Lang('overwrite'));
$smarty->assign('overwrite', $this->CreateInputCheckbox($id, 'overwrite', '1', '1'));
$smarty->assign('submit', $this->CreateInputSubmit ($id, 'importsubmitbutton', $this->Lang('submit')));



$smarty->assign('formstart2', $this->CreateFormStart ($id, 'do_editsingleimgtemplate', $returnid, 'post', 'multipart/form-data', false));
$smarty->assign('formend2',$this->CreateFormEnd());

$smarty->assign('title_singleimg_template',$this->Lang('title_singleimg_template'));

$templatelist = array();
$query = "SELECT templateid, template FROM ".cms_db_prefix()."module_gallery_templateprops ORDER BY template ASC";
$result = $db->Execute($query);
while ($result && $row = $result->FetchRow())
{
	$templatelist[$row['template']] = $row['template'];
}
$smarty->assign('prompt_singleimg_template',$this->Lang('template'));
$smarty->assign('singleimg_template', $this->CreateInputDropdown($id, 'singleimg_template', $templatelist, -1, $singleimg_template));
$smarty->assign('prompt_singleimg_template_html',$this->Lang('prompt_template'));
$smarty->assign('singleimg_template_html', $this->CreateSyntaxArea ($id, $this->GetPreference('singleimg_template_html'), 'singleimg_template_html', '', '', '', '', 80, 5, 'style="height:70px;"'));
$availablevariableslist = explode('{$images}', $this->Lang('availablevariableslist'));
$smarty->assign('availablevariables',$this->Lang('availablevariables'));
$smarty->assign('availablevariableslist', '<code>{$image}' . $availablevariableslist[1]);
$smarty->assign('availablevariableslink',$gCms->variables['admintheme']->DisplayImage('icons/system/info.gif', $this->Lang('availablevariables'),'','','systemicon'));

$smarty->assign('submit2', $this->CreateInputSubmit ($id, 'submitbutton', $this->Lang('submit')));


echo $this->ProcessTemplate('admintemplates.tpl');

?>