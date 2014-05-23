<div class="precios form">
<?php echo $this->Form->create('Precio');?>
	<fieldset>
		<legend><?php __('Edit Precio'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('de');
		echo $this->Form->input('a');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Precio.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Precio.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Precios', true), array('action' => 'index'));?></li>
	</ul>
</div>