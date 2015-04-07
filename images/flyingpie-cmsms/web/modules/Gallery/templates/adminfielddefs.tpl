{if $items|@count > 0}
<div class="pageoverflow">
  <p class="pageoptions">{$newfielddeflink}</p>
</div>
<div class="pageoverflow">
{$formstart}
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th class="pagew25">{$fielddef} ({if $items[0]->dirfield}{$galleries}{else}{$images}{/if})</th>
      <th class="pagew25">{$alias}</th>
      <th class="pagew25">{$type}</th>
      <th class="pagew10">{$public}</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
    </tr>
  </thead>
{foreach from=$items item=entry}
{if $entry->newtable}
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th class="pagew25">{$fielddef} ({$images})</th>
      <th class="pagew25">{$alias}</th>
      <th class="pagew25">{$type}</th>
      <th class="pagew10">{$public}</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
    </tr>
  </thead>
{/if}
    <tr class="{$entry->rowclass}">
      <td>{$entry->name}</td>
      <td>{$entry->alias}</td>
      <td>{$entry->type}</td>
      <td>{$entry->public}</td>
      <td>{$entry->moveup}</td>
      <td>{$entry->movedown}</td>
      <td>{$entry->editlink}</td>
      <td>{$entry->deletelink}</td>
    </tr>
{/foreach}
</table>

{*<div class="pageoverflow">
	<p class="pageinput">{$submit}{$cancel}</p>
</div>*}

{$formend}
</div>
{/if}

<div class="pageoverflow">
  <p class="pageoptions">{$newfielddeflink}</p>
</div>
