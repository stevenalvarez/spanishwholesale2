<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/proveedores">Listado de proveedores</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/transportistas">Listado de transportistas</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="admin-search">
<h2>B&uacute;squeda de logs</h2>
<form method="post" action="?search=true">
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" name="like" value="<?php echo isset($_POST["like"])?$_POST["like"]:''?>" /></td>
<td>
<select name="criterio">
    <option value="title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='title'?'selected="selected"':''  ?>>Nombre</option>
    <option value="email" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='email'?'selected="selected"':''  ?>>Email</option>
    <option value="telefonos" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='telefonos'?'selected="selected"':''  ?>>Telefonos</option>
    
</select>
</td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" /></td></tr>
</table>
</form>

</div>
<div class="userlogs index" id="admin-table">
	<h2><?php
     __(utf8_encode('Clientes logueados en este momento'));
     ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<!--
	<th><?php echo $this->Paginator->sort('id');?></th>
-->
			<th><?php echo $this->Paginator->sort('usuario_id');?></th>
			<th><?php echo $this->Paginator->sort('operacion');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
		    <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($userlogs as $userlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
	?>
	<tr<?php echo $class;?>>
		<!--
<td><?php echo $userlog['Userlog']['id']; ?>&nbsp;</td>
-->
		<td>
			<?php echo $this->Html->link($userlog['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $userlog['Usuario']['id'])); ?>
		</td>
		<td><?php echo $userlog['Userlog']['operacion']; ?>&nbsp;</td>
		<td><?php echo $userlog['Userlog']['tim']; ?>&nbsp;</td>
		
        <td class="fix"></td>
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?><?php echo $this->Paginator->numbers();?><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</td></tr>





	</table>
	
</div>

</div>