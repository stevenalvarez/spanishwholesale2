<div class="articulos form">
<?php echo $this->Form->create('Articulo');?>
	<fieldset>
		<legend><?php __('Edit Articulo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('surtido_id');
		echo $this->Form->input('pedido_id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('subtotal');
		echo $this->Form->input('especificacion');
		echo $this->Form->input('descuento');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Articulo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Articulo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Surtidos', true), array('controller' => 'surtidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surtido', true), array('controller' => 'surtidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>