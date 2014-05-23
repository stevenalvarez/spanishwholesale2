<div class="groupContacts form cont">
<?php echo $form->create('GroupContact');?>
	<fieldset>
 		<legend><?php __('Edit GroupContact');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name_group');
		echo $form->input('sql');
		echo $form->input('table');
		echo $form->input('descripcion');
		echo $form->input('replaces');
	?>
	</fieldset>
    <br />
<?php echo $form->end('Guardar');?>
</div>
