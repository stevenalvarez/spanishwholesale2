<div class="translates form">
<?php echo $this->Form->create('Translate');?>
	<fieldset>
		<legend><?php __('Edit Translate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('esp');
		echo $this->Form->input('cat');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Translate.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Translate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Translates', true), array('action' => 'index'));?></li>
	</ul>
</div>