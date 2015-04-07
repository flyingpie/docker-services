<?php /* Smarty version 2.6.26, created on 2014-11-11 20:03:02
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/067bc30d610f28825755d1aefdc15744^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = 'f8f8bab7ca1f5cca25763c221118d76f';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php
function _smarty_tplfunc_f8f8bab7ca1f5cca25763c221118d76f_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('f8f8bab7ca1f5cca25763c221118d76f','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_f8f8bab7ca1f5cca25763c221118d76f_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('f8f8bab7ca1f5cca25763c221118d76f','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_f8f8bab7ca1f5cca25763c221118d76f_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('f8f8bab7ca1f5cca25763c221118d76f','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
