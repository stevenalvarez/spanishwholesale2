<div class="precios form">
<?php echo $this->Form->create('Precio');?>
	<fieldset>
		<legend><?php __('Add Precio'); ?></legend>
	<?php
		echo $this->Form->input('de');
		echo $this->Form->input('a');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Precios', true), array('action' => 'index'));?></li>
	</ul>
</div>