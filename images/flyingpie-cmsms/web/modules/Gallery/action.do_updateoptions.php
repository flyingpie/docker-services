<?php
if (!isset($gCms)) exit;

if( !$this->CheckPermission('Modify Site Preferences') )
{
	echo $this->ShowErrors(lang('needpermissionto', 'Modify Site Preferences'));
	return;
}

if( !empty($params['urlprefix']) ) $this->SetPreference('urlprefix', munge_string_to_url($params['urlprefix']));
$this->SetPreference('allowed_extensions', $params['allowed_extensions']);
if( !empty( $params['maximagewidth']) && ctype_digit($params['maximagewidth']) ) $this->SetPreference("maximagewidth", $params['maximagewidth']);
if( !empty( $params['maximageheight']) && ctype_digit($params['maximageheight']) ) $this->SetPreference("maximageheight", $params['maximageheight']);
$this->SetPreference('use_comment_wysiwyg', isset($params['use_comment_wysiwyg']) ? $params['use_comment_wysiwyg'] : 0);
$this->SetPreference('editdirdates', isset($params['editdirdates']) ? $params['editdirdates'] : 0);
$this->SetPreference('editfiledates', isset($params['editfiledates']) ? $params['editfiledates'] : 0);
$this->SetPreference('fe_folderpath', empty($params['fe_folderpath']) ? 'modules/Gallery/images/folder.png' : $params['fe_folderpath']);
$this->SetPreference('be_folderpath', empty($params['be_folderpath']) ? 'modules/Gallery/images/foldersmall.png' : $params['be_folderpath']);

if ( isset($params['updatethumbs']) && $params['updatethumbs'] == 1 )
{
	$this->_DeleteFiles(str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERYTHUMBS_PATH), '*', false);
	$galleries = $this->_GetGalleries();
	foreach ($galleries as $gallery)
	{
		$dir = str_replace('/', DIRECTORY_SEPARATOR, '../' . DEFAULT_GALLERY_PATH . $gallery['filepath'] . (empty($gallery['filepath']) ? '' : '/') . ($gallery['filename'] == "Gallery/" ? '' : $gallery['filename']));
		$this->_DeleteFiles($dir, IM_PREFIX . '*', false);
	}
}

$params = array('tab_message'=> 'optionsupdated', 'active_tab' => 'options');
$this->Redirect($id, 'defaultadmin', '', $params);
?>
