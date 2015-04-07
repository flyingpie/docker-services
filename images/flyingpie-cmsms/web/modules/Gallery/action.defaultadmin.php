<?php
if (!isset($gCms)) exit;

if ( !$this->CheckPermission('Use Gallery') ) 
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}


/*
 * The tab headers
 */
echo $this->StartTabHeaders();
$active_tab = empty($params['active_tab']) ? '' : $params['active_tab'];


echo $this->SetTabHeader('galleries',$this->Lang('galleries'), ($active_tab == 'galleries')?true:false);


if ( $this->CheckPermission('Modify Templates') )
{
	echo $this->SetTabHeader('fielddefs',$this->Lang('fielddefinitions'), ($active_tab == 'fielddefs')?true:false);
	echo $this->SetTabHeader('templates',$this->Lang('templates'), ($active_tab == 'templates')?true:false);
}

			
if ($this->CheckPermission('Modify Site Preferences'))
{
	echo $this->SetTabHeader('options',$this->Lang('options'), ($active_tab == 'options')?true:false);
}
echo $this->EndTabHeaders();


/*
 * The content of the tabs
 */
echo $this->StartTabContent();

if ( $this->CheckPermission('Use Gallery') )
{
	echo $this->StartTab('galleries', $params);
	include(dirname(__FILE__).'/function.admin_galleriestab.php');
	echo $this->EndTab();
}

if( $this->CheckPermission('Modify Templates') )
{
	echo $this->StartTab('fielddefs', $params);
	include(dirname(__FILE__).'/function.admin_fielddefstab.php');
	echo $this->EndTab();
	
	echo $this->StartTab('templates', $params);
	include(dirname(__FILE__).'/function.admin_templatestab.php');
	echo $this->EndTab();
}

if ($this->CheckPermission('Modify Site Preferences'))
{
	echo $this->StartTab('options', $params);
	include(dirname(__FILE__).'/function.admin_optionstab.php');
	echo $this->EndTab();
}

echo $this->EndTabContent();

?>