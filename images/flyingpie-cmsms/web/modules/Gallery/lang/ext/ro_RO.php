<?php
$lang['friendlyname'] = 'Galerie';
$lang['moddescription'] = 'Cea mai usoara cale de a administra si a afisa galerii foto';
$lang['description'] = 'O galerie usor de folosit care afiseaza utomat imaginile unui folder specificat.';
$lang['postinstall'] = 'Modulul Galerie a fost instalat cu succes.';
$lang['installed'] = 'Modulul Galerie versiunea %s a fost instalat.';
$lang['upgraded'] = 'Modulul Galerie este actualizat la versiunea %s.';
$lang['postuninstall'] = 'Modulul Galerie a fost dezinstalat';
$lang['uninstalled'] = 'Modulul Galerie a fost dezinstalat';
$lang['really_uninstall'] = 'Sigur doriti sa dezinstalati modulul Galerie? Acest lucru nu afecteaza imaginile, dat toate datele de comentarii si miniaturile care au fost create de Galerie vor fi sterse.';
$lang['accessdenied'] = 'Acces Interzis. Verificati-va permisiunile.';
$lang['actions'] = 'Actiuni';
$lang['active'] = 'Activ';
$lang['apply'] = 'Aplicare';
$lang['areyousure'] = 'Sigur doriti sa stergeti?';
$lang['cancel'] = 'Anulare';
$lang['copy'] = 'Copiere';
$lang['default'] = 'implicit';
$lang['delete'] = 'Stergere';
$lang['edit'] = 'Editare';
$lang['error'] = 'Eroare!';
$lang['setfalse'] = 'Setare Fals';
$lang['settrue'] = 'Setare Adevarat';
$lang['submit'] = 'Salvare';
$lang['galleries'] = 'Galerii';
$lang['gallerypath'] = 'Galerie';
$lang['editgallery'] = 'Editare galerie';
$lang['addgallery'] = 'Adaugare galerie';
$lang['nogalleriestext'] = 'Nci o galerie disponibila';
$lang['image'] = 'imagine';
$lang['title'] = 'Titlu';
$lang['date'] = 'Data';
$lang['nofilestext'] = 'Nici o imagine disponibila';
$lang['gallerytitle'] = 'Titlu galerie';
$lang['comment'] = 'Comentariu';
$lang['template'] = 'Template ';
$lang['usedefault'] = 'folosire implicit';
$lang['thumbnailsize'] = 'Dimensiune miniaturi (Frontend)';
$lang['leaveempty'] = '(lasati gol pentru a folosi miniaturile implicite de la Manager Imagini)';
$lang['width'] = 'latime';
$lang['height'] = 'inaltime';
$lang['resizemethod'] = 'metoda redimensionare';
$lang['crop'] = 'crop ';
$lang['scale'] = 'scalare';
$lang['zoomcrop'] = 'zoom &amp; crop ';
$lang['zoomscale'] = 'zoom &amp; scalare';
$lang['createthumbs'] = '(Re)Creare Miniaturi';
$lang['thumbscreated'] = 'Miniaturi create';
$lang['galleryupdated'] = 'Galeria a fost actualizata cu succes.';
$lang['error_updategalleryfailed'] = 'Actualizare galerie esuata.';
$lang['templates'] = 'Template-uri';
$lang['title_available_templates'] = 'Templateuri disponibile';
$lang['prompt_name'] = 'Nume';
$lang['prompt_default'] = 'Implicit';
$lang['prompt_newtemplate'] = 'Creare template nou';
$lang['title_template'] = 'Editor template';
$lang['prompt_templatename'] = 'Nume template';
$lang['prompt_template'] = 'Sursa template';
$lang['prompt_templatejs'] = 'JavaScript Template';
$lang['prompt_templatecss'] = 'Stylesheet CSS template';
$lang['templateupdated'] = 'Template-ul a fost actualizat cu succes.';
$lang['templateadded'] = 'Template-ul a fost adaugat cu succes.';
$lang['error_templatenameexists'] = 'Numele de template exista deja.';
$lang['templatedeleted'] = 'Template sters';
$lang['availablevariables'] = 'Variabile smarty disponibile pentru template';
$lang['availablevariableslist'] = 'Acestea sunt variabilele pe care le puteti folosi pentru a customiza template-ul dumneavoastra:<br /><br />
{$module_message} - error message, is only set if there&#039;s a message<br />
{$gallerytitle} - title of the gallery. If there is no title, this will show the directory name<br />
{$gallerycomment} - comment of the gallery<br />
{$parentlink} - link to the parent folder<br />
{$imagecount} - shows e.g. &quot;6 images&quot;, depending on language<br />
{$itemcount} - number of items, images + folders<br />
{$pages} - number of pages<br />
{$prevpage} - link to previous page, if applicable<br />
{$nextpage} - link to next page, if applicable<br />
{$pagelinks} - links to each existing page<br />
{$images} - array with keys:<br />
&emsp;&bull; file - relative path to the original image<br />
&emsp;&bull; title - title of the image. If there is no title, this will show the filename<br />
&emsp;&bull; comment - comment to the image<br />
&emsp;&bull; filedate - creation date/time <br />
&emsp;&bull; thumb - relative path to the thumbnail<br />
&emsp;&bull; folderlink - link to a subgallery with the thumb of the image which is set as default in that subgallery. If no image is set as default, a standard folder-icon will be used. folderlink is empty if the item is an image<br />
';
$lang['options'] = 'Optiuni';
$lang['allowed_extensions'] = 'Extensii permise';
$lang['use_comment_wysiwyg'] = 'Se foloseste un editor WYSIWYG in campul de comentarii';
$lang['optionsupdated'] = 'Optiunile au fost actualizate cu succes.';
$lang['images'] = 'imagini';
$lang['prevpage'] = 'inapoi';
$lang['nextpage'] = 'inainte';
$lang['defaultgallerycomment'] = 'Va multumim ca ati instalat modulul Galerie. Daca ati urcat imagini in folderul &#039;uploads/images/Gallery/&#039;, le veti vedea mai jos. Puteti edita titlurile, descrierile si dimensiunile miniaturilor in sectiunea de administrare. Verificati toate celelalte optiuni disponibile in Ajutor modul.';
$lang['help_dir'] = 'Parametru pentru specificare folder, relativ la uploads/images/Gallery/';
$lang['help_template'] = 'Folosire template baza de date separat pentru afisare galerie foto. Acest template trebuie sa existe si sa fie vizibil in tabul de template-uri din panoul de administrare al modulului, totusi nu trebuie sa fie cel implicit. Daca acest parametru nu este specificat, atunci template-ul alocat folderului este flosit, altfel se foloseste cel implicit.';
$lang['help_number'] = 'Numarul maxim de miniaturi de afisat (per pagina). Daca lasati campul gol, se vor afisa toate imaginile.';
$lang['help_start'] = 'Pornire la a n-a imagine. Daca lasati campul gol, se va porni de la prima imagine.';
$lang['help_show'] = 'Suprascrie care imagini sa fie afisate. Valori posibile sunt:
<ul>
<li>&#039;active&#039; - pentru afisare imagini marcate ca active (implicit)</li>
<li>&#039;inactive&#039; - pentru afisare numai imagini marcate ca inactive </li>
<li>&#039;all&#039; - pentru afisare toate imaginile</li>
</ul>
';
$lang['help_category'] = 'To display only images/galleries assigned to the specified categories. Use * after the name to show children.  Multiple categories can be used if separated with a comma. Leaving empty, will show all categories. ';
$lang['help_action'] = 'Override the default action. Use it in combination with the above parameters. Possible values are:
<ul>
<li>&#039;showrandom&#039; - to display a set of random thumb-images (applies only to the images which are stored in the database, defaults to a number of 6 images). The dir parameter must be set, or the default Gallery-root will be used. Use &#039;/*&#039; after the name to include images from subdirectories</li>
<li>&#039;showlatest&#039; - to display the most recently added images (applies only to the images which are stored in the database, defaults to a number of 6 images) The dir parameter must be set, or the default Gallery-root will be used. Subdirectories are automatically included</li>
<li>&#039;showlatestdir&#039; - not yet implemented! Mend to display a set of random thumb-images from the most recently added directory (applies only to the images which are stored in the database, defaults to a number of 6 images) The thumb-settings of the Gallery-root will be used</li>
</ul> 
';
$lang['changelog'] = '<ul>
<li>Version 1.0.1. 23 August 2009. Apply thumbnail-settings on &#039;Album-covers&#039; [#3924], Bugfix for [#3927], Added missing /div to thickbox-template, fixed an issue with generating thumbnails when no thumbs available in ImageManager, improved the naming of thumbs, Bugfix for [#3931], Prevent display the content of galleries that are set as inactive.</li>
<li>Version 1.0. 17 August 2009. Pagination parameters added, Standard templates changed accordingly, Extended the module-help, Added functions to show random or latest images, Support of pretty-urls, Various improvements</li>
<li>Version 0.6. 9 August 2009. Initial Beta Release.</li>
</ul> ';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>The Gallery module is an easy to use photo gallery which automatically shows the images of a specified directory. Subdirectories will be shown as subgalleries. It has lots of features, such as automatic thumbnailing, the use of multiple Lightbox-like templates or any css/javascript template you like, and you can give titles and descriptions to your galleries as well as your photos.</p>
<h3>How Do I Use It</h3>
<p>First, insert the module with the {Gallery} tag into your page or template anywhere you whish. Then upload some images with the Image Manager, File Manager (e.g. multiple images in zipfile) or FTP to the uploads/images/Gallery/ directory.</p>
<p>That&#039;s it!</p>
<p>If you want more photo galleries, simply create a subdirectory and upload your photos as described. By adding parameters to the {Gallery} tag, you can easily manipulate which subgallery will be shown in which template, e.g. {Gallery dir=&quot;holidays/Netherlands2009&quot; template=&quot;Lightbox&quot;}</p>
<p>By default the thumbnails from the Image Manager are used to display the photo galleries.</p>
<h3>Advanced Options, but still easy to use</h3>
<p>In the admin section you have lots of other options:</p>
<ul>
<li>Set a photo as the default for a gallery, so it will show in the parent gallery as a &#039;cover&#039; in stead of the default folder-icon.</li>
<li>Give titles and descriptions to galleries.</li>
<li>Set a default template for each gallery.</li>
<li>Set thumbnail sizes for each gallery, with posibilities to scale, crop and/or zoom the images.</li>
<li>Give titles and descriptions to photos.</li>
<li>Switch a specific photo or gallery to inactive, preventing it from display.</li>
<li>Edit/copy templates or create new ones. Check the info-icon beneath the template-code for the available variables.</li>
</ul>
<p>In order to edit templates, the user must belong to a group with the &#039;Modify Templates&#039; permission. To edit the global Gallery options, the user must belong to a group with the &#039;Modify Site Preferences&#039; permission.</p>
<p>All titles, descriptions and settings are stored in the database. The database will synchronize with the filedirectory each time the according gallery is visited in the Gallery-admin. A little warning: when you move an image or subdirectory to another directory, you will loose its title, description and settings.</p>
<h3>Support</h3>
<p>This module does not include commercial support. However, there are a number of resources available to help you with it:</p>
<ul>
<li>For the latest version of this module, FAQs, or to file a Feature Request or Bug Report, please visit the Module Forge
<a href="http://dev.cmsmadesimple.org/projects/gallery/">Gallery Page</a>.</li>
<li>Additional discussion of this module may also be found in the <a href="http://forum.cmsmadesimple.org">CMS Made Simple Forums</a>.</li>
<li>Lastly, you may have some success emailing the author directly.</li>  
</ul>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>

<h3>Copyright and License</h3>
<p>Copyright &copy; 2009, Jos <a href="mailto:josvd@live.nl"><josvd@live.nl></a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p> 
';
$lang['utma'] = '156861353.1526037350.1251959343.1251981192.1251985688.5';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1251959343.1.1.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=cmsmadesimple';
$lang['qca'] = 'P0-901653473-1251959342729';
$lang['utmb'] = '156861353';
?>