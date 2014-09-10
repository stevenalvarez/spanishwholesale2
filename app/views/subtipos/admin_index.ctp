<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/subtipos/index">Listado de subtipos de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div style="padding: 0 0 16px 0; overflow: hidden; width: 100%;">
<input type="submit" name="step" class="btn-admin-orange2" value="A&Ntilde;ADIR SUBTIPO" onclick="$(this).parent().slideUp('',function(){$('#mostrate').slideDown()})" id="showbutton">   
</div>


<div class="tipos form" id="mostrate" style="margin-bottom: 20px; display: none;">
<h2>Registro nuevo subtipo de art&iacute;culos</h2>
<form method="post" action="<?php echo $this->webroot?>admin/subtipos/add">
	<?php
	//	echo $this->Form->input('tipo_id');
		echo $this->Form->input('title',array('label'=>'Nombre*','class'=>'validate[required]'));
       // echo $this->Form->input('categoria_id',array('label'=>'Categor&iacute;a'));
	    echo $this->Form->input('orden',array('label'=>'Orden (Opcional)'));
		echo $this->Form->input('activo',array('type'=>'select','options'=>array('1'=>'Si','0'=>'No')));
	?>
<hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="submit" name="step" class="btn-admin-orange2" value="SALVAR Y REGISTRAR OTRO SUBTIPO"/>
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</form>
</div>




<div class="admin-search">
<h2>B&uacute;squeda de subtipos</h2>
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
	<h2>Subtipos</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
					<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('orden');?></th>
			<th><?php echo $this->Paginator->sort('activo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($subtipos as $subtipo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        	$class = ' class="noaltrow"';
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $subtipo['Subtipo']['id']; ?>&nbsp;</td>
	   <td><?php echo $subtipo['Subtipo']['title']; ?>&nbsp;</td>
		<td><?php echo $subtipo['Subtipo']['orden']; ?>&nbsp;</td>
		<td><?php echo $subtipo['Subtipo']['activo']=='1'?'<label class="aprobado">Activo</label>':'<label class="pendiente">Desactivado</label>'; ?>&nbsp;</td>
		<td class="actions">
		<a href="<?php echo $this->webroot?>admin/subtipos/edit/<?php echo $subtipo['Subtipo']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>        
        <a onclick="return confirm('Esta seguro de eliminar el subtipo <?php echo $subtipo['Subtipo']['title']; ?>')" href="<?php echo $this->webroot?>admin/subtipos/delete/<?php echo $subtipo['Subtipo']['id'] ?>"><?php echo $html->image('x.png') ?></a>	
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