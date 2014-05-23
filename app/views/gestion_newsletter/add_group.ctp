<div class="contenido_2 clearfix">
		<?php $session->flash(); ?>
        <?php echo $form->create('', array('action'=>'addGroup')); ?>
		<div class="cont">
      		<h3>Nombre de Grupo : </h3>
			<?php echo $form->input('GroupContacts.name_group',array('label'=>'','id'=>'name_group')); ?><br />
            <h3>Descripcion : </h3>
			<?php echo $form->input('GroupContacts.descripcion',array('label'=>'','id'=>'descripcion_group')); ?><br />
		</div>
     	<div style="float:left; margin-right:50px; margin-top:5px;">
			<?php echo $html->link('Volver','listSuscriptores'); ?>
		</div>
		<?php echo $form->end('Crear Grupo'); ?>
</div>