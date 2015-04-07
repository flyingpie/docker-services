<?php

if (!isset($gCms)) exit;

if (!isset($params['name']))
{
  echo '[' . $this->Lang('error_insufficientparams', 'name') . ']';
}
else //Parameter is OK
{
  $db = &$this->GetDb();

  $query = 'SELECT down_cnt FROM ' . cms_db_prefix() . 'module_downcnt WHERE name = ?';
  $result = $db->Execute($query, array($params['name']));

  $row = $result->FetchRow();

  if ($row)
  {
    echo $row['down_cnt'];
  }
  else //Row does not exist (the link has never been clicked before)
  {
    echo '0';
  }
}

?>