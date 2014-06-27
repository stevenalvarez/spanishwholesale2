<div class="usuarios view">
<h2><?php  __('Usuario');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Regione'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($usuario['Regione']['title'], array('controller' => 'regiones', 'action' => 'view', $usuario['Regione']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['rol']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo De Negocio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['tipo_de_negocio']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Persona Contacto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['persona_contacto']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cif'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['cif']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Direccion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['direccion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo Postal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['codigo_postal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Iva'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['iva']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Re'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['re']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['fax']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Telefonos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['telefonos']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['tim']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha Alta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['fecha_alta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Estado'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['estado']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['ip']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usuario', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Usuario', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['Usuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regiones', true), array('controller' => 'regiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regione', true), array('controller' => 'regiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consultas', true), array('controller' => 'consultas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consulta', true), array('controller' => 'consultas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Calsados');?></h3>
	<?php if (!empty($usuario['Calsado'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
        <!--
		<th><?php __('Categoria Id'); ?></th>
        -->
		<th><?php __('Code'); ?></th>
        <!--
		<th><?php __('Tipo Id'); ?></th>
        -->
		<th><?php __('Usuario Id'); ?></th>
		<th><?php __('Material Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Marca'); ?></th>
		<th><?php __('Activado'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($usuario['Calsado'] as $calsado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calsado['id'];?></td>
            <!--
			<td><?php echo $calsado['categoria_id'];?></td>
            -->
			<td><?php echo $calsado['code'];?></td>
            <!--
			<td><?php echo $calsado['tipo_id'];?></td>
            -->
			<td><?php echo $calsado['usuario_id'];?></td>
			<td><?php echo $calsado['material_id'];?></td>
			<td><?php echo $calsado['country_id'];?></td>
			<td><?php echo $calsado['title'];?></td>
			<td><?php echo $calsado['marca'];?></td>
			<td><?php echo $calsado['activado'];?></td>
			<td><?php echo $calsado['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'calsados', 'action' => 'view', $calsado['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'calsados', 'action' => 'edit', $calsado['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'calsados', 'action' => 'delete', $calsado['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $calsado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Consultas');?></h3>
	<?php if (!empty($usuario['Consulta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Usuario Id'); ?></th>
		<th><?php __('Usuario Prov Id'); ?></th>
		<th><?php __('Consulta'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($usuario['Consulta'] as $consulta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $consulta['id'];?></td>
			<td><?php echo $consulta['usuario_id'];?></td>
			<td><?php echo $consulta['usuario_prov_id'];?></td>
			<td><?php echo $consulta['consulta'];?></td>
			<td><?php echo $consulta['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'consultas', 'action' => 'view', $consulta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'consultas', 'action' => 'edit', $consulta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'consultas', 'action' => 'delete', $consulta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consulta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Consulta', true), array('controller' => 'consultas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Pedidos');?></h3>
	<?php if (!empty($usuario['Pedido'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Usuario Id'); ?></th>
		<th><?php __('Re'); ?></th>
		<th><?php __('Iva'); ?></th>
		<th><?php __('Portes'); ?></th>
		<th><?php __('Total Pedido'); ?></th>
		<th><?php __('Forma Pago'); ?></th>
		<th><?php __('Di Factura'); ?></th>
		<th><?php __('Di Envio'); ?></th>
		<th><?php __('Comentarios'); ?></th>
		<th><?php __('Confirmado'); ?></th>
		<th><?php __('Esperando Mercancia'); ?></th>
		<th><?php __('Enviado'); ?></th>
		<th><?php __('Anulado'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($usuario['Pedido'] as $pedido):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pedido['id'];?></td>
			<td><?php echo $pedido['usuario_id'];?></td>
			<td><?php echo $pedido['re'];?></td>
			<td><?php echo $pedido['iva'];?></td>
			<td><?php echo $pedido['portes'];?></td>
			<td><?php echo $pedido['total_pedido'];?></td>
			<td><?php echo $pedido['forma_pago'];?></td>
			<td><?php echo $pedido['di_factura'];?></td>
			<td><?php echo $pedido['di_envio'];?></td>
			<td><?php echo $pedido['comentarios'];?></td>
			<td><?php echo $pedido['confirmado'];?></td>
			<td><?php echo $pedido['esperando_mercancia'];?></td>
			<td><?php echo $pedido['enviado'];?></td>
			<td><?php echo $pedido['anulado'];?></td>
			<td><?php echo $pedido['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pedidos', 'action' => 'view', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pedidos', 'action' => 'edit', $pedido['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pedidos', 'action' => 'delete', $pedido['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pedido['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
