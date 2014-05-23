<div class="articulos view">
<h2><?php  __('Articulo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Surtido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($articulo['Surtido']['id'], array('controller' => 'surtidos', 'action' => 'view', $articulo['Surtido']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($articulo['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $articulo['Pedido']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cantidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['cantidad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Subtotal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['subtotal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Especificacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['especificacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descuento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['descuento']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $articulo['Articulo']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Articulo', true), array('action' => 'edit', $articulo['Articulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Articulo', true), array('action' => 'delete', $articulo['Articulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['Articulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Surtidos', true), array('controller' => 'surtidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surtido', true), array('controller' => 'surtidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
