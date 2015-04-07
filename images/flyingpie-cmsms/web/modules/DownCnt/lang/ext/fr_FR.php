<?php
$lang['modulename'] = 'Compteur de T&eacute;l&eacute;chargement';
$lang['help'] = '<h3>Que fait ce module?</h3>
<p>Le module de compteur de t&eacute;l&eacute;chargement est un modul tr&egrave;s simple d&#039;utilisation. Il est utilis&eacute; pour ajouter des compteurs aux fichiers pr&eacute;sentes dans vos pages.
Ce module ne d&eacute;pend ni du module Uploads, ni d&#039;aucun autre module. Vous pouvez l&#039;utiliser pour n&#039;importe quel fichier, peut importe s&#039;il est pr&eacute;sent sur votre serveur ou non. Encore mieux : vous pouvez l&#039;utiliser pour <b>n&#039;importe quel lien</b> de votre site pointant vers votre site ou un autre site pour compter combien de fois il a &eacute;t&eacute; cliqu&eacute;!
</p>

<h3>Comment l&#039;utiliser?</h3>
<p>Le module Download counter est juste un module de type tag. Il est &agrave; ins&eacute;rer dans vos pages ou vos templates en utilisant le tag suivant :<br />


<code>{DownCnt name=&#039;nom_du_compteur&#039; link=&#039;sitecible.com&#039; protocol=&#039;http&#039;}</code> - pour compter les clics, et<br />
<code>(DownCnt name=&#039;nom_du_compteur&#039; action=&#039;display&#039;}</code> - pour afficher le compteur.</p>
<p>Soyez certain de d&eacute;finir les permissions &#039;Manage Download Counters&#039; aux utilisateurs qui administreront les compteurs.</p>

<h4>attention avec le WYSIWYG!</h4>

<p>dans un bloc de contenu avec le WYSIWYG activ&eacute;, il est dangereux d&#039;&eacute;crire :</p>

<p>
<code>&amp;lt;a href=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span> link=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>downloads/the_file.zip<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&quot;</span>&amp;gt;download this file&amp;lt;/a&amp;gt;</code> <span style=&quot;color:#F00;&quot;>--&amp;gt; M&ecirc;me indicateur dans le code smarty et &agrave; l&#039;exterieur</span><br/>

<code>&amp;lt;a href=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span> link=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>downloads/the_file.zip<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>&amp;gt;download this file&amp;lt;/a&amp;gt;</code> <span style=&quot;color:#F00;&quot;>--&amp;gt; M&ecirc;me indicateur dans le code smarty et &agrave; l&#039;exterieurl</span><br/>

<code>&amp;lt;a href=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>{DownCnt name=<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>the_file<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span> link=&quot;downloads/the_file.zip&quot;}<span style=&quot;background-color:#000000;color:#FFFFFF;&quot;>&#039;</span>&amp;gt;download this file&amp;lt;/a&amp;gt;</code> <span style=&quot;color:#F00;&quot;>--&amp;gt; M&ecirc;me indicateur dans le code smarty et &agrave; l&#039;exterieur</span><br/>
</p>

<p>par ce que TinyMce va d&eacute;truire le code :(</p>

<p>dans le WYSIWYG, TinyMCE g&eacute;n&egrave;re toujours un lien de la m&ecirc;me mani&egrave;re: </p>

<code>&amp;lt;a href=<b>&quot;</b>XXXXXXX<b>&quot;</b>&amp;gt;bla bla&amp;lt;/a&amp;gt;</code><br/><br/>

<p>avec XXXXXXX &eacute;tant l&#039;url du lien. De ce fait il est imperatif de toujours d&eacute;clarer le code smarty avec des apostrophe (&#039;) et non avec des guillemets (&quot;) pour ne pas rentrer en conflit avec TinyMCE</p>

<code>&amp;lt;a href=<b>&quot;</b>{DownCnt name=<b>&#039;</b>the_file<b>&#039;</b> link=&#039;downloads/the_file.zip&#039;}<b>&quot;</b>&amp;gt;download this file&amp;lt;/a&amp;gt;</code> <span style=&quot;color:#0A0;&quot;>--&amp;gt; diff&eacute;rent indicateur dans le code smarty et &agrave; l&#039;exterieur</span><br/><br/>

<h3>Param&egrave;tres</h3>
<ul>
<li><i>action</i> - action entreprise par le module. Les valeurs possibles sont :
  <ul>
    <li><i>default</i> - Le tag va g&eacute;n&eacute;rer un syst&egrave;me de comptage. Pour cela il va remplacer votre lien par un substitut dans le tag html &amp;lt;a&amp;gt; (par exemple: &amp;lt;a href=&quot;{DownCnt ...)&quot;; Les param&egrave;tres <i>name</i> et <i>link</i> sont obligatoires pour cette action; Le param&egrave;tre <i>protocol</i> est obligatoire si vous souhaitez un lien externe</li>
    <li><i>display</i> - Le tag va seulement afficher le compteur pour le nom donn&eacute;.; Le param&egrave;tre <i>name</i> est obligatoire.;</li>
  </ul>
<li><i>name</i> - Nom du compteur &agrave; utiliser. Le nom peut &ecirc;tre ce que vous souhaitez (le nom du fichier par exemple), mais, il devra &ecirc;tre unique sur l&#039;installation de CMS. Le nom est un identifiant qui permet de distinguer les diff&eacute;rents compteurs. Le nom ne peut pas &ecirc;tre plus grand que 255 caract&egrave;res.!</li>
<li><i>link</i> - Obligatoire uniquement si <i>action</i>=&#039;default&#039;; Ins&eacute;rez ici le lien vers la cible : le lien qui aurait &eacute;t&eacute; normalement utilis&eacute; dans la propri&eacute;t&eacute; href de la balise html &amp;lt;a&amp;gt; Le chemin est relatif au r&eacute;pertoire d&#039;installation de CMS. Pour des liens externes vous ne devez pas pr&eacute;ciser  <b>http://</b> mais vous devez ajouter le <b>param&egrave;tre protocol</b>.</li>
<li><i>protocol</i> - useful if and only if you define an external url to your website with param <i>link</i>. it can take the value of <b>http</b> / <b>https</b> / <b>ftp</b> (http is the most common)
</ul>
<br/>
<p>To display the counter of a link after the actual link the tag must be used twice - first with default <i>action</i> (the <i>action</i> parameter may be omitted in this case), and second with <i>action</i>=&#039;display&#039;, and the same <i>name</i> must be set in both tags.</p>

<h3>Examples</h3>
<h4>Creating link to a site or downloadable file that will count clicks:</h4>
<p>If your link looks like<br />
<br />
<code>&amp;lt;a href=&quot;/downloads/the_file.zip&quot;&amp;gt;download this file&amp;lt;/a&amp;gt;</code> or<br />
<code>&amp;lt;a href=&quot;http://somesite.com&quot;&amp;gt;go to the site&amp;lt;/a&amp;gt;</code> or<br />
<code>&amp;lt;a href=&quot;www.somesite.com/sub/contact.html&quot;&amp;gt;go to the site&amp;lt;/a&amp;gt;</code> or<br />
<code>&amp;lt;a href=&quot;ftp://sub.somesite.com&quot;&amp;gt;see my ftp file&amp;lt;/a&amp;gt;</code><br />
<br />
to make the link counting clicks, you will have to change it to<br />
<br />
<code>&amp;lt;a href=&quot;{DownCnt name=&#039;the_file&#039; link=&#039;/downloads/the_file.zip&#039;}&quot;&amp;gt;download this file&amp;lt;/a&amp;gt;</code> or<br />
<code>&amp;lt;a href=&quot;{DownCnt name=&#039;the_site&#039; link=&#039;somesite.com&#039; protocol=&#039;http&#039;}&quot;&amp;gt;go to the site&amp;lt;/a&amp;gt;</code> or<br />
<code>&amp;lt;a href=&quot;{DownCnt name=&#039;the_site&#039; link=&#039;www.somesite.com/sub/contact.html&#039; protocol=&#039;http&#039;}&quot;&amp;gt;go to the site&amp;lt;/a&amp;gt;</code> or<br /> 
<code>&amp;lt;a href=&quot;{DownCnt name=&#039;the_site&#039; link=&#039;sub.somesite.com&#039; protocol=&#039;ftp&#039;}&quot;&amp;gt;see my ftp file&amp;lt;/a&amp;gt;</code> <br />
<br />

Note that <b>there are quotation marks around the tag</b> since version 1.1.0,  It&#039;s important to add them.<br />
<br />
Other &amp;lt;A&amp;gt; tag parameters, like target or class or id, can be used freely.</p>

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
		1.1.0: nouvelle grosse version
		<ul>
			<li><span style=&quot;color:#F00;&quot;>CHANGE : vous devez maintenant sp&eacute;cifier les guillemets autour de l&#039;appel au code smarty (Lire l&#039;aide pour plus d&#039;information)</span></li>
			<li></li>
			<li>AJOUT: ajout du param&egrave;tre &quot;protocol&quot; qui vous permet de sp&eacute;cifier un lien externe en toute s&eacute;curit&eacute;</li>
			<li>AJOUT: meilleur int&eacute;gration dans les WYSIWYG (<span style=&quot;color:#F00;&quot;>pas encore parfait &agrave; l&#039;heure actuelle, veuillez regarder l&#039;aide pour plus d&#039;information</span>)</li>
			<li>AJOUT: le module peut maintenant &ecirc;tre appel&eacute; par une commande plus simple</li>
			<li>AJOUT: meilleur contr&ocirc;le des param&egrave;tres pass&eacute;s</li>
			<li></li>
			<li>MAJ : mise &agrave; jour de la documentation</li>
		</ul>
	
	
	</li>
	
	<li>1.0.0: Premi&egrave;re release</li>
</ul>

';
$lang['description'] = 'Le module compteur de t&eacute;l&eacute;chargement vous permet de compter le nombre de clic sur un lien &agrave; partir de votre site.';
$lang['postinstall'] = 'Ne pas oubliez pas de vous assurer de mettre <b>la  permission &#039;Manage Download Counters&#039;</b> sur les utilisateurs qui g&eacute;reront les compteurs.<br />
Voir l&#039;aide pour plus information.';
$lang['pre_uninstall'] = 'Tous les compteurs seront supprim&eacute;s. Voulez-vous d&eacute;sinstaller ce module ?';
$lang['uninstalled'] = 'Module d&eacute;sinstall&eacute;.';
$lang['installed'] = 'Version %s du module version install&eacute;e.';
$lang['upgraded'] = 'Module mis &agrave; jour en version %s.';
$lang['nameunspec'] = 'Le param&egrave;tre n&eacute;cessaire name est ind&eacute;termin&eacute; !';
$lang['error_insufficientparams'] = 'Param&egrave;tre obligatoire non sp&eacute;cifi&eacute; : %s ';
$lang['nocountersfound'] = 'Il n&#039;y a pas encore ce compteur.<br />
Pour cr&eacute;er un compteur ajouter la balise module dans une page (voir l&#039;aide du module Pour plus d&#039;informations sur la fa&ccedil;on de le faire) - un nouveau compteur sera cr&eacute;&eacute; automatiquement quand quelqu&#039;un cliquera sur le lien pour la premi&egrave;re fois.';
$lang['delete'] = 'Supprimer';
$lang['areyousure'] = 'Supprimer le compteur ?';
$lang['areyousure2'] = 'Supprimer les compteurs ?';
$lang['name'] = 'Nom du compteur';
$lang['value'] = 'Nombre de t&eacute;l&eacute;chargements';
$lang['lastdate'] = 'Derni&egrave;re date de click';
$lang['active'] = 'Actif';
$lang['delselected'] = 'Supprimer les compteurs s&eacute;lectionn&eacute;s';
$lang['needpermission'] = 'Vous avez besoin de la permission &#039;%s&#039; pour cette fonction.';
$lang['error_no_id'] = 'Erreur interne : id non sp&eacute;cifi&eacute;e';
$lang['error_protocol_nok'] = 'Le param&egrave;tre protocol doit &ecirc;tre http ou https ou ftp';
$lang['param_action'] = 'Action &agrave; effectuer dans la balise courante. \<i>default</i>&#039;: affiche des liens cliquable, &#039;<i>display</i>&#039;: affiche la valeur du compteur.';
$lang['param_name'] = 'Nom du compteur, par lequel les diff&eacute;rents compteurs serons distingu&eacute;s.';
$lang['param_link'] = 'Lien vers la ressource cible.';
$lang['param_protocol'] = 'Si c&#039;est un lien externe alors il faut d&eacute;finir le protocole : http ou https ou ftp (http est le plus courant)';
$lang['utma'] = '156861353.1949673112.1265210769.1285602551.1285658846.181';
$lang['utmz'] = '156861353.1284967236.166.35.utmcsr=feedburner|utmccn=Feed: cmsmadesimple/blog (CMS Made Simple)|utmcmd=feed';
$lang['qca'] = 'P0-1075820551-1265210768764';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1285658846';
?>