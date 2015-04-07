<?php

if (!isset($gCms)) exit;

$db = &$gCms->GetDb();

$taboptarray = array('mysql' => 'TYPE=MyISAM');

$dict = NewDataDictionary($db);

$flds = "
    id I KEY,
    name C(255),
    lastdown_date DT,
    down_cnt I,
    active I1
";


$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_downcnt", $flds, $taboptarray);

$dict->ExecuteSQLArray($sqlarray);

$db->CreateSequence(cms_db_prefix()."module_downcnt_seq");

$this->CreatePermission('Manage Download Counters', 'Manage Download Counters');

// put mention into the admin log
$this->Audit( 0,
	      $this->GetFriendlyName(),
	      $this->Lang('installed', $this->GetVersion()) );

?>