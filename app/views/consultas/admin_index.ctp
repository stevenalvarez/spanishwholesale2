<div class="consultas index">
	<h2><?php __('Consultas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('usuario_id');?></th>
			<th><?php echo $this->Paginator->sort('usuario_prov_id');?></th>
			<th><?php echo $this->Paginator->sort('consulta');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($consultas as $consulta):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $consulta['Consulta']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($consulta['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $consulta['Usuario']['id'])); ?>
		</td>
		<td><?php echo $consulta['Consulta']['usuario_prov_id']; ?>&nbsp;</td>
		<td><?php echo $consulta['Consulta']['consulta']; ?>&nbsp;</td>
		<td><?php echo $consulta['Consulta']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $consulta['Consulta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $consulta['Consulta']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $consulta['Consulta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consulta['Consulta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Consulta', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Respuestas', true), array('controller' => 'respuestas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Respuesta', true), array('controller' => 'respuestas', 'action' => 'add')); ?> </li>
	</ul>
</div>