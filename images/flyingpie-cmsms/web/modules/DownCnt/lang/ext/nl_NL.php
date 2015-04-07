<?php
$lang['modulename'] = 'Download Counter ';
$lang['help'] = '<h3>What does this do?</h3>
<p>The Download Counter module is a very simple tag module. It&#039;s used to add download counters to files you present on your page.
This module does not depend on Uploads, nor any other module. You can use it for any file you want, no matter which way it has been uploaded to the server. Even better: you can use it for <b>any link</b> to your site pointing to your site or at another site to count how many times it has been clicked!
</p>

<h3>How to use it?</h3>
<p>Download counter is just a tag module. It&#039;s inserted into your page or template by using the cms_module tag. Example syntax would be:<br />


<code>{DownCnt name=&#039;counter_name&#039; link=&#039;targetsite.com&#039; protocol=&#039;http&#039;}</code> - for counting clicks, and<br />
<code>(DownCnt name=&#039;counter_name&#039; action=&#039;display&#039;}</code> - for displaying the counter value.</p>
<p>Make sure to set the &#039;Manage Download Counters&#039; permission on users who will be administrating the counters.</p>

<h4>careful with the WYSIWYG!</h4>

<p>in a content-bloc with WYSIWYG-enabled it is dangerous to write :</p>

<p>
<code><a href=<span style="background-color:#000000;color:#FFFFFF;">&quot;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span> link=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>downloads/the_file.zip<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>>download this file</a></code> <span style=&quot;color:#F00;&quot;>--> same indicator in the smarty code and external</span><br/>

<code><a href=<span style="background-color:#000000;color:#FFFFFF;">&#039;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span> link=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>downloads/the_file.zip<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>>download this file</a></code> <span style=&quot;color:#F00;&quot;>--> same indicator in the smarty code and external</span><br/>

<code><a href=<span style="background-color:#000000;color:#FFFFFF;">&#039;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span> link=&quot;downloads/the_file.zip&quot;}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>>download this file</a></code> <span style=&quot;color:#F00;&quot;>--> same indicator in the smarty code and external</span><br/>
</p>

<p>because TinyMce will destroy the code :(</p>

<p>in the WYSIWYG, TinyMCE always generates a new link in the same way: </p>

<code><a href=<b>&quot;</b>XXXXXXX<b>&quot;</b>>bla bla</a></code><br/><br/>

<p>with XXXXXXX as the URL of the link. Therefore it is imperative to take the code with apostrophes (&#039;) and not with quotation marks (&quot;) so that it finds TinyMCE</p>

<code><a href=<b>&quot;</b>{DownCnt name=<b>&#039;</b>the_file<b>&#039;</b> link=&#039;downloads/the_file.zip&#039;}<b>&quot;</b>>download this file</a></code> <span style=&quot;color:#0A0;&quot;>--> different indicator in the smarty code and external</span><br/><br/>

<h3>Parameters</h3>
<ul>
<li><i>action</i> - action to be taken in the current tag. The possible values are:
  <ul>
    <li><i>default</i> - this tag will perform counting; to make it working it should be placed instead of the target address of the <a> html tag (for example: <a href="{DownCnt ...)"; <i>name</i> and <i>link</i> parameters are required for this action; <i>protocol</i> is requiered if you want external link</li>
    <li><i>display</i> - this tag will only display the counter for given name; <i>name</i> parameter is required for this action;</li>
  </ul>
<li><i>name</i> - name of the counter to be used; the name may be anything you want (the file name for example), but it should be unique across the CMS installation; the name is an identifier by which the module distinguishes separate counters; the name cannot be longer than 255 characters!</li>
<li><i>link</i> - required only if <i>action</i>=&#039;default&#039;; put here the link to the target resource - the link that otherwise would be used as href of the <a> html tag; the path is relative to the CMS MS installation directory. For external links you musn&#039;t include <b>http://</b> but you must add the <b>param protocol</b>.</li>
<li><i>protocol</i> - useful if and only if you define an external url to your website with param <i>link</i>. it can take the value of <b>http</b> / <b>https</b> / <b>ftp</b> (http is the most common)
</ul>
<br/>
<p>To display the counter of a link after the actual link the tag must be used twice - first with default <i>action</i> (the <i>action</i> parameter may be omitted in this case), and second with <i>action</i>=&#039;display&#039;, and the same <i>name</i> must be set in both tags.</p>

<h3>Examples</h3>
<h4>Creating link to a site or downloadable file that will count clicks:</h4>
<p>If your link looks like<br />
<br />
<code><a href="/downloads/the_file.zip">download this file</a></code> or<br />
<code><a href="http://somesite.com">go to the site</a></code> or<br />
<code><a href="www.somesite.com/sub/contact.html">go to the site</a></code> or<br />
<code><a href="ftp://sub.somesite.com">see my ftp file</a></code><br />
<br />
to make the link counting clicks, you will have to change it to<br />
<br />
<code><a href="{DownCnt name=&#039;the_file&#039; link=&#039;/downloads/the_file.zip&#039;}">download this file</a></code> or<br />
<code><a href="{DownCnt name=&#039;the_site&#039; link=&#039;somesite.com&#039; protocol=&#039;http&#039;}">go to the site</a></code> or<br />
<code><a href="{DownCnt name=&#039;the_site&#039; link=&#039;www.somesite.com/sub/contact.html&#039; protocol=&#039;http&#039;}">go to the site</a></code> or<br /> 
<code><a href="{DownCnt name=&#039;the_site&#039; link=&#039;sub.somesite.com&#039; protocol=&#039;ftp&#039;}">see my ftp file</a></code> <br />
<br />

Note that <b>there are quotation marks around the tag</b> since version 1.1.0,  It&#039;s important to add them.<br />
<br />
Other <A> tag parameters, like target or class or id, can be used freely.</p>

<h4>Displaying the clicks counter:</h4>
<p>Regardless whether the link leads to a site or a file, there is only one method to display its counter. This is:<br />
<br />
<code>{DownCnt action=&#039;display&#039; name=&#039;the_file&#039;}</code><br />
<br />
In the <i>name</i> parameter you must specify the name used for the appropriate tag in the link.<br />
This tag will dislpay a plain integer value of the counter. You can enclose it with any tags you want to alter its appearance.<br />
If the link has never been clicked (its counter does not exist yet) the tag will display zero.</p>

<h3>The admin part</h3>
<p>You can manage already existing counters from the admin area of the CMS MS. Go to Content menu and choose Download Counter.</p>
<p>If you want to reset a counter to zero, simply delete it. It will be recreated automatically the next time the link is clicked.</p>
<p>The <i>Active</i> tells if the counter should be incremented or not. If a counter is disabled (not active) the link will still work and its value can be displayed, it just won&#039;t increase the counter value when clicked.</p>
';
$lang['changeLog'] = '<ul>
	<li>
		1.1.0: new big version
		<ul>
			<li><span style=&quot;color:#F00;&quot;>CHANGE : you must specify the quotation marks around the call to the code (Watch Help for more informations)</span></li>
			<li></li>
			<li>ADD : adding the parameter &quot;protocol&quot; which allows you to specify an external link safely</li>
			<li>ADD : better integration into the WYSIWYG (<span style=&quot;color:#F00;&quot;>not perfect now, please watch Help for more informations</span>)</li>
			<li>ADD : module can now be called by the simple command</li>
			<li>ADD : greater control of consistency of parameters passed</li>
			<li></li>
			<li>UPDATE : Update documentation</li>
		</ul>
	
	
	</li>
	
	<li>1.0.0: Initial Release</li>
</ul>

';
$lang['description'] = 'The Download Counter module allows you to count downloads of files you make available for downloading from your site.';
$lang['postinstall'] = 'Don&#039;t forget to make sure to set the <b>&#039;Manage Download Counters&#039; permission</b> on users who will be administering the counters.<br />
See the help for usage information.';
$lang['pre_uninstall'] = 'All couters will be deleted. Do you want to uninstall this module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['nameunspec'] = 'The required name parameter is unspecified!';
$lang['error_insufficientparams'] = 'Required parameter is not specified: %s';
$lang['nocountersfound'] = 'There are no counters yet.<br />
To create a counter put the module tag into a page (see the module help for information on how to do it) - a new counter will be created automatically when someone clicks the link for the first time.';
$lang['delete'] = 'Verwijder';
$lang['areyousure'] = 'Deze teller verwijderen?';
$lang['areyousure2'] = 'Deze tellers verwijderen?';
$lang['name'] = 'Teller naam';
$lang['value'] = 'Teller waarde';
$lang['lastdate'] = 'Laatste klik datum';
$lang['active'] = 'Ctief';
$lang['delselected'] = 'Verwijder geselecteerde tellers';
$lang['needpermission'] = 'You need the &#039;%s&#039; permission to perform that function.';
$lang['error_no_id'] = 'Internal error: id is not specified';
$lang['error_protocol_nok'] = 'the protocol parameter must be http or https or ftp';
$lang['param_action'] = 'action to be performed in the current tag. &#039;<i>default</i>&#039;: count clicks, &#039;<i>display</i>&#039;: show the counter value.';
$lang['param_name'] = 'name of the counter, by which separate counters are distinguished.';
$lang['param_link'] = 'link to the target resource.';
$lang['param_protocol'] = 'if it is an external link then define its protocol : http or https or ftp (http is the most common)';
$lang['utma'] = '156861353.1335698708.1284586217.1285407291.1285425870.60';
$lang['utmz'] = '156861353.1285000824.40.9.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/index.php/topic,47502.0/topicseen.html';
$lang['qca'] = 'P0-1551306179-1284586216711';
$lang['utmb'] = '156861353.1.10.1285425870';
$lang['utmc'] = '156861353';
?>