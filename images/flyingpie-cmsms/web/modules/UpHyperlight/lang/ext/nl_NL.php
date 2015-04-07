<?php
$lang['friendly_name'] = 'UpHyperlight ';
$lang['admin_description'] = 'UpHyperlight maakt het weergeven van source code binnen een website makkelijk.';
$lang['install_post_message'] = 'UpHyperlight module is ge&iuml;nstalleerd';
$lang['uninstall_post_message'] = 'UpHyperlight is gedeinstalleerd';
$lang['code_empty'] = 'Parameter code is leeg';
$lang['help'] = '<h3>Over deze module</h3>

<p>
UpHyperlight maakt het weergeven van source code binnen een website makkelijk. Wanneer je nieuws of blog artikelen schrijft en hierin source code wilt toevoegen dan kan deze module je van dienst zijn.
</p>

<p>
Als optie is het mogelijk om verschillende &#039;source code&#039; formaten (filetypes) te gebruiken, weergave hiervan kan met of zonder lijnnummers.
</p>

<p>
Tijdens de installatie is het UpHyperlight.css bestand toegevoegd aan Opmaak -> Stylesheets hiermee kan bepaald worden hoe de &#039;output&#039; van UpHyperlight eruit ziet.
</p>

<p>
UpHyperlight is een wikkel om hyperlight. Hyperlight is (c) 2008-2011 door Konrad Rudolph. Je kunt de hyperlight homepage vinden op: <a href="http://code.google.com/p/hyperlight">http://code.google.com/p/hyperlight</a>
</p>

<h3>Hoe gebruik ik deze module</h3>

<p>

<b>Het toekennen van een waarde aan $code</b><br />

<pre>
{capture assign=&#039;code&#039;}
{literal}
... code voorbeeld hier ....
{/literal}
{/capture}
</pre>

<br /><b>Roep de module met de juiste parameters aan</b><br /><br />

<pre>
{UpHyperlight filetype=&#039;html&#039; code=$code linenumbers=&#039;1&#039;}
</pre>

</p>

<h3>Smarty modifier</h3>

<p>In het mapje modules/UpHyperlight/ kan je een plugin bestand voor Smarty vinden. Wanneer je deze wilt gebruiken dien je  modifier.uphyperlight.php naar de plugins/ map te kopieren</p>

<p>
Hierna kan je deze Smarty modifier als volgt aanroepen:

<pre>

{$code|uphyperlight:&#039;xml&#039;:&#039;1&#039; } 

</pre>

</p>
';
$lang['help_code'] = '<i>string</i> - Deze parameter bevat de code die via UpHyperlight geformateerd zal worden.';
$lang['help_filetype'] = '<i>string</i>: (cpp|csharp|css| iphp|php|phython|vb|xml), xml is de standaard . - Deze parameter wordt gebruikt om te specificeren in welk &#039;filetype&#039; de code geformateerd moet worden.';
$lang['help_linenumbers'] = '<i>boolean</i> (1|0) 0 is de standaard. - Deze parameter wordt gebruikt om aan te geven of lijnnummers wel of niet worden weergegeven.';
$lang['utma'] = '156861353.734685051.1308582223.1308582223.1308582223.1';
$lang['utmc'] = '156861353';
$lang['utmz'] = '156861353.1308555425.1.1.utmccn=(organic)|utmcsr=google|utmctr=translation center cmsms|utmcmd=organic';
$lang['utmb'] = '156861353';
?>