<?php
$lang['friendlyname'] = 'Gallery';
$lang['moddescription'] = 'The easiest way to manage and display photo galleries';
$lang['description'] = 'An easy to use gallery which automatically shows the images of a specified directory.';
$lang['postinstall'] = 'The Gallery module was successfully installed.';
$lang['installed'] = 'The Gallery module version %s was installed.';
$lang['upgraded'] = 'The Gallery module is upgraded to version %s.';
$lang['postuninstall'] = 'The Gallery  module was uninstalled';
$lang['uninstalled'] = 'The Gallery module was uninstalled';
$lang['really_uninstall'] = 'Are you sure you want to uninstall Gallery? This does not effect the images, but all comment-data and thumbnails that were created by Gallery will be lost.';
$lang['tinymce_description_picker'] = 'Allows easy injection of photo galleries.';
$lang['tinymce_button_picker'] = 'Add Gallery';

$lang['active'] = 'Active';
$lang['apply'] = 'Apply';
$lang['areyousure'] = 'Are you sure you want to delete?';
$lang['areyousuremulti'] = 'Are you sure you want to execute this bulk action?';
$lang['cancel'] = 'Cancel';
$lang['copy'] = 'Copy';
$lang['default'] = 'Default';
$lang['delete'] = 'Delete';
$lang['down'] = 'Down';
$lang['edit'] = 'Edit';
$lang['error'] = 'Error!';
$lang['inactive'] = 'Inactive';
$lang['setfalse']= 'Set False';
$lang['settrue']= 'Set True';
$lang['submit'] = 'Save';
$lang['up'] = 'Up';


$lang['galleries'] = 'Galleries';
$lang['gallerypath'] = 'Gallery';
$lang['dirtag'] = 'Tag to display this subgallery';
$lang['editgallery'] = 'Edit gallery';
$lang['addsubgallery'] = 'Add subgallery';
$lang['addimages'] = 'Add images';
$lang['editimage'] = 'Edit image details';
$lang['nogalleriestext'] = 'No galleries available';
$lang['list'] = 'List';
$lang['item'] = 'Image';
$lang['title'] = 'Title';
$lang['date'] = 'Date';
$lang['nofilestext'] = 'No images available';
$lang['directoryname'] = 'New directory name';
$lang['gallerytitle'] = 'Gallery Title';
$lang['comment'] = 'Comment';
$lang['albumcover'] = 'Album Cover';
$lang['noalbumcover'] = 'Subgallery does not have an album cover';
$lang['template'] = 'Template';
$lang['parentgallery'] = 'Parent gallery';
$lang['hideparentlink'] = 'Hide link to parent gallery';
$lang['usedefault'] = 'use default';
$lang['sortbysettings'] = 'Sort by template settings';
$lang['sureunsort'] = 'Are you sure you want to delete the manual sortorder?';
$lang['updatethumbs'] = 'Update thumbnails';
$lang['sureupdatethumbs'] = 'Are you sure you want to delete thumbnails?';
$lang['thumbsrecreated'] = 'They will be recreated at the first visit of the gallery';
$lang['thumbsdeleted'] = 'Thumbnails are deleted.';
$lang['galleryupdated'] = 'The gallery was successfully updated.';
$lang['withselected'] = 'With Selected';
$lang['moveto'] = 'Move To';
$lang['imageupdated'] = 'The image details are updated.';
$lang['error_insufficientparams'] = 'Insufficient parameters.';
$lang['error_updategalleryfailed'] = 'Updating the gallery failed.';
$lang['error_directorynameinvalid'] = 'Invalid directoryname.';
$lang['error_directoryalreadyexists'] = 'The directory already exists.';


