<div class="mensajes form">
<?php echo $this->Form->create('Mensaje');?>
	<fieldset>
		<legend><?php __('Add Mensaje'); ?></legend>
	<?php
		echo $this->Form->input('pedido_id');
		echo $this->Form->input('tipo_mensaje');
		echo $this->Form->input('mensaje');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Mensajes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>