<div class="translates view">
<h2><?php  __('Translate');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $translate['Translate']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Esp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $translate['Translate']['esp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $translate['Translate']['cat']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Translate', true), array('action' => 'edit', $translate['Translate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Translate', true), array('action' => 'delete', $translate['Translate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $translate['Translate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Translates', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Translate', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
