        <h2><?php echo $language=="spa"?"Desuscribite de nuestro newsletter":"Unsubscribe from our newsletter"; ?></h2>
		<p><?php echo $html->image("elements/bullet_1.gif", array("alt"=>"bullet")); ?> <?php echo $language=="spa"?"Si no desea recibir más noticias nuestras por favor ingresa tu e-mail aquí y te eliminaremos de nuestra lista de newsletters. Muchas gracias.":"If you don't want to recive more newsletters, please insert your e-mail bellow. Thank you."; ?></p>
        <?php $session->flash(); ?>
		<?php echo $form->create('Newsletteremail', array('action'=>'delete')); ?>
          <div class="campo spa">
            <a class="btn_desuscribir <?php echo $language; ?>" href="javascript:$('#NewsletteremailDeleteForm').submit();" onclick="$('#NewsletteremailDeleteForm').submit(); return false;"></a>
			<?php echo $form->input('email', array('label'=>'')); ?>
          </div>
		<?php echo $form->end(); ?>
        <br />