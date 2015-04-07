<?php

if( ! $this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if( !(isset($params['template'])) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
}

$template = cms_html_entity_decode($params['template']);
$this->DeleteTemplate($template);

// delete css-file
if( file_exists('../modules/Gallery/templates/css/' . $template . '.css') )
{
    unlink('../modules/Gallery/templates/css/' . $template . '.css');
}

// delete template folder and content
function deleteDirectory($dir)
{
	$deletefiles = glob($dir . '*', GLOB_MARK);
	foreach($deletefiles as $file)
	{
		if ( substr($file, -1) == DIRECTORY_SEPARATOR )
			deleteDirectory($file);
		else
			unlink($file);
	}
	if (is_dir($dir)) rmdir($dir);
}
deleteDirectory(str_replace('/', DIRECTORY_SEPARATOR, '../modules/Gallery/templates/' . strtolower($template) . '/'));

// delete templateproperties
$query = "DELETE FROM " . cms_db_prefix() . "module_gallery_templateprops WHERE template=?";
$result = $db->Execute($query, array($template));

// set assigned galleries to default-template
$query = "UPDATE " . cms_db_prefix() . "module_gallery_props SET templateid=? WHERE template=?";
$result = $db->Execute($query, array(0, $template));

$params = array('tab_message'=> 'templatedeleted', 'active_tab' => 'templates');
$this->Redirect($id, 'defaultadmin', '', $params);

?>