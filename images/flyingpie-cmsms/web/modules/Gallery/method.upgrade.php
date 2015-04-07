<?php
#-------------------------------------------------------------------------
# Module: Gallery
# Method: Upgrade
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2008 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/gallery/
#-------------------------------------------------------------------------

if (!isset($gCms)) exit;


$current_version = $oldversion;
$db =& $this->GetDb();
$taboptarray = array( 'mysql' => 'ENGINE=MyISAM' );
$dict = NewDataDictionary( $db );

switch($current_version)
{
	case "1.0":
	case "1.0.1":
	case "1.0.2":
	case "1.0.3":
// delete all thumbnails and old thumb directory
		$thumbsfolder = '..'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'Gallery'.DIRECTORY_SEPARATOR.'thumbs';
		if( $dh = @opendir($thumbsfolder) )
		{
			while( false !== ($obj = readdir($dh)) )
			{
				if( $obj != '.' && $obj != '..' )
				{
					@unlink($thumbsfolder.DIRECTORY_SEPARATOR.$obj);
				}
			}
			closedir($dh);
		}
		@rmdir($thumbsfolder);
// create new database table for template properties
		$flds = "
			templateid I KEY AUTO,
			template C(255),
			thumbwidth I,
			thumbheight I,
			resizemethod C(10),
			maxnumber I,
			sortitems C(255)
		";
		$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_gallery_templateprops", $flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);

// save templateproperties for every Gallery template
		$query = "SELECT template_name FROM " . cms_db_prefix() . "module_templates WHERE module_name=?";
		$result = $db->Execute($query, array('Gallery'));
		if ( $result && $result->RecordCount() > 0 )
		{
		  while ( $row=$result->FetchRow() )
		  {
				$query2 = "INSERT INTO " . cms_db_prefix() . "module_gallery_templateprops (template,sortitems) VALUES (?,?)";
				$result2 = $db->Execute($query2, array($row['template_name'],'n-isdir/s+file'));
				if ( $result2 )
				{
					$tplid[$row['template_name']] = $db->Insert_ID();
				}
				else
				{
					echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
					exit();
				}
		  }
		}
		if ( !$result )
		{
			echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
			exit();
		}
// pass over thumbsettings from galleryprops to templateprops
		$tpl = array();
		$query = "SELECT fileid, template, thumbwidth, thumbheight, resizemethod FROM " . cms_db_prefix() . "module_gallery_props";
		$result = $db->Execute($query);
		if ( $result && $result->RecordCount() > 0 )
		{
			$defaulttemplate = $this->GetPreference('current_template');
		  while ( $row=$result->FetchRow() )
		  {
				$tpl[$row['fileid']] = isset($tplid[$row['template']]) ? $tplid[$row['template']] : 0;
				$row['template'] = ($row['template'] == 'usedefaulttemplate') ? $defaulttemplate : $row['template'];
				$query2 = "UPDATE " . cms_db_prefix() . "module_gallery_templateprops  SET thumbwidth=?, thumbheight=?, resizemethod=? WHERE template=?";
				$result2 = $db->Execute($query2, array($row['thumbwidth'],$row['thumbheight'],$row['resizemethod'],$row['template']));
				if ( !$result2 )
				{
					echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
					exit();
				}
		  }
		}
		if ( !$result )
		{
			echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
			exit();
		}
// drop table galleryprops
		$sqlarray = $dict->DropTableSQL( cms_db_prefix()."module_gallery_props" );
		$dict->ExecuteSQLArray($sqlarray);

// create new table galleryprops and fill it for every subgallery
		$flds = "
			fileid I KEY,
			templateid I,
			hideparentlink I
		";
		$sqlarray = $dict->CreateTableSQL( cms_db_prefix()."module_gallery_props", $flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);
		$query = "SELECT fileid FROM " . cms_db_prefix() . "module_gallery WHERE filename LIKE '%/'";
		$result = $db->Execute($query);
		if ( $result && $result->RecordCount() > 0 )
		{
		  while ( $row=$result->FetchRow() )
		  {
				$tpl[$row['fileid']] = isset($tpl[$row['fileid']]) ? $tpl[$row['fileid']] : 0;
				$hideparentlink = $row['fileid'] == 1 ? 1 : 0;
				$query2 = "INSERT INTO " . cms_db_prefix() . "module_gallery_props (fileid,templateid,hideparentlink) VALUES (?,?,?)";
				$result2 = $db->Execute($query2, array($row['fileid'], $tpl[$row['fileid']], $hideparentlink));
				if ( !$result2 )
				{
					echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
					exit();
				}
		  }
		}
		if ( !$result )
		{
			echo 'ERROR ' . __LINE__ . ': ' . mysql_error();
			exit();
		}
		$current_version = "1.1";

	case "1.1":
		// create new thumbsfolder
		$thumbsfolder = '..'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'GalleryThumbs'.DIRECTORY_SEPARATOR;
		if( !is_dir($thumbsfolder) )
		{
			mkdir($thumbsfolder);
		}
		$current_version = "1.1.1";

	case "1.1.1":
	case "1.1.2":
		$sqlarray = $dict->AddColumnSQL(cms_db_prefix()."module_gallery_templateprops", "version C(20), about X, visible I");
		$dict->ExecuteSQLArray($sqlarray);
		$query = "UPDATE ".cms_db_prefix()."module_gallery_templateprops SET visible=1";
		$db->Execute($query);
		$current_version = "1.2";

	case "1.2":
	case "1.2.1":
	case "1.2.2":
		$this->SetPreference("singleimg_template", 'Fancybox');
		$this->SetPreference("singleimg_template_html", '<a class="group" href="{$image->file|escape:\'url\'|replace:\'%2F\':\'/\'}" title="{$image->title}" rel="gallery"><img src="{$image->thumb|escape:\'url\'|replace:\'%2F\':\'/\'}" alt="{$image->title}" /></a>');
		$this->SetPreference("maximagewidth", 1024);
		$this->SetPreference("maximageheight", 768);

		$current_version = "1.3";

	case "1.3":
	case "1.3.1":
		$this->AddEventHandler( 'Core', 'ContentPostRender', false );

		$current_version = "1.3.2";

	case "1.3.2":
		$this->SetPreference("urlprefix", 'gallery');
		$this->SetPreference("fe_folderpath", 'modules/Gallery/images/folder.png');
		$this->SetPreference("be_folderpath", 'modules/Gallery/images/foldersmall.png');
		$this->SetPreference("editdirdates", false);
		$this->SetPreference("editfiledates", false);

		$flds = "
			fieldid I KEY AUTO,
			name C(255),
			type C(20),
			maxlength I,
			dirfield L,
			sortorder I,
			public L
		";
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_gallery_fielddefs", $flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);

		$flds = "
			fileid I KEY NOT NULL,
			fieldid I KEY NOT NULL,
			value X
		";
		$sqlarray = $dict->CreateTableSQL(cms_db_prefix()."module_gallery_fieldvals", $flds, $taboptarray);
		$dict->ExecuteSQLArray($sqlarray);

		@unlink('../modules/Gallery/event.Core.ContentPostRender.php');

		$fn = dirname(__FILE__).DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'Gallery-tpl-gallerytree.xml';
		if( file_exists( $fn ) )
		{
			$xml = @file_get_contents($fn);
			include 'function.importtemplate.php';
		}
		
}

$current_version = "1.4.4";

// put mention into the admin log
$this->Audit( 0,
	      $this->Lang('friendlyname'),
	      $this->Lang('upgraded', $current_version));

?>