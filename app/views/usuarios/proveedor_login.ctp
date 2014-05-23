<div id="main">

<h1>Administraci&oacute;n</h1>
<p>Bienvenido al panel de administraci&oacute;n de spanishwholesale
por favor introduzca sus datos de acceso
</p>

<div style="margin-top: 45px;">
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('Usuario');
echo $this->Form->input('email',array('label'=>'Usuario'));
echo $this->Form->input('password',array('label'=>'Contrase&ntilde;a'));
?>
<div class="olvidado">
<label style="width: 110px;"> <input type="checkbox" value="rec" name="rec" /> Recuerdame</label>
<a href="<?php echo $this->webroot?>cliente/usuarios/recuperar"> He olvidado mi contrase&ntilde;a </a> 
</div>

<?php

echo $this->Form->end(array('label'=>'Entrar','class'=>'btn'));
?>
</div>
</div>