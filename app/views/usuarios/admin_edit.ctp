<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
	<fieldset>
		<legend><?php __('Admin Edit Usuario'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('regione_id');
		echo $this->Form->input('rol');
		echo $this->Form->input('title');
		echo $this->Form->input('tipo_de_negocio');
		echo $this->Form->input('persona_contacto');
		echo $this->Form->input('email');
		echo $this->Form->input('cif');
		echo $this->Form->input('direccion');
		echo $this->Form->input('codigo_postal');
		echo $this->Form->input('iva');
		echo $this->Form->input('re');
		echo $this->Form->input('fax');
		echo $this->Form->input('telefonos');
		echo $this->Form->input('tim');
		echo $this->Form->input('fecha_alta');
		echo $this->Form->input('estado');
		echo $this->Form->input('ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Usuario.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Usuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Regiones', true), array('controller' => 'regiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regione', true), array('controller' => 'regiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consultas', true), array('controller' => 'consultas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consulta', true), array('controller' => 'consultas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>