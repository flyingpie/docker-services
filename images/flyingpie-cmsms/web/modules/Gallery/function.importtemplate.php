<?php
// needs $xml variable containing xml-code for input
// checks with $dirs variable if the call came from initial install

if( !isset( $gCms ) ) exit();


if( !$this->CheckPermission('Modify Templates') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Templates'));
	return;
}

// first make sure that we can actually write to the module directory, for initial install this is already checked
$dir = "../modules/Gallery/templates/"; // . $params['template'];
if( !is_writable($dir) )
{
	// directory not writable
	$params = array('module_error' => $this->Lang('error_directorynotwritable'), 'active_tab' => 'templates');
	$this->Redirect($id, 'defaultadmin' , $returnid, $params);
	return;
}

// start parsing xml
$parser = xml_parser_create();
$ret = xml_parse_into_struct($parser, $xml, $val, $xt );
xml_parser_free($parser);

if( $ret == 0 )
{
	if ( isset($dirs) )
	{
		$tmp = lang('errorcouldnotparsexml') . ' ' . $fn;
		return $tmp;
	}
	else
	{
		$params = array('module_error' => lang('errorcouldnotparsexml') . ' ' . $fn, 'active_tab' => 'templates');
		$this->Redirect($id, 'defaultadmin' , $returnid, $params);
		return;
	}
}

$tpldetails = array();
$tpldetails['size'] = strlen($xml);
$required = array();
foreach( $val as $elem )
{
	$value = (isset($elem['value']) ? $elem['value'] : '');
	$type = (isset($elem['type']) ? $elem['type'] : '');
	switch( $elem['tag'] )
	{
		case 'NAME':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			// check if this module is already installed
			if( is_dir($dir . strtolower($value)) && isset($params) && (!array_key_exists('overwrite', $params) || $params['overwrite'] == 0 ))
			{
				$params = array('module_error' => $this->Lang('error_templateexists'), 'active_tab' => 'templates');
				$this->Redirect($id, 'defaultadmin' , $returnid, $params);
				return;
			}
			$tpldetails['name'] = $value;
			break;
		}

		case 'VERSION':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['version'] = $value;
			break;
		}

		case 'GALLERYVERSION':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['galleryversion'] = $value;
			break;
		}

		case 'ABOUT':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['about'] = base64_decode($value);
			break;
		}

		case 'THUMBWIDTH':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['thumbwidth'] = $value;
			break;
		}

		case 'THUMBHEIGHT':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['thumbheight'] = $value;
			break;
		}

		case 'RESIZEMETHOD':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['resizemethod'] = $value;
			break;
		}

		case 'MAXNUMBER':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['maxnumber'] = $value;
			break;
		}

		case 'SORTITEMS':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['sortitems'] = $value;
			break;
		}

		case 'TPLCODE':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['tplcode'] = base64_decode($value);
			break;
		}

		case 'TPLCSS':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['tplcss'] = base64_decode($value);
			break;
		}

		case 'TPLJS':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['tpljs'] = base64_decode($value);
			break;
		}

		case 'FILE':
		{
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}

			// finished a first file
			if( !isset( $tpldetails['name'] )	   || !isset( $tpldetails['version'] ) ||
					!isset( $tpldetails['filename'] ) || !isset( $tpldetails['isdir'] ) )
			{
				$params = array('module_error' => lang('errorcouldnotparsexml') . ' ' . $fn, 'active_tab' => 'templates');
				$this->Redirect($id, 'defaultadmin' , $returnid, $params);
				return;
			}

			// ready to go
			$templatedir = str_replace('/', DIRECTORY_SEPARATOR, $dir . strtolower($tpldetails['name']));
			$filename = str_replace('/', DIRECTORY_SEPARATOR, $templatedir . $tpldetails['filename']);
			if( !file_exists($templatedir) )
			{
				if( !@mkdir($templatedir) && !is_dir($templatedir) )
				{
					$params = array('module_error' => $this->Lang('error_cantcreatedir') . ' \'' . $templatedir . '\'', 'active_tab' => 'templates');
					$this->Redirect($id, 'defaultadmin' , $returnid, $params);
					return;
					break;
				}
			}

			if( $tpldetails['isdir'] )
			{
				if( !@mkdir($filename) && !is_dir($filename) )
				{
					$params = array('module_error' => $this->Lang('error_cantcreatedir') . ' \'' . $filename . '\'', 'active_tab' => 'templates');
					$this->Redirect($id, 'defaultadmin' , $returnid, $params);
					return;
					break;
				}
			}
			else
			{
				$data = $tpldetails['filedata'];
				if( strlen($data) )
				{
					$data = base64_decode($data);
				}
				$fp = @fopen($filename, "w");
				if( !$fp )
				{
					$params = array('module_error' => $this->Lang('error_cantcreatefile') . ' \'' . $filename . '\'', 'active_tab' => 'templates');
					$this->Redirect($id, 'defaultadmin' , $returnid, $params);
					return;
				}
				if( strlen($data) )
				{
					@fwrite($fp, $data);
				}
				@fclose($fp);
			}
			unset( $tpldetails['filedata'] );
			unset( $tpldetails['filename'] );
			unset( $tpldetails['isdir'] );
		}

		case 'FILENAME':
			$tpldetails['filename'] = $value;
			break;

		case 'ISDIR':
			$tpldetails['isdir'] = $value;
			break;

		case 'DATA':
			if( $type != 'complete' && $type != 'close' )
			{
				continue;
			}
			$tpldetails['filedata'] = $value;
			break;
	}
} // foreach


