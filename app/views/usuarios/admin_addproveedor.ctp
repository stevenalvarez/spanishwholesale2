<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/addproveedor">Nuevo proveedor</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<div id="right-side">
<div class="usuarios form">
<h2>Alta de proveedor</h2>
<?php echo $this->Form->create('Usuario',array('type'=>'file'));?>
	<?php
    
		echo $this->Form->input('title',array('class'=>'validate[required]','label'=>'Empresa *'));
		echo $this->Form->input('tipo_de_negocio',array('class'=>'validate[required]','label'=>'Tipo de Negocio *'));
		echo $this->Form->input('persona_contacto',array('class'=>'validate[required]','label'=>'Persona Contacto *'));
	
    	
        echo $this->Form->input('cif',array('class'=>'validate[required]','label'=>'Cif *'));
        
        ?>
        <div class="input select"><label for="UsuarioCountryId">Pais</label><?
        echo $this->Form->select('country',$regioness,28);?></div>
        <?php
        
        echo $this->Form->input('regione_id',array('label'=>'Regi&oacute;n','class'=>'validate[required]','empty'=>'Seleccione Pais' ));        
		echo $this->Form->input('direccion');
		echo $this->Form->input('codigo_postal');
        echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>'Impuestos *' ,'options'=>array(''=>___('Seleccione',1),1=>___('IVA Registrado',1),0=>___('IVA No Registrado',1))));
        echo $this->Form->input('comision',array('after'=>'%  ejm 3'));
       // echo $this->Form->input('portes',array('after'=>'&euro;'));
		//echo $this->Form->input('re');
		echo $this->Form->input('fax');
		echo $this->Form->input('telefonos');
//		echo $this->Form->input('tim');
//		echo $this->Form->input('fecha_alta');
		echo $this->Form->input('estado',array('type'=>'select','options'=>array('0'=>'Pendiente','1'=>'Aprobado')));
        ?>
            <div class="input text"><label for="UsuarioTelefonos">N&uacute;mero cuenta</label><input type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][ncuenta]"/></div>
            <div class="input text"><label for="UsuarioTelefonos">C&oacute;digo Swift</label><input type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][cswift]"/></div>
            <div class="input text"><label for="UsuarioTelefonos">Iban</label><input type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][Iban]"/></div>
            <div class="input text"><label for="UsuarioTelefonos">Direcci&oacute;n del banco </label><input type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][banco]"/></div>
        
            
    <?php
    echo $this->Form->input('img',array('label'=>'Imagen','type'=>'file')); ?>
    <?php // portes?>
    <h4>Portes</h4>
    
    <div class="input text" id="portesss">
        <label><input checked="" onclick="$('#porbultos').show(); $('#porprecio').hide();" type="radio" name="data[Usuario][portes]" value="bultos"/> Por Bultos</label>
        <label><input onclick="$('#porbultos').hide(); $('#porprecio').show();" type="radio" name="data[Usuario][portes]" value="precio"/> Por precio</label>        
    </div>
    
    <div id="porbultos" >
    <div class="input text" id="portesss">
        <label>Numero de Bultos</label>
        <label>Precio &euro;</label>        
    </div>
    
        
     <div class="input text porten">
        <label> <input  name="data[Usuario][portes_txt][bultos][]" value="" size="4" style="width: 40px;" type="text" /> </label>
        <label> <input name="data[Usuario][portes_txt][precio][]" value="" size="4" style="width: 40px;" type="text" /> &euro;</label>
        <input type="button" value="Eliminar" onclick="$(this).parent().remove()"/>
    </div>
    
    <div class="input text">
    <label> <input onclick="$(this).parent().parent().before($('#port div').clone());" type="button" value="A&ntilde;adir portes" /> </label>    
    </div>
    </div>
    
    <div id="porprecio" style="display: none;">   
     <div class="input text porten">
        <label> Precio por env&iacute;o</label>
        <label> <input name="data[Usuario][portes_txt][porenvio]" value="" size="4" style="width: 40px;" type="text" /> &euro;</label>
     </div>
     
     <div class="input text porten">
        <label> No pagan gastos de env&iacute;o en montos superiores a</label>
        <label>
            <input name="data[Usuario][portes_txt][mayor]" value="" size="4" style="width: 40px;" type="text" /> &euro;
        </label>
     </div>
    </div>

<?php // portes?>    

    <h4>Datos de acceso</h4>

	
<?php
        echo $this->Form->input('email',array('label'=>'email *','class'=>'validate[required,custom[email]]'));
        echo $this->Form->input('password',array('label'=>'password *','class'=>'validate[required]'));
?>        

<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="submit" name="step" class="btn-admin-orange2" value="SALVAR Y DAR DE ALTA A OTRO PROVEEDOR"/>
<input type="button" value="CANCELAR" onclick="window.location.href=jQuery('#link_cancelar').attr('href');" class="btn-admin-red" />
<a style="display: none;" id="link_cancelar" class="btn-admin-red" href="<?php echo $this->webroot;?>admin/usuarios/proveedores">CANCELAR</a>
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
    
          $.ajax({
   url: "<?php echo $this->webroot?>admin/regiones/ajaxoptions/"+$("#UsuarioCountry").val(),
   success: function(data)
   {
    $("#UsuarioRegioneId").html(data);
   }
          
});
       
});




</script>
<div style="display: none;" id="port">
<div class="input text porten">
        <label> <input name="data[Usuario][portes_txt][bultos][]" value="" size="4" style="width: 40px;" type="text" /> </label>
        <label> <input name="data[Usuario][portes_txt][precio][]" value="" size="4" style="width: 40px;" type="text" /> &euro;</label>
        <input type="button" value="Eliminar" onclick="$(this).parent().remove()"/>
    </div>

</div>
