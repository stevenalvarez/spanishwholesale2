<div class="userlogs index">
	<h2><?php __('Userlogs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('usuario_id');?></th>
			<th><?php echo $this->Paginator->sort('operacion');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($userlogs as $userlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userlog['Userlog']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($userlog['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $userlog['Usuario']['id'])); ?>
		</td>
		<td><?php echo $userlog['Userlog']['operacion']; ?>&nbsp;</td>
		<td><?php echo $userlog['Userlog']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $userlog['Userlog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $userlog['Userlog']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $userlog['Userlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userlog['Userlog']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Userlog', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>