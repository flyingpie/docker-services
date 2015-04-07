<?php
#-------------------------------------------------------------------------
# Module: Gallery
# Version: 1.4.4, Jos
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2005 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/gallery/
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------


define('DEFAULT_GALLERY_PATH', "uploads/images/Gallery/");
define('DEFAULT_GALLERYTHUMBS_PATH', "uploads/images/GalleryThumbs/");
define('IM_PREFIX', "thumb_");   // $IMConfig['thumbnail_prefix']
define('IM_THUMBWIDTH', get_site_preference('thumbnail_width',96));
define('IM_THUMBHEIGHT', get_site_preference('thumbnail_height',96));
define('TEMPLATE_SEPARATOR', "{*----------");


class Gallery extends CMSModule
{

  function GetName()
  {
    return 'Gallery';
  }

  function GetFriendlyName()
  {
    return $this->Lang('friendlyname');
  }


  function GetVersion()
  {
    return '1.4.4';
  }

  function GetHelp()
  {
    return $this->Lang('help');
  }

  function GetAuthor()
  {
    return 'Jos';
  }

  function GetAuthorEmail()
  {
    return 'josvd@live.nl';
  }

  function GetChangeLog()
  {
    return file_get_contents(dirname(__FILE__).'/changelog.inc');
  }

  function IsPluginModule()
  {
    return true;
  }

  function HasAdmin()
  {
    return true;
  }

  function GetAdminSection()
  {
    return 'content';
  }

  function GetAdminDescription()
  {
    return $this->Lang('moddescription');
  }

  function VisibleToAdminUser()
	{
		return $this->CheckPermission('Use Gallery');
	}

  function GetDependencies()
  {
    return array();
  }

  function MinimumCMSVersion()
  {
    return "1.6";
  }

  function SetParameters()
  {
	  $this->RegisterModulePlugin();

	  $this->RestrictUnknownParams();

	  // syntax for creating a parameter is parameter name, default value, description
	  $this->CreateParameter('dir', 'sub1/sub2', $this->Lang('help_dir'));
	  $this->SetParameterType('dir',CLEAN_STRING);

	  $this->CreateParameter('template', '', $this->Lang('help_template'));
	  $this->SetParameterType('template',CLEAN_STRING);

	  $this->CreateParameter('targetpage', '', $this->Lang('help_targetpage'));
	  $this->SetParameterType('targetpage',CLEAN_STRING);

	  $this->CreateParameter('number', '100', $this->Lang('help_number'));
	  $this->SetParameterType('number',CLEAN_INT);

	  $this->CreateParameter('start', '1', $this->Lang('help_start'));
	  $this->SetParameterType('start',CLEAN_INT);

	  $this->CreateParameter('show', 'all', $this->Lang('help_show'));
	  $this->SetParameterType('show',CLEAN_STRING);

	  $this->CreateParameter('action', 'default', $this->Lang('help_action'));
	  $this->SetParameterType('action',CLEAN_STRING);

	  $this->CreateParameter('img', 10, $this->Lang('help_img'));
	  $this->SetParameterType('img',CLEAN_INT);

	  $this->SetParameterType('fid',CLEAN_INT);
	  $this->SetParameterType('gid',CLEAN_INT);

	  // Pretty url route for viewing a gallery in all its variations
		$urlprefix = $this->GetPreference('urlprefix', '[gG]allery');
	  $this->RegisterRoute('/'.$urlprefix.'\/(?P<dir>.+)\/(?P<start>[0-9]+)-(?P<number>[0-9]+)-(?P<show>[a-zA-Z]+)-(?P<returnid>[0-9]+)$/', array('action'=>'default'));
		$this->RegisterRoute('/'.$urlprefix.'\/(?P<dir>.+)\/(?P<start>[0-9]+)-(?P<number>[0-9]+)-(?P<returnid>[0-9]+)$/', array('action'=>'default'));
	  $this->RegisterRoute('/'.$urlprefix.'\/(?P<dir>.+)\/(?P<returnid>[0-9]+)$/', array('action'=>'default'));
		$this->RegisterRoute('/'.$urlprefix.'\/(?P<start>[0-9]+)-(?P<number>[0-9]+)-(?P<show>[a-zA-Z]+)-(?P<returnid>[0-9]+)$/', array('action'=>'default'));
		$this->RegisterRoute('/'.$urlprefix.'\/(?P<start>[0-9]+)-(?P<number>[0-9]+)-(?P<returnid>[0-9]+)$/', array('action'=>'default'));
		$this->RegisterRoute('/'.$urlprefix.'\/(?P<returnid>[0-9]+)$/', array('action'=>'default'));

  }

