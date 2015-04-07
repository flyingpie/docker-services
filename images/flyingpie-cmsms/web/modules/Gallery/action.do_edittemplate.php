<?php
if( !isset( $gCms ) ) exit();

if( isset($params['cancel']) )
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

if ( isset($params['resetbutton']) )
{
	$fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'Gallery-tpl-'.$params['template'].'.xml';
	if( file_exists( $fn ) )
	{
		$xml = @file_get_contents($fn);
		$params['overwrite'] = 1;
		require_once 'function.importtemplate.php';
	}
}
else
{
	// save template
	$this->SetTemplate($params['template'], $params['templatecontent'].TEMPLATE_SEPARATOR.$params['templatecss'].TEMPLATE_SEPARATOR.$params['templatejs'].'*}' );

	// save css-file
	if ( empty($params['templatecss']) )
	{
		@unlink('../modules/Gallery/templates/css/' . $params['template'] . '.css');
	}
	else
	{
		$handle = fopen('../modules/Gallery/templates/css/' . $params['template'] . '.css','w');
		fwrite($handle,$params['templatecss']);
		fclose($handle);
	}

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

	$query = "UPDATE " . cms_db_prefix() . "module_gallery_templateprops
			SET version=?,about=?,thumbwidth=?,thumbheight=?,resizemethod=?,maxnumber=?,sortitems=?
			WHERE template=?";
	$result = $db->Execute($query, array($params['version'],$params['about'],$params['thumbwidth'],$params['thumbheight'],$params['resizemethod'],$params['maxnumber'],$params['sortitems'],$params['template']));
	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}
}
	
if ( isset($params['applybutton']) || isset($params['resetbutton']) )
{
	$params = array('template' => $params['template'], 'mode' => "edit", 'module_message' => $this->Lang('templateupdated'));
	$this->Redirect($id, 'edittemplate', '', $params);
}
else
{
	$params = array('tab_message'=> 'templateupdated', 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin', '', $params);
}
?>