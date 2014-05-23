
<link href="<?php echo $this->webroot?>css/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

<script>

jQuery(function(){
    $(".fancybox").fancybox();
    $("#cambiarpassword").validationEngine();
    
    });
</script>

<div class="container" style="margin: auto;  margin: auto;    padding-left: 10px;    width: 960px;">

<?php
echo $this->Session->flash();

?>
<div class="span-24">
<div class="span-12">
    <h2><?php  ___('Olvidaste tu password?');?></h2>    
</div>


<div style="width: 100%; clear: both;">
<?php ___("Escribe tu correo y te enviaremos tu recordaremos tu password")?>
</div>

<br style="width: 100%; clear: both;" />

        <form id="cambiarpassword" method="post">
        <table>
            <tr><td>Email</td>  <td> <input value="" class="validate[required,custom[email]]" id="asdfas" name="old_p" type="text"/></td></tr>

        </table>
        <a class="button" title="comprar" onclick="$(this).parent('form').submit();"><?php echo ___("Enviar")?></a>
        </form>


</div>
</div>