<?php /* Smarty version 2.6.26, created on 2014-11-09 14:23:36
         compiled from content:content_en */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'global_content', 'content:content_en', 1, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/71^%%70^707^707A8977%%content%3Acontent_en.inc'] = '20a75f204e3cafad336d2b002e27d282'; ?><p><?php if ($this->caching && !$this->_cache_including): echo '{nocache:20a75f204e3cafad336d2b002e27d282#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('20a75f204e3cafad336d2b002e27d282','0');echo smarty_cms_function_global_content(array('name' => 'menu_madstats_documentation'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:20a75f204e3cafad336d2b002e27d282#0}'; endif;?>
</p>
<p>Madstats can be used in languages other than english, using language files. The 'language' property in the settings file defines which language should be used. All language files are located in the 'languages' folder.</p>
<p>A language is structured into a couple different sections:</p>
<ul>
<li><strong>main.ini</strong> Main pages, such as the playerlist, playerdetails and server status;</li>
<li><strong>configuration.ini</strong> Configuration index;</li>
<li><strong>server.cfg.ini</strong> Server.cfg fields and descriptions;</li>
<li><strong>mani_server.cfg.ini</strong> Mani_server.cfg fields and descriptions;</li>
<li>...</li>
</ul>