// save template
$templatecode = $tpldetails['tplcode'].TEMPLATE_SEPARATOR.$tpldetails['tplcss'].TEMPLATE_SEPARATOR.$tpldetails['tpljs'].'*}';
$this->SetTemplate($tpldetails['name'], $templatecode);

// save css-file
if ( empty($tpldetails['tplcss']) )
{
	@unlink('../modules/Gallery/templates/css/' . $tpldetails['name'] . '.css');
}
else
{
	$handle = fopen('../modules/Gallery/templates/css/' . $tpldetails['name'] . '.css','w');
	fwrite($handle,$tpldetails['tplcss']);
	fclose($handle);
}


if ( $tpldetails['thumbwidth'] <= 0 || $tpldetails['thumbheight'] <= 0 )
{
	$tpldetails['thumbwidth'] = NULL;
	$tpldetails['thumbheight'] = NULL;
	$tpldetails['resizemethod'] = NULL;
}
$tpldetails['maxnumber'] = $tpldetails['maxnumber'] > 0 ? $tpldetails['maxnumber'] : NULL;


// check if the template already exists in the database
$templateprops = $this->_GetTemplateprops($tpldetails['name']);

// save templateproperties in database
if ( $templateprops )
{
	$query = "UPDATE " . cms_db_prefix() . "module_gallery_templateprops
			SET version=?,about=?,thumbwidth=?,thumbheight=?,resizemethod=?,maxnumber=?,sortitems=?
			WHERE templateid=?";
	$result = $db->Execute($query, array($tpldetails['version'], $tpldetails['about'], $tpldetails['thumbwidth'], $tpldetails['thumbheight'], $tpldetails['resizemethod'], $tpldetails['maxnumber'], $tpldetails['sortitems'], $templateprops['templateid']));
}
else
{
	$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_templateprops
			(template,version,about,thumbwidth,thumbheight,resizemethod,maxnumber,sortitems,visible)
			VALUES (?,?,?,?,?,?,?,?,?)";
	$result = $db->Execute($query, array($tpldetails['name'], $tpldetails['version'], $tpldetails['about'], $tpldetails['thumbwidth'], $tpldetails['thumbheight'], $tpldetails['resizemethod'], $tpldetails['maxnumber'], $tpldetails['sortitems'], $tpldetails['name'] == 'gallerytree' ? 0 : 1));
}
if ( !$result )
{
	echo 'ERROR: ' . mysql_error();
	exit();
}
?>