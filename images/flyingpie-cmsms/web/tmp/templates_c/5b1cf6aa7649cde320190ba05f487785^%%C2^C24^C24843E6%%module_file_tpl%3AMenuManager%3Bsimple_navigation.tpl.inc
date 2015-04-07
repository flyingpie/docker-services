<?php /* Smarty version 2.6.26, created on 2014-11-11 20:02:02
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/5b1cf6aa7649cde320190ba05f487785^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = '7f1b5a8853e8ad461b9beb48404184a7';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php
function _smarty_tplfunc_7f1b5a8853e8ad461b9beb48404184a7_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('7f1b5a8853e8ad461b9beb48404184a7','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_7f1b5a8853e8ad461b9beb48404184a7_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('7f1b5a8853e8ad461b9beb48404184a7','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_7f1b5a8853e8ad461b9beb48404184a7_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('7f1b5a8853e8ad461b9beb48404184a7','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
