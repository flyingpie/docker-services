<?php /* Smarty version 2.6.26, created on 2014-11-11 20:03:02
         compiled from content:content_en */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'global_content', 'content:content_en', 1, false),)), $this); ?>
<?php $this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/65^%%70^707^707A8977%%content%3Acontent_en.inc'] = 'a54decc4a584135b7d3e52d08003da40'; ?><div><?php if ($this->caching && !$this->_cache_including): echo '{nocache:a54decc4a584135b7d3e52d08003da40#0}'; endif;$_cache_attrs =& $this->_smarty_cache_attrs('a54decc4a584135b7d3e52d08003da40','0');echo smarty_cms_function_global_content(array('name' => 'menu_madstats_documentation'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:a54decc4a584135b7d3e52d08003da40#0}'; endif;?>
</div>
<h3 id="getting-started">Getting started</h3>
<p>In order to run Madstats, be sure your setup meets the following requirements:</p>
<ul>
<li>Running Counter-Strike Source on a dedicated server, Linux and Windows should both work;</li>
<li>The dedicated server is accessable, either via FTP or locally, when your gameserver is also your webserver;</li>
<li>The configuration files on the dedicated server are writable by the user running the webserver;</li>
<li>The webserver is running PHP5 or above;</li>
<li>The gameserver has <a href="http://www.mani-admin-plugin.com">Mani's Admin Plugin</a> installed;</li>
</ul>
<div> </div>
<h3 id="installation">Installation</h3>
<ol>
<li>Download the code from <a href="https://github.com/FlyingPie/Madstats">GitHub</a> and unpack it to your webfolder;</li>
<li>Make sure the data and config directories are writable;</li>
<li>Open de server_settings_2.txt file, located in the config directory;</li>
<li>Fill in the fields in the file, according to your gameserver;</li>
</ol>
<h3 id="configuration">Configuration</h3>
<p>The server settings file contains the following fields:</p>
<p><strong>srcds_host</strong>: The address of the gameserver;</p>
<p><strong>srcds_port</strong>: The port of the gameserver;</p>
<p><strong>srcds_game</strong>: The game running on the gameserver, currently only cstrike is supported;</p>
<p><strong>srcds_path</strong>: The path to the game directory, e.g. /home/srcds/css/cstrike</p>
<p><strong>connection_method</strong>: Can either be local or ftp;</p>
<p><strong>template</strong>: The template to use;</p>
<p><strong>cache_time</strong>: The maximum amount of time cached data can be used;</p>
<p><strong>api_password</strong>: The password to the remote API;</p>
<p><strong>language</strong>: The language to use</p>
<p><em>The following settings are only required when the <strong>connection_method</strong> is set to ftp;</em></p>
<p><strong>ftp_host</strong>: The address of the ftp server;</p>
<p><strong>ftp_port</strong>: The port of the ftp server;</p>
<p><strong>ftp_username</strong>: The ftp username;</p>
<p><strong>ftp_password</strong>: The ftp password;</p>