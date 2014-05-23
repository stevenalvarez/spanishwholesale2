<div class="surtidos form">
<?php echo $this->Form->create('Surtido');?>
	<fieldset>
		<legend><?php __('Add Surtido'); ?></legend>
	<?php
		echo $this->Form->input('calsado_id');
		echo $this->Form->input('talla_inf');
		echo $this->Form->input('talla_sup');
		echo $this->Form->input('descripcion');
		echo $this->Form->input('pares');
		echo $this->Form->input('precio_par');
		echo $this->Form->input('precio_sur');
		echo $this->Form->input('oferta');
		echo $this->Form->input('precio_par_oferta');
		echo $this->Form->input('precio_sur_oferta');
		echo $this->Form->input('surtido_libre');
		echo $this->Form->input('cajas_surtidas');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Surtidos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
	</ul>
</div>