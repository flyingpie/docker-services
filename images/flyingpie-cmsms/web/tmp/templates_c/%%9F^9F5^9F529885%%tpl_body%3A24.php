<?php /* Smarty version 2.6.26, created on 2014-11-08 14:19:37
         compiled from tpl_body:24 */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'menu', 'tpl_body:24', 12, false),array('function', 'title', 'tpl_body:24', 18, false),array('function', 'content', 'tpl_body:24', 19, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/%%9F^9F5^9F529885%%tpl_body%3A24.inc'] = '74344f86a8cc827a4c09ce0702a99be0'; ?>
<body>
<div id="container">
<!-- start header -->
<div id="header">
  <div id="logo"></div>
</div>
<!-- end header -->

<!-- start menu -->
<div id="menu" class="menu">
  <div id="menu-inner"><?php if ($this->caching && !$this->_cache_including): echo '{nocache:74344f86a8cc827a4c09ce0702a99be0#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('74344f86a8cc827a4c09ce0702a99be0','0');echo smarty_cms_function_menu(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:74344f86a8cc827a4c09ce0702a99be0#0}'; endif;?>
</div>
</div>
<!-- end menu -->

<!-- start content -->
<div id="content">
  <h1><?php if ($this->caching && !$this->_cache_including): echo '{nocache:74344f86a8cc827a4c09ce0702a99be0#1}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('74344f86a8cc827a4c09ce0702a99be0','1');echo smarty_cms_function_title(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:74344f86a8cc827a4c09ce0702a99be0#1}'; endif;?>
</h1>
  <?php if ($this->caching && !$this->_cache_including): echo '{nocache:74344f86a8cc827a4c09ce0702a99be0#2}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('74344f86a8cc827a4c09ce0702a99be0','2');echo smarty_cms_function_content(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:74344f86a8cc827a4c09ce0702a99be0#2}'; endif;?>

</div>
<!-- end content -->

<!-- start footer -->
<div id="footer">
  <div id="footer-content">
    <div id="logos" style="margin-top: 20px; text-align: center;">
        <a href="http://github.com/FlyingPie" title="Flying Pie on GitHub"><img src="uploads/images/githublogo.png"/></a>
    </div>

    <p style="text-align: center;">&copy; 2011 - 2012 Flying Pie</p>
  </div>
</div>
<!-- end footer -->
</div>
<?php echo '
<script type="text/javascript">
  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
'; ?>

</body>
</html>