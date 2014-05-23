<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/categorias/index">Gesti&oacute;n de tags de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div style="padding: 0 0 16px 0; overflow: hidden; width: 100%;">
<input id="showbutton" type="submit" onclick="$('.form').slideDown('',function(){$('#showbutton').parent().slideUp()})" value="A&Ntilde;ADIR TAG NUEVO" class="btn-admin-orange2" name="step">   
</div>

<div class="colors form" style="margin-bottom: 20px; display: none;">
<h2>Registro nuevo tag</h2>
<?php echo $this->Form->create('Tag',array('action'=>'add'));?>

	<?php
		echo $this->Form->input('title',array('label'=>'Nombre','class'=>'validate[required]'));
		echo $this->Form->input('orden',array('label'=>'Orden (Opcional)'));
		echo $this->Form->input('activo',array('type'=>'select','options'=>array('1'=>'Si','0'=>'No')));
	?>
    <hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</form>
</div>

<div id="admin-table">
	<h2>Tags</h2>
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
	foreach ($tags as $tag):
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
		<td><?php echo $tag['Tag']['id']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['title']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['orden']; ?>&nbsp;</td>
		<td><?php echo $tag['Tag']['activo']=='1'?'<label class="aprobado">Activo</label>':'<label class="pendiente">Desactivado</label>'; ?>&nbsp;</td>
        
        <td class="actions">
		<a href="<?php echo $this->webroot?>admin/tags/edit/<?php  echo $tag['Tag']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>        
        <a onclick="return confirm('Esta seguro de eliminar el tag <?php echo $tag['Tag']['title']; ?>')" href="<?php echo $this->webroot?>admin/tags/delete/<?php echo  $tag['Tag']['id'] ?>"><?php echo $html->image('x.png') ?></a>	
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
    
 
	




