<div class="pageoverflow">
<h3>{$pagetitle}</h3>
</div>
{$formstart}{$hidden}
<div class="pageoverflow">
  <p class="pagetext">{$file}: #{$image->fileid}</p>
  <p class="pageinput">{$image->thumb}<br />{$image->filename_input}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$title}:</p>
  <p class="pageinput">{$image->title_input}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$comment}:</p>
  <p class="pageinput">{$image->comment_input}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$filedate}:</p>
  <p class="pageinput">{$image->filedate_input}</p>
</div>

{foreach from=$image->fields item=field }
<div class="pageoverflow">
  <p class="pagetext">{$field.name}:</p>
  <p class="pageinput">{$field.fieldhtml}</p>
</div>
{/foreach}

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}{$apply}{$cancel}</p>
	<p>&nbsp;</p>
</div>

<div class="pageoverflow">
  <p class="pagetext"><img src="{$image->file}" id="cropbox" /></p>
		<div class="pagetext" style="width:96px;height:64px;overflow:hidden;">
			<img src="{$image->file}" id="preview" />
		</div>
</div>

{$formend}
