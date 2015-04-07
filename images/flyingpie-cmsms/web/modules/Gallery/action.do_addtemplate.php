<?php
if ( !$gCms ) exit();

if ( isset($params['cancel']) )
{
	$params = array('active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
}

if ( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if ( empty($params['template']) )
{
	$params = array('module_error' => lang('errorgettingtemplatename'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
	return;
}

if ( empty($params['templatecontent']) )
{
	$params = array('module_error' => lang('invalidcode'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
	return;
}

$params['template'] = trim($params['template']);

// check if this template already exists
$txt = trim($this->GetTemplate($params['template']));
if( $txt != "" )
{
	$params = array('module_error' => lang('templateexists'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
	return;
}

// save template
$this->SetTemplate($params['template'], $params['templatecontent'].TEMPLATE_SEPARATOR.$params['templatecss'].TEMPLATE_SEPARATOR.$params['templatejs'].'*}' );

// save css-file
$handle = fopen('../modules/Gallery/templates/css/' . $params['template'] . '.css','w');
fwrite($handle,$params['templatecss']);
fclose($handle);

// save templateproperties
if ( $params['thumbwidth'] <= 0 || $params['thumbheight'] <= 0 )
{
	$params['thumbwidth'] = NULL;
	$params['thumbheight'] = NULL;
	$params['resizemethod'] = NULL;
}
$params['maxnumber'] = $params['maxnumber'] > 0 ? $params['maxnumber'] : NULL;

// join sortpreferences to string
$params['sortitems'] = '';
foreach($params['sortfield'] as $key=>$sortfield)
{
	$params['sortitems'] .= !empty($sortfield) ? str_replace('#',$params['sorttype'][$key],$sortfield).'/' : '';
}
$params['sortitems'] = substr($params['sortitems'],0,-1);

$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_templateprops
		(template,version,about,thumbwidth,thumbheight,resizemethod,maxnumber,sortitems,visible)
		VALUES (?,?,?,?,?,?,?,?,1)";
$result = $db->Execute($query, array($params['template'],$params['version'],$params['about'],$params['thumbwidth'],$params['thumbheight'],$params['resizemethod'],$params['maxnumber'],$params['sortitems']));
if ( !$result )
{
	echo 'ERROR: ' . mysql_error();
	exit();
}

$params = array('tab_message'=> 'templateadded', 'active_tab' => 'templates');
$this->Redirect($id, 'defaultadmin', '', $params);
?>