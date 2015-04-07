<?php /* Smarty version 2.6.26, created on 2014-11-08 14:24:00
         compiled from content:content_en */

$this->_cache_serials['/home/workspace/flyingpie.nl/cmsms-1.10/tmp/templates_c/58^%%70^707^707A8977%%content%3Acontent_en.inc'] = '31f0965664af3625544e550dd1593a80';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'global_content', 'content:content_en', 1, false),array('function', 'popup_image', 'content:content_en', 3, false),array('function', 'cms_selflink', 'content:content_en', 25, false),)), $this); ?>
<?php
function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_0(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','0');echo smarty_cms_function_global_content(array('name' => 'menu_madstats'), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_1(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','1');echo cms_user_tag_popup_image(array('src' => "madstats/playerlist.png",'title' => 'Player list','desc' => 'The player list is the home page and shows all players that have joined the server','style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_2(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','2');echo cms_user_tag_popup_image(array('src' => "madstats/playerdetails.png",'title' => 'Player details','desc' => "The player details screen features various ingame statistics, but also information from the player's Steam account",'style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_3(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','3');echo cms_user_tag_popup_image(array('src' => "madstats/servers.png",'title' => 'Servers','desc' => "An example configuration with 2 servers, which can be selected via the web interface",'style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_4(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','4');echo cms_user_tag_popup_image(array('src' => "madstats/serverstatus.png",'title' => 'Server status','desc' => "The current map and a list of online players are shown by the server status screen, which can also be used to change the map",'style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_5(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','5');echo cms_user_tag_popup_image(array('src' => "madstats/configuration.png",'title' => 'Configuration','desc' => "The web interface can be used to configure various settings, such as main server settings, bot settings and the message of the day",'style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_6(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','6');echo cms_user_tag_popup_image(array('src' => "madstats/rconclient.png",'title' => 'Rcon client','desc' => "A small rcon client is available to do any manual configuration or send messages to connected players.",'style' => "float: left;"), $_smarty);
}


function _smarty_tplfunc_31f0965664af3625544e550dd1593a80_7(&$_smarty)
{
$_cache_attrs =& $_smarty->_smarty_cache_attrs('31f0965664af3625544e550dd1593a80','7');echo smarty_cms_function_cms_selflink(array('href' => 'madstats-download'), $_smarty);
}



?>
