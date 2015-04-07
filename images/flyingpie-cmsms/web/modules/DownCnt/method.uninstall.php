<?php

if (!isset($gCms)) exit;

$db = &$gCms->GetDb();

// remove the database table
$dict = NewDataDictionary($db);
$sqlarray = $dict->DropTableSQL(cms_db_prefix()."module_downcnt");
$dict->ExecuteSQLArray($sqlarray);

// remove the sequence
$db->DropSequence(cms_db_prefix()."module_downcnt_seq");

// remove the permissions
$this->RemovePermission('Manage Download Counters');

// put mention into the admin log
$this->Audit( 0, $this->GetFriendlyName(), $this->Lang('uninstalled'));

?>