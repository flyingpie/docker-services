<?php

if (!isset($gCms)) exit;

if (!isset($params['cnt_id']))
{
  echo $this->Lang('error_insufficientparams', 'cnt_id');
}
else if (!isset($params['active']))
{
  echo $this->Lang('error_insufficientparams', 'active');
}
else //Everything is OK
{
  $db = &$this->GetDb();

  $query = 'UPDATE ' . cms_db_prefix() . 'module_downcnt SET active=? WHERE id = ?';
  $db->Execute($query, Array(($params['active'] == 1) ? 1 : 0, $params['cnt_id']));
  $this->Redirect($id, 'defaultadmin', '', Array());
}

?>