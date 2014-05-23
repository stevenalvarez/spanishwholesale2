
<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="#">Editar Rango de Precios</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="materials form">
<h2>Editar Tag</h2>
<?php echo $this->Form->create('Precio');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('de',array('label'=>'precio inferior &euro;*','class'=>'validate[required,custom[integer]]'));
		echo $this->Form->input('a',array('label'=>'precio superior &euro;*','class'=>'validate[required,custom[integer]]'));
	?>
	</fieldset>
    <hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</form>
</div>

</div>
