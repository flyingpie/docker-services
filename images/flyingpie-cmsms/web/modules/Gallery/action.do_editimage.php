<?php
if( !isset( $gCms ) ) exit();

if( !$this->CheckPermission('Use Gallery') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

if( !isset($params['fid']) )
{
	if( isset($params['gid']) )
	{
		$params = array('gid' => $params['gid'], 'mode' => 'edit', 'module_error' => lang('missingparams'));
		$this->Redirect($id,'editgallery','',$params);
	}
	else
	{
		$params = array('active_tab' => 'galleries');
		$this->Redirect($id, 'defaultadmin', '', $params);
	}
	return;
}

if( isset($params['cancel']) )
{
	$params = array('gid' => $params['gid'], 'mode' => 'edit');
	$this->Redirect($id,'editgallery','',$params);
}

// update image details
$filetitle = isset($params['filetitle']) ? $params['filetitle'] : '';
$filecomment = isset($params['filecomment']) ? $params['filecomment'] : '';
if( isset($params['filedate']) )
{
	$checkdate = explode('-', $params['filedate']);
	$filedate = checkdate($checkdate[1], $checkdate[2], $checkdate[0]) ? $params['filedate'] : '';
}
if( !empty($filedate) )
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filedate = ?, title = ?, comment = ? WHERE fileid = ?";
	$result = $db->Execute($query, array($filedate, $filetitle, $filecomment, $params['fid']));
}
else
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery SET title = ?, comment = ? WHERE fileid = ?";
	$result = $db->Execute($query, array($filetitle, $filecomment, $params['fid']));
}

if ( !$result )
{
	echo 'ERROR: ' . mysql_error();
	exit();
}

// save custom fields
$query = "DELETE FROM " . cms_db_prefix() . "module_gallery_fieldvals WHERE fileid = ?";
$result = $db->Execute($query, array($params['fid']));

if ( !empty($params['field']) )
{
	foreach( $params['field'] as $key => $field )
	{
		if ( !empty($field) )
		{
			$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_fieldvals (fieldid, fileid, value) VALUES (?,?,?)";
			$result = $db->Execute($query, array($key, $params['fid'], $field));
		}
	}
}

// update search index for the complete gallery.
$searchwords = '';
$query = "SELECT fileid, title, comment FROM " . cms_db_prefix() . "module_gallery
					WHERE (fileid=? OR (galleryid=? AND filename NOT LIKE ?)) AND active=1";
$result = $db->Execute($query, array($params['gid'], $params['gid'], '%/'));
if ( $result && $result->RecordCount() > 0 )
{
	while ( $row=$result->FetchRow() )
	{
		$searchwords .= $row['title'] . ' ' . $row['comment'] . ' ';
		$fileid[] = $row['fileid'];
	}
}

// add custom fields to search index
$fids = implode(",", $fileid);
$query = "SELECT fv.value FROM " . cms_db_prefix() . "module_gallery_fieldvals fv
					JOIN " . cms_db_prefix() . "module_gallery_fielddefs fd ON fv.fieldid=fd.fieldid AND fd.public=1
					WHERE fv.fileid IN(".$fids.")";
$result = $db->Execute($query);
if ( $result && $result->RecordCount() > 0 )
{
	while ( $row=$result->FetchRow() )
	{
		$searchwords .= $row['value'] . ' ';
	}
}
$search =& $this->GetModuleInstance('Search');
if( $search  )
{
	$search->AddWords($this->GetName(),$params['gid'],'gallery',$searchwords);
}


if ( isset($params['applybutton']) )
{
	$params = array('fid' => $params['fid'], 'mode' => "edit", 'module_message' => $this->Lang('imageupdated'));
	$this->Redirect($id, 'editimage', '', $params);
}
else
{
	$params = array('gid' => $params['gid'], 'mode' => "edit", 'module_message' => $this->Lang('imageupdated'));
	$this->Redirect($id, 'editgallery', '', $params);
}
?>