<div class="translates form">
<?php echo $this->Form->create('Translate');?>
	<fieldset>
		<legend><?php __('Admin Add Translate'); ?></legend>
	<?php
		echo $this->Form->input('esp');
		echo $this->Form->input('cat');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Translates', true), array('action' => 'index'));?></li>
	</ul>
</div>