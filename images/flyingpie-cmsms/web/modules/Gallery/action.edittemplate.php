<?php
if( !$gCms ) exit();

if( !$this->CheckPermission('Modify Templates') || !$this->CheckPermission('Use Gallery') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery\'/\'Modify Templates'));
	return;
}

if( !isset($params['mode']) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
	return;
}

if( $params['mode'] == 'switchactive' )
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery_templateprops SET visible = visible^1 WHERE templateid = ?";
	$db->Execute($query, array($params['templateid']));
	$this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates'));
	return;
}

$params['origaction'] = $params['action'];
$templateprops = array('templateid'=>0, 'version'=>"1.0", 'about'=>"", 'thumbwidth'=>"", 'thumbheight'=>"", 'resizemethod'=>"", 'maxnumber'=>"", 'sortitems'=>"");
$contents = "";
if( $params['mode'] == 'add' )
{
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_addtemplate',$returnid,'post','', false, '', $params));
	$smarty->assign('templatename', $this->CreateInputText( $id, 'template', "", 40 ));
	if( isset($params['defaulttemplatepref']) && $params['defaulttemplatepref'] != '' )
	{
		$contents = $this->GetPreference($params['defaulttemplatepref']);
	}
	if( isset($params['template']) && $params['template'] != '' )
	{
		$contents = $this->GetTemplate($params['template']);
		$templateprops = $this->_GetTemplateprops($params['template']);
	}
}
else 
{
	if( !isset($params['template']) )
	{
		$params['module_error'] = lang('missingparams');
		$this->Redirect($id,'defaultadmin','',$params);
		return;
	}
	$smarty->assign('formstart', $this->CreateFormStart ($id, 'do_edittemplate',$returnid,'post','', false, '', $params));
	$smarty->assign('templatename',$params['template']);
	$contents = $this->GetTemplate($params['template']);
	$templateprops = $this->_GetTemplateprops($params['template']);
}

$smarty->assign('hidden',
		$this->CreateInputHidden($id, 'templateid', $templateprops['templateid']) .
		$this->CreateInputHidden($id, 'version', $templateprops['version']) .
		$this->CreateInputHidden($id, 'about', $templateprops['about'])
);

$smarty->assign('prompt_thumbnailsize', $this->Lang('thumbnailsize'));
$resizemethodlist = array($this->Lang('crop')=>'cr',$this->Lang('scale')=>'sc',$this->Lang('zoomcrop')=>'zc',$this->Lang('zoomscale')=>'zs');
$smarty->assign('thumbnailsize',
		$this->Lang('leaveempty') . '<br />' .
		$this->Lang('width') . ':&nbsp;' .
		$this->CreateInputText( $id, 'thumbwidth', $templateprops['thumbwidth'], 4, 4 ) .
		'&nbsp;&nbsp;&nbsp;' . $this->Lang('height') . ':&nbsp;' .
		$this->CreateInputText( $id, 'thumbheight', $templateprops['thumbheight'], 4, 4 ) .
		'&nbsp;&nbsp;&nbsp;' . $this->Lang('resizemethod') . ':&nbsp;' .
		$this->CreateInputDropdown($id, 'resizemethod', $resizemethodlist, -1, $templateprops['resizemethod'])
);

$sortfieldlist = array(' -'=>'','filename'=>'s#file', 'filedate'=>'s#filedate', 'title'=>'s#title', 'titlename'=>'s#titlename', 'comment'=>'s#comment', 'subgallery (true/false)'=>'n#isdir', 'active (true/false)'=>'n#active');
$sorttypelist = array($this->Lang('ascending')=>'+',$this->Lang('descending')=>'-');
$sortitems = explode('/',$templateprops['sortitems']);
$sortfields = '';
foreach ($sortitems as $sortitem)
{
	$sortfields .= '<p class="sortfield">' .
	$this->CreateInputDropdown($id, 'sortfield[]', $sortfieldlist, -1, substr($sortitem,0,1) . '#' . substr($sortitem,2)) . '&nbsp; ' .
	$this->CreateInputDropdown($id, 'sorttype[]', $sorttypelist, -1, substr($sortitem,1,1)) .
	'</p>';
}
$smarty->assign('prompt_sortingoptions', $this->Lang('sortingoptions'));
$smarty->assign('sortingoptions', '<p>' . $this->Lang('specifysortfields') . '</p>' .
	'<div id="sortfields">' . $sortfields . '</div>
	<p><a href="#" id="addfield">' . $this->Lang('addfield') . '</a>&nbsp;&nbsp;&nbsp;<a href="#" id="deletefield">' . $this->Lang('deletefield') . '</a></p>'
);

$contentscode = explode(TEMPLATE_SEPARATOR, $contents);

$smarty->assign('title',$this->Lang('title_template'));
$smarty->assign('prompt_templatename',$this->Lang('prompt_templatename'));
$smarty->assign('prompt_template',$this->Lang('prompt_template'));
$smarty->assign('template', $this->CreateSyntaxArea ($id, $contentscode[0], 'templatecontent'));

$smarty->assign('prompt_maxnumber',$this->Lang('maxnumber'));
$smarty->assign('maxnumber', $this->CreateInputText( $id, 'maxnumber', $templateprops['maxnumber'], 4, 10 ));
$smarty->assign('showallimages',$this->Lang('showallimages'));

$smarty->assign('availablevariables',$this->Lang('availablevariables'));
$smarty->assign('availablevariableslist',$this->Lang('availablevariableslist'));
$smarty->assign('availablevariableslink',$gCms->variables['admintheme']->DisplayImage('icons/system/info.gif', $this->Lang('availablevariables'),'','','systemicon'));

$smarty->assign('prompt_templatecss',$this->Lang('prompt_templatecss'));
$smarty->assign('templatecss', $this->CreateSyntaxArea ($id, str_replace("*}", "", $contentscode[1]), 'templatecss'));
$smarty->assign('prompt_templatejs',$this->Lang('prompt_templatejs'));
$smarty->assign('templatejs', $this->CreateSyntaxArea ($id, substr($contentscode[2],0,-2), 'templatejs'));

$smarty->assign('submit',$this->CreateInputSubmit ($id, 'submitbutton', $this->Lang('submit')));
$smarty->assign('apply',$params['mode'] == 'add' ? '' : $this->CreateInputSubmit($id, 'applybutton', $this->Lang('apply')));
$smarty->assign('cancel',$this->CreateInputSubmit ($id, 'cancel', $this->Lang('cancel')));
$smarty->assign('reset',$params['mode'] != 'add' && file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'Gallery-tpl-'.$params['template'].'.xml') ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->CreateInputSubmit($id, 'resetbutton', $this->Lang('resetoriginal'), '', '', $this->Lang('resetoriginalwarning')) : '');

$smarty->assign('formend',$this->CreateFormEnd());

echo $this->ProcessTemplate('edittemplate.tpl');

?>