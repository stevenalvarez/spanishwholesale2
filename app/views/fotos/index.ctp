<div class="fotos index">
	<h2><?php __('Fotos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('calsado_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('orden');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fotos as $foto):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $foto['Foto']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($foto['Calsado']['title'], array('controller' => 'calsados', 'action' => 'view', $foto['Calsado']['id'])); ?>
		</td>
		<td><?php echo $foto['Foto']['title']; ?>&nbsp;</td>
		<td><?php echo $foto['Foto']['url']; ?>&nbsp;</td>
		<td><?php echo $foto['Foto']['orden']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $foto['Foto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $foto['Foto']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $foto['Foto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $foto['Foto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Foto', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
	</ul>
</div>