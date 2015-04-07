<?php
if( !isset( $gCms ) ) exit();

if( isset($params['cancel']) )
{
	$params = array('active_tab' => 'galleries');
	$this->Redirect($id, 'defaultadmin', '', $params);
}

if( !$this->CheckPermission('Use Gallery') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

if( !isset($params['gid']) )
{
	$params = array('gid' => $params['gid'], 'mode' => 'edit', 'module_error' => lang('missingparams'));
	$this->Redirect($id,'editgallery','',$params);
	return;
}

if( isset($params['multiactionsubmit']) )
{
	$params = array('gid' => $params['gid'], 'multiaction' => $params['multiaction'], 'moveto' => empty($params['moveto']) ? '' : $params['moveto'], 'imgselect' => empty($params['imgselect']) ? '' : implode(',',array_keys($params['imgselect'])), 'origaction' => $params['origaction']);

	$this->Redirect($id,'multiaction','',$params);
	return;
}

if( isset($params['unsortbutton']) )
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery SET fileorder=0 WHERE galleryid = ?";
	$result = $db->Execute($query, array($params['gid']));
	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}
	else
	{
		$params['module_message'] = $this->Lang('galleryupdated');
	}
}
elseif( isset($params['updatethumbsbutton']) )
{
	$query = "SELECT fileid, filepath FROM " . cms_db_prefix() . "module_gallery WHERE galleryid=?";
	$result = $db->Execute($query, array($params['gid']));
	if ( $result && $result->RecordCount() > 0 )
	{
		while ( $row=$result->FetchRow() )
		{
			$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERYTHUMBS_PATH), $row['fileid'] . '-*', false);
			$filepath = $row['filepath'];
		}
		$filepath .= $filepath != '' ? '/' : '';
		$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERY_PATH . $filepath), IM_PREFIX . '*', false);
	}
	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}
	else
	{
		$params['module_message'] = $this->Lang('thumbsdeleted') . ' ' . $this->Lang('thumbsrecreated');
	}
}
elseif( isset($params['directoryname']) )
{
	// cleanup the directoryname, see reference-arrays in lib/replacement.php
	$params['directoryname'] = munge_string_to_url($params['directoryname']);

	// add subgallery
	if ( empty($params['directoryname']) )
	{
		$params['module_error'] = $this->Lang('error_directorynameinvalid');
		$this->Redirect($id, 'editgallery', '', $params);
		exit();
	}

	$params['gid'] = $params['moveto'];

	$galleryinfo = $this->_Getgalleryinfobyid($params['gid']);
	$gallerypath = $params['gid'] == 1 ? '' : (trim($galleryinfo['filepath'] . '/' . $galleryinfo['filename'],'/') . '/');
	if ( is_dir($gallerypath . $params['directoryname']) )
	{
		$params['module_error'] = $this->Lang('error_directoryalreadyexists');
		$this->Redirect($id, 'editgallery', '', $params);
		exit();
	}
	else
	{
		if( !mkdir('../' . DEFAULT_GALLERY_PATH . $gallerypath . $params['directoryname']) )
		{
			$params = array('gid' => $params['gid'], 'mode' => 'edit', 'module_error' => $this->Lang('error_cantcreatedir') . ' \'' . $gallerypath . $params['directoryname'] . '\'');
			$this->Redirect($id, 'editgallery', '', $params);
			exit();
		}

		$gallerytitle = isset($params['gallerytitle']) ? $params['gallerytitle'] : '';
		$gallerycomment = isset($params['gallerycomment']) ? $params['gallerycomment'] : '';
		$gallerydate = date('Y-m-d H:i:s');
		if( isset($params['gallerydate']) )
		{
			$checkdate = explode('-', $params['gallerydate']);
			$gallerydate = checkdate($checkdate[1], $checkdate[2], $checkdate[0]) ? $params['gallerydate'] : date('Y-m-d H:i:s');
		}
		$templateid = isset($params['templateid']) ? $params['templateid'] : 0;
		$hideparentlink = isset($params['hideparentlink']) ? $params['hideparentlink'] : 0;

		$params['gid'] = $this->_AddFileToDB($params['directoryname'] . '/', trim($gallerypath, '/'), $gallerydate, $params['gid'], $gallerytitle, $gallerycomment, $templateid, $hideparentlink);
		$result = $params['gid'];
		$searchwords = $gallerytitle . ' ' . $gallerycomment;
		$params['module_message'] = '';

		// save gallery custom fields, exclude non public fields for the search index
		$query = "SELECT fieldid FROM " . cms_db_prefix() . "module_gallery_fielddefs WHERE public <> 1";
		$result = $db->Execute($query);
		if ( $result && $result->RecordCount() > 0 )
		{
			while ( $row=$result->FetchRow() )
			{
				$nonpublicfields[] = $row['fieldid'];
			}
		}
		if ( !empty($params['field']) )
		{
			foreach( $params['field'] as $key => $field )
			{
				if ( !empty($field) )
				{
					if ( isset($nonpublicfields) && !in_array($key, $nonpublicfields) ) $searchwords .= ' ' . $field;
					$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_fieldvals (fieldid, fileid, value) VALUES (?,?,?)";
					$result = $db->Execute($query, array($key, $params['gid'], $field));
				}
			}
		}
	}
	
}
else
{
	// update gallery
	$gallerytitle = isset($params['gallerytitle']) ? $params['gallerytitle'] : '';
	$gallerycomment = isset($params['gallerycomment']) ? $params['gallerycomment'] : '';
	if( isset($params['gallerydate']) )
	{
		$checkdate = explode('-', $params['gallerydate']);
		$gallerydate = checkdate($checkdate[1], $checkdate[2], $checkdate[0]) ? $params['gallerydate'] : '';
	}
	if( !empty($gallerydate) )
	{
		$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filedate = ?, title = ?, comment = ? WHERE fileid = ?";
		$result = $db->Execute($query, array($gallerydate, $gallerytitle, $gallerycomment, $params['gid']));
	}
	else
	{
		$query = "UPDATE " . cms_db_prefix() . "module_gallery SET title = ?, comment = ? WHERE fileid = ?";
		$result = $db->Execute($query, array($gallerytitle, $gallerycomment, $params['gid']));
	}

	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}

	$searchwords = $gallerytitle . ' ' . $gallerycomment;

	// save gallery custom fields, exclude non public fields for the search index
	$query = "SELECT fieldid FROM " . cms_db_prefix() . "module_gallery_fielddefs WHERE public <> 1";
	$result = $db->Execute($query);
	if ( $result && $result->RecordCount() > 0 )
	{
		while ( $row=$result->FetchRow() )
		{
			$nonpublicfields[] = $row['fieldid'];
		}
	}
	//since we lack an INSERT ... ON DUPLICATE KEY UPDATE function, we delete them first
	$query = "DELETE FROM " . cms_db_prefix() . "module_gallery_fieldvals WHERE fileid = ?";
	$result = $db->Execute($query, array($params['gid']));

	if ( !empty($params['field']) )
	{
		foreach( $params['field'] as $key => $field )
		{
			if ( !empty($field) )
			{
				if ( isset($nonpublicfields) && !in_array($key, $nonpublicfields) ) $searchwords .= ' ' . $field;
				$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_fieldvals (fieldid, fileid, value) VALUES (?,?,?)";
				$result = $db->Execute($query, array($key, $params['gid'], $field));
			}
		}
	}
	
	$params['hideparentlink'] = isset($params['hideparentlink']) ? $params['hideparentlink'] : 0;
	$params['hideparentlink'] = $params['gid'] == 1 ? 1 : $params['hideparentlink'];
	$params['templateid'] = $params['templateid'] == '' ? 0 : $params['templateid'];

	$query = "UPDATE " . cms_db_prefix() . "module_gallery_props SET templateid=?,hideparentlink=? WHERE fileid=?";
	$result = $db->Execute($query, array($params['templateid'],$params['hideparentlink'],$params['gid']));
	if ( !$result )
	{
		echo 'ERROR: ' . mysql_error();
		exit();
	}

	
	// Save images and subgalleries
	if ( !empty($params['sort']) )
	{
		$sort = explode(",",$params['sort']);
	}
	if ( isset($params['filetitle']) )
	{
		foreach($params['filetitle'] as $key=>$filetitle)
		{
			$filedate = '';
			if( !empty($params['filedate'][$key]) )
			{
				$checkdate = explode('-', $params['filedate'][$key]);
				$filedate = (count($checkdate) == 3 && checkdate($checkdate[1], $checkdate[2], $checkdate[0])) ? $params['filedate'][$key] : '';
			}

			if ( !empty($params['sort']) )
			{
				$sortkey = empty($sort) ? 0 : array_search($key, $sort) + 1;
				if ( $filetitle == "#dir" )
				{
					$query = "UPDATE " . cms_db_prefix() . "module_gallery SET fileorder=? WHERE fileid = ?";
					$result = $db->Execute($query, array($sortkey, $key));
				}
				else
				{
					if ( $params['fileactive'][$key] )
					{
						$fileid[] = $key;
						$searchwords .= ' ' . $filetitle . ' ' . $params['filecomment'][$key];
					}
					if( !empty($filedate) )
					{
						$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filedate=?, title=?, comment=?, fileorder=? WHERE fileid = ?";
						$result = $db->Execute($query, array($filedate, $filetitle, $params['filecomment'][$key], $sortkey, $key));
					}
					else
					{
						$query = "UPDATE " . cms_db_prefix() . "module_gallery SET title=?, comment=?, fileorder=? WHERE fileid = ?";
						$result = $db->Execute($query, array($filetitle, $params['filecomment'][$key], $sortkey, $key));
					}
				}
			}
			elseif ( $filetitle != "#dir" )
			{
				if ( $params['fileactive'][$key] )
				{
					$fileid[] = $key;
					$searchwords .= ' ' . $filetitle . ' ' . $params['filecomment'][$key];
				}
				if( !empty($filedate) )
				{
					$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filedate=?, title=?, comment=? WHERE fileid = ?";
					$result = $db->Execute($query, array($filedate, $filetitle, $params['filecomment'][$key], $key));
				}
				else
				{
					$query = "UPDATE " . cms_db_prefix() . "module_gallery SET title=?, comment=? WHERE fileid = ?";
					$result = $db->Execute($query, array($filetitle, $params['filecomment'][$key], $key));
				}
			}
			if ( !$result )
			{
				echo 'ERROR: ' . mysql_error();
				exit();
			}
		}
		if ( !empty($fileid) )
		{
			// include the image custom fields, only the public ones.
			$fids = implode(",", $fileid);
			$query = "SELECT value FROM " . cms_db_prefix() . "module_gallery_fieldvals WHERE fileid IN(".$fids.")";
			if ( !empty($nonpublicfields) )
			{
				$nonpublicflds = implode(",", $nonpublicfields);
				$query .= " AND fieldid NOT IN(".$nonpublicflds.")";
			}
			$result = $db->Execute($query);
			if ( $result && $result->RecordCount() > 0 )
			{
				while ( $row=$result->FetchRow() )
				{
					$searchwords .= ' ' . $row['value'];
				}
			}
		}
	}
	$params['module_message'] = $this->Lang('galleryupdated');
}

if ( $result ) 
{
	//Update search index, only if the gallery is active.
	$search =& $this->GetModuleInstance('Search');
	if( $search && isset($params['submitbutton']) && $params['active'] )
	{
		$search->AddWords($this->GetName(),$params['gid'],'gallery',$searchwords);
	}

	$params = array('gid' => $params['gid'], 'mode' => 'edit', 'module_message' => $params['module_message']);
	$this->Redirect($id, 'editgallery', '', $params);
}
else 
{
	$params = array('gid' => $params['gid'], 'mode' => 'edit', 'module_error' => $this->Lang('error_updategalleryfailed'));
	$this->Redirect($id, 'editgallery', '', $params);
}

?>