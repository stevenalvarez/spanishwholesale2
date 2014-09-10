<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/pedidos/incomplete/direction:desc/sort:id">Listado de Pedidos eliminados</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<!--
<div class="admin-search">
<h2>B&uacute;squeda de Materiales</h2>
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" /></td><td><select><option>Nombre</option></select></td><td><input type="submit" /></td></tr>
</table>

</div>
-->
<div id="admin-table">
	<h2>Listado de Pedidos eliminados</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort( utf8_encode('Número'),'id');?></th>
            <th><?php echo $this->Paginator->sort('fecha pedido','tim');?></th>
			<th><?php echo $this->Paginator->sort('Cliente','usuario_id');?></th>
		<!--
	<th><?php echo $this->Paginator->sort('re');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('portes');?></th>
-->
			<th>importe</th>
		    <th>Recibo</th>
			
			<th class="actions"><?php __('Actions');?></th>
            <td char="fix"></td>
	</tr>
	<?php
	$i = 0;
    
     App::import('Model', 'Pedido');
    $PedidoModel = new Pedido();   
    
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        {
            	$class = ' class="noaltrow"';
        }
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
        <td><?php echo $pedido['Pedido']['tim'] ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pedido['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'editcliente', $pedido['Usuario']['id'])); ?>
		</td>
        
	<!--
	<td><?php echo $pedido['Pedido']['re']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['iva']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['portes']; ?>&nbsp;</td>
-->
		<td><?php
        echo $PedidoModel->calcularTotalneto($pedido['Pedido']['id']);
        ?> &euro;</td>
    <td>
    <?php
    $prov=$PedidoModel->query("Select title from usuarios where id={$pedido['Pedido']['proveedor']}");
    echo   $prov[0]['usuarios']['title'];
    ?>
    </td>
        <td class="actions">
            <a onclick="return confirm('Esta seguro de restaurar el pedido <?php echo $pedido['Pedido']['id']; ?>')" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/pedidos/undelete/<?php echo $pedido['Pedido']['id'] ?>">Recuperar</a>
		</td>
        
        <td char="fix"></td>
	</tr>
<?php endforeach; ?>

<tr class="clear">
<td colspan="7">
<?php
	echo $this->Paginator->counter(array(
	'format' => __('P&aacute;gina %page% de %pages%', true)
	));
	?>
	<div class="paging">
		<?php echo $this->Paginator->prev("<img src='".$this->webroot."img/admin-previus.png'/>", array('escape'=>false,'class'=>'nav_btn'), null, array('class'=>'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator'=>'&nbsp;&nbsp;'));?>
        <?php echo $this->Paginator->next("<img src='".$this->webroot."img/admin-next.png'/>" , array('escape'=>false,'class'=>'nav_btn'), null, array('class' => 'disabled'));?>
	</div>

</td></tr>

	</table>
</div>
</div>

