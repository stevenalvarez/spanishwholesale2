<div class="tags form">
<?php echo $this->Form->create('Tag');?>
	<fieldset>
		<legend><?php __('Edit Tag'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('orden');
		echo $this->Form->input('activo');
		echo $this->Form->input('Calsado');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Tag.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Tag.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
	</ul>
</div>