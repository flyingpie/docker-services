<?php

# $Id: modifier.uphyperlight.php 5 2011-02-20 11:46:36Z arnoud $

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty uphyperlight modifier plugin
 * ----------------------------------------------------------------
 * Type:     modifier 
 * Name:     uphyperlight 
 * Purpose:  syntaxhighlighter
 *
 *
 * @link    http://dev.cmsmadesimple.org/users/arnoud
 * @link    http://code.google.com/p/hyperlight/
 * @author  Arnoud van Susteren <arnoud at upservice dot nl>
 * @param   string
 * @param   filetype : cpp|csharp|css|iphp|php|phyton|vb|xml
 * @param   linenumbers : boolean
 * @return  string
 *
 * If you want to use this smarty modifier cop this file 
 * into /cmsms/plugins directory
 *
 */

function smarty_cms_modifier_uphyperlight($string, $filetype = 'xml', $linenumbers = '0' ) 
{

    $data = array();
    
	$uphyperlight = CMSModule::GetModuleInstance("UpHyperlight");

	if ($uphyperlight != false) 
	{
	    
	    $data['code']           = $string;
	    $data['filetype']       = $filetype;
	    $data['linenumbers']    = $linenumbers;
	    
	    $uphyperlight->Hyperlight($data);
	    
	} 
	
	return $string;    
}

function smarty_cms_help_function_uphyperlight() 
{
    ?>
    <p>Copy modifier.uphyperlight.php to the directory plugins/ </p>
    
    <p>When done you can call this Smarty modifier like: </p>

    <p>&#123;$code&#124;uphyperlight:'xml':'1' &#125; </p>
    
    <p>More documentation can be found under Extensions -> Modules -> UpHyperlight (help)</p>


    <?php
}

function smarty_cms_about_function_uphyperlight() 
{
	?>
	<p>Author: Arnoud van Susteren&lt;arnoud@upservice.nl&gt;</p>
	<p>Version: 1.0</p>
	<p>
	Change History:<br/>
	</p>
	<?php
}

?>
