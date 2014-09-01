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
<li> <a href="<?php echo $this->webroot?>admin/usuarios/addproveedor">Nuevo proveedor</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">


<div class="usuarios form">
<h2>Alta de proveedor</h2>
<?php echo $this->Form->create('Usuario',array('type'=>'file'));?>

	<?php
    
           	//	echo $this->Form->input('rol');
        echo $this->Form->input('id',array('type'=>'hidden'));    
            
		echo $this->Form->input('title',array('label'=>'Empresa*','class'=>'validate[required]'));
		echo $this->Form->input('tipo_de_negocio',array('label'=>'Tipo de Negocio*','class'=>'validate[required]'));
		echo $this->Form->input('persona_contacto',array('label'=>'Persona Contacto*','class'=>'validate[required]'));
        
        echo $this->Form->input('cif');
        
        ?>
        <div class="input select"><label for="UsuarioCountryId">Pais</label><? 
        if(isset( $this->data["Regione"]["country_id"]))
        $region=$this->data["Regione"]["country_id"];
        else
        $region=null;
        echo $this->Form->select('country',$paises,array('empty'=>false,'selected'=>$this->data["Regione"]["country_id"]));?></div>
        <?php
        echo $this->Form->input('regione_id',array('label'=>'Regi&oacute;n'));        
		echo $this->Form->input('direccion');
		echo $this->Form->input('codigo_postal');
        echo $this->Form->input('impuestos',array('type'=>'select','class'=>'validate[required]','label'=>'Impuestos' ,'options'=>array(''=>___('Seleccione',1),1=>___('IVA Registrado',1),0=>___('IVA No Registrado',1))));
        echo $this->Form->input('comision',array('after'=>'%  ejm 3'));
      //  echo $this->Form->input('portes',array('after'=>'&euro;'));
	//	echo $this->Form->input('re');
		echo $this->Form->input('fax');
		echo $this->Form->input('telefonos');