  function GetEventDescription ( $eventname )
  {
    return; // $this->Lang('event_info_'.$eventname );
  }

  function GetEventHelp ( $eventname )
  {
    return; // $this->Lang('event_help_'.$eventname );
  }

  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }

  function UninstallPostMessage()
  {
    return $this->Lang('postuninstall');
  }

  function UninstallPreMessage()
  {
    return $this->Lang('really_uninstall');
  }


	/**
	 * DoEvent methods
	 */

	function DoEvent( $originator, $eventname, &$params )
	{
		if ($originator == 'Core' && $eventname == 'ContentPostRender')
		{
			$pos = stripos($params["content"],"</head");
			if( $pos !== FALSE && isset($this->GalleryMetadata) )
			{
				$params["content"] = substr($params["content"], 0, $pos) . $this->GalleryMetadata . substr($params["content"], $pos);
			}
		}
	}


	/**
	 * Search methods
	 */

	function SearchResult($returnid, $gid, $attr = '')
	{
		$result = array();

		if ($attr == 'gallery')
		{
			$galleryinfo = $this->_Getgalleryinfobyid($gid);
			if ( $galleryinfo && $galleryinfo['active'] )
			{
				//0 position is the prefix displayed in the list results.
				$result[0] = $this->GetFriendlyName();

				//1 position is the title
				$result[1] = empty($galleryinfo['title']) ? trim($galleryinfo['filename'],"/") : $galleryinfo['title'];

				//2 position is the URL to the title.
				$gdir = $gid == 1 ? '' : str_replace('%2F','/',rawurlencode((empty($galleryinfo['filepath']) ? '' : $galleryinfo['filepath'] . '/') . $galleryinfo['filename']));
				$prettyurl = $this->GetPreference('urlprefix','gallery') . '/' . $gdir . $returnid;
				$result[2] = $this->CreateLink('cntnt01', 'default', $returnid, '', array('dir' => trim($gdir,'/')) ,'', true, false, '', true, $prettyurl);
			}
		}
		return $result;
	}


	function SearchReindex(&$module)
	{
		$galleries = $this->_GetGalleries();
		
		foreach ($galleries as $gid=>$gallery) 
		{
			$galleryinfo = $this->_Getgalleryinfobyid($gid);
			if ( $galleryinfo['active'] )
			{
				$searchwords = $gallery['title'] . ' ' . $gallery['comment'];
				$db =& $this->GetDB();
				$query = "SELECT title, comment 
									FROM " . cms_db_prefix() . "module_gallery g1
									WHERE galleryid=?";
				$result = $db->Execute($query, array($gid));
				if ( $result && $result->RecordCount() > 0 )
				{
					while ( $row=$result->FetchRow() )
					{
						$searchwords .= ' ' . $row['title'] . ' ' . $row['comment'];
					}
				}
				if ( !$result )
				{
					echo 'ERROR: ' . mysql_error();
					exit();
				}
				$module->AddWords($this->GetName(), $gid, 'gallery',$searchwords);
			}
		}
	}

	
	/**
	 * Register TinyMCE plugin
	 */

	function RegisterTinyMCEPlugin()
	{
		global $gCms;
		$config = $this->GetConfig();
		$galleries = $this->_GetGalleries();

		$plugin1 = "
tinymce.create('tinymce.plugins.picker', {
	createControl: function(n, cm) {
		switch (n) {
			case 'picker':
				var c = cm.createMenuButton('picker', {
					title : '".$this->Lang('tinymce_button_picker')."',
					image : '".$config["root_url"]."/modules/Gallery/images/icon_TinyMCE.gif',
					icons : false
				});

				c.onRenderMenu.add(function(c, m) {
		";

		foreach($galleries as $gallery)
		{
			$plugin1 .= "
				m.add({title : '".$gallery['filename']."', onclick : function() {
	  					tinyMCE.activeEditor.execCommand('mceInsertContent', false, '{Gallery" . ($gallery['filename'] == "Gallery/" ? "}" : " dir=\'" . substr((empty($gallery['filepath']) ? "" : $gallery['filepath'] . "/") . $gallery['filename'], 0, -1) . "\'}")."');
				}});
				m.addSeparator();
			";
		}

		$plugin1 .= "
				});
				// Return the new menu button instance
				return c;
		}

		return null;
	}
});
		";

		return array(array('picker',$plugin1,$this->Lang('tinymce_description_picker')));
	}


	function GetHeaderHTML()
	{
		$tmpl = <<<EOT
<link rel="stylesheet" type="text/css" href="../modules/Gallery/templates/jquery/jquery.treeTable.css" media="screen" />
{literal}
<script type="text/javascript">
if( typeof(jQuery) == "undefined") {
	document.write('<script type="text/javascript" src="../modules/Gallery/templates/jquery/jquery.js"><\/script>');
}
</script>
<script type="text/javascript" src="../modules/Gallery/templates/jquery/jquery.tablednd.js"></script>
<script type="text/javascript" src="../modules/Gallery/templates/jquery/jquery.treeTable.js"></script>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function($) {
	$("#gtree").treeTable();
	$('#gtree tr.initialized:odd').addClass('row1');
	$('#gtree tr.initialized:even').addClass('row2');
	$('#gtable tr, #gtree tr').hover(function(){
		$(this).stop().addClass('row1hover');
	}, function(){
		$(this).stop().removeClass('row1hover');
	});
	$('#gtable').tableDnD({
		onDragStart: function(table,row) {
			$('#gtable tr').removeClass();
		},
		onDragClass: "row1hover",
		onDrop: function(table, row) {
			$('#gtable tr:odd').addClass('row1');
			$('#gtable tr:even').addClass('row2');
			var rows = table.tBodies[0].rows;
			var sortstr = rows[0].id;
			for (var i=1; i<rows.length; i++) {
				sortstr += ","+rows[i].id;
			}
			$('#sort input').val(sortstr);
		}
	});

	$('input#selectall').click(function() {
		$('.checkbox input').attr('checked',$(this).attr('checked'));
	});

	$('#multiaction').change(function() {
		if ($('#multiaction').val() == 'move')
		{
			$('#moveto').show('slow');
		}
		else
		{
			$('#moveto').hide('slow');
		}
	});
	$('#multiaction').change();

	$('a#addfield').click(function() {
		var htmlStr = $('.sortfield').html();
				htmlStr = htmlStr.replace(/ selected="selected"/g, '');
		$('<p class="sortfield">' + htmlStr + '</p>').appendTo('#sortfields');
		return false;
	});
	$('a#deletefield').click(function() {
		if($('.sortfield').size() > 1) {
			$('.sortfield:last').remove();
		}
		return false;
	});

});

