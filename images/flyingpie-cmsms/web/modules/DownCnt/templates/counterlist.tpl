{if $itemcount > 0}

{$formstart}
<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th>{$nametext}</th>
      <th>{$valuetext}</th>
      <th>{$lastdatetext}</th>
      <th class="pagepos">{$activetext}</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    {foreach from=$items item=entry}
      <tr class="{$entry->rowclass}" onmouseover="this.className='{$entry->rowclass}hover';" onmouseout="this.className='{$entry->rowclass}';">
        <td>{$entry->name}</td>
        <td>{$entry->value}</td>
        <td>{$entry->lastdate}</td>
        <td class="pagepos">{$entry->activelink}</td>
        <td>{$entry->deletelink}</td>
        <td>{$entry->massdeletebox}</td>
      </tr>
    {/foreach}
  </tbody>
</table>
<div style="text-align:right; padding-right: 37px;">{$massdelbutton}</div>
{$formend}

{else}

<br />{$message}<br />

{/if}
