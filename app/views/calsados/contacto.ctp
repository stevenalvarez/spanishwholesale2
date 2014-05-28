    <?php
    App::import('vendor', 'recaptchalib');
    $publickey = "6LffGcoSAAAAAF4Q2-Y3S2yDPvEeCILOQGXdr2bB";
    $privatekey = "6LffGcoSAAAAAEwyd7RB_O8-N65Vnt6p_odnZF-V";
    # the response from reCAPTCHA
    $resp = null;
    # the error code from reCAPTCHA, if any
    $error = null;
    $mostrarForm = true;
    ?>
    

 <link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>

<div class="container">
        <div class="box1_content">
        <div style="padding: 30px;">
        <h3><span><?php ___("CONTACTO")?></span></h3>
                <p class="rellene"><?php ___("Rellene el siguiente formulario y nos prondremos en contacto con usted")?></p>
        
        <?php if(isset($_SESSION["okk"])){
        unset($_SESSION["okk"]);
        ?>
        <p  style="background-color: #590000; color: white;"><?php ___("Su petici&oacute;n se ha procesado correctamente. Recibir&aacute; una respuesta tan pronto como nos sea posible en el buz&oacute;n de correo electr&oacute;nico especificado en el formulario de contacto.")?></p>
        <?php }else { ?>
        <div>
                
        </div>
        <?php }?>
        
        <form method="post" action="<?php echo $this->webroot?>usuarios/contacto">        
        <table style="margin-right: 100px ;">
        <tr>
            <td height="30" width="60"><label><?php ___("Nombre*")?></label>  </td><td><input type="text" name="nombre"  class="validate[required]" id="nombre" /></td>
            
            <td width="60"><label><?php ___("Apellidos*")?></label> </td><td> <input type="text" name="apellidos"  class="validate[required]" id="app" /></td>
        </tr>
        <tr>
            <td height="30"><label>E-mail*</label> </td><td> <input type="text" name="email"  class="validate[required,custom[email]]"  id="email"/></td>
            
            <td><label><?php ___("Tel&eacute;fono")?></label> </td><td> <input type="text" name="telefono" /></td>
        </tr>
        
        <tr>
        <td>
        <label><?php ___("Comentarios")?></label>
        </td>
            <td colspan="2" height="120">
                <textarea style="width: 90%; height: 120px;" name="comentario"></textarea>
            </td>       
            <td>
            <?php
            if(isset($_SESSION["err_cap"]))
            {
            unset($_SESSION["err_cap"]);
                            ?>
                            <script>
                            alert('<?php ___( utf8_encode("Captcha erróneo"))?> <?php ___(utf8_encode("Vuelva a introducir los datos y asegurese de que introduce correctamente el código de seguridad."))?>');
                            </script>
                    <div class="message_erro_sucess">
                        <p style="color: #CC3333;" class="error_text"><b><?php ___("Captcha err&oacute;neo")?></b></p>
    				    <p style="color: #CC3333;"><?php ___("Vuelva a introducir los datos y asegurese de que introduce correctamente el c&oacute;digo de seguridad.")?></p>
                    </div>
            <?php }
             echo recaptcha_get_html($publickey, $error); ?>
            </td> 
        </tr>
        <tr>
            <td colspan="2">
            <!--
                 <input type="checkbox" class="validate[required]" id="chebox" name="checbok" /> <label class="leido">
                 <?php ___("He le&iacute;do las")?>
                 <a href="<?php echo $this->webroot?>pages/terminos<?php echo  (isset($_SESSION["cake_lang"])&&$_SESSION["cake_lang"]=='eng')?'_eng':'_esp'; ?>"><?php ___("condiciones")?></a>  <?php ___("y acepto el env&iacute;o de mis datos")?> </label>
            -->
            </td>
            
            <td colspan="2">
                <input style="float: right; background-color: #590000;border: 0 none;    color: white;    padding: 8px 15px;" type="submit" value="<?php ___("Enviar consulta")?>"/>
            </td>
        </tr>               
        </table>
        </form>
        <?php // echo ($cont["Galery"]["texto"])?>
        </div>
        </div>
        </div>
        
        </div>
        <style>
        table,tr,td { border: 0; }
        
        </style>