<?php /* Smarty version 2.6.26, created on 2014-11-10 16:21:52
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/cb97430c61e6ca82cafa8703e53f52fa^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = 'd9827120af83f4cf8c00fedcdc449656';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php
function _smarty_tplfunc_d9827120af83f4cf8c00fedcdc449656_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('d9827120af83f4cf8c00fedcdc449656','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $_smarty->_tpl_vars['node']->depth-$_smarty->_tpl_vars['node']->prevdepth), $_smarty);
}


function _smarty_tplfunc_d9827120af83f4cf8c00fedcdc449656_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('d9827120af83f4cf8c00fedcdc449656','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->prevdepth-$_smarty->_tpl_vars['node']->depth), $_smarty);
}


function _smarty_tplfunc_d9827120af83f4cf8c00fedcdc449656_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('d9827120af83f4cf8c00fedcdc449656','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $_smarty->_tpl_vars['node']->depth-1), $_smarty);
}



?>
