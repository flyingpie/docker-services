<?php
$themeObject =& $gCms->variables['admintheme'];

$rowarray = array();

$db =& $this->GetDB();
$query = "SELECT
						*
					FROM
						" . cms_db_prefix() . "module_gallery_fielddefs
					ORDER BY
						dirfield DESC, sortorder ASC";
$result = $db->GetAll($query);
$rowcount = count($result);

if ( $result && $rowcount > 0 )
{
	$rowclass = 'row1';
	foreach ( $result as $key => $def )
	{
		$row = new StdClass();
		$row->fieldid = $def['fieldid'];
		$row->name = $this->CreateLink($id, 'editfielddef', $returnid, $def['name'], array('fieldid' => $def['fieldid'], 'mode'=>'edit'));
		$row->alias = strtolower(str_replace(' ', '_', $def['name']));
		$row->type = $this->Lang($def['type']);
		$row->dirfield = $def['dirfield'];
		$row->public = $def['public'] ? $themeObject->DisplayImage('icons/system/true.gif', $this->Lang('true'),'','','systemicon') : $themeObject->DisplayImage('icons/system/false.gif', $this->Lang('false'),'','','systemicon');
		$row->newtable = 0;
		if( $key > 0 && $def['sortorder'] <= $result[$key-1]['sortorder'] )
		{
			$row->newtable = 1;
			$rowclass = 'row1';
		}
		$row->rowclass = $rowclass;
		if ( $def['sortorder'] > 1 )
		{
			$row->moveup = $this->CreateLink($id, 'editfielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/arrow-u.gif', $this->Lang('up'),'','','systemicon'), array('fieldid' => $def['fieldid'], 'mode'=>'moveup'));
		}
		else
		{
			$row->moveup = '';
		}
		if ( $key < $rowcount - 1 && $result[$key+1]['sortorder'] != 1 )
		{
			$row->movedown = $this->CreateLink($id, 'editfielddef', $returnid, $gCms->variables['admintheme']->DisplayImage('icons/system/arrow-d.gif', $this->Lang('up'),'','','systemicon'), array('fieldid' => $def['fieldid'], 'mode'=>'movedown'));
		}
		else
		{
			$row->movedown = '';
		}
		$row->editlink = $this->CreateLink($id, 'editfielddef', $returnid,
				    $gCms->variables['admintheme']->DisplayImage ('icons/system/edit.gif', $this->Lang ('edit'), '', '', 'systemicon'),
				    array ('fieldid' => $def['fieldid'], 'mode'=>'edit'));
		$row->deletelink = $this->CreateLink($id, 'editfielddef', $returnid,
					  $gCms->variables['admintheme']->DisplayImage('icons/system/delete.gif', $this->Lang ('delete'), '', '', 'systemicon'),
					  array ('fieldid' => $def['fieldid'], 'mode'=>'delete'), $this->Lang ('areyousure'));

		array_push ($rowarray, $row);
		($rowclass == "row1" ? $rowclass = "row2" : $rowclass = "row1");
	}
}
if ( $result === FALSE )
{
	echo 'ERROR: ' . mysql_error();
	exit();
}

$smarty->assign('items', $rowarray );
$smarty->assign('galleries', ucwords($this->Lang('galleries')));
$smarty->assign('images', ucwords($this->Lang('images')));
$smarty->assign('fielddef', $this->Lang('fielddefinition'));
$smarty->assign('alias', $this->Lang('alias'));
$smarty->assign('type', $this->Lang('type'));
$smarty->assign('public', $this->Lang('public'));

$smarty->assign('newfielddeflink',
	  $this->CreateLink($id, 'editfielddef', $returnid,
			     $gCms->variables['admintheme']->DisplayImage('icons/system/newfolder.gif', $this->Lang('addfielddef'),'','','systemicon'),
			     array('mode' => 'add'), '', false, false, '').' '.

	  $this->CreateLink($id, 'editfielddef', $returnid,
			     $this->Lang('addfielddef'),
			     array('mode' => 'add')));

$smarty->assign('formstart', $this->CreateFormStart ($id, 'editfielddef', $returnid, 'post'));
$smarty->assign('formend',$this->CreateFormEnd());

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang ('cancel')));


echo $this->ProcessTemplate('adminfielddefs.tpl');

?>