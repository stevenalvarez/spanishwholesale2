        <h2><?php echo $language=="spa"?"suscr&iacute;bete a nuestro newsletter":"Subscribe to our newsletter"; ?></h2>
         <?php $session->flash(); ?>
        <?php echo $form->create('Newsletteremail', array('action'=>'add')); ?>
          <?php echo $language=="spa"?"Nombre:":"Name:"; ?>
          <div class="campo spa">
            <?php echo $form->input('nombre', array('label'=>'')); ?>
          </div>
          <?php echo $language=="spa"?"Apellido:":"Last name:"; ?>
          <div class="campo spa">
            <?php echo $form->input('apellido', array('label'=>'')); ?>
          </div>
          <?php echo $language=="spa"?"Empresa:":"Company:"; ?>
          <div class="campo spa">
            <?php echo $form->input('empresa', array('label'=>'')); ?>
          </div>
          E-Mail:
          <div class="campo spa">
            <a class="btn_suscribir <?php echo $language; ?>" href="javascript: $('#NewsletteremailAddForm').submit();" onclick="$('#NewsletteremailAddForm').submit(); return false;"></a>
        	<?php echo $form->input('email', array('label'=>'')); ?>
          </div>
        <?php echo $form->end(); ?>
        <?php echo $language=="spa"?"<a href='/desuscribir'>Cancelar subscripci&oacute;n</a>":"<a href='/desuscribir'>Unsubscribe</a>" ?>