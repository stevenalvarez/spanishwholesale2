<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>

<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/categorias/add">Editar registro de tipo de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="tipos form">
<h2>Editar registro de tipo de art&iacute;culos</h2>
<?php echo $this->Form->create('Tipo');?>

	<?php
    	echo $this->Form->input('id');
		echo $this->Form->input('title',array('label'=>'Nombre','class'=>'validate[required]'));
       // echo $this->Form->input('categoria_id',array('label'=>'Categor&iacute;a'));
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

</div>