$lang['templates'] = 'Templates';
$lang['title_available_templates'] = 'Available Templates';
$lang['prompt_name'] = 'Name';
$lang['prompt_version'] = 'Version';
$lang['prompt_about'] = 'About';
$lang['prompt_default'] = 'Default';
$lang['prompt_visible'] = 'Visible in template dropdown';
$lang['prompt_newtemplate'] = 'Create a new template';
$lang['makevisible'] = 'Make visible in template dropdown to users without \'Modify Templates\' permission';
$lang['makeinvisible'] = 'Make invisible in template dropdown to users without \'Modify Templates\' permission';
$lang['title_importxml'] = 'Import template via XML file';
$lang['importxmlnote'] = 'XML files containing various Gallery templates can be found at the Module Forge <a href="http://dev.cmsmadesimple.org/project/files/726" target="_blank">Gallery page</a>. Read the release-notes before uploading!';
$lang['importxml'] = 'Import template XML';
$lang['overwrite'] = 'Overwrite existing module templates';
$lang['title_singleimg_template'] = 'Template for module-calls to a single image';
$lang['title_template'] = 'Template Editor';
$lang['prompt_templatename'] = 'Template Name';
$lang['thumbnailsize'] = 'Thumbnail Size (Frontend)';
$lang['leaveempty'] = '(leave this empty to use the default thumbnails from ImageManager)';
$lang['width'] = 'width';
$lang['height'] = 'height';
$lang['resizemethod'] = 'resize method';
$lang['crop'] = 'crop';
$lang['scale'] = 'scale';
$lang['zoomcrop'] = 'zoom &amp; crop';
$lang['zoomscale'] = 'zoom &amp; scale';
$lang['maxnumber'] = 'Maximum number of items per page';
$lang['showallimages'] = 'Leaving empty will show all images without pagelinks';
$lang['sortingoptions'] = 'Sorting Options';
$lang['specifysortfields'] = 'Specify the field(s) to sort on';
$lang['ascending'] = 'ascending';
$lang['descending'] = 'descending';
$lang['addfield'] = 'Add field';
$lang['deletefield'] = 'Delete last row';
$lang['prompt_template'] = 'Template Source';
$lang['prompt_templatejs'] = 'Template JavaScript';
$lang['prompt_templatecss'] = 'Template CSS-stylesheet';
$lang['resetoriginal'] = 'Reset to original';
$lang['resetoriginalwarning'] = 'Are you sure you want to reset the template code to its original code?';
$lang['templateupdated'] = 'The template was successfully updated.';
$lang['templateadded'] = 'The template was successfully added.';
$lang['error_templateexists'] = 'The module template already exists and is not overwritten.';
$lang['error_directorynotwritable'] = 'Directory not writable.';
$lang['error_incompletexml'] = 'Incomplete xml.';
$lang['error_cantcreatedir'] = 'Cannot create directory';
$lang['error_cantcreatefile'] = 'Cannot create file';
$lang['templatedeleted'] = 'Template deleted';
$lang['availablevariables'] = 'Available Template Smarty Variables';
$lang['availablevariableslist'] = 'These are the variables you can use to customize your template:<br /><br />
<code>{$module_message}</code> - error message, is only set if there\'s a message<br />
<code>{$gallerytitle}</code> - title of the gallery. If there is no title, this will show the directory name<br />
<code>{$gallerycomment}</code> - comment of the gallery<br />
<code>{$galleryid}</code> - unique id for the gallery<br />
<code>{$parentlink}</code> - link to the parent folder<br />
<code>{$parent_url}</code> - url to the parent folder<br />
<code>{$parent_txt}</code> - text to create a link with above url<br />
<code>{$hideparentlink}</code> - true/false<br />
<code>{$imagecount}</code> - shows e.g. "6 images", depending on language<br />
<code>{$itemcount}</code> - number of items, images + folders<br />
<code>{$numimages}</code> - number of images<br />
<code>{$numdirs}</code> - number of folders<br />
<code>{$pages}</code> - number of pages<br />
<code>{$currentpage}</code> - the current pagenumber<br />
<code>{$prevpage}</code> - link to previous page, if applicable<br />
<code>{$prevpage_url}</code> - url to previous page, if applicable<br />
<code>{$prevpage_txt}</code> - text to create a link with above url<br />
<code>{$nextpage}</code> - link to next page, if applicable<br />
<code>{$nextpage_url}</code> - url to next page, if applicable<br />
<code>{$nextpage_txt}</code> - text to create a link with above url<br />
<code>{$pagelinks}</code> - links to each existing page<br />
<code>{$fields.your_field_alias.name}</code> - gallery custum field name<br />
<code>{$fields.your_field_alias.value}</code> - gallery custom field value<br />
<code>{$fields.your_field_alias.type}</code> - gallery custom field type<br />
<code>{$images}</code> - array with keys:<br />
 - <code>file</code> - relative path to the original image (or subgallery)<br />
 - <code>filename</code> - filename of the image (or subgallery)<br />
 - <code>title</code> - title of the image<br />
 - <code>titlename</code> - this shows the title if there is one, or else the filename<br />
 - <code>comment</code> - comment to the image<br />
 - <code>active</code> - true/false<br />
 - <code>filedate</code> - creation date/time<br />
 - <code>thumb</code> - relative path to the thumbnail. In case of a subgallery, this wil revert to the image which is set as default in that subgallery. If no image is set as default, a standard folder-icon will be used.<br />
 - <code>fileid</code> - unique id for the image or subgallery<br />
 - <code>isdir</code> - true if it\'s a subgallery<br />
 - <code>galleryid</code> - id of the gallery the image belongs to<br />
 - <code>gallery_url</code> - url to gallery the image belongs to<br />
 - <code>fields.your_field_alias.name</code> - custum field name<br />
 - <code>fields.your_field_alias.value</code> - custom field value<br />
 - <code>fields.your_field_alias.type</code> - custom field type<br />
