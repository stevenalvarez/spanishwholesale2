<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
	<fieldset>
		<legend><?php __('Admin Add Usuario'); ?></legend>
	<?php
	//	echo $this->Form->input('regione_id',array("label"=>utf8_encode("Región")));
		//echo $this->Form->input('rol');
		echo $this->Form->input('title');
	//	echo $this->Form->input('tipo_de_negocio');
//		echo $this->Form->input('persona_contacto');
	
    	echo $this->Form->input('email');
        echo $this->Form->input('password');
	//	echo $this->Form->input('cif');
//		echo $this->Form->input('direccion');
//		echo $this->Form->input('codigo_postal');
//		echo $this->Form->input('iva');
//		echo $this->Form->input('re');
//		echo $this->Form->input('fax');
//		echo $this->Form->input('telefonos');
//		echo $this->Form->input('tim');
//		echo $this->Form->input('fecha_alta');
//		echo $this->Form->input('estado');
//		echo $this->Form->input('ip');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
