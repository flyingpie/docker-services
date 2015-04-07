<?php /* Smarty version 2.6.26, created on 2014-11-08 14:19:37
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/cd9e80d0ddd0da893c296d0bd28c06c2^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = '4a410fef202fbef2b1502c47845f1fff';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php
function _smarty_tplfunc_4a410fef202fbef2b1502c47845f1fff_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('4a410fef202fbef2b1502c47845f1fff','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_4a410fef202fbef2b1502c47845f1fff_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('4a410fef202fbef2b1502c47845f1fff','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_4a410fef202fbef2b1502c47845f1fff_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('4a410fef202fbef2b1502c47845f1fff','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
