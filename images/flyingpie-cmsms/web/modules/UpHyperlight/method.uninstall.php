<?php

# $Id: method.uninstall.php 10 2011-06-20 19:38:11Z arnoud $

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
# File   : method.uninstall.php
# Purpose: uninstalls the module, removes tables, preferences, permissions... 
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

###############################################################################
# audit
###############################################################################

$this->Audit( 0, $this->Lang('friendly_name'), $this->Lang('uninstalled'));





