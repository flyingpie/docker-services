<?php /* Smarty version 2.6.26, created on 2014-11-08 14:23:43
         compiled from module_file_tpl:MenuManager%3Bsimple_navigation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'repeat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 17, false),array('modifier', 'cat', 'module_file_tpl:MenuManager;simple_navigation.tpl', 30, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/4af2b11eac17519a74fb8dbe84015e70^%%C2^C24^C24843E6%%module_file_tpl%3AMenuManager%3Bsimple_navigation.tpl.inc'] = 'ea1ef4733f95c06d33eedd73483118d1'; ?> 

<?php $this->assign('number_of_levels', 10000); ?>
<?php if (isset ( $this->_tpl_vars['menuparams']['number_of_levels'] )): ?>
  <?php $this->assign('number_of_levels', $this->_tpl_vars['menuparams']['number_of_levels']); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['count'] > 0): ?>
<ul>
<?php $_from = $this->_tpl_vars['nodelist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['node']):
?>
<?php if ($this->_tpl_vars['node']->depth > $this->_tpl_vars['node']->prevdepth): ?>
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:ea1ef4733f95c06d33eedd73483118d1#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('ea1ef4733f95c06d33eedd73483118d1','0');echo smarty_cms_function_repeat(array('string' => "<ul>",'times' => $this->_tpl_vars['node']->depth-$this->_tpl_vars['node']->prevdepth), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:ea1ef4733f95c06d33eedd73483118d1#0}'; endif;?>

<?php elseif ($this->_tpl_vars['node']->depth < $this->_tpl_vars['node']->prevdepth): ?>
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:ea1ef4733f95c06d33eedd73483118d1#1}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('ea1ef4733f95c06d33eedd73483118d1','1');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $this->_tpl_vars['node']->prevdepth-$this->_tpl_vars['node']->depth), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:ea1ef4733f95c06d33eedd73483118d1#1}'; endif;?>

</li>
<?php elseif ($this->_tpl_vars['node']->index > 0): ?></li>
<?php endif; ?>

<?php if ($this->_tpl_vars['node']->parent == true || $this->_tpl_vars['node']->current == true): ?>
  <?php $this->assign('classes', 'menuactive'); ?>
  <?php if ($this->_tpl_vars['node']->parent == true): ?>
    <?php $this->assign('classes', 'menuactive menuparent'); ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['node']->children_exist == true && $this->_tpl_vars['node']->depth < $this->_tpl_vars['number_of_levels']): ?>
    <?php $this->assign('classes', ((is_array($_tmp=$this->_tpl_vars['classes'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' parent') : smarty_modifier_cat($_tmp, ' parent'))); ?>
  <?php endif; ?>
  <li class="<?php echo $this->_tpl_vars['classes']; ?>
"><a class="<?php echo $this->_tpl_vars['classes']; ?>
" href="<?php echo $this->_tpl_vars['node']->url; ?>
"><span><?php echo $this->_tpl_vars['node']->menutext; ?>
</span></a>

<?php elseif ($this->_tpl_vars['node']->children_exist == true && $this->_tpl_vars['node']->depth < $this->_tpl_vars['number_of_levels'] && $this->_tpl_vars['node']->type != 'sectionheader' && $this->_tpl_vars['node']->type != 'separator'): ?>
<li class="parent"><a class="parent" href="<?php echo $this->_tpl_vars['node']->url; ?>
"><span><?php echo $this->_tpl_vars['node']->menutext; ?>
</span></a>

<?php elseif ($this->_tpl_vars['node']->current == true): ?>
<li class="currentpage"><h3><span><?php echo $this->_tpl_vars['node']->menutext; ?>
</span></h3>

<?php elseif ($this->_tpl_vars['node']->type == 'sectionheader'): ?>
<li class="sectionheader"><span><?php echo $this->_tpl_vars['node']->menutext; ?>
</span>

<?php elseif ($this->_tpl_vars['node']->type == 'separator'): ?>
<li class="separator" style="list-style-type: none;"> <hr />

<?php else: ?>
<li><a href="<?php echo $this->_tpl_vars['node']->url; ?>
"><span><?php echo $this->_tpl_vars['node']->menutext; ?>
</span></a>

<?php endif; ?>

<?php endforeach; endif; unset($_from); ?>
<?php if ($this->caching && !$this->_cache_including): echo '{nocache:ea1ef4733f95c06d33eedd73483118d1#2}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('ea1ef4733f95c06d33eedd73483118d1','2');echo smarty_cms_function_repeat(array('string' => "</li></ul>",'times' => $this->_tpl_vars['node']->depth-1), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:ea1ef4733f95c06d33eedd73483118d1#2}'; endif;?>
</li>
</ul>
<?php endif; ?>