<div class="mensajes index">
	<h2><?php __('Mensajes');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('pedido_id');?></th>
			<th><?php echo $this->Paginator->sort('tipo_mensaje');?></th>
			<th><?php echo $this->Paginator->sort('mensaje');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($mensajes as $mensaje):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $mensaje['Mensaje']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($mensaje['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $mensaje['Pedido']['id'])); ?>
		</td>
		<td><?php echo $mensaje['Mensaje']['tipo_mensaje']; ?>&nbsp;</td>
		<td><?php echo $mensaje['Mensaje']['mensaje']; ?>&nbsp;</td>
		<td><?php echo $mensaje['Mensaje']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $mensaje['Mensaje']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $mensaje['Mensaje']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $mensaje['Mensaje']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensaje['Mensaje']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>