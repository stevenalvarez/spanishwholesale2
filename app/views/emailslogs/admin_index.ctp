<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/emailslogs/index/">Logs de Emails</a></li>

</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">

<div class="userlogs index" id="admin-table">
	<h2>Logs de Emails</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('asunto');?></th>
            <th><?php echo $this->Paginator->sort('para');?></th>
			<th><?php echo $this->Paginator->sort('fechahora');?></th>
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($emailslogs as $userlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userlog['Emailslog']['id']; ?>&nbsp;</td>
		
		<td><?php echo $userlog['Emailslog']['asunto']; ?>&nbsp;</td>
		<td><?php echo $userlog['Emailslog']['para']; ?>&nbsp;</td>
        <td><?php echo $userlog['Emailslog']['fechahora']; ?>&nbsp;</td>
		<td class="actions">
            <?php echo $this->Html->link(___('Ver', true), array('action' => 'view', $userlog['Emailslog']['id'])); ?>
		</td>
        <td class="fix"></td>
	</tr>
<?php endforeach; ?>
	<tr class="clear">
<td colspan="7">
<?php
	echo $this->Paginator->counter(array(
	'format' => __('P&aacute;gina %page% de %pages%', true)
	));
	?>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?><?php echo $this->Paginator->numbers();?><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</td></tr>

	</table>
	
</div>

</div>