<div class="pedidos index">
	<h2><?php __('Pedidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('usuario_id');?></th>
			<th><?php echo $this->Paginator->sort('re');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('portes');?></th>
			<th><?php echo $this->Paginator->sort('total_pedido');?></th>
			<th><?php echo $this->Paginator->sort('forma_pago');?></th>
			<th><?php echo $this->Paginator->sort('di_factura');?></th>
			<th><?php echo $this->Paginator->sort('di_envio');?></th>
			<th><?php echo $this->Paginator->sort('comentarios');?></th>
			<th><?php echo $this->Paginator->sort('confirmado');?></th>
			<th><?php echo $this->Paginator->sort('esperando_mercancia');?></th>
			<th><?php echo $this->Paginator->sort('enviado');?></th>
			<th><?php echo $this->Paginator->sort('anulado');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pedido['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $pedido['Usuario']['id'])); ?>
		</td>
		<td><?php echo $pedido['Pedido']['re']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['iva']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['portes']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['total_pedido']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['forma_pago']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['di_factura']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['di_envio']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['comentarios']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['confirmado']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['esperando_mercancia']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['enviado']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['anulado']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pedido['Pedido']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pedido['Pedido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['Pedido']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Pedido', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajes', true), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>