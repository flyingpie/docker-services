<?php /* Smarty version 2.6.26, created on 2014-11-17 22:01:27
         compiled from module_file_tpl:MicroTiny%3Bmicrotinyconfig.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cms_stylesheet', 'module_file_tpl:MicroTiny;microtinyconfig.tpl', 8, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/MicroTiny^%%A4^A4D^A4D98377%%module_file_tpl%3AMicroTiny%3Bmicrotinyconfig.tpl.inc'] = 'b63a2d19818764536b2f279ca89bc7bb'; ?><?php echo ' tinyMCE.init({ '; ?>

    mode : "exact",
  elements : "<?php echo $this->_tpl_vars['textareas']; ?>
",
  body_class : "CMSMSBody",
  <?php if (isset ( $this->_tpl_vars['templateid'] )): ?>
  <?php if (isset ( $this->_tpl_vars['stripbackground'] )): ?>
  content_css : "<?php if ($this->caching && !$this->_cache_including): echo '{nocache:b63a2d19818764536b2f279ca89bc7bb#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('b63a2d19818764536b2f279ca89bc7bb','0');echo smarty_cms_function_cms_stylesheet(array('templateid' => $this->_tpl_vars['templateid'],'nolinks' => 1,'adjustforeditor' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:b63a2d19818764536b2f279ca89bc7bb#0}'; endif;?>
",
  <?php else: ?>
  content_css : "<?php if ($this->caching && !$this->_cache_including): echo '{nocache:b63a2d19818764536b2f279ca89bc7bb#1}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('b63a2d19818764536b2f279ca89bc7bb','1');echo smarty_cms_function_cms_stylesheet(array('templateid' => $this->_tpl_vars['templateid'],'nolinks' => 1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:b63a2d19818764536b2f279ca89bc7bb#1}'; endif;?>
",
  <?php endif; ?>
  <?php endif; ?>
    entity_encoding : "raw",
  button_tile_map : true, 

		
  theme : "advanced",
  skin : "o2k7",
  skin_variant : "black",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  visual : true,
	      
  accessibility_warnings : false,

  forced_root_block : '',      			
  fix_list_elements : true,
  verify_html : true,
  verify_css_classes : false,
  
  plugins : "paste,inlinepopups<?php if ($this->_tpl_vars['isfrontend'] == false): ?>,cmslinker<?php endif; ?>",
  
  paste_auto_cleanup_on_paste : true,
  paste_remove_spans : true,
  paste_remove_styles : true,
  theme_advanced_buttons1 : "<?php echo $this->_tpl_vars['toolbar']; ?>
",
  theme_advanced_buttons2 : "",
  theme_advanced_buttons3 : "",
  
<?php if ($this->_tpl_vars['isfrontend'] == false): ?>
<?php if ($this->_tpl_vars['show_statusbar'] == 1): ?>
  theme_advanced_statusbar_location: "bottom",
<?php if ($this->_tpl_vars['allow_resize'] == 1): ?>
  theme_advanced_resizing: true,
<?php endif; ?> 
<?php endif; ?>
<?php endif; ?>

  theme_advanced_blockformats : "p,div,h1,h2,h3,h4,h5,h6,blockquote,code",
  document_base_url : "<?php echo $this->_tpl_vars['rooturl']; ?>
/",

  relative_urls : true,
  remove_script_host : true,
  language: "<?php echo $this->_tpl_vars['language']; ?>
",
  dialog_type: "modal",
  apply_source_formatting : true  
	 
<?php if (isset ( $this->_tpl_vars['css_styles'] ) && $this->_tpl_vars['css_styles'] != ''): ?>
  ,theme_advanced_styles : '<?php echo $this->_tpl_vars['css_styles']; ?>
'
<?php endif; ?>
<?php if ($this->_tpl_vars['isfrontend'] == false): ?>
  ,file_browser_callback : 'CMSMSFilePicker'
<?php endif; ?>
  <?php echo '
});
  '; ?>


<?php if ($this->_tpl_vars['isfrontend'] == false): ?><?php echo '
function toggleMicroTiny(id) {
  if (!tinyMCE.getInstanceById(id))
    tinyMCE.execCommand(\'mceAddControl\', false, id);
  else
    tinyMCE.execCommand(\'mceRemoveControl\', false, id);
}
'; ?>
<?php endif; ?>
	
  <?php if ($this->_tpl_vars['isfrontend'] == false): ?>
  <?php echo '
function CMSMSFilePicker (field_name, url, type, win) {
  '; ?>
   
  var cmsURL = "<?php echo $this->_tpl_vars['rooturl']; ?>
/modules/MicroTiny/filepicker.php?<?php echo $this->_tpl_vars['urlext']; ?>
&type="+type;
  <?php echo '
  tinyMCE.activeEditor.windowManager.open({
  '; ?>

    file : cmsURL,
    title : '<?php echo $this->_tpl_vars['filepickertitle']; ?>
',
    width : '800',
    height : '500',
    resizable : "yes",
    scrollbars : "yes",
    inline : "yes",      close_previous : "no"
  <?php echo '
  }, {
    window : win,
    input : field_name
  });
  return false;
}
'; ?>

<?php endif; ?>