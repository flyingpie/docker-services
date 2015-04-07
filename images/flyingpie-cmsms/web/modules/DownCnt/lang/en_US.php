<?php
$lang['modulename'] = 'Download Counter';
$lang['help'] = '
<h3>What does this do?</h3>
<p>The Download Counter module is a very simple tag module. It\'s used to add download counters to files you present on your page.
This module does not depend on Uploads, nor any other module. You can use it for any file you want, no matter which way it has been uploaded to the server. Even better: you can use it for <b>any link</b> to your site pointing to your site or at another site to count how many times it has been clicked!
</p>

<h3>How to use it?</h3>
<p>Download counter is just a tag module. It\'s inserted into your page or template by using the cms_module tag. Example syntax would be:<br />


<code>{DownCnt name=\'counter_name\' link=\'targetsite.com\' protocol=\'http\'}</code> - for counting clicks, and<br />
<code>(DownCnt name=\'counter_name\' action=\'display\'}</code> - for displaying the counter value.</p>
<p>Make sure to set the \'Manage Download Counters\' permission on users who will be administrating the counters.</p>

<h4>careful with the WYSIWYG!</h4>

<p>in a content-bloc with WYSIWYG-enabled it is dangerous to write :</p>

<p>
<code>&lt;a href=<span style="background-color:#000000;color:#FFFFFF;">"</span>{DownCnt name=<span style="background-color:#000000;color:#FFFFFF;">"</span>the_file<span style="background-color:#000000;color:#FFFFFF;">"</span> link=<span style="background-color:#000000;color:#FFFFFF;">"</span>downloads/the_file.zip<span style="background-color:#000000;color:#FFFFFF;">"</span>}<span style="background-color:#000000;color:#FFFFFF;">"</span>&gt;download this file&lt;/a&gt;</code> <span style="color:#F00;">--&gt; same indicator in the smarty code and external</span><br/>

<code>&lt;a href=<span style="background-color:#000000;color:#FFFFFF;">\'</span>{DownCnt name=<span style="background-color:#000000;color:#FFFFFF;">\'</span>the_file<span style="background-color:#000000;color:#FFFFFF;">\'</span> link=<span style="background-color:#000000;color:#FFFFFF;">\'</span>downloads/the_file.zip<span style="background-color:#000000;color:#FFFFFF;">\'</span>}<span style="background-color:#000000;color:#FFFFFF;">\'</span>&gt;download this file&lt;/a&gt;</code> <span style="color:#F00;">--&gt; same indicator in the smarty code and external</span><br/>

<code>&lt;a href=<span style="background-color:#000000;color:#FFFFFF;">\'</span>{DownCnt name=<span style="background-color:#000000;color:#FFFFFF;">\'</span>the_file<span style="background-color:#000000;color:#FFFFFF;">\'</span> link="downloads/the_file.zip"}<span style="background-color:#000000;color:#FFFFFF;">\'</span>&gt;download this file&lt;/a&gt;</code> <span style="color:#F00;">--&gt; same indicator in the smarty code and external</span><br/>
</p>

<p>because TinyMce will destroy the code :(</p>

<p>in the WYSIWYG, TinyMCE always generates a new link in the same way: </p>

<code>&lt;a href=<b>"</b>XXXXXXX<b>"</b>&gt;bla bla&lt;/a&gt;</code><br/><br/>

<p>with XXXXXXX as the URL of the link. Therefore it is imperative to take the code with apostrophes (\') and not with quotation marks (") so that it finds TinyMCE</p>

<code>&lt;a href=<b>"</b>{DownCnt name=<b>\'</b>the_file<b>\'</b> link=\'downloads/the_file.zip\'}<b>"</b>&gt;download this file&lt;/a&gt;</code> <span style="color:#0A0;">--&gt; different indicator in the smarty code and external</span><br/><br/>

<h3>Parameters</h3>
<ul>
<li><i>action</i> - action to be taken in the current tag. The possible values are:
  <ul>
    <li><i>default</i> - this tag will perform counting; to make it working it should be placed instead of the target address of the &lt;a&gt; html tag (for example: &lt;a href="{DownCnt ...)"; <i>name</i> and <i>link</i> parameters are required for this action; <i>protocol</i> is requiered if you want external link</li>
    <li><i>display</i> - this tag will only display the counter for given name; <i>name</i> parameter is required for this action;</li>
  </ul>
<li><i>name</i> - name of the counter to be used; the name may be anything you want (the file name for example), but it should be unique across the CMS installation; the name is an identifier by which the module distinguishes separate counters; the name cannot be longer than 255 characters!</li>
<li><i>link</i> - required only if <i>action</i>=\'default\'; put here the link to the target resource - the link that otherwise would be used as href of the &lt;a&gt; html tag; the path is relative to the CMS MS installation directory. For external links you musn\'t include <b>http://</b> but you must add the <b>param protocol</b>.</li>
<li><i>protocol</i> - useful if and only if you define an external url to your website with param <i>link</i>. it can take the value of <b>http</b> / <b>https</b> / <b>ftp</b> (http is the most common)
</ul>
<br/>
<p>To display the counter of a link after the actual link the tag must be used twice - first with default <i>action</i> (the <i>action</i> parameter may be omitted in this case), and second with <i>action</i>=\'display\', and the same <i>name</i> must be set in both tags.</p>

<h3>Examples</h3>
<h4>Creating link to a site or downloadable file that will count clicks:</h4>
<p>If your link looks like<br />
<br />
<code>&lt;a href="/downloads/the_file.zip"&gt;download this file&lt;/a&gt;</code> or<br />
<code>&lt;a href="http://somesite.com"&gt;go to the site&lt;/a&gt;</code> or<br />
<code>&lt;a href="www.somesite.com/sub/contact.html"&gt;go to the site&lt;/a&gt;</code> or<br />
<code>&lt;a href="ftp://sub.somesite.com"&gt;see my ftp file&lt;/a&gt;</code><br />
<br />
to make the link counting clicks, you will have to change it to<br />
<br />
<code>&lt;a href="{DownCnt name=\'the_file\' link=\'/downloads/the_file.zip\'}"&gt;download this file&lt;/a&gt;</code> or<br />
<code>&lt;a href="{DownCnt name=\'the_site\' link=\'somesite.com\' protocol=\'http\'}"&gt;go to the site&lt;/a&gt;</code> or<br />
<code>&lt;a href="{DownCnt name=\'the_site\' link=\'www.somesite.com/sub/contact.html\' protocol=\'http\'}"&gt;go to the site&lt;/a&gt;</code> or<br /> 
<code>&lt;a href="{DownCnt name=\'the_site\' link=\'sub.somesite.com\' protocol=\'ftp\'}"&gt;see my ftp file&lt;/a&gt;</code> <br />
<br />

Note that <b>there are quotation marks around the tag</b> since version 1.1.0,  It\'s important to add them.<br />
<br />
Other &lt;A&gt; tag parameters, like target or class or id, can be used freely.</p>

<h4>Displaying the clicks counter:</h4>
<p>Regardless whether the link leads to a site or a file, there is only one method to display its counter. This is:<br />
<br />
<code>{DownCnt action=\'display\' name=\'the_file\'}</code><br />
<br />
In the <i>name</i> parameter you must specify the name used for the appropriate tag in the link.<br />
This tag will dislpay a plain integer value of the counter. You can enclose it with any tags you want to alter its appearance.<br />
If the link has never been clicked (its counter does not exist yet) the tag will display zero.</p>

<h3>The admin part</h3>
<p>You can manage already existing counters from the admin area of the CMS MS. Go to Content menu and choose Download Counter.</p>
<p>If you want to reset a counter to zero, simply delete it. It will be recreated automatically the next time the link is clicked.</p>
<p>The <i>Active</i> tells if the counter should be incremented or not. If a counter is disabled (not active) the link will still work and its value can be displayed, it just won\'t increase the counter value when clicked.</p>
';
$lang['changeLog'] = '
<ul>
	<li>
		1.1.0: new big version
		<ul>
			<li><span style="color:#F00;">CHANGE : you must specify the quotation marks around the call to the code (Watch Help for more informations)</span></li>
			<li></li>
			<li>ADD : adding the parameter "protocol" which allows you to specify an external link safely</li>
			<li>ADD : better integration into the WYSIWYG (<span style="color:#F00;">not perfect now, please watch Help for more informations</span>)</li>
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
$lang['postinstall'] = 'Don\'t forget to make sure to set the <b>\'Manage Download Counters\' permission</b> on users who will be administering the counters.<br />
See the help for usage information.';
$lang['pre_uninstall'] = 'All couters will be deleted. Do you want to uninstall this module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module version %s updated.';
$lang['nameunspec'] = 'The required name parameter is unspecified!';
$lang['error_insufficientparams'] = 'Required parameter is not specified: %s';
$lang['nocountersfound'] = 'There are no counters yet.<br />
To create a counter put the module tag into a page (see the module help for information on how to do it) - a new counter will be created automatically when someone clicks the link for the first time.';
$lang['delete'] = 'Delete';
$lang['areyousure'] = 'Delete the counter?';
$lang['areyousure2'] = 'Delete the counters?';
$lang['name'] = 'Counter name';
$lang['value'] = 'Counter value';
$lang['lastdate'] = 'Last click date';
$lang['active'] = 'Active';
$lang['delselected'] = 'Delete selected counters';
$lang['needpermission'] = 'You need the \'%s\' permission to perform that function.';
$lang['error_no_id'] = 'Internal error: id is not specified';
$lang['error_protocol_nok'] = 'the protocol parameter must be http or https or ftp';
$lang['param_action'] = 'action to be performed in the current tag. \'<i>default</i>\': count clicks, \'<i>display</i>\': show the counter value.';
$lang['param_name'] = 'name of the counter, by which separate counters are distinguished.';
$lang['param_link'] = 'link to the target resource.';
$lang['param_protocol'] = 'if it is an external link then define its protocol : http or https or ftp (http is the most common)';

?>
