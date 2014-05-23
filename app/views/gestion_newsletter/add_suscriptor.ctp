   <div class="contenido_2 clearfix">
        <h3><?php echo $language=="spa"?"Nuevo registro de suscripci&oacute;n newsletter":"";?></h3>
        <?php echo $form->create('', array('action'=>'addSuscriptor')); ?>
          <div class="cont">
          <?php //echo $language=="spa"?"Nombre:":"Name:"; ?>
          <div class="campo spa">
            <?php echo $form->input('nombre', array('type'=>'text' ,'label'=>'Nombres y Apellidos')); ?>
          </div>
          <div class="campo spa">
            <?php echo $form->input('email', array('type'=>'text' ,'label'=>'Email'));?>
          </div>
          
          <div class="input select">
          <label for="MemberGroupIdGroup">Agregar a grupo</label>
          <select id="MemberGroupIdGroup" name="grupo">
          <?php
          foreach($grupos as $g)
          $selected="";
          if ($grupo==$g["GroupContacts"]["name_group"])
          $selected=="selected='true'";
          {?>
          
          <option <?php echo $selected?> value="<?php echo $g["GroupContacts"]["id"]?>"><?php echo $g["GroupContacts"]["name_group"]?></option>
          
            <?php
          }      
          
          
          ?>
          
          </select> Solo se puede añadir a suscriptores a grupos creados por el sistema mailing </div>
          
          
          </div>
        <div style="float:left; margin-right:50px; margin-top:5px;">
			<?php echo $html->link('Atras','listSuscriptores'); ?>
		</div>
		<?php echo $form->end('Añadir Suscriptor'); ?>
     </div>