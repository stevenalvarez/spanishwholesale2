<div class="groupContacts view">
<h2><?php  __('GroupContact');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Group'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['name_group']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sql'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['sql']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Table'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['table']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Replaces'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $groupContact['GroupContact']['replaces']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit GroupContact', true), array('action' => 'edit', $groupContact['GroupContact']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete GroupContact', true), array('action' => 'delete', $groupContact['GroupContact']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $groupContact['GroupContact']['id'])); ?> </li>
		<li><?php echo $html->link(__('List GroupContacts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New GroupContact', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
