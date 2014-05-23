<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>

<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/materials/add">Registro nuevo material</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="materials form">
<h2>Registro nuevo material</h2>
<?php echo $this->Form->create('Material');?>

	<?php
		echo $this->Form->input('title',array('label'=>'Nombre*','class'=>'validate[required]'));
		echo $this->Form->input('orden',array('label'=>'Orden (Opcional)'));
		echo $this->Form->input('activo',array('type'=>'select','options'=>array('1'=>'Si','0'=>'No')));
	?>
    <hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="submit" name="step" class="btn-admin-orange2" value="SALVAR Y REGISTRAR OTRO MATERIAL"/>
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</form>
</div>

</div>