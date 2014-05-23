<div class="userlogs view">
<h2><?php  __('Userlog');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userlog['Userlog']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($userlog['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $userlog['Usuario']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Operacion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userlog['Userlog']['operacion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $userlog['Userlog']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Userlog', true), array('action' => 'edit', $userlog['Userlog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Userlog', true), array('action' => 'delete', $userlog['Userlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userlog['Userlog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Userlogs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Userlog', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
