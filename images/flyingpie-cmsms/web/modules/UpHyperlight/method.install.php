<?php

# $Id: method.install.php 10 2011-06-20 19:38:11Z arnoud $

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
# File   : method.install.php
# Purpose: installs the module, creates tables and set preferences
# License: GPL
#
#-------------------------------------------------------------------------------

if(!is_object(cmsms())) exit;

###############################################################################
# css
###############################################################################

$db = cmsms()->GetDb();

// check css

$query = "SELECT css_id 
            FROM ".cms_db_prefix()."css 
            WHERE css_name = ?";

$css_id = $db->GetOne($query, array( $this->GetName() ) );

// add css 

if (! $css_id ) {
    $css_id = $db->GenID(cms_db_prefix().'css_seq');

    $css = file_get_contents(cms_join_path(dirname(__FILE__), 'css', 'vibrant-ink.css'));
    
    $query = "INSERT INTO ".cms_db_prefix()."css 
                (css_id, css_name, css_text, media_type, create_date) 
                VALUES (?,?,?,?,?)";
            
    $db->Execute($query, array( $css_id, $this->GetName(), $css, 'screen', date('Y-m-d') ) );
}

###############################################################################
# audit
###############################################################################

$this->Audit(0, $this->Lang('friendly_name'), $this->Lang('installed', $this->GetVersion()) );



