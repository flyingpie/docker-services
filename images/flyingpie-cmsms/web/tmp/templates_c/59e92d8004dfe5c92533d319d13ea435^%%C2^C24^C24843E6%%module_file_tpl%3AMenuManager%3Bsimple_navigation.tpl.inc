<?php /* Smarty version 2.6.26, created on 2014-11-09 02:38:15
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/59e92d8004dfe5c92533d319d13ea435^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = '934604d2f7e78696d522585ae22f16ec';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php
function _smarty_tplfunc_934604d2f7e78696d522585ae22f16ec_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('934604d2f7e78696d522585ae22f16ec','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_934604d2f7e78696d522585ae22f16ec_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('934604d2f7e78696d522585ae22f16ec','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_934604d2f7e78696d522585ae22f16ec_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('934604d2f7e78696d522585ae22f16ec','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
