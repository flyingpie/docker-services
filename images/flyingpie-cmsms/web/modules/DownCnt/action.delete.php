<?php

if (!isset($gCms)) exit;

if (!$this->CheckPermission('Manage Download Counters'))
{
  echo '<p class="error">' . $this->Lang('needpermission', array('Manage Download Counters')) . '</p>';
  return;
}

if (!isset($params['cnt_id']))
{
  echo $this->Lang('error_insufficientparams', 'cnt_id');
}
else
{
  //Now remove the counter
  $query = 'DELETE FROM ' . cms_db_prefix() . 'module_downcnt WHERE id = ?';
  $db->Execute($query, array($params['cnt_id']));

  $this->Redirect($id, 'defaultadmin', '', Array('tab_message' => 'counter_deleted'));
}

?>