';


$lang['fielddefinitions'] = 'Field Definitions';
$lang['fielddefinition'] = 'Field Definition';
$lang['addfielddef'] = 'Add Field Definition';
$lang['editfielddef'] = 'Edit Field Definition';
$lang['alias'] = 'Alias';
$lang['type'] = 'Type';
$lang['textinput'] = 'Text Input';
$lang['pulldown'] = 'Pulldown';
$lang['checkbox'] = 'Checkbox';
$lang['textarea'] = 'Text Area';
$lang['wysiwyg'] = 'WYSIWYG';
$lang['maxlength'] = 'Maximum Length';
$lang['maxlength_help'] = 'Only applies to text input fields';
$lang['public'] = 'Public';
$lang['dirfield'] = 'Apply field for';
$lang['fielddefadded'] = 'Field Definition is added';
$lang['fielddefsupdated'] = 'Field Definition list is updated';


$lang['options'] = 'Options';
$lang['urlprefix'] = 'Prefix to use on all URLs from the Gallery module';
$lang['urlprefix_help'] = 'This only applies when pretty urls are enabled either via mod_rewrite or internal pretty urls';
$lang['allowed_extensions'] = 'Allowed Extensions';
$lang['maxsize'] = 'Before upload, resize big images to these maximum sizes';
$lang['use_comment_wysiwyg'] = 'Use a WYSIWYG editor on the Gallery comment field';
$lang['editdirdates'] = 'Allow users to edit creationdates of subgalleries';
$lang['editfiledates'] = 'Allow users to edit filedates of images';
$lang['fe_folderpath'] = 'Path to the default frontend folder icon';
$lang['be_folderpath'] = 'Path to the backend folder icon';
$lang['optionsupdated'] = 'The options were successfully updated.';


$lang['image'] = 'image';
$lang['images'] = 'images';
$lang['parent'] = 'Back to parent gallery';
$lang['prevpage'] = 'Previous';
$lang['nextpage'] = 'Next';
$lang['defaultgallerycomment'] = 'Thank you for installing the Gallery module. If you have uploaded some images to the \'uploads/images/Gallery\' folder, you will see them below. You can edit titles, descriptions and thumbnail sizes in the admin section. Check out all the other features this module offers in the Module Help.';
$lang['message_wrongdir'] = 'The directory \'Gallery/%s\' does not exist. Check your parameters.';


$lang['help_dir'] = 'Parameter to specify a directory, relative to uploads/images/Gallery/';
$lang['help_template'] = 'Use a separate database template for displaying the photo gallery. This template must exist and be visible in the template tab of the Gallery admin, though it does not need to be the default. If this parameter is not specified, then the template which is assigned to the directory will be used, else the default template.';
$lang['help_targetpage'] = 'Page to display Gallery in.  This can either be a page alias or an id. Used to allow Gallery to be displayed in a different page template.';
$lang['help_number'] = 'Maximum number of imagethumbs to display (per page). Leaving empty will show all images.';
$lang['help_start'] = 'Start at the nth image. Leaving empty will start at the first image.';
$lang['help_show'] = 'Overide which images have to be shown. Possible values are:
<ul>
<li>\'active\' - to display the images marked as active (default)</li>
<li>\'inactive\' - to display only the images marked as inactive </li>
<li>\'all\' - to display all images</li>
</ul>
';
$lang['help_action'] = 'Override the default action. Use it in combination with the above parameters. Possible values are:
<ul>
<li>\'showrandom\' - to display a set of random thumb-images (applies only to the images which are stored in the database, defaults to a number of 6 images). Use \'/*\' after the directoryname in the dir parameter to include images from subdirectories</li>
<li>\'showlatest\' - to display the most recently added images (applies only to the images which are stored in the database, defaults to a number of 6 images) The dir parameter can be set, or the default Gallery-root will be used. Subdirectories are automatically included</li>
<li>\'showlatestdir\' - to display a set of random thumb-images from the most recently added directory (applies only to the images which are stored in the database, defaults to a number of 6 images)</li>
<li>\'gallerytree\' - to display links to all galleries and subgalleries. This uses the gallerytree template by default, but this can be changed with the template parameter. Use the dir parameter to display a subset of the gallerytree. (applies only to the galleries which are stored in the database)</li>
</ul>
Note that images are only stored in the database when the specific gallery is visited in the admin or frontend.
';
$lang['help_img'] = 'Call a single image with <code>{Gallery img=123}</code>. The html output can be modified in the templates tab. The thumb-size and JavaScript system can be set by choosing a template with the dropdown field.';

