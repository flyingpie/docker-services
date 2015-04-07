<div class="pageoverflow">
  <p class="pageoptions">{$newtemplatelink}</p>
</div>
<div class="pageoverflow">
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th class="pagew50">{$nameprompt}</th>
      <th class="pagew10">{$versionprompt}</th>
      <th class="pagew10">{$aboutprompt}</th>
      <th class="pagew10">{$defaultprompt}</th>
      <th class="pagew10">{$visibleprompt}</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">Export</th>
    </tr>
  </thead>
{foreach from=$items item=entry}
   <tr class="{$entry->rowclass}">
     <td>{$entry->name}</td>
     <td>{$entry->version}</td>
     <td>{$entry->about}</td>
     <td>{$entry->default}</td>
     <td>{$entry->visible}</td>
     <td>{$entry->editlink}</td>
     <td>{$entry->copylink}</td>
     <td>{$entry->deletelink}</td>
     <td>{$entry->export}</td>
   </tr>
{/foreach}
</table>
</div>
<div class="pageoverflow">
  <p class="pageoptions">{$newtemplatelink}</p>
</div>

{$formstart}
<fieldset>
<legend>{$title_importxml}</legend>

<div class="pageoverflow">
<p class="pageinput">{$importxmlnote}</p>
</div>

<div class="pageoverflow">
<p class="pagetext">{$prompt_importxml}:</p>
<p class="pageinput">
{$importxml}
</p>
</div>

<div class="pageoverflow">
<p class="pagetext">{$prompt_overwrite}:</p>
<p class="pageinput">
{$overwrite}
</p>
</div>

<div class="pageoverflow">
<p class="pagetext">&nbsp;</p>
<p class="pageinput">
{$submit}
</p>
</div>

</fieldset>
{$formend}

<div class="pageoverflow">
  &nbsp;
</div>

{$formstart2}
<fieldset>
<legend>{$title_singleimg_template}</legend>

<div class="pageoverflow">
<p class="pagetext">{$prompt_singleimg_template}:</p>
<p class="pageinput">
{$singleimg_template}
</p>
</div>

<div class="pageoverflow">
<p class="pagetext">{$prompt_singleimg_template_html}:</p>
<p class="pageinput">
{$singleimg_template_html}
</p>
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
<p class="pagetext">&nbsp;</p>
<p class="pageinput">
{$submit2}
</p>
</div>

</fieldset>
{$formend2}