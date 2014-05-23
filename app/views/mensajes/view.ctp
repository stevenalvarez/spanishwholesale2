<div class="mensajes view">
<h2><?php  __('Mensaje');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mensaje['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $mensaje['Pedido']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo Mensaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['tipo_mensaje']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mensaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['mensaje']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mensaje['Mensaje']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mensaje', true), array('action' => 'edit', $mensaje['Mensaje']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Mensaje', true), array('action' => 'delete', $mensaje['Mensaje']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mensaje['Mensaje']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajes', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
