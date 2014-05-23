<div class="precios view">
<h2><?php  __('Precio');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $precio['Precio']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('De'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $precio['Precio']['de']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('A'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $precio['Precio']['a']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Precio', true), array('action' => 'edit', $precio['Precio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Precio', true), array('action' => 'delete', $precio['Precio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $precio['Precio']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Precios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Precio', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
