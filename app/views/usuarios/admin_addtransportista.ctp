<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>
	jQuery(document).ready(function(){    
    jQuery("form").validationEngine();});
</script>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/addproveedor">Nuevo Transportista</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">


<div class="usuarios form">
<h2>Nuevo Transportista</h2>
<?php echo $this->Form->create('Usuario');?>

	<?php
    
           	//	echo $this->Form->input('rol');
       // echo $this->Form->input('id',array('type'=>'hidden'));    
            
		echo $this->Form->input('title',array('label'=>'Empresa*','class'=>'validate[required]'));
		echo $this->Form->input('tipo_de_negocio',array('label'=>'Tipo de Negocio*','class'=>'validate[required]'));
		echo $this->Form->input('persona_contacto',array('label'=>'Persona Contacto*','class'=>'validate[required]'));
	
    	
        echo $this->Form->input('cif');
        
        ?>
        <div class="input select"><label for="UsuarioCountryId">Pais</label>
        <? 
        if(isset( $this->data["Regione"]["country_id"]))
        $region=$this->data["Regione"]["country_id"];
        else
        $region=null;
        echo $this->Form->select('country',$regioness,array('empty'=>false,'selected'=>$this->data["Regione"]["country_id"]));?></div>
        <?php
        echo $this->Form->input('regione_id',array('label'=>'Regi&oacute;n'));        
		echo $this->Form->input('direccion');
//		echo $this->Form->input('codigo_postal');
     //   echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>'Impuestos' ,'options'=>array(''=>'Seleccione','1'=>'IVA','2'=>'IVA + RE')));
	//	echo $this->Form->input('re');
		echo $this->Form->input('fax');
		echo $this->Form->input('telefonos');
//		echo $this->Form->input('tim');
//		echo $this->Form->input('fecha_alta');
	//	echo $this->Form->input('estado',array('type'=>'select','options'=>array('0'=>'Pendiente','1'=>'Aprobado')));
	//	echo $this->Form->input('comentarios');


	?>
<h4>email de la empresa</h4>

	
<?php
        echo $this->Form->input('email');

?>
    
               <hr /> 
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
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

</script>
