<div class="pedidos view">
<h2><?php  __('Pedido');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pedido['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $pedido['Usuario']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Re'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['re']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Iva'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['iva']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Portes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['portes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Total Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['total_pedido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Forma Pago'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['forma_pago']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Di Factura'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['di_factura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Di Envio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['di_envio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comentarios'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['comentarios']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Confirmado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['confirmado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esperando Mercancia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['esperando_mercancia']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Enviado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['enviado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Anulado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['anulado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pedido', true), array('action' => 'edit', $pedido['Pedido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pedido', true), array('action' => 'delete', $pedido['Pedido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['Pedido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajes', true), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Articulos');?></h3>
	<?php if (!empty($pedido['Articulo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Surtido Id'); ?></th>
		<th><?php __('Pedido Id'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Subtotal'); ?></th>
		<th><?php __('Especificacion'); ?></th>
		<th><?php __('Descuento'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pedido['Articulo'] as $articulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $articulo['id'];?></td>
			<td><?php echo $articulo['surtido_id'];?></td>
			<td><?php echo $articulo['pedido_id'];?></td>
			<td><?php echo $articulo['cantidad'];?></td>
			<td><?php echo $articulo['subtotal'];?></td>
			<td><?php echo $articulo['especificacion'];?></td>
			<td><?php echo $articulo['descuento'];?></td>
			<td><?php echo $articulo['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'articulos', 'action' => 'view', $articulo['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'articulos', 'action' => 'edit', $articulo['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'articulos', 'action' => 'delete', $articulo['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Mensajes');?></h3>
	<?php if (!empty($pedido['Mensaje'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Pedido Id'); ?></th>
		<th><?php __('Tipo Mensaje'); ?></th>
		<th><?php __('Mensaje'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pedido['Mensaje'] as $mensaje):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $mensaje['id'];?></td>
			<td><?php echo $mensaje['pedido_id'];?></td>
			<td><?php echo $mensaje['tipo_mensaje'];?></td>
			<td><?php echo $mensaje['mensaje'];?></td>
			<td><?php echo $mensaje['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'mensajes', 'action' => 'view', $mensaje['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'mensajes', 'action' => 'edit', $mensaje['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'mensajes', 'action' => 'delete', $mensaje['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensaje['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mensaje', true), array('controller' => 'mensajes', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
