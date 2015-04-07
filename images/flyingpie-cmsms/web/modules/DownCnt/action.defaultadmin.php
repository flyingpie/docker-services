<?php

//This file is largely based on Comments module code

if (!isset($gCms)) exit;

if (!$this->CheckPermission('Manage Download Counters')) exit;

//echo $this->StartTabHeaders();   There may be tabs later

/*if( $this->CheckPermission( 'Manage Comments' ) )
{
		echo $this->SetTabHeader('comments', $this->Lang('comments'), ('comments' == $tab)?true:false);
	}*/ //gdybym kiedyœ potrzebowa³ zak³adek

//echo $this->EndTabHeaders();

//#The content of the tabs
//echo $this->StartTabContent();

//echo $this->StartTab('comments', $params);

if (isset($params['error_msg']))
{
  if ($params['error_msg'] === 'error_no_id')
    $this->ShowErrors(Array($this->Lang['error_no_id']));
}

$entryarray = array();

$query = '';
$dbresult = '';

$db = &$this->GetDb();
$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_downcnt ORDER BY lastdown_date DESC';
$dbresult = $db->Execute($query);

$rowclass = 'row1';

$message = '';
if($dbresult->RecordCount() == 0){
  $message = $this->Lang('nocountersfound');
}

while ($row = $dbresult->FetchRow())
{
  $onerow = new stdClass();

  $onerow->id = $row['id'];
  $onerow->name = $row['name'];
  $onerow->value = $row['down_cnt'];
  //$onerow->active = $row['active'] == 1 ? lang('true') : lang('false');
  $onerow->lastdate = $row['lastdown_date'];
  $onerow->rowclass = $rowclass;
  
  $img_true = $gCms->variables['admintheme']->DisplayImage('icons/system/true.gif', lang('true'),'','','systemicon');
  $img_false = $gCms->variables['admintheme']->DisplayImage('icons/system/false.gif', lang('false'),'','','systemicon');

  $onerow->activelink = $this->CreateLink($id, 'changeactive', $returnid, ($row['active']) ? $img_true : $img_false, array('cnt_id' => $row['id'], 'active' => (($row['active']) ? '0' : '1')));
  $onerow->deletelink = $this->CreateLink($id, 'delete', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang('delete'),'','','systemicon'), array('cnt_id' => $row['id']), $this->Lang('areyousure'));
  $onerow->massdeletebox = $this->CreateInputCheckbox($id, 'massdel_'.$row['id'], 'massdel_'.$row['id'], -1);

  array_push($entryarray, $onerow);

  ($rowclass == "row1") ? $rowclass = "row2" : $rowclass = "row1";
}

$this->smarty->assign('message', $message);
$this->smarty->assign('formstart', $this->CreateFormStart($id, 'massdelete', $returnid));
$this->smarty->assign('formend', $this->CreateFormEnd());
$this->smarty->assign_by_ref('items', $entryarray);
$this->smarty->assign('itemcount', count($entryarray));
$this->smarty->assign('nametext', $this->Lang('name'));
$this->smarty->assign('valuetext', $this->Lang('value'));
$this->smarty->assign('lastdatetext', $this->Lang('lastdate'));
$this->smarty->assign('activetext', $this->Lang('active'));

$this->smarty->assign('massdelbutton', $this->CreateInputSubmit($id, 'delselected', $this->Lang('delselected'), '', '', $this->Lang('areyousure2')));
		
#Display template
echo $this->ProcessTemplate('counterlist.tpl');
//echo $this->EndTab();

?>
