<div class="consultas form">
<?php echo $this->Form->create('Consulta');?>
	<fieldset>
		<legend><?php __('Admin Add Consulta'); ?></legend>
	<?php
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('usuario_prov_id');
		echo $this->Form->input('consulta');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Consultas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Respuestas', true), array('controller' => 'respuestas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Respuesta', true), array('controller' => 'respuestas', 'action' => 'add')); ?> </li>
	</ul>
</div>