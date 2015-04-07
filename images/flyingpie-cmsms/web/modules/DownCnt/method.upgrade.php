<?php

if (!isset($gCms)) exit;


$db =& $gCms->GetDb();

$current_version = $oldversion;

switch($current_version)
{
  case '1.0.0':
  case '1.1.0':
  case '1.1.1':
}

// put mention into the admin log
$this->Audit( 0, $this->GetFriendlyName(), $this->Lang('upgraded', $this->GetVersion()));
?>