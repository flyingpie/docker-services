<?php

if (!isset($gCms)) exit;


if (!isset($params['name']))
{
  //As this module is intended to be put in palce of a link's URL, javascript won't work.
  echo $this->Lang('error_insufficientparams', 'name');
}
else if (!isset($params['link']))
{
  echo $this->Lang('error_insufficientparams', 'link');
}
else //Everything is OK
{
	$db = &$this->GetDb();

	$query = 'SELECT id, down_cnt, active FROM ' . cms_db_prefix() . 'module_downcnt WHERE name = ?';
	$result = $db->Execute($query, array($params['name']));

	$row = $result->FetchRow();

	if ($row)
	{
		if ($row['active']) //Update the value only if the item is active
		{
		  $query = 'UPDATE ' . cms_db_prefix() . 'module_downcnt SET lastdown_date=' . $db->DBTimeStamp(time()) . ', down_cnt=? WHERE id = ' . $row['id'];
		  $db->Execute($query, array($row['down_cnt'] + 1));
		  
		  //echo $query;
		}
	}
	else //Row does not exist yet, we have to create it
	{
		$new_id = $db->GenID(cms_db_prefix() . 'module_downcnt_seq');
		$query = 'INSERT INTO ' . cms_db_prefix() . 'module_downcnt (id, name, lastdown_date, down_cnt, active) VALUES(' . $new_id . ', \'' . $params['name'] . '\', ' . $db->DBTimeStamp(time()) . ', 1, 1)';
		$db->Execute($query);

		//echo $query;
	}

	$link = urldecode($params['link']);
	
	$protocol = '';
	if(isset($params['protocol']) && !$params['protocol'] == '')
	{
		$protocol = $params['protocol'].'://';
	} 

	header('Location: ' . $protocol.urldecode($params['link']));
}

?>