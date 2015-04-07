<?php
#-------------------------------------------------------------------------
# Module: Gallery
# Method: Uninstall
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/gallery/
#-------------------------------------------------------------------------

if (!isset($gCms)) exit;


$db =& $gCms->GetDb();

// remove the database tables
$dict = NewDataDictionary( $db );
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery_props" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery_fielddefs" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery_fieldvals" );
$dict->ExecuteSQLArray($sqlarray);
$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery_templateprops" );
$dict->ExecuteSQLArray($sqlarray);

// remove the permissions
$this->RemovePermission('Use Gallery');
$this->RemovePermission('Set Gallery Prefs');

// remove all preferences
$this->RemovePreference();

// remove all templates
$this->DeleteTemplate();

// remove the events
//$this->RemoveEvent( 'OnGalleryPreferenceChange' );
$this->RemoveEventHandler( 'Core', 'ContentPostRender' );

// put mention into the admin log
$this->Audit( 0, $this->Lang('friendlyname'), $this->Lang('uninstalled'));

?>