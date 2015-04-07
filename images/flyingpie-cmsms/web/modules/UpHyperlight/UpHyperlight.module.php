<?php

# $Id: UpHyperlight.module.php 12 2011-10-22 12:14:41Z arnoud $

#-------------------------------------------------------------------------------
#
# Module : UpHyperlight (c) 2011 - UpService
#          by Arnoud van Susteren (arnoud@upservice.nl) 
#          is a server-side syntax highlighter for CMS Made Simple
#          The projects homepage is: dev.cmsmadesimple.org/projects/uphyperlight
#          Hyperlight is (c) 2008-2011 by Konrad Rudolph
#          The projects homepage is: http://code.google.com/p/hyperlight
#          CMS Made Simple is (c) 2004-2011 by Ted Kulp
#          The projects homepage is: cmsmadesimple.org
# File   : action.default.php
# Purpose: main module class 
# License: GPL
#
#-------------------------------------------------------------------------------

/**
 * Class definition and methods for UpHyperlight
 *
 * @package CMSModule
 * @license GPL
 */

/**
 * Main class of the UpHyperlight Module
 *
 * @author Arnoud van Susteren
 * @copyright 2011 Arnoud van Susteren - UpService
 *
 * @package CMSModule
 * @license GPL
 */

 class UpHyperlight extends CMSModule {
     
    public static $filetypes = array ('cpp', 'csharp', 'css', 'iphp', 'php', 'phython', 'vb', 'xml');
           
    ###########################################################################
    # cmsms
    ###########################################################################    
   
    /**
     * Constructor
     * @ignore
     */
     function __construct() 
     {
        spl_autoload_register(array($this,'autoload'));
        parent::__construct(); 
     }
     
    /**
     * autoload method
     * @param $classname - string
     * @return true|false
     */
    public function autoload($classname) 
    {
     
        if ( !is_object($this) ) 
        {
            return false;
        }
        
        $classname = strtolower($classname);
                
        $fn = $this->GetModulePath()."/lib/hyperlight/{$classname}.php";
        
        if ( file_exists($fn) ) 
        {
            require_once($fn);
            return true;
        }
  
    }

    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetName
     * @ignore
     */
    function GetName() 
    { 
        return 'UpHyperlight'; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetFriendlyName
     * @ignore
     */
    function GetFriendlyName() 
    { 
        return $this->Lang('friendly_name'); 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetVersion
     * @ignore
     */
    function GetVersion() 
    { 
        return '1.4'; 
    }
    
    /**
    * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#MinimumCMSVersion
    * @ignore
    */
    function MinimumCMSVersion() 
    { 
        return '1.8.2'; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#MaximumCMSVersion
     * @ignore
     */
     function MaximumCMSVersion() 
     {
         return "1.10.9";
     }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetHelp
     * @ignore
     */
    public function GetHelp() 
    { 
        return $this->Lang('help'); 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAuthor
     * @ignore
     */
    function GetAuthor() 
    { 
        return 'Arnoud van Susteren'; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAuthorEmail
     * @ignore
     */
    function GetAuthorEmail() 
    { 
        return 'arnoud@upservice.nl'; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetChangeLog
     * @ignore
     */
    function GetChangeLog() 
    { 
        return file_get_contents(dirname(__FILE__).'/doc/changelog.txt');
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#IsPluginModule
     * @ignore
     */
    function IsPluginModule() 
    { 
        return true; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#HasAdmin
     * @ignore
     */
    function HasAdmin() 
    {
        return false; 
    }

    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAdminSection
     * @ignore
     */
    function GetAdminSection() 
    { 
        return 'content'; 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetAdminDescription
     * @ignore
     */
    function GetAdminDescription() 
    { 
        return $this->Lang('admin_description'); 
    }
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#VisibleToAdminUser
     * @ignore
     */
   function VisibleToAdminUser() 
   { 
       return false;
   } 
    
    /**
     * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#GetDependecies
     * @ignore
     */
    function GetDependencies() 
    { 
        return array(); 
    }
    
    /**
    * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#InstallPostMessage
    * @ignore
    */
    function InstallPostMessage() 
    { 
        return $this->Lang('install_post_message'); 
    }
    
    /**
    * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#UninstallPostMessage
    * @ignore
    */
    function UninstallPostMessage() 
    { 
        return $this->Lang('uninstall_post_message'); 
    }
            
    ###########################################################################
    # actions
    ########################################################################### 
        
    /**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#DoAction
	 * @ignore
	 */
	 
	function DoAction($action, $id, $params, $returnid = '') 
	{
	    $this->Hyperlight($params);
	}
	
	/**
	 * @link http://www.cmsmadesimple.org/apidoc/CMS/CMSModule.html#SetParameters
	 *
	 * Called from within the constructor, Only for frontend module actions
	 * This method should be overridden to create routes, and set handled params
	 * and performs other initialization tasks that need to be setup for all
	 * frontend actions
	 *
	 */
	function SetParameters() 
	{
		
	    // no unknown parameters
	    $this->RestrictUnknownParams();
		
	    // register plugin to smarty with the name of the module
		$this->RegisterModulePlugin();
        
		// no routes
		// $this->SetupRoutes();
		
		$this->CreateParameter('code', 'code_to_hyperlight', $this->Lang('help_code'), false);
        $this->SetParameterType('code', CLEAN_NONE);
		
		$this->CreateParameter('filetype', 'xml', $this->Lang('help_filetype'), true);
        $this->SetParameterType('filetype', CLEAN_STRING);
                        
        $this->CreateParameter('linenumbers', '0', $this->Lang('help_linenumbers'), true);
        $this->SetParameterType('linenumbers', CLEAN_INT);
		
	}
    
	###########################################################################
    # subroutines
    ###########################################################################
    
    function Hyperlight($params) 
    {

        $data = array();

        // filetype
        in_array($params['filetype'], self::$filetypes) == '1' ? $data['filetype'] = $params['filetype'] : $data['filetype'] = 'xml';

        // code
        empty($params['code']) == '1' ? $data['code'] = $this->Lang('code_empty') : $data['code'] = trim($params['code']);

        // linenumbers
        $params['linenumbers'] == '1' ? $data['linenumbers'] = 1 : $data['linenumbers'] = 0;
        
        $hyperlight = new Hyperlight($data['filetype']);

        if (! $data['linenumbers']) 
        {

            print "<pre class='source-code ". $data['filetype'] ."'>\n";
            $hyperlight->renderAndPrint($data['code']);
            print "</pre>\n";

        } else 
        {

            $code       = $hyperlight->render($data['code']);
            $lines      = count(explode("\n", $code));
            $code_lines = (explode("\n", $code));

            print "<pre class='source-code ". $data['filetype'] ."'>\n";
            print "<ol class='line-numbers'>";
            for ($i = 0; $i < $lines; $i++) 
            {
                print "<li><div>&nbsp;". $code_lines[$i]. "</div></li>\n";
            }    
            print "</ol>";
            print "</pre>\n";

        }
        
    }
	
}

?>
