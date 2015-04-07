<ul>
<li><strong>Version 1.4.4</strong> - 6 February 2011
	<ul>
	<li>Ignore dot directories (FR #5901)</li>
	<li>Added smarty variable $image->active</li>
	<li>Bug #5991: fixed - MySQL error during installation (if MySQL version is higher then 5.0)</li>
	</ul>
</li>
<li><strong>Version 1.4.3</strong> - 4 December 2010
	<ul>
	<li>Added smarty variable $image->galleryid</li>
	<li>Minor bugfix for the CreateThumbnail function</li>
	</ul>
</li>
<li><strong>Version 1.4.2</strong> - 2 December 2010
	<ul>
	<li>Ability to use custom fields with action=showrandom/showlatest/showlatestdir</li>
	<li>Added smarty variable $image->gallery_url (FR #5501)</li>
	<li>Search results respect the chosen url-prefix</li>
	<li>Preserve transparency for gif thumbnails</li>
	<li>Bugfix for the show='inactive' parameter</li>
	<li>Bug #5395: fixed - Update Fancybox Gallerytemplate to version 1.3.4</li>
	<li>Bug #5581: fixed - Custom fields were not saved when creating a new subgallery</li>
	<li>Bug #5658: fixed - Don't allow Maximum Image Width/Height options to be empty</li>
	</ul>
</li>
<li><strong>Version 1.4.1</strong> - 30 August 2010
	<ul>
	<li>Bug #5309: fixed - the drag&amp;drop sort function does not work in cmsms 1.8.2</li>
	<li>prevent error when saving a gallery with only subgalleries in it</li>
	</ul>
</li>
<li><strong>Version 1.4</strong> - 18 August 2010
	<ul>
	<li>New action gallerytree</li>
	<li>Define custom fields for galleries or images</li>
	<li>Added smarty variables $numimages and $numdirs</li>
	<li>Editable url-prefix for mod_rewrite/pretty_urls</li>
	<li>Automatic refresh of the page after image upload</li>
	<li>New 'Add subgallery' button in first tab galleries list (FR #5087)</li>
	<li>Edit date of images and subgalleries (FR #5142)</li>
	<li>Gallery folder setting (FR #5232)</li>
	<li>Minor bugfix in moveto function</li>
	<li>Bug #5159: fixed - drop chmod of thumbnails</li>
	<li>Bug #4690: fixed - Install fails with no feedback if Modules folder not writeable</li>
	<li>Bug #4873: fixed - unalowed characters should be replaced in directoryname</li>
	<li>Bug #4735: fixed - error with filenames</li>
	</ul>
</li>
<li><strong>Version 1.3.2</strong> - 4 July 2010
	<ul>
	<li>Bug #5127: fixed - Gallery doesn't work with CMSms 1.8</li>
	</ul>
</li>
<li><strong>Version 1.3.1</strong> - 3 July 2010
	<ul>
	<li>Fix for image upload on some Windows servers</li>
	<li>Update Fancybox Gallerytemplate to version 1.3.1</li>
	<li>Update Slimbox Gallerytemplate to version 2.04</li>
	<li>Fixed export Gallerytemplates including files</li>
	<li>Applied the fix for Bugreport #4808 also to actions showrandom, showlatest and showlatestdir</li>
	<li>Bug #5034: fixed - $image->titlename does not work</li>
	<li>Bug #4634: fixed - php errors on empty imagefiles</li>
	<li>Bug #5086: fixed - Gallery's jQuery conflicts with other javascript libraries in admin back-end</li>
	</ul>
</li>
<li><strong>Version 1.3</strong> - 2 May 2010
	<ul>
	<li>multiple image upload and client side image resize with SWFUpload</li>
	<li>deletefunction for galeries and bulk or separate images</li>
	<li>Fixed a bug related to assigning the albumcover of a subgallery as albumcover</li>
	<li>Added TinyMCE Gallery Picker code (by Stikki)</li>
	<li>Added smarty variable $currentpage (FR #4729)</li>
	<li>Added filename and titlename to image-object smarty variable. Changed $image->title to only show the title and not the filename anymore</li>
	<li>Bug #4712: fixed - Overwrite existing module templates even if unchecked</li>
	<li>Bug #4772: fixed - Collapse/expand doesn't work in IE</li>
	<li>Bug #4808: fixed - Multiple templates on one page removes previous stylesheets/javascripts</li>
	</ul>
</li>
<li><strong>Version 1.2.1</strong> - 3 March 2010
	<ul>
	<li>Fixed a bug that prevented installing the example moduletemplates during initial module install</li>
	<li>Update jQuery to version 1.4.2</li>
	<li>Update Fancybox system to version 1.3.0</li>
	</ul>
</li>
<li><strong>Version 1.2</strong> - 22 February 2010
	<ul>
	<li>Export/import function for Gallery templates</li>
	<li>Mark templates as hidden in the template dropdown for users without 'Modify Templates' permission</li>
	<li>Added backlink to list and breadcrumbs in Gallery editor (FR #4427)</li>
	<li>Added possibility to assign the subfolder's albumcover as albumcover for the parent (FR #4224)</li>
	<li>Added parameter 'targetpage' (FR #4298)</li>
	<li>Better handling for automatic deleting thumbs and added buttons to manualy delete thumbs (FR #4440)</li>
	<li>Bug #4439: fixed - Smarty Error when a non-exixting dir is called</li>
	</ul>
</li>
<li><strong>Version 1.1.2</strong> - 5 December 2009
	<ul>
	<li>Update Fancybox system to version 1.2.6</li>
	<li>Bug #4422: fixed - Error when sortingoption is empty</li>
	<li>Bug #4305: fixed - Built in check for templates/css directory</li>
	</ul>
</li>
<li><strong>Version 1.1.1</strong> - 12 November 2009
	<ul>
	<li>Bug #4294: fixed - Thumbfolder not created when upgrading</li>
	</ul>
</li>
<li><strong>Version 1.1</strong> - 8 November 2009
	<ul>
	<li>Added sorting and drag&amp;drop feature (FR #3907 #4210)</li>
	<li>Moved thumbnailsettings to templatestab</li>
	<li>Make galleries searchable (FR #3956)</li>
	<li>Create backend thumbs if they don't exist in IM (FR #4101)</li>
	<li>Added fileid to image-object (FR #4259)</li>
	<li>Bug #4027: fixed</li>
	</ul>
</li>
<li><strong>Version 1.0.3</strong> - 8 September 2009
	<ul>
	<li>Improved synchronizing the database to files</li>
	<li>and other minor improvements</li>
	<li>Bug #4001: fixed</li>
	</ul>
</li>
<li><strong>Version 1.0.2</strong> - 5 September 2009
	<ul>
	<li>Added templates Fancybox and Lytebox_slideshow (FR #3944 &amp; #3967)</li>
	<li>Bug #3983: fixed - spaces in directory names</li>
	</ul>
</li>
<li><strong>Version 1.0.1</strong> - 23 August 2009
	<ul>
	<li>Apply thumbnail-settings on 'Album-covers' (FR #3924)</li>
	<li>Added missing /div to thickbox-template</li>
	<li>fixed an issue with generating thumbnails when no thumbs available in ImageManager</li>
	<li>improved the naming of thumbs</li>
	<li>Prevent display the content of galleries that are set as inactive</li>
	<li>Bug #3927: fixed</li>
	<li>Bug #3931: fixed</li>
	</ul>
</li>
<li><strong>Version 1.0</strong> - 17 August 2009
	<ul>
	<li>Pagination parameters added</li>
	<li>Standard templates changed accordingly</li>
	<li>Extended the module-help</li>
	<li>Added functions to show random or latest images</li>
	<li>Support of pretty-urls</li>
	<li>Various improvements</li>
	</ul>
</li>
<li><strong>Version 0.6</strong> - 9 August 2009
	<ul>
	<li>Initial Beta Release</li>
	</ul>
</li>
</ul>