</script>

<style type="text/css">
	.swfupload {
		position: absolute;
		z-index: 1;
	}
</style>
{/literal}
EOT;
		return $this->ProcessTemplateFromData($tmpl);
	}


  /**
   * Gallery methods
   */

	function _Getdirfiles($path,$recursive)
	{
		$path = empty($path) ? '' : trim($path,"/") . '/';
		$updir = is_dir(DEFAULT_GALLERY_PATH . $path) ? '' : '../';
		$allowext = explode(',', $this->GetPreference('allowed_extensions',''));
		$maxext = array('jpg','jpeg','gif','png');
		$output = array();
		if ( $handle = opendir(str_replace('/',DIRECTORY_SEPARATOR,$updir . DEFAULT_GALLERY_PATH . $path)) )
		{
			while ( false !== ($file = readdir($handle)) )
			{
				$ext = substr($file, strrpos($file, '.') + 1);
				if ( substr($file,0,1) != "." && substr($file,0,strlen(IM_PREFIX)) != IM_PREFIX && ((in_array(strtolower($ext),$allowext) && in_array(strtolower($ext),$maxext)) || is_dir($updir . DEFAULT_GALLERY_PATH . $path . $file)) )
				{
					$output[$path . $file] = array(
						'filename' => is_dir($updir . DEFAULT_GALLERY_PATH . $path . $file) ? $file . '/' : $file,
						'filepath' => trim($path,"/"),
						'filemdate' => date("Y-m-d H:i:s", filemtime($updir . DEFAULT_GALLERY_PATH . $path . $file)),
					);
					if ( $recursive && is_dir($updir . DEFAULT_GALLERY_PATH . $path . $file) )
					{
						$output = array_merge($output,$this->_Getdirfiles($path . $file,$recursive));
					}
				}
			}
			closedir($handle);
		}
		return $output;
	}


	function _Getgalleryfiles($path)
	{
		$path = trim($path,"/");
		$output = array();
		$db =& $this->GetDB();
		$query = "SELECT
								g1.*, CONCAT(g2.filepath,?,g2.filename) AS thumb
							FROM
								" . cms_db_prefix() . "module_gallery g1
							LEFT JOIN
								" . cms_db_prefix() . "module_gallery g2
							ON
								g1.defaultfile = g2.fileid
							WHERE
								g1.filepath=?";
		$result = $db->Execute($query, array('/'.IM_PREFIX,$path));
		if ( $result && $result->RecordCount() > 0 )
		{
		  while ( $row=$result->FetchRow() )
		  {
		    $output[trim($row['filepath'] . '/' . $row['filename'],'/')] = $row;
		  }
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return $output;
	}


	function _GetGalleries()
	{
		$output = array();
		$db =& $this->GetDB();
		$query = "SELECT
								g1.*, CONCAT(g2.filepath,?,g2.filename) AS thumb
							FROM
								" . cms_db_prefix() . "module_gallery g1
							LEFT JOIN
								" . cms_db_prefix() . "module_gallery g2
							ON
								g1.defaultfile = g2.fileid
							WHERE
								g1.filename LIKE '%/'
							ORDER BY
								IF(g1.fileid=1,0,1) ASC,
								CONCAT(g1.filepath,CAST(IF(g1.filepath='','','/') AS BINARY),g1.filename) ASC";
		$result = $db->Execute($query, array('/'.IM_PREFIX));
		if ( $result && $result->RecordCount() > 0 )
		{
		  while ( $row=$result->FetchRow() )
		  {
		    $output[$row['fileid']] = $row;
		  }
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return $output;
	}


	function _Getgalleryinfo($path)
	{
		$path = trim($path,"/");
		if( strpos($path,"/") === FALSE )
		{
			$filename = empty($path) ?  'Gallery/' : $path . '/';
			$filepath = '';
		}
		else
		{
			$filename = substr($path, strrpos($path, '/') + 1) . '/';
			$filepath = substr($path, 0, strrpos($path, '/'));
		}
		$db =& $this->GetDB();
		$query = "SELECT g.*, gp.hideparentlink, gt.templateid, gt.template, gt.thumbwidth, gt.thumbheight, gt.resizemethod, gt.maxnumber, gt.sortitems
				FROM " . cms_db_prefix() . "module_gallery g
				LEFT JOIN " . cms_db_prefix() . "module_gallery_props gp
				ON g.fileid=gp.fileid
				LEFT JOIN " . cms_db_prefix() . "module_gallery_templateprops gt
				ON gp.templateid=gt.templateid
				WHERE g.filename=? AND g.filepath=?";
		$result = $db->Execute($query, array($filename, $filepath));

		if( $result && $result->RecordCount() > 0 )
		{
			$output = $result->FetchRow();
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return isset($output) ? $output : FALSE;
	}


	function _Getgalleryinfobyid($gid)
	{
		$db =& $this->GetDB();
		$query = "SELECT g.*, gp.hideparentlink, gt.templateid, gt.template, gt.thumbwidth, gt.thumbheight, gt.resizemethod, gt.maxnumber, gt.sortitems
				FROM " . cms_db_prefix() . "module_gallery g
				LEFT JOIN " . cms_db_prefix() . "module_gallery_props gp
				ON g.fileid=gp.fileid
				LEFT JOIN " . cms_db_prefix() . "module_gallery_templateprops gt
				ON gp.templateid=gt.templateid
				WHERE g.fileid=?";
		$result = $db->Execute($query, array($gid));
		if( $result && $result->RecordCount() > 0 )
		{
			$output = $result->FetchRow();
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return isset($output) ? $output : FALSE;
	}


	function _Getimagebyid($fid)
	{
		$db =& $this->GetDB();
		$query = "SELECT * FROM " . cms_db_prefix() . "module_gallery WHERE fileid=? AND filename NOT LIKE '%/'";
		$result = $db->Execute($query, array($fid));
		if( $result && $result->RecordCount() > 0 )
		{
			$output = $result->FetchRow();
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return isset($output) ? $output : FALSE;
	}


	function _AddFileToDB($filename,$filepath,$filemdate,$gid,$title='',$comment='',$templateid=0,$hideparentlink=0)
	{
		$db =& $this->GetDB();
		$insertid = 0;
		$query = "INSERT INTO " . cms_db_prefix() . "module_gallery (filename, filepath, filedate, fileorder, active, defaultfile, galleryid, title, comment) VALUES (?,?,?,0,1,0,?,?,?)";
		$result = $db->Execute($query, array($filename, $filepath, $filemdate, $gid, $title, $comment));
		if ( $result )
		{
			$insertid = $db->Insert_ID();
			if ( substr($filename,-1) == '/' )
			{
				$query = "INSERT INTO " . cms_db_prefix() . "module_gallery_props (fileid,templateid,hideparentlink) VALUES (?,?,?)";
				$result = $db->Execute($query, array($insertid, $templateid, $hideparentlink));
				if ( !$result )
				{
					echo 'Error: ' . mysql_error();
					exit();
				}
			}
		}
		else
		{
			echo 'Error: ' . mysql_error();
			echo "<br /><br />" . $query;
			exit();
		}
		return $insertid;
	}


	function _UpdateGalleryDB($path,$gid)
	{
		$path = trim($path,"/");
		$file_gallery = $this->_Getdirfiles($path,false);
		$db_gallery = $this->_Getgalleryfiles($path);

		if ( $file_gallery )
		{
			// add to DB:
			$gallery_add = empty($db_gallery) ? $file_gallery : array_diff_assoc($file_gallery,$db_gallery);
			foreach($gallery_add as $key=>$item)
			{
				$fileid = $this->_AddFileToDB($item['filename'],$item['filepath'],$item['filemdate'],$gid);
			}
		}
		if ( $db_gallery )
		{
			// delete from DB:
			$gallery_del = empty($file_gallery) ? $db_gallery : array_diff_assoc($db_gallery,$file_gallery);
			foreach($gallery_del as $key=>$item)
			{
				// make sure that the root gallery and other directories are not deleted here
				if ( $item['fileid'] != 1 && substr($item['filename'],-1) != "/" )
				{
					$delete_ids[] = $item['fileid'];
					// delete thumbs created for this image
					$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERYTHUMBS_PATH), $item['fileid'] . '-*', false);
				}
			}
			if ( isset($delete_ids) )
			{
				$query = implode("','",$delete_ids);
				$query = "DELETE FROM " . cms_db_prefix() . "module_gallery WHERE fileid IN('" . $query . "')";
				$db =& $this->GetDB();
				$result = $db->Execute($query);
				if ( !$result )
				{
					echo 'Error: ' . mysql_error();
					exit();
				}
			}
		}
		return TRUE;
	}

	function _DeleteGalleryDB($path,$gid)
	{
		$path = trim($path,"/");
		$db =& $this->GetDB();
		$query = "SELECT fileid, filename, filepath FROM " . cms_db_prefix() . "module_gallery WHERE
			fileid <> 1 AND
			(fileid = ? OR filepath = ? OR filepath like ?)";
		$result = $db->Execute($query, array($gid, $path, $path . '/%'));
		if ( $result && $result->RecordCount() > 0 )
		{
			$search =& $this->GetModuleInstance('Search');
		  while ( $row=$result->FetchRow() )
		  {
				$row['filepath'] = empty($row['filepath']) ? '' : $row['filepath'] . '/';
				// delete thumbs created for this image
				$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERYTHUMBS_PATH), $row['fileid'] . '-*', false);
				// delete original files and IM-thumbs
				$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERY_PATH . (empty($row['filepath']) ? '' : $row['filepath'] . '/') . $row['filename']));
				$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERY_PATH . $row['filepath']), IM_PREFIX . $row['filename'], false);
				//Update search index
				if ( $search != FALSE && substr($row['filename'], -1) == '/' )
				{
					$search->DeleteWords($this->GetName(), $row['fileid'], 'gallery');
				}
		  }
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		$query = "DELETE FROM " . cms_db_prefix() . "module_gallery WHERE
			fileid <> 1 AND
			(fileid = ? OR filepath = ? OR filepath like ?)";
		$result = $db->Execute($query, array($gid, $path, $path . '/%'));
		if ( !$result )
		{
			echo 'Error: ' . mysql_error();
			exit();
		}
	}


	function _DeleteFiles($dir,$pattern = '*',$deletedir = true)
	{
		$deletefiles = glob($dir . $pattern, GLOB_MARK);
		foreach($deletefiles as $file)
		{
			if ( substr($file, -1) == DIRECTORY_SEPARATOR )
				$this->_DeleteFiles($file);
			else
				@unlink($file); 
		}
		if ( $deletedir && is_dir($dir) ) rmdir($dir);
	}


	function _GetTemplateprops($template)
	{
		$db =& $this->GetDB();
		$query = "SELECT *
				FROM " . cms_db_prefix() . "module_gallery_templateprops
				WHERE template=?";
		$result = $db->Execute($query, array($template));

		if( $result && $result->RecordCount() > 0 )
		{
			$output = $result->FetchRow();
		}
		if ( !$result )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}
		return isset($output) ? $output : FALSE;
	}


	function _Getcustomfields($fileid, $dirfield, $id, $onlypublic = 0)
	{
		$db =& $this->GetDB();
		$output = array();
		$query = "SELECT fd.*, fv.value
				FROM " . cms_db_prefix() . "module_gallery_fielddefs fd
				LEFT JOIN " . cms_db_prefix() . "module_gallery_fieldvals fv
				ON fd.fieldid = fv.fieldid AND fv.fileid = ?
				WHERE fd.dirfield = ?";
		if ( $onlypublic ) $query .= " AND fd.public = 1";
		$query .= " ORDER BY fd.sortorder ASC";
		$result = $db->Execute($query, array($fileid, $dirfield));
		if ( $result && $result->RecordCount() > 0 )
		{
		  while ( $row=$result->FetchRow() )
		  {
				$alias = strtolower(str_replace(' ', '_', $row['name']));
				$output[$alias] = $row;
				if ( !empty($id) )
				{
					$fieldname = 'field[' . $row['fieldid'] . ']';
					switch ( $row['type'] )
					{
						case 'textinput':
							$size = min(50, $row['maxlength']);
							$output[$alias]['fieldhtml'] = $this->CreateInputText( $id, $fieldname, $row['value'], $size, $row['maxlength'] );
							break;

						case 'pulldown':
							$output[$alias]['fieldhtml'] = '';
							break;

						case 'checkbox':
							$output[$alias]['fieldhtml'] = $this->CreateInputCheckbox($id, $fieldname, '1', $row['value'], '');
							break;

						case 'textarea':
							$output[$alias]['fieldhtml'] = $this->CreateTextArea(FALSE, $id, $row['value'], $fieldname);
							break;

						case 'wysiwyg':
							$output[$alias]['fieldhtml'] = $this->CreateTextArea(TRUE, $id, $row['value'], $fieldname);
							break;
					}
				}
			}
		}
		if ( $output === FALSE )
		{
			echo 'ERROR: ' . mysql_error();
			exit();
		}

		return $output;
	}


	function _ArraySort($array, $arguments = array(), $keys = true)
	{
		// source:  http://nl2.php.net/manual/en/function.uasort.php#42723

		// comparing function code
		$code = "\$result=0; ";

		// foreach sorting argument (array key)
		foreach ($arguments as $argument)
		{
			if ( !empty($argument) )
			{
				// order field
				$field = substr($argument, 2, strlen($argument));

				// sort type ("s" -> string, "n" -> numeric)
				$type = $argument[0];

				// sort order ("+" -> "ASC", "-" -> "DESC")
				$order = $argument[1];

				// add "if" statement, which checks if this argument should be used
				$code .= "if (!Is_Numeric(\$result) || \$result == 0) ";

				// if "numeric" sort type
				if (strtolower($type) == "n")
				{
					$code .= $order == "-" ? "\$result = (\$a->{$field} > \$b->{$field} ? -1 : (\$a->{$field} < \$b->{$field} ? 1 : 0));" : "\$result = (\$a->{$field} > \$b->{$field} ? 1 : (\$a->{$field} < \$b->{$field} ? -1 : 0)); ";
				}
				else
				{
					// if "string" sort type
					$code .= $order == "-" ? "\$result = strcoll(\$a->{$field}, \$b->{$field}) * -1;" : "\$result = strcoll(\$a->{$field}, \$b->{$field}); ";
				}
			}
		}
		// return result
		$code .= "return \$result;";

		// create comparing function
		$compare = create_function('$a, $b', $code);

		// sort array and preserve keys
		uasort($array, $compare);
		
		// return array
		return $array;
	}


	function _CreateThumbnail($thumbname, $image, $thumbwidth, $thumbheight, $method)
	{
		$zoom = .30; // zoom percentage
		$imgdata = @getimagesize($image);
		if ( $imgdata === FALSE ) return FALSE;
		$imgratio = $imgdata[0] / $imgdata[1];  // width/height
		$thumbratio = $thumbwidth / $thumbheight;
		switch($method) {
			case "sc": // scale
			case "zs": // zoom & scale
				$src_x = 0;
				$src_y = 0;
				$src_w = $imgdata[0];
				$src_h = $imgdata[1];
				if( $imgratio > $thumbratio )
				{
				$newwidth = $thumbwidth;
				$newheight = ceil($thumbwidth / $imgratio);
				}
				else
				{
				$newheight = $thumbheight;
				$newwidth = ceil($thumbheight * $imgratio);
				}
				break;

			case "cr": // crop
			case "zc": // zoom & crop
				$newwidth = $thumbwidth;
				$newheight = $thumbheight;
				if( $imgratio > $thumbratio )
				{
					$src_x = ceil(($imgdata[0] - $imgdata[1] * $thumbratio) / 2);
					$src_y = 0;
					$src_w = $imgdata[0] - $src_x * 2;
					$src_h = $imgdata[1];
				}
				else
				{
					$src_x = 0;
					$src_y = ceil(($imgdata[1] - $imgdata[0] / $thumbratio) / 3);
					$src_w = $imgdata[0];
					$src_h = $imgdata[1] - $src_y * 3;
				}
				break;
		}
		if ( $method == "zs" || $method == "zc" )
		{
			$src_x = $src_x + ceil($zoom / 2 * $src_w);
			$src_y = $src_y + ceil($zoom / 3 * $src_h);
			$src_w = ceil($src_w * (1-$zoom));
			$src_h = ceil($src_h * (1-$zoom));
		}
		if ( file_exists($thumbname) )
		{
			$thumbdata = getimagesize($thumbname);
		}
		if ( !isset($thumbdata) || $thumbdata[0] != $newwidth || $thumbdata[1] != $newheight )
		{
			$newimage = imagecreatetruecolor($newwidth, $newheight);
			switch($imgdata[2]) {
				case IMAGETYPE_GIF:
					$source = imagecreatefromgif($image);
					$trnprt_indx = imagecolortransparent($source);
					if ($trnprt_indx >= 0)
					{
					@$trnprt_color = imagecolorsforindex($source, $trnprt_indx);
					$trnprt_indx = imagecolorallocate($newimage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
					imagefill($newimage, 0, 0, $trnprt_indx);
					imagecolortransparent($newimage, $trnprt_indx);
					@imagetruecolortopalette($newimage, true, imagecolorstotal($image));
					}
					break;
				case IMAGETYPE_JPEG:
					$source = imagecreatefromjpeg($image);
					break;
				case IMAGETYPE_PNG:
					$source = imagecreatefrompng($image);
					imagealphablending($newimage, false);
					$trnprt_color = imagecolorallocatealpha($newimage, 0, 0, 0, 127);
					imagefill($newimage, 0, 0, $trnprt_color);
					imagesavealpha($newimage, true);
					break;
				default:
					return FALSE;
			}

			imagecopyresampled($newimage, $source, 0, 0, $src_x, $src_y, $newwidth, $newheight, $src_w, $src_h);
			switch($imgdata[2]) {
				case IMAGETYPE_GIF:
					imagegif($newimage, $thumbname);
					break;
				case IMAGETYPE_JPEG:
					imagejpeg($newimage, $thumbname, 80);
					break;
				case IMAGETYPE_PNG:
					imagepng($newimage, $thumbname);
					break;
				default:
					return FALSE;
			}
			imagedestroy($newimage);
		}
		return $thumbname;
	}
}
?>