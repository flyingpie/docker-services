<?php

$lang['friendly_name'] = 'UpHyperlight';
$lang['admin_description'] = 'UpHyperlight a server-side syntax highlighter';
$lang['install_post_message'] = 'UpHyperlight is installed';
$lang['uninstall_post_message'] = 'UpHyperlight is uninstalled';

$lang['code_empty'] = 'Parameter code is empty'; 

$lang['help'] = <<<EOT
<h2>About</h2>

<p>
UpHyperlight is a server-side syntax highlighter. If you write news articles or blog posts and want to include source code. This module can help you to display and format it.
</p>

<p>
As an option you can define different source code formats (filetypes) and display them with or without linenumbers. 
</p>

<p>
During installation an UpHyperlight.css file is added to Layout -> Stylesheets from where you can control the look & feel of the UpHyperlight output.
</p>

<p>
UpHyperlight is a wrapper around hyperlight. Hyperlight is (c) 2008-2011 by Konrad Rudolph. The projects homepage is: <a href="http://code.google.com/p/hyperlight">http://code.google.com/p/hyperlight</a>
</p>

<h2>How to use</h2>

<p>

<b>Assign \$code</b><br />

<pre>
{capture assign='code'}
{literal}
... code here ....
{/literal}
{/capture}
</pre>

<br /><b>Call the module with the proper parameters</b><br /><br />

<pre>
{UpHyperlight filetype='html' code=\$code linenumbers='1'}
</pre>

</p>

<h2>Smarty modifier</h2>

<p>In the directory modules/UpHyperlight/ you can find the a plugin file for Smarty. Copy modifier.uphyperlight.php to the directory plugins/</p>

<p>
When done you can call this Smarty modifier like:

<pre>

&#123;\$code&#124;uphyperlight:'xml':'1' &#125; 

</pre>

</p>

<h2>Support</h2>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Bug Report or buy commercial support, please visit the cms development forge at <a href="http://dev.cmsmadesimple.org">dev.cmsmadesimple.org</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>The author(s), arnoud et all can sometimes be found in the <a href="irc://irc.freenode.net/#cms">CMS IRC Channel</a>.</li>
<li>Lastly, you may have some success emailing the author(s) directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text
of the <a href="http://www.gnu.org/licenses/licenses.html#GPL">license</a> for the full disclaimer.</p>

<h2>Copyright and License</h2>
<p>Copyright &copy; 2011, Arnoud van Susteren <a href="mailto:arnoud@upservice.nl">&lt;arnoud@upservice.nl&gt;</a>. All Rights Are Reserved.</p>

<strong>Support more mods like this:</strong>

<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
</form><br/><br/>

<p>This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.</p>
<p>However, as a special exception to the GPL, this software is distributed
as an addon module to CMS Made Simple.  You may not use this software
in any Non GPL version of CMS Made simple, or in any version of CMS
Made simple that does not indicate clearly and obviously in its admin 
section that the site was built with CMS Made simple.</p>
<p>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Or read it <a href="http://www.gnu.org/licenses/licenses.html#GPL">online</a></p>

<br />


</p>



EOT;


$lang['help_code'] = '<i>string</i> - Parameter contains the code to hyperlight';
$lang['help_filetype'] = '<i>string</i>: (cpp|csharp|css| iphp|php|phython|vb|xml), xml is the default. - Parameter is used to specify the filetype of the code to hyperlight.';
$lang['help_linenumbers'] = '<i>boolean</i> (1|0) 0 is the default. - Parameter is used to show the linenumbers or not';
