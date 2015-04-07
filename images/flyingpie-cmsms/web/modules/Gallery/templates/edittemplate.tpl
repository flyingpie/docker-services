<div class="pageoverflow">
<h3>{$title}</h3>
</div>
{$formstart}{$hidden}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_templatename}:</p>
  <p class="pageinput">{$templatename}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_thumbnailsize}:</p>
  <p class="pageinput">{$thumbnailsize}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_maxnumber}:</p>
  <p class="pageinput">{$maxnumber} ({$showallimages})</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_sortingoptions}:</p>
  <fieldset class="pageinput" style="width:400px; padding:6px;">{$sortingoptions}</fieldset>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}{$cancel}{$apply}{$reset}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_template}:</p>
  <p class="pageinput">{$template}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$availablevariables}: <a href="#" onclick="togglecollapse('variablesinfo'); return false;">{$availablevariableslink}</a></p>
</div>
<div id="variablesinfo" style="display: none;">
<div class="pageoverflow">
  <p class="pageinput">{$availablevariableslist}</p>
</div>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_templatecss}:</p>
  <p class="pageinput">{$templatecss}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_templatejs}:</p>
  <p class="pageinput">{$templatejs}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}{$cancel}{$apply}{$reset}</p>
</div>
{$formend}
