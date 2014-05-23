<div class="articulos index">
	<h2><?php __('Articulos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('surtido_id');?></th>
			<th><?php echo $this->Paginator->sort('pedido_id');?></th>
		
			<th><?php echo $this->Paginator->sort('subtotal');?></th>
			<th><?php echo $this->Paginator->sort('especificacion');?></th>
			<th><?php echo $this->Paginator->sort('descuento');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($articulo['Surtido']['id'], array('controller' => 'surtidos', 'action' => 'view', $articulo['Surtido']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($articulo['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $articulo['Pedido']['id'])); ?>
		</td>
		<td><?php echo $articulo['Articulo']['cantidad']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['subtotal']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['especificacion']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['descuento']; ?>&nbsp;</td>
		<td><?php echo $articulo['Articulo']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $articulo['Articulo']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $articulo['Articulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['Articulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Articulo', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Surtidos', true), array('controller' => 'surtidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surtido', true), array('controller' => 'surtidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>