//		echo $this->Form->input('tim');
//		echo $this->Form->input('fecha_alta');
		echo $this->Form->input('estado',array('type'=>'select','options'=>array('0'=>'Pendiente','1'=>'Aprobado')));
        
        $serializado=unserialize(base64_decode($this->data["Usuario"]["serializado"]));
        
        ?>
        <div class="input text"><label for="UsuarioTelefonos">N&uacute;mero cuenta</label><input value="<?php echo $serializado["ncuenta"]?>" type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][ncuenta]"/></div>
        <div class="input text"><label for="UsuarioTelefonos">C&oacute;digo Swift</label><input value="<?php echo $serializado["cswift"]?>" type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][cswift]"/></div>
        <div class="input text"><label for="UsuarioTelefonos">Iban</label><input value="<?php echo $serializado["Iban"]?>" type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][Iban]"/></div>
        <div class="input text"><label for="UsuarioTelefonos">Direcci&oacute;n del banco </label><input value="<?php echo $serializado["banco"]?>" type="text" id="UsuarioTelefonos" maxlength="50" name="data[Usuario][serializado][banco]"/></div>
        
        <?php        
    //    echo $this->Form->input('portes_txt',array('label'=>'Portes'));        
        ?>
        
        <?php 
        if($this->data["Usuario"]['img'])
        {?>
        
        <div class="input textarea">
        <label for="UsuarioPortesTxt"></label>
                <img src="<?php echo $this->webroot?>img/prov/<?php echo $this->data["Usuario"]['img'] ?>" height="130"/>
                <input type="hidden" value="<?php echo $this->data["Usuario"]['img'] ?>" name="data[Usuario][img_old]" />
        </div>
            
    
         <?php }?>
        
        <?php
        echo $this->Form->input('img',array('label'=>'Imagen','type'=>'file'));
		echo $this->Form->input('comentarios',array('label' => 'notas'));


	?>
    <?php // portes
  //  print_r($this->data);
    ?>
    <h4>Portes</h4>
    
    <div class="input text" id="portesss">
        <label><input <?php echo $this->data["Usuario"]["portes"]=='bultos'?'checked="checked"':''?> onclick="$('#porbultos').show(); $('#porprecio').hide();" type="radio" name="data[Usuario][portes]" value="bultos"/> Por Bultos</label>
        <label><input <?php echo $this->data["Usuario"]["portes"]=='precio'?'checked="checked"':''?> onclick="$('#porbultos').hide(); $('#porprecio').show();" type="radio" name="data[Usuario][portes]" value="precio"/> Por precio</label>        
    </div>
    <?php
    
    ?>
    <div id="porbultos" <?php echo $this->data["Usuario"]["portes"]=='precio'?'style="display: none;"':''?> >
    <div class="input text" id="portesss">
        <label>Numero de Bultos</label>
        <label>Precio &euro;</label>        
    </div>
    <?php
    if($this->data["Usuario"]["portes"]=='bultos')
    {
     $precios =unserialize($this->data["Usuario"]["portes_txt"]);
     foreach($precios as $k=>$v)
     {?>        
    <div class="input text porten">
        <label> <input name="data[Usuario][portes_txt][bultos][]" value="<?php echo $k?>" size="4" style="width: 40px;" type="text" /> </label>
        <label> <input name="data[Usuario][portes_txt][precio][]" value="<?php echo $v?>" size="4" style="width: 40px;" type="text" /> &euro;</label>
        <input type="button" value="Eliminar" onclick="$(this).parent().remove()"/>
    </div>
        
    <?php } }?>        
     <div class="input text porten">
        <label> <input name="data[Usuario][portes_txt][bultos][]" value="" size="4" style="width: 40px;" type="text" /> </label>
        <label> <input name="data[Usuario][portes_txt][precio][]" value="" size="4" style="width: 40px;" type="text" /> &euro;</label>
        <input type="button" value="Eliminar" onclick="$(this).parent().remove()"/>
    </div>    
    <div class="input text">
        <label> <input onclick="$(this).parent().parent().before($('#port div').clone());" type="button" value="A&ntilde;adir portes" /> </label>    
    </div>
    </div>
    
    <div id="porprecio" <?php echo $this->data["Usuario"]["portes"]=='bultos'?'style="display: none;"':''?> >
    <?php
    if($this->data["Usuario"]["portes"]=='precio')
    {
         $precios =unserialize($this->data["Usuario"]["portes_txt"]);                     
    }
  ?>
     <div class="input text porten">
        <label> Precio por env&iacute;o</label>
        <label><input value="<?php echo isset($precios["porenvio"]) ? $precios["porenvio"] : ""; ?>" name="data[Usuario][portes_txt][porenvio]" size="4" style="width: 40px;" type="text" /> &euro;</label>
     </div>
     
     <div class="input text porten">
        <label> No pagan gastos de env&iacute;o en montos superiores a</label>
        <label>
            <input value="<?php echo isset($precios["mayor"]) ? $precios["mayor"] : ""; ?>" name="data[Usuario][portes_txt][mayor]"  size="4" style="width: 40px;" type="text" /> &euro;
        </label>
     </div>
    </div>

<?php // portes?>       
    
    
    
<h4>Datos de acceso</h4>

	
<?php
        echo $this->Form->input('email');
        echo $this->Form->input('password',array('value'=>$this->data["Usuario"]["contra"],'type'=>'text'));
        
        
?>
        
               <hr /> 
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
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
<div style="display: none;" id="port">
<div class="input text porten">
        <label> <input name="data[Usuario][portes_txt][bultos][]" value="" size="4" style="width: 40px;" type="text" /> </label>
        <label> <input name="data[Usuario][portes_txt][precio][]" value="" size="4" style="width: 40px;" type="text" /> &euro;</label>
        <input type="button" value="Eliminar" onclick="$(this).parent().remove()"/>
    </div>

</div>