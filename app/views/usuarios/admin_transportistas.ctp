<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/transportistas">Listado de Transportistas</a></li>

</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div class="admin-search">
<h2>B&uacute;squeda de Transportistas</h2>
<form method="post" action="?search=true">
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" name="like" value="<?php echo isset($_POST["like"])?$_POST["like"]:''?>" /></td>
<td>
<select name="criterio">
    <option value="title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='title'?'selected="selected"':''  ?>>Nombre</option>
    <option value="email" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='email'?'selected="selected"':''  ?>>Email</option>
    <option value="persona_contacto" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='persona_contacto'?'selected="selected"':''  ?>>Persona Contacto</option>
</select>
</td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" />
<a style="display: inline-block; font-size: 11px; text-decoration: none; text-align: center; width: 64px;" href="<?php echo $this->webroot;?>admin/usuarios/transportistas" class="btn-admin-orange">LIMPIAR</a>
</td></tr>
</table>
</form>
</div>
<form method="post" action="?aprove=true">
<div id="admin-table">
	<h2>Transportistas</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
<!--
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('regione_id');?></th>
			<th><?php echo $this->Paginator->sort('rol');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('tipo_de_negocio');?></th>
-->
			<th><?php echo $this->Paginator->sort('Nombre','title');?></th>
            <th><?php echo $this->Paginator->sort('Contacto','persona_contacto');?></th>
            <th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('telefonos');?></th>
            
			<th><?php echo $this->Paginator->sort('email');?></th>
			<!--
<th><?php echo $this->Paginator->sort('cif');?></th>
			<th><?php echo $this->Paginator->sort('direccion');?></th>
			<th><?php echo $this->Paginator->sort('codigo_postal');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('re');?></th>
		

			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th><?php echo $this->Paginator->sort('fecha_alta');?></th>-->
			<th><?php echo $this->Paginator->sort('estado');?></th>
		<!--
	<th><?php echo $this->Paginator->sort('ip');?></th>
-->
			<th class="actions" width="65"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
        
	?>
	<tr<?php echo $class;?>>
	<!--	<td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuario['Regione']['title'], array('controller' => 'regiones', 'action' => 'view', $usuario['Regione']['id'])); ?>
		</td>
	
	<td><?php echo $usuario['Usuario']['rol']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['title']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['tipo_de_negocio']; ?>&nbsp;</td>
-->
		<td><?php echo $usuario['Usuario']['title']; ?>&nbsp;</td>
        <td><?php echo $usuario['Usuario']['persona_contacto']; ?>&nbsp;</td>
        <td><?php echo $usuario['Usuario']['fax']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['telefonos']; ?>&nbsp;</td>        
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
        
		<!--
<td><?php echo $usuario['Usuario']['cif']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['direccion']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['codigo_postal']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['iva']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['re']; ?>&nbsp;</td>
	
		<td><?php echo $usuario['Usuario']['tim']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['fecha_alta']; ?>&nbsp;</td>
		
-->     <td><?php echo $usuario['Usuario']['estado']=='1'?'<label class="aprobado">Aprobado</label>':'<label class="pendiente">Pendiente</label>';?>&nbsp;</td>

<!--
		<td><?php echo $usuario['Usuario']['ip']; ?>&nbsp;</td>
-->
		<td class="actions">
        <a href="<?php echo $this->webroot?>admin/usuarios/editTrans/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>
        <a href="<?php echo $this->webroot?>admin/usuarios/smail/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('letter.png') ?></a>
        <a onclick="return confirm('Esta seguro de eliminar al tranportista <?php echo $usuario['Usuario']['title']; ?>')" href="<?php echo $this->webroot?>admin/usuarios/deleteProv/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('x.png') ?></a>
        <input type="checkbox" class="check_aprove" name="aprove[]" value="<?php echo $usuario['Usuario']['id'] ?>"  />
        </td>
        <td class="fix" >
        
        
        
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?><?php echo $this->Paginator->numbers();?><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</td></tr>


<tr class="clear">
    <td colspan="7">
    <input type="button" class="btn-admin-green" value="Nuevo" onclick="window.location.href='<?php echo $this->webroot?>admin/usuarios/addtransportista'" />
    
    <div class="admin-buttons">
   
    <input type="button" id="call" class="btn-admin-lblue" value="SELECCIONAR" />
    <input type="button" id="uall" class="btn-admin-lblue" value="DESSELECCIONAR" />
    <input type="submit" class="btn-admin-blue" value="APROBAR" />
    
    </div>
    
    </td>
</tr>


	</table>

</div>
</form>
</div>

<script>

jQuery(function(){
    $("#call").click(function(){
        $(".check_aprove").attr('checked','cheked');
    });
        $("#uall").click(function(){
        $(".check_aprove").removeAttr("checked");
    });
    
});


</script>

