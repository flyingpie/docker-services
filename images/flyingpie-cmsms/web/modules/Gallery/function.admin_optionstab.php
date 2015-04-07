<?php

  // CreateFormStart sets up a proper form tag that will cause the submit to
  // return control to this module for processing.
$smarty->assign('startform', $this->CreateFormStart ($id, 'do_updateoptions', $returnid));
$smarty->assign('endform', $this->CreateFormEnd ());

$smarty->assign('urlprefix',$this->Lang('urlprefix'));
$smarty->assign('input_urlprefix',$this->CreateInputText($id,'urlprefix',$this->GetPreference('urlprefix','gallery'),15,50));
$smarty->assign('urlprefix_help',$this->Lang('urlprefix_help'));

$smarty->assign('allowed_extensions',$this->Lang('allowed_extensions'));
$smarty->assign('input_allowed_extensions',$this->CreateInputText($id,'allowed_extensions',$this->GetPreference('allowed_extensions',''),50,255));

$this->smarty->assign('prompt_imagesize', $this->Lang('maxsize'));
$this->smarty->assign('imagesize',
		$this->Lang('width') . ':&nbsp;' .
		$this->CreateInputText( $id, 'maximagewidth', $this->GetPreference('maximagewidth',800), 4, 4 ) .
		'&nbsp;&nbsp;&nbsp;' . $this->Lang('height') . ':&nbsp;' .
		$this->CreateInputText( $id, 'maximageheight', $this->GetPreference('maximageheight',800), 4, 4 )
);

$smarty->assign('use_comment_wysiwyg',$this->Lang('use_comment_wysiwyg'));
$smarty->assign('input_use_comment_wysiwyg', $this->CreateInputCheckbox($id, 'use_comment_wysiwyg', '1', $this->GetPreference('use_comment_wysiwyg',1)));

$smarty->assign('editdirdates',$this->Lang('editdirdates'));
$smarty->assign('input_editdirdates', $this->CreateInputCheckbox($id, 'editdirdates', '1', $this->GetPreference('editdirdates',1)));

$smarty->assign('editfiledates',$this->Lang('editfiledates'));
$smarty->assign('input_editfiledates', $this->CreateInputCheckbox($id, 'editfiledates', '1', $this->GetPreference('editfiledates',1)));

$smarty->assign('fe_folderpath',$this->Lang('fe_folderpath'));
$smarty->assign('input_fe_folderpath', $this->CreateInputText($id, 'fe_folderpath', $this->GetPreference('fe_folderpath', 'modules/Gallery/images/folder.png'),50,255));

$smarty->assign('be_folderpath',$this->Lang('be_folderpath'));
$smarty->assign('input_be_folderpath', $this->CreateInputText($id, 'be_folderpath', $this->GetPreference('be_folderpath', 'modules/Gallery/images/foldersmall.png'),50,255));

$smarty->assign('updatethumbs',$this->Lang('updatethumbs'));
$smarty->assign('input_updatethumbs', $this->CreateInputCheckbox($id, 'updatethumbs', '1', 0) . ' ' . $this->Lang('thumbsrecreated'));

$smarty->assign('submit', $this->CreateInputSubmit ($id, 'optionssubmitbutton', $this->Lang('submit')));

// Display the populated template
echo $this->ProcessTemplate ('adminoptions.tpl');

?>