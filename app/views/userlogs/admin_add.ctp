<div class="userlogs form">
<?php echo $this->Form->create('Userlog');?>
	<fieldset>
		<legend><?php __('Admin Add Userlog'); ?></legend>
	<?php
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('operacion');
		echo $this->Form->input('tim');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Userlogs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>