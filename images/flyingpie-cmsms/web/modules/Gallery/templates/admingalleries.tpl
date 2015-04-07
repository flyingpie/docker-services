<div class="pageoverflow">
	{$addgallery}
</div>
{if $itemcount > 0}

	{$formstart}
	<table id="gtree" cellspacing="0" class="pagetable">
		<thead>
			<tr>
				<th>{$gallerypath}</th>
				<th class="pagew60">{$dirtag}</th>
				<th class="pageicon">{$active}</th>			
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon">&nbsp;</th>
				<th class="pageicon"><input id="selectall" type="checkbox" /></th>
			</tr>
		</thead>
		<tbody>
	{foreach from=$items item=entry}
		{cycle values="row1,row2" assign=rowclass}
			{*
			<tr id="node-{$entry->id}" class="{$rowclass}{$entry->gidclass}" onmouseover="this.className='{$rowclass}hover{$entry->gidclass}';" onmouseout="this.className='{$rowclass}{$entry->gidclass}';">
			*}
			<tr id="node-{$entry->id}"{if !empty($entry->gidclass)} class="{$entry->gidclass|trim}"{/if}>
				<td class="tfile">{$entry->file}</td>
				<td class="tfile">{$entry->dirtag}</td>
				<td class="pagepos" style="text-align:center">{$entry->activelink}</td>			
				<td class="pagepos" style="text-align:center">{$entry->editlink}</td>
				<td class="pagepos" style="text-align:center">{$entry->deletelink}</td>
				<td class="checkbox">{$entry->imgselect}</td>
			</tr>
	{/foreach}
		</tbody>
	</table>

	<div style="margin-top: 0; float: right; text-align: right">
		{$prompt_multiaction}: {$multiaction}
	</div>

	{$formend}

{else}
	<h4>{$nogalleriestext}</h4>
{/if}

<div class="pageoverflow">
	&nbsp;
</div>