<div class="surtidos index">
	<h2><?php __('Surtidos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('calsado_id');?></th>
			<th><?php echo $this->Paginator->sort('talla_inf');?></th>
			<th><?php echo $this->Paginator->sort('talla_sup');?></th>
			<th><?php echo $this->Paginator->sort('descripcion');?></th>
			<th><?php echo $this->Paginator->sort('pares');?></th>
			<th><?php echo $this->Paginator->sort('precio_par');?></th>
			<th><?php echo $this->Paginator->sort('precio_sur');?></th>
			<th><?php echo $this->Paginator->sort('oferta');?></th>
			<th><?php echo $this->Paginator->sort('precio_par_oferta');?></th>
			<th><?php echo $this->Paginator->sort('precio_sur_oferta');?></th>
			<th><?php echo $this->Paginator->sort('surtido_libre');?></th>
			<th><?php echo $this->Paginator->sort('cajas_surtidas');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($surtidos as $surtido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $surtido['Surtido']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($surtido['Calsado']['title'], array('controller' => 'calsados', 'action' => 'view', $surtido['Calsado']['id'])); ?>
		</td>
		<td><?php echo $surtido['Surtido']['talla_inf']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['talla_sup']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['pares']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['precio_par']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['precio_sur']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['oferta']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['precio_par_oferta']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['precio_sur_oferta']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['surtido_libre']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['cajas_surtidas']; ?>&nbsp;</td>
		<td><?php echo $surtido['Surtido']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $surtido['Surtido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $surtido['Surtido']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $surtido['Surtido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surtido['Surtido']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Surtido', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
	</ul>
</div>