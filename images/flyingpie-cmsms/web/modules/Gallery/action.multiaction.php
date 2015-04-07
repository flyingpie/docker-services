<?php
if (!isset($gCms)) exit;

// Check permissions
if( !$this->CheckPermission('Use Gallery') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Use Gallery'));
	return;
}

if( empty($params['fid']) && empty($params['imgselect']) )
{
	$params['module_error'] = lang('missingparams');
	$this->Redirect($id,'defaultadmin','',$params);
}

if ( !empty($params['imgselect']) && is_array($params['imgselect']) )
{
	$params['imgselect'] = empty($params['imgselect']) ? '' : implode(',',array_keys($params['imgselect']));
}
$fid_array = empty($params['fid']) ? explode(',', $params['imgselect']) : array($params['fid']);
$fids = empty($params['fid']) ? $params['imgselect'] : $params['fid'];
$gid = empty($params['gid']) ? 0 : $params['gid'];

switch( $params['multiaction'] )
{
	case 'delete':
	{
		foreach( $fid_array as $fid )
		{
			$fileinfo = $this->_Getgalleryinfobyid($fid);
			if( strpos($fileinfo['filename'],"/") === FALSE )
			{
				// delete only one file
				$this->_DeleteGalleryDB('do_not_delete_directory',$fid);
			}
			else
			{
				// delete directory and files
				$this->_DeleteGalleryDB((empty($fileinfo['filepath']) ? '' : $fileinfo['filepath'] . '/') . $fileinfo['filename'],$fid);
			}
		}
		$gid = empty($params['gid']) ? $fileinfo['galleryid'] : $params['gid'];
		break;
	}

	case 'active':
	{
		$query = "UPDATE " . cms_db_prefix() . "module_gallery SET active = 1 WHERE fileid IN (" . $fids . ")";
		$db->Execute($query);
		break;
	}

	case 'inactive':
	{
		$query = "UPDATE " . cms_db_prefix() . "module_gallery SET active = 0 WHERE fileid IN (" . $fids . ")";
		$db->Execute($query);
		break;
	}
	
	case 'switchactive':
	{
		$query = "UPDATE " . cms_db_prefix() . "module_gallery SET active = active^1 WHERE fileid IN (" . $fids . ")";
		$db->Execute($query);
		break;
	}

	case 'move':
	{
		$galleryinfo = $this->_Getgalleryinfobyid($params['moveto']);
		$newdir = $params['moveto'] == 1 ? '' : trim($galleryinfo['filepath'] . '/' . $galleryinfo['filename'], '/');

		foreach( $fid_array as $fid )
		{
			if ( $fid != 1 )
			{
				$fileinfo = $this->_Getgalleryinfobyid($fid);
				$newpath = '../' . DEFAULT_GALLERY_PATH . trim($newdir . '/' . $fileinfo['filename'],'/');
				$oldpath = '../' . DEFAULT_GALLERY_PATH .  trim($fileinfo['filepath'] . '/' . $fileinfo['filename'],'/');
				if ( @rename($oldpath, $newpath) )
				{
					if( strpos($fileinfo['filename'],"/") === FALSE )
					{
						// move only one file, let's don't forget the thumb
						$newpath = '../' . DEFAULT_GALLERY_PATH . trim($newdir . '/' . IM_PREFIX . $fileinfo['filename'],'/');
						$oldpath = '../' . DEFAULT_GALLERY_PATH .  trim($fileinfo['filepath'] . '/' . IM_PREFIX . $fileinfo['filename'],'/');
						@rename($oldpath, $newpath);
						$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filepath = ?, galleryid = ? WHERE fileid = ?";
						$db->Execute($query, array($newdir, $params['moveto'], $fid));
					}
					else
					{
						// move directory
						$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filepath = ?, galleryid = ? WHERE fileid = ?";
						$db->Execute($query, array($newdir, $params['moveto'], $fid));

						//move content
						$oldpath = trim($fileinfo['filepath'] . '/' . $fileinfo['filename'], '/');
						$newpath = trim($newdir . '/' . $fileinfo['filename'], '/');
						$query = "UPDATE " . cms_db_prefix() . "module_gallery SET filepath = REPLACE(filepath,?,?) WHERE filepath = ? OR filepath LIKE ?";
						$db->Execute($query, array($oldpath, $newpath, $oldpath, $oldpath . '/%'));
					}
				}
			}
		}

		break;
	}

}

$origaction = $params['origaction'];
switch( $origaction )
{
	case 'editgallery':
	{
		$params = array('gid' => $gid, 'mode' => 'edit');
		break;
	}
	case 'defaultadmin':
	{
		$params = array();
		break;
	}
}

$this->Redirect($id, $origaction, $returnid, $params);
?>