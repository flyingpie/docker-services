<?php
#Download Counter module
#(c)2009 by Kazimierz Krol (kazink@gmail.com)
#
#designed for use with
#CMS Made Simple (c)2004 by Ted Kulp (wishy@users.sf.net)
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
#This module is largely based on Comments module by Andi Petzoldt (not that I
#copied the code from it (for some code I did), but rather I copied some solutions). I would like to
#thank Andi and various other module developers, and also all people who wrote
#module writing help for beginners: all your work was a huge help for me,
#thanks!

class DownCnt extends CMSModule
{
  function GetName()
  {
    return 'DownCnt';
  }

  function GetFriendlyName()
  {
    return $this->Lang('modulename');
  }

  function GetVersion()
  {
    return '1.1.1';
  }

  function GetHelp($lang = 'en_US')
  {
    return $this->Lang('help');
  }

  function GetAuthor()
  {
    return 'Kazimierz Krol and Kevin Danezis';
  }

  function GetAuthorEmail()
  {
    return 'kazink@gmail.com or contact@furie.be';
  }
  
  function GetChangeLog()
  {
    return $this->Lang('changeLog');
  }
  
  function IsPluginModule()
  {
    return true;
  }
  
  function HasAdmin()
  {
    return true;
  }
  
  function GetAdminSection()
  {
    return 'content';
  }
  
  function GetAdminDescription()
  {
    return $this->Lang('description');
  }
  
  function VisibleToAdminUser()
  {
    return $this->CheckPermission('Manage Download Counters');
  }

  function MinimumCMSVersion()
  {
    return '1.6.7';
  }

  function SetParameters()
  {
	//use {mymodule ...} instead of {cms_module module='mymodule' ...}
	$this->RegisterModulePlugin();
   
    $this->CreateParameter('action', 'default', $this->lang('param_action'));
	$this->SetParameterType('module_message',CLEAN_STRING);
	
    $this->CreateParameter('name', '', $this->lang('param_name'));
	$this->SetParameterType('name',CLEAN_STRING);
	
    $this->CreateParameter('link', '', $this->lang('param_link'));
	$this->SetParameterType('link',CLEAN_STRING);
	
    $this->CreateParameter('protocol', '', $this->lang('param_protocol'));
	$this->SetParameterType('protocol',CLEAN_STRING);
	
	// Don't allow parameters other than the ones you've explicitly defined
	$this->RestrictUnknownParams();
  }

  function InstallPostMessage()
  {
    return $this->Lang('postinstall');
  }
  
  function UninstallPreMessage()
  {
    return $this->Lang('pre_uninstall');
  }

}

?>
