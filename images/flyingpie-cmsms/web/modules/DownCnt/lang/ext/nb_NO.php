<?php
$lang['modulename'] = 'Download Counter';
$lang['help'] = '<h3>What does this do?</h3>
<p>The Download Counter module is a very simple tag module. It&#039;s used to add download counters to files you present on your page.
This module does not depend on Uploads, nor any other module. You can use it for any file you want, no matter which way it has been uploaded to the server. Even better: you can use it for <b>any</b> link in your site to count how many times it has been clicked!
</p>

<h3>How to use it?</h3>
<p>Download counter is just a tag module. It&#039;s inserted into your page or template by using the cms_module tag. Example syntax would be:<br />
<code>{cms_module module=&#039;DownCnt&#039; name=&#039;counter_name&#039; link=&#039;http://targetsite.com&#039;}</code> - for counting clicks, and<br />
<code>(cms_module module=&#039;DownCnt&#039; name=&#039;counter_name&#039; action=&#039;display&#039;}</code> - for displaying the counter value.</p>
<p>Make sure to set the &#039;Manage Download Counters&#039; permission on users who will be administrating the counters.</p>

<h3>Parameters</h3>
<ul>
<li><i>action</i> - action to be taken in the current tag. The possible values are:
  <ul>
    <li><i>default</i> - this tag will perform counting; to make it working it should be placed instead of the target address of the <A> html tag (for example: <A HREF={cms_module module=&#039;DownCnt&#039;...); don&#039;t use any quotation marks around the tag, otherwise problems may happen; <i>name</i> and <i>link</i> parameters are required for this action;</li>
    <li><i>display</i> - this tag will only display the counter for given name; <i>name</i> parameter is required for this action;</li>
  </ul>
<li><i>name</i> - name of the counter to be used; the name may be anything you want (the file name for example), but it should be unique across the CMS installation; the name is an identifier by which the module distinguishes separate counters; the name cannot be longer than 255 characters!</li>
<li><i>link</i> - required only if <i>action</i>=&#039;default&#039;; put here the link to the target resource - the link that otherwise would be used as HREF of the <A> html tag; the path is relative to the CMS MS installation directory; for external links the full path must be given, <b>including http:// part</b>.</li>
</ul>

<p>To display the counter of a link after the actual link the tag must be used twice - first with default <i>action</i> (the <i>action</i> parameter may be omitted in this case), and second with <i>action</i>=&#039;show&#039;, and the same <i>name</i> must be set in both tags.</p>

<h3>Examples</h3>
<h4>Creating link to a site or downloadable file that will count clicks:</h4>
<p>If your link looks like<br />
<br />
<code><A HREF=&quot;/downloads/the_file.zip&quot;>download this file</A></code> or<br />
<code><A HREF=&quot;http://somesite.com&quot;>go to the site</A></code><br />
<br />
to make the link counting clicks, you will have to change it to<br />
<br />
<code><A HREF={cms_module module=&#039;DownCnt&#039; name=&#039;the_file&#039; link=&#039;/downloads/the_file.zip&#039;}>download this file</A></code> or<br />
<code><A HREF={cms_module module=&#039;DownCnt&#039; name=&#039;the_site&#039; link=&#039;http://somesite.com&#039;}>go to the site</A></code><br />
<br />
accordingly.<br />
Note that there are no quotation marks around the tag. It&#039;s important not to add them, because the tag will return modified link already surrounded with quotation marks.<br />
<br />
Other <A> tag parameters, like TARGET, can be used freely.</p>

<h4>Displaying the clicks counter:</h4>
<p>Regardless whether the link leads to a site or a file, there is only one method to display its counter. This is:<br />
<br />
<code>{cms_module module=&#039;DownCnt&#039; action=&#039;show&#039; name=&#039;the_file&#039;}</code><br />
<br />
In the <i>name</i> parameter you must specify the name used for the appropriate tag in the link.<br />
This tag will dislpay a plain integer value of the counter. You can enclose it with any tags you want to alter its appearance.<br />
If the link has never been clicked (its counter does not exist yet) the tag will display zero.</p>

<h3>The admin part</h3>
<p>You can manage already existing counters from the admin area of the CMS MS. Go to Content menu and choose Download Counter.</p>
<p>If you want to reset a counter to zero, simply delete it. It will be recreated automatically the next time the link is clicked.</p>
<p>The <i>Active</i> tells if the counter should be incremented or not. If a counter is disabled (not active) the link will still work and its value can be displayed, it just won&#039;t increase the counter value when clicked.</p>
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
$lang['delete'] = 'Delete';
$lang['areyousure'] = 'Delete the counter?';
$lang['areyousure2'] = 'Delete the counters?';
$lang['name'] = 'Counter name';
$lang['value'] = 'Counter value';
$lang['lastdate'] = 'Last click date';
$lang['active'] = 'Active';
$lang['delselected'] = 'Delete selected counters';
$lang['needpermission'] = 'You need the &#039;%s&#039; permission to perform that function.';
$lang['error_no_id'] = 'Internal error: id is not specified';
$lang['param_action'] = 'action to be performed in the current tag. &#039;<i>default</i>&#039;: count clicks, &#039;<i>display</i>&#039;: show the counter value.';
$lang['param_name'] = 'name of the counter, by which separate counters are distinguished.';
$lang['param_link'] = 'link to the target resource.';
$lang['utmz'] = '156861353.1284404356.3261.76.utmcsr=forum.cmsmadesimple.org|utmccn=(referral)|utmcmd=referral|utmcct=/';
$lang['utma'] = '156861353.179052623084110100.1210423577.1285270054.1285273217.3274';
$lang['qca'] = '1210971690-27308073-81952832';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.2.10.1285273217';
?>