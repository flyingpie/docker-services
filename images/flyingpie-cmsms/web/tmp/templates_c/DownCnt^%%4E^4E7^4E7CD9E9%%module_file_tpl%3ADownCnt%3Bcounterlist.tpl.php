<?php /* Smarty version 2.6.26, created on 2014-11-08 14:20:40
         compiled from module_file_tpl:DownCnt%3Bcounterlist.tpl */ ?>
<?php if ($this->_tpl_vars['itemcount'] > 0): ?>

<?php echo $this->_tpl_vars['formstart']; ?>

<table cellspacing="0" class="pagetable">
  <thead>
    <tr>
      <th><?php echo $this->_tpl_vars['nametext']; ?>
</th>
      <th><?php echo $this->_tpl_vars['valuetext']; ?>
</th>
      <th><?php echo $this->_tpl_vars['lastdatetext']; ?>
</th>
      <th class="pagepos"><?php echo $this->_tpl_vars['activetext']; ?>
</th>
      <th class="pageicon">&nbsp;</th>
      <th class="pageicon">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entry']):
?>
      <tr class="<?php echo $this->_tpl_vars['entry']->rowclass; ?>
" onmouseover="this.className='<?php echo $this->_tpl_vars['entry']->rowclass; ?>
hover';" onmouseout="this.className='<?php echo $this->_tpl_vars['entry']->rowclass; ?>
';">
        <td><?php echo $this->_tpl_vars['entry']->name; ?>
</td>
        <td><?php echo $this->_tpl_vars['entry']->value; ?>
</td>
        <td><?php echo $this->_tpl_vars['entry']->lastdate; ?>
</td>
        <td class="pagepos"><?php echo $this->_tpl_vars['entry']->activelink; ?>
</td>
        <td><?php echo $this->_tpl_vars['entry']->deletelink; ?>
</td>
        <td><?php echo $this->_tpl_vars['entry']->massdeletebox; ?>
</td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
  </tbody>
</table>
<div style="text-align:right; padding-right: 37px;"><?php echo $this->_tpl_vars['massdelbutton']; ?>
</div>
<?php echo $this->_tpl_vars['formend']; ?>


<?php else: ?>

<br /><?php echo $this->_tpl_vars['message']; ?>
<br />

<?php endif; ?>