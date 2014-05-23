<div class="groupContacts form cont">
<?php echo $form->create('GroupContact');?>
	<fieldset>
 		<legend><?php __('Crear nuevo Grupo');?></legend>
	<?php
		echo $form->input('name_group',array("label"=>"Nombre del Grupo"));
		echo $form->input('descripcion',array("label"=>"Descrpción del grupo (opcional)"));
	?>
	</fieldset>
    
    <br />
    <br /><br />
<?php echo $form->end('Crear');?>
</div>
