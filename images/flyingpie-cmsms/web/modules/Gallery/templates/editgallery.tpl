{if !empty($addimages)}
{literal}
<script type="text/javascript" src="../modules/Gallery/templates/swfupload/swfupload.js"></script>
<script type="text/javascript" src="../modules/Gallery/templates/swfupload/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function () {
			swfu = new SWFUpload({
				// Backend Settings
				upload_url: "../modules/Gallery/function.upload.php",
				post_params: {"PHPSESSID": "{/literal}{$sessionid}{literal}"},

				// File Upload Settings{/literal}
				file_size_limit : "{$file_size_limit}",
				file_types : "{$file_types}",
				file_types_description : "{$file_types_description}",
				file_upload_limit : 0,{literal}

				// Event Handler Settings
				swfupload_preload_handler : preLoad,
				swfupload_load_failed_handler : loadFailed,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,

				// Button Settings
				//button_image_url : "../modules/Gallery/images/SmallSpyGlassWithTransperancy_17x18.png",
				button_placeholder_id : "spanButtonPlaceholder",
				button_width: 200,
				button_height: 32,
				//button_text : '<span class="button">Select Images <span class="buttonSmall">({/literal}{$file_size_limit}{literal} Max)</span></span>',
				//button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
				//button_text_top_padding: 0,
				//button_text_left_padding: 18,
				button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
				button_cursor: SWFUpload.CURSOR.HAND,

				// Flash Settings
				flash_url : "../modules/Gallery/templates/swfupload/swfupload.swf",
				flash9_url : "../modules/Gallery/templates/swfupload/swfupload_fp9.swf",

				custom_settings : {
					upload_target : "divFileProgressContainer",
					thumbnail_height: {/literal}{$maximageheight}{literal},
					thumbnail_width: {/literal}{$maximagewidth}{literal},
					thumbnail_quality: 80,
					msg_complete: "{/literal}{$msg_complete}{literal}"
				},

				// Debug Settings
				debug: false
			});
		};
</script>
{/literal}
{/if}

<div class="pageoverflow">
<h3>{$pagetitle}</h3>
</div>
{$formstart}<div class="hidden" id="sort">{$hidden}</div>
{if !empty($directoryname)}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_directoryname}:</p>
  <p class="pageinput">{$directoryname}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_parent}:</p>
  <p class="pageinput">{$moveto}</p>
</div>
{/if}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_gallerytitle}:</p>
  <p class="pageinput">{$gallerytitle}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">{$prompt_comment}:</p>
  <p class="pageinput">{$gallerycomment}</p>
</div>

{if !empty($gallerydate)}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_date}:</p>
  <p class="pageinput">{$gallerydate}</p>
</div>
{/if}

{if !empty($customfields)}
{foreach from=$customfields item=field }
<div class="pageoverflow">
  <p class="pagetext">{$field.name}:</p>
  <p class="pageinput">{$field.fieldhtml}</p>
</div>
{/foreach}
{/if}

{if !empty($prompt_template)}
<div class="pageoverflow">
  <p class="pagetext">{$prompt_template}:</p>
  <p class="pageinput">{$template}</p>
</div>
{else}
{$template}
{/if}

<div class="pageoverflow">
  <p class="pagetext">{$prompt_hideparentlink}:</p>
  <p class="pageinput">{$hideparentlink}</p>
</div>

<div class="pageoverflow">
  <p class="pagetext">&nbsp;</p>
  <p class="pageinput">{$submit}{$cancel}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$unsort}{$updatethumbs}</p>
	<p>&nbsp;</p>
</div>

{if !empty($addimages)}
<div class="pageoverflow">
{*		<div style="width: 180px; height: 18px; border: solid 1px #7FAAFF; background-color: #C5D9FF; padding: 2px;">*}
{*		</div>*}

  {$addgallery} <span id="spanButtonPlaceholder"></span>{$addimages}

</div>
<div class="pageoverflow">
	<div id="divFileProgressContainer"></div>
	<div id="thumbnails">
	</div>
</div>

	<table id="gtable" cellspacing="0" class="pagetable">
		<thead>
		<tr>
			<th class="pageicon">#</th>
			<th>{$item}</th>
			<th>{$title}</th>
			<th>{$comment}</th>
			<th>{$filedate}</th>
			<th class="pageicon">{$cover}</th>
			<th class="pageicon">{$active}</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon">&nbsp;</th>
			<th class="pageicon"><input id="selectall" type="checkbox" /></th>
		</tr>
		</thead>
		<tbody>
	{foreach from=$items item=entry}
		{cycle values="row1,row2" assign=rowclass}
		<tr id="{$entry->fileid}" class="{$rowclass}">
			<td>{if $entry->isdir}&nbsp;{else}{$entry->fileid}{/if}</td>
			<td><a href="{$entry->editurl}" alt="{$entry->edittext}" title="{$entry->edittext}"><span style="display: block; width:96px; height:72px; background: url({$entry->thumburl}) no-repeat center; overflow:hidden;">&nbsp;</span></a></td>
			<td{if $entry->isdir} colspan="2"{/if}>{$entry->filename_input}<br />{$entry->title_input}</td>
			{if !$entry->isdir}<td>{$entry->comment_input}</td>{/if}
			<td>{$entry->filedate_input}</td>
			<td class="pagepos" style="text-align:center">{$entry->defaultlink}</td>
			<td class="pagepos" style="text-align:center">{$entry->activelink}{$entry->active}</td>
			<td class="pagepos" style="text-align:center">{$entry->editlink}</td>
			<td class="pagepos" style="text-align:center">{$entry->deletelink}</td>
			<td class="checkbox">{$entry->imgselect}</td>
		</tr>
	{/foreach}
		</tbody>
	</table>

{if $itemcount > 1}
<div class="pageoptions">
	<div style="margin-top: 0; float: right; text-align: right">
		{$prompt_multiaction}: {$multiaction} {$multiactionsubmit}<br /><div style="margin-top:6px;">{$moveto}</div>
	</div>

	<div class="pageoverflow">
		<p class="pageinput">{$submit}{$cancel}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$unsort}{$updatethumbs}</p>
	</div>
</div>
{elseif $itemcount == 0}
	<h4>{$nofilestext}</h4>
{/if}

{/if}
{$formend}
