<?php
if( !isset( $gCms ) ) exit();

if( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

if( !isset($params['template']) )
{
	$params = array('module_error'=> lang('missingparams'), 'active_tab' => 'templates');
  $this->Redirect($id, 'defaultadmin' , $returnid, $params);
	return;
}

// get template
$templatecode = $this->GetTemplate($params['template']);
$templatearr = explode(TEMPLATE_SEPARATOR, $templatecode);
$tplcode = $templatearr[0];
$tplcss = $templatearr[1];
$tpljs = substr($templatearr[2],0,-2);
$templateprops = $this->_GetTemplateprops($params['template']);


// get a file list
function Gettplfiles($root,$path)
{
	$output = array();
	if ( $handle = opendir(str_replace('/',DIRECTORY_SEPARATOR,$root . $path)) )
	{
		while ( false !== ($file = readdir($handle)) )
		{
			if ( $file != "." && $file != ".." )
			{
				if ( is_dir($root . $path . $file) )
				{
					$output[] = array(
						'filename' => $path . $file . "/",
						'isdir' => 1
					);
					$output = array_merge($output,Gettplfiles($root, $path . $file . "/"));
				}
				else
				{
					$output[] = array(
						'filename' => $path . $file,
						'isdir' => 0
					);
				}
			}
		}
		closedir($handle);
	}
	return $output;
}

$filecount = 0;
$dir = "../modules/Gallery/templates/" . $params['template'];
$dir = is_dir($dir) ? $dir : "../modules/Gallery/templates/" . strtolower($params['template']);
$files = Gettplfiles($dir, "/");

$xmltxt  = '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n";
$xmltxt .= "<gallerytpl>\n";
$xmltxt .= "	<name>".$params['template']."</name>\n";
$xmltxt .= "	<version>".$templateprops['version']."</version>\n";
$xmltxt .= "	<galleryversion>".$this->GetVersion()."</galleryversion>\n";
$xmltxt .= "	<about>".base64_encode($templateprops['about'])."</about>\n";
$xmltxt .= "	<thumbwidth>".$templateprops['thumbwidth']."</thumbwidth>\n";
$xmltxt .= "	<thumbheight>".$templateprops['thumbheight']."</thumbheight>\n";
$xmltxt .= "	<resizemethod>".$templateprops['resizemethod']."</resizemethod>\n";
$xmltxt .= "	<maxnumber>".$templateprops['maxnumber']."</maxnumber>\n";
$xmltxt .= "	<sortitems>".$templateprops['sortitems']."</sortitems>\n";
$xmltxt .= "	<tplcode>".base64_encode($tplcode)."</tplcode>\n";
$xmltxt .= "	<tplcss>".base64_encode($tplcss)."</tplcss>\n";
$xmltxt .= "	<tpljs>".base64_encode($tpljs)."</tpljs>\n";

foreach( $files as $file )
{
	$xmltxt .= "	<file>\n";
	$xmltxt .= "	  <filename>" . $file['filename'] . "</filename>\n";
	$xmltxt .= "	  <isdir>" . $file['isdir'] . "</isdir>\n";
	if ( !$file['isdir'] )
	{
		$data = base64_encode(file_get_contents($dir . $file['filename']));
		$xmltxt .= "	  <data><![CDATA[".$data."]]></data>\n";
	}
	$xmltxt .= "	</file>\n";
	++$filecount;
}
$xmltxt .= "</gallerytpl>\n";

$message = 'XML package of ' . strlen($xmltxt) . ' bytes created for Gallery template ' . $params['template'];
$message .= ' including ' . $filecount . ' files';

$xmlname = 'Gallery-tpl-' . $params['template'] . '.xml';

// send the file
ob_end_clean();
ob_end_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename='.$xmlname);
echo $xmltxt;
exit();

?>