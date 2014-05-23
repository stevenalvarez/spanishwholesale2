<div class="pedidos form">
<?php echo $this->Form->create('Pedido');?>
	<fieldset>
		<legend><?php __('Admin Add Pedido'); ?></legend>
	<?php
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('re');
		echo $this->Form->input('iva');
		echo $this->Form->input('portes');
		echo $this->Form->input('total_pedido');
		echo $this->Form->input('forma_pago');
		echo $this->Form->input('di_factura');
		echo $this->Form->input('di_envio');
		echo $this->Form->input('comentarios');
		echo $this->Form->input('confirmado');
		echo $this->Form->input('esperando_mercancia');
		echo $this->Form->input('enviado');
		echo $this->Form->input('anulado');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pedidos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mensajes', true), array('controller' => 'mensajes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mensaje', true), array('controller' => 'mensajes', 'action' => 'add')); ?> </li>
	</ul>
</div>