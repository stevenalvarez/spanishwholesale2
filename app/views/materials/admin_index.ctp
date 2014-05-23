<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/categorias/index">Listado de materiales de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div class="admin-search">
<h2>B&uacute;squeda de Materiales</h2>
<form method="post" action="?search=true">
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" name="like" value="<?php echo isset($_POST["like"])?$_POST["like"]:''?>" /></td>
<td>
<select name="criterio">
    <option value="title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='title'?'selected="selected"':''  ?>>Nombre</option>
</select>
</td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" /></td></tr>
</table>
</form>

</div>
<div id="admin-table">
	<h2>Listado de materiales de art&iacute;culos</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('orden');?></th>
			<th><?php echo $this->Paginator->sort('activo');?></th>
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($materials as $material):
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
		<td><?php echo $material['Material']['id']; ?>&nbsp;</td>
		<td><?php echo $material['Material']['title']; ?>&nbsp;</td>
		<td><?php echo $material['Material']['orden']; ?>&nbsp;</td>
		<td><?php echo $material['Material']['activo']=='1'?'<label class="aprobado">Activo</label>':'<label class="pendiente">Desactivado</label>'; ?>&nbsp;</td>
        
        <td class="actions">
		<a href="<?php echo $this->webroot?>admin/materials/edit/<?php echo $material['Material']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>        
        <a onclick="return confirm('Esta seguro de eliminar la categoria <?php echo  $material['Material']['title']; ?>')" href="<?php echo $this->webroot?>admin/materials/delete/<?php echo $material['Material']['id'] ?>"><?php echo $html->image('x.png') ?></a>	
		</td>
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
		<?php echo $this->Paginator->prev("<img src='".$this->webroot."img/admin-previus.png'/>", array('escape'=>false,'class'=>'nav_btn'), null, array('class'=>'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator'=>'&nbsp;&nbsp;'));?>
        <?php echo $this->Paginator->next("<img src='".$this->webroot."img/admin-next.png'/>" , array('escape'=>false,'class'=>'nav_btn'), null, array('class' => 'disabled'));?>
	</div>

</td></tr>

	</table>
</div>
</div>