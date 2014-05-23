<div class="surtidos view">
<h2><?php  __('Surtido');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Calsado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($surtido['Calsado']['title'], array('controller' => 'calsados', 'action' => 'view', $surtido['Calsado']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Talla Inf'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['talla_inf']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Talla Sup'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['talla_sup']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pares'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['pares']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio Par'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['precio_par']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio Sur'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['precio_sur']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['oferta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio Par Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['precio_par_oferta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Precio Sur Oferta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['precio_sur_oferta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Surtido Libre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['surtido_libre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cajas Surtidas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['cajas_surtidas']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $surtido['Surtido']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Surtido', true), array('action' => 'edit', $surtido['Surtido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Surtido', true), array('action' => 'delete', $surtido['Surtido']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $surtido['Surtido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Surtidos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Surtido', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articulos', true), array('controller' => 'articulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Articulos');?></h3>
	<?php if (!empty($surtido['Articulo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Surtido Id'); ?></th>
		<th><?php __('Pedido Id'); ?></th>
		<th><?php __('Cantidad'); ?></th>
		<th><?php __('Subtotal'); ?></th>
		<th><?php __('Especificacion'); ?></th>
		<th><?php __('Descuento'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($surtido['Articulo'] as $articulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $articulo['id'];?></td>
			<td><?php echo $articulo['surtido_id'];?></td>
			<td><?php echo $articulo['pedido_id'];?></td>
			<td><?php echo $articulo['cantidad'];?></td>
			<td><?php echo $articulo['subtotal'];?></td>
			<td><?php echo $articulo['especificacion'];?></td>
			<td><?php echo $articulo['descuento'];?></td>
			<td><?php echo $articulo['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'articulos', 'action' => 'view', $articulo['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'articulos', 'action' => 'edit', $articulo['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'articulos', 'action' => 'delete', $articulo['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articulo['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Articulo', true), array('controller' => 'articulos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
