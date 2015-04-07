<?php

if (!isset($gCms)) exit;


if (!$this->CheckPermission('Manage Comments'))
{
  echo '<p class="error">'.$this->Lang('needpermission', array('Manage DownloadCounters')).'</p>';
  return;
}

$query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt WHERE';

foreach ($params as $param)
{
  echo $param . '<br>';
  if(strpos('_' . $param, 'massdel_'))
  {
    $id = substr($param, 8);
    $query .= ' id = ' . $id . ' OR';
  }
}

$query = substr($query, 0, -3);

$result = $db->Execute($query);

$this->Redirect($id, 'defaultadmin', '', array('tab_message' => 'counters_deleted'));

?>