$lang['help'] = '<h3>What Does This Do?</h3>
<p>The Gallery module is an easy to use photo gallery which automatically shows the images of a specified directory. Subdirectories will be shown as subgalleries. It has lots of features, such as automatic thumbnailing, the use of multiple Lightbox-like templates or any css/javascript template you like, and you can give titles and descriptions to your galleries as well as your photos.</p>
<h3>How Do I Use It</h3>
<p>First, insert the module with the <code>{Gallery}</code> tag into your page or template anywhere you whish. Then upload some images with the Image Manager, File Manager (e.g. multiple images in zipfile) or FTP to the uploads/images/Gallery/ directory. You can also add multiple images with the built-in upload function (see below).</p>
<p>That\'s it!</p>
<p>If you want more photo galleries, simply create a subdirectory and upload your photos as described. By adding parameters to the <code>{Gallery}</code> tag, you can easily manipulate which subgallery will be shown in which template, e.g. <code>{Gallery dir="holidays/Netherlands2009" template="Lightbox"}</code></p>
<p>By default the thumbnails from the Image Manager are used to display the photo galleries.</p>

<h3>Advanced Options, but still easy to use</h3>
<p>In the admin section you have lots of other options:</p>
<ul>
<li>Set a photo as the default for a gallery, so it will show in the parent gallery as a \'album-cover\' in stead of the default folder-icon.</li>
<li>Give titles and descriptions to galleries.</li>
<li>Set a default template for each gallery.</li>
<li>Set thumbnail sizes for each template, with posibilities to scale, crop and/or zoom the images.</li>
<li>Specify for each template in which order the photos have to be sorted.</li>
<li>Overrule the sorting manually by dragging&dropping the photos in the galleries list. (Note the change of the mousepointer)</li>
<li>Give titles and descriptions to photos.</li>
<li>Switch a specific photo or gallery to inactive, preventing it from display.</li>
<li>Edit/copy templates or create new ones. Check the info-icon beneath the template-code for the available variables.</li>
</ul>
<p>All titles, descriptions and settings are stored in the database. The database will synchronize with the filedirectory each time the according gallery is visited in the Gallery-admin. A little warning: when you rename an image or subdirectory or move it to another directory with FileManager, ImageManager or FTP, you will lose its title, description and settings! Always use the built-in move-function of Gallery</p>

<h3>Upload and resize images</h3>
<p>The Gallery module has its own upload function. It uses the SWFUpload JavaScript/Flash library to upload multiple files at once by ctrl/shift-selecting in dialog. For this to work, your browser needs to have a recent Flash Player plugin.</p>
<p>To prevent users from uploading big size images, you can set maximum upload sizes in the options tab. Bigger images will be resized client side before upload. Proportions of the original image are maintained.</p>

<h3>Custom Fields</h3>
<p>The Gallery module allows defining numerous custom fields. A custom field can belong to a subgallery or to an image.</p>
<p>Gallery-related fields can be called directly in the gallerytemplate with <code>{$fields.your_field_alias.name}</code> and <code>{$fields.your_field_alias.value}</code>. You could also create a foreach loop on <code>{$fields}</code>.</p>
<p>Image- and subgallery-related fields can be called within the images foreach loop in the gallerytemplate with <code>{$image->fields.your_field_alias.name}</code> and <code>{$image->fields.your_field_alias.value}</code></p>

<h3>Edit, Import and Export Gallery templates</h3>
<p>In order to edit templates, the user must belong to a group with the \'Modify Templates\' permission.</p>
<p>Gallery templates can be separately downloaded from the <a href="http://dev.cmsmadesimple.org/project/files/726" target="_blank">Gallery module Forge</a>. The import session will overwrite if the checkbox is on and the name of the template already exists. Note that an update of the Gallery module will not affect your module templates.</p>
<p>If you want to create your own template and be able to export it, be shure to put any needed files (besides the default available ones) in its own folder with the template name in modules/Gallery/templates/. Those files will be included in the xml exportfile automatically. Click on the about link to edit the version number and the about text.</p>
<p>Templates can be set as invisible in template dropdown, so they can\'t be chosen by normal admin-users, only by users with \'Modify Templates\' permission.</p>

<h3>Global Gallery Options</h3>
<p>To edit the global Gallery options, the user must belong to a group with the \'Modify Site Preferences\' permission.</p>

<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>FAQs, extended module help and Troubleshooting can be found in the <a href="http://wiki.cmsmadesimple.org/index.php/User_Handbook/Admin_Panel/Content/Gallery">Gallery Wiki Documentation</a>.</li>
<li>For the latest version of this module or to file a Feature Request or Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/gallery/">Gallery Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>. You are warmly invited to open a new thread if you didn\'t find an answer to your question.</li>
<li>Lastly, you may have some success emailing the author directly.</li>
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2009, Jos -<a href="mailto:josvd@live.nl">josvd@live.nl</a>-. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
';
?>