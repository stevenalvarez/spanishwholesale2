<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/consultas/index">Nuevas Consultas</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side" style="padding: 0;">

<div id="admin-table" style="clear: both;">

	<h2>Listado de Consultas</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort( utf8_encode('Numero'),'id');?></th>
			<th><?php echo $this->Paginator->sort('Cliente','usuario_id');?></th>
            <th><?php echo $this->Paginator->sort('Calsado','calsado_id');?></th>
			<th>Consulta</th>
            <th><?php echo $this->Paginator->sort('fecha consulta','tim');?></th>
			<th class="actions">Acciones</th>
	</tr>
	<?php
	$i = 0;
    
	foreach ($consultas as $consulta):
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
		<td><?php echo $consulta['Consulta']['id']; ?>&nbsp;</td>        
		<td><?php echo $consulta['Usuario']['title']; ?></td>
        <td><?php echo $consulta['Calsado']['code']; ?></td>
        <td style="width: 350px;overflow: hidden;display: block;height: auto;"><?php echo trim($consulta['Consulta']['consulta']); ?></td>
        <td><?php echo $consulta['Consulta']['tim'] ?>&nbsp;</td>
        <td class="actions">
            <a href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/respuestas/view/<?php echo $consulta['Consulta']['id'] ?>"><?php echo $html->image('ul-zoomin.png') ?></a>
            <a title="mail al cliente" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/usuarios/smailrespuesta/<?php echo $consulta['Usuario']['id'] ?>/<?php echo $consulta['Consulta']['id'] ?>"><?php echo $html->image('letter.png') ?></a>
            <a onclick="return confirm('Esta seguro de eliminar la consulta <?php echo $consulta['Consulta']['id']; ?>')" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/consultas/delete/<?php echo $consulta['Consulta']['id'] ?>"><?php echo $html->image('x.png') ?></a>            
		</td>
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