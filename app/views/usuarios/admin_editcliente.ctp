<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/addusuario">Editar Cliente</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">


<div class="usuarios form">
<h2>Editar Cliente</h2>
<?php echo $this->Form->create('Usuario');?>

	<?php
    
           	//	echo $this->Form->input('rol');
        echo $this->Form->input('id',array('type'=>'hidden'));    
/** ****************/


        echo $this->Form->input('company',array('class'=>'validate[required]]','size'=>'50','label'=>___(utf8_encode('Nombre de la Compañia*'),1),));        
        echo $this->Form->input('name',array('class'=>'validate[required]','size'=>'50','label'=>___('Nombre*',1),));
        echo $this->Form->input('surname',array('class'=>'validate[required]','size'=>'50','label'=>___('Apellido*',1),));
        
        echo $this->Form->input('email',array('class'=>'validate[required,custom[email]]','size'=>'50','label'=>'Email*',));
       //echo $this->Form->input('title',array('class'=>'validate[required]','size'=>'50','label'=>___("Nombres y Apellidos*",true),'div'=>array('class'=>'contact')));
        

        //echo $this->Form->input('direccion',array('class'=>'validate[required]','size'=>'50','label'=>___("Direcci&oacute;n 1*",true),));
        //echo $this->Form->input('direccion2',array('size'=>'50','label'=>___("Direcci&oacute;n 2",true)));
     
        echo $this->Form->input('country',array('class'=>'validate[required]','size'=>'50','label'=>___("Pais*",true)));
        echo $this->Form->input('city',array('class'=>'validate[required]','size'=>'50','label'=>___("Ciudad*",true),));
        //echo $this->Form->input('countyprovince',array('size'=>'50','label'=>___("Condado/Provincia",true),));
        echo $this->Form->input('codigo_postal',array('class'=>'validate[required]','size'=>'50','label'=>___("C&oacute;digo Postal*",true),));        
        
        echo $this->Form->input('telefonos',array('class'=>'validate[required]','size'=>'50','label'=>___("Tel&eacute;fono*",true),));
        echo $this->Form->input('fax',array('size'=>'50','label'=>___("Fax",true),));
        //echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>'Impuestos*' ,'options'=>array(''=>___('Seleccione',1),1=>'IVA',2=>'IVA + RE'), ));
        echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>___('Impuestos*',1), 'id' =>'impuestos' ,'options'=>array(''=>___('Seleccione',1),1=>___('IVA Registrado',1),0=>___('IVA No Registrado',1) )));
        ?>
        <div class="nit" style="display: none;margin-left: 162px;font-size: 12px;">
        <?php echo $this->Form->input('nit',array('label'=>false,'div'=>array('class'=>'contact mids'),'class' => 'validate[required]','disabled'=>'disabled','size'=>'50'));?>
        <label style="clear: both;margin: 5px 0;display: inline-block;"  ><?php ___("*If you are VAT registered you must provide us with a valid VAT Number otherwise the respective VAT amount will be charged to the total invoice") ?></label>
        </div>
        <?php        
        //echo $this->Form->input('cif',array('label'=>___("Cif",1)));
        
        echo $this->Form->input('denv',array('size'=>'50','label'=>___(utf8_encode("Direcci&oacute;n de entrega"),1)));
        echo $this->Form->input('dfac',array('size'=>'50','label'=>___(utf8_encode("Dirección de Facturación"),1) ));

/** ************/
		echo $this->Form->input('estado',array('type'=>'select','options'=>array('0'=>'Pendiente','1'=>'Aprobado')));
		echo $this->Form->input('comentarios');


	?>
<h4>Datos de acceso</h4>
<?php
        echo $this->Form->input('email');
        echo $this->Form->input('password',array('value'=>$this->data["Usuario"]["contra"],'type'=>'text'));
?>      

<hr /> 
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="submit" name="step" class="btn-admin-orange2" value="SALVAR Y DAR DE ALTA A OTRO PROVEEDOR"/>
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>


        
        
</div>
</div>

<script>
jQuery(function(){
    $("#UsuarioCountry").change(function(){
      $.ajax({
   url: "<?php echo $this->webroot?>admin/regiones/ajaxoptions/"+this.value,
   success: function(data)
   {
    $("#UsuarioRegioneId").html(data);
   }
          
});
    });
    
});

function pass()
{
    jQuery(function(){
        if($("#change_pass").is(":checked"))
        {
            $("#UsuarioPassword").removeAttr("disabled");
            $("#UsuarioPassword").val('').focus();
        }
        else
        {
            $("#UsuarioPassword").attr("disabled",'true');
        }
    });
    
}

    var impuesto = jQuery("#impuestos").find("option:selected").val();
    if(impuesto == 1){
        $(".nit").fadeIn("slow");
        $(".nit").find("input").removeAttr("disabled");        
    }
    
    jQuery("#impuestos").change(function(){
        if($(this).val() == 1){
            $(".nit").fadeIn("slow");
            $(".nit").find("input").removeAttr("disabled");
        }else{
            $(".nit").fadeOut("slow");
            $(".nit").find("input").atrr("disabled","disabled");
        }
    });
</script>
