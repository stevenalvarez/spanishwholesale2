 	<div class="contenido_2 clearfix">
		<?php $session->flash(); ?>
		<?php echo $form->create('Newsletteremail', array('action'=>'addUserNL')); ?>
		<div class="cont">
			<h3>Nombre: </h3>
			<?php echo $form->input('title_spa', array('label'=>'Español: ')); ?><br />
			<h3>Apellido: </h3>
			<?php echo $form->input('link', array('label'=>'')); ?><br />
			<h3>Empresa: </h3>
			<?php echo $form->input('date', array('label'=>'', "class"=>"date")); ?><br />
            <h3>E-mail: </h3>
			<?php echo $form->input('date', array('label'=>'', "class"=>"date")); ?><br />
		</div>
		<div style="float:left; margin-right:50px; margin-top:5px;">
			<?php echo $html->link('Volver','index'); ?>
		</div>
		<?php echo $form->end('Crear'); ?>
	</div>