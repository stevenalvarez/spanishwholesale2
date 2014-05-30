
<?php
//esto se añade solo para esta vista---- al header y no por ahi
echo $this->Html->css('fileuploader',null,array('inline'=>false));
$this->Html->script(array("fileuploader"),array('inline'=>false));

//pr();

?>
<script>

                function createUploader(){            
                var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader1'),
                action: '<?php echo $this->webroot?>proveedor/fotos/add',
                allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                params: {
                    calsado: '<?php echo $this->data["Calsado"]["id"]?>',
                },
                onComplete: function(id,filename,response)
                {
                   jQuery(function(){
                                    
                   $(".field.btn-admin-green").after('<div id="'+response["id"]+'" class="foto" style="display: block; overflow: hidden; margin: 10px;"><div style="height: 22px; padding: 18px; width: 355px;" class="foto">Color: <input type="text" onfocus="edit_foto(this)" class="foto_name" value="" name="color"/></div><div style="width: 200px;" class="foto"><img alt="" src="<?php echo $this->webroot?>img/Foto/mid/'+response["filename"]+'"><input type="button" style="vertical-align: top; margin: 17px 0 17px 10px;" value="ELIMINAR" class="btn-admin-red " onclick="delete_foto(this)"/><input type="button" style="vertical-align: top; margin: 17px 0 17px 10px;" value="GUARDAR" class="btn-admin-green " onclick="save_foto(this)"/></div></div>');
//                   $("#add_table").show();
                   $("#file-uploaderh1").val(response["filename"]);
                   });
                },
                debug: true
                });           
                }
                window.onload = createUploader;

//ajax upload script
</script>
<!--  -->
<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>
jQuery(function(){
        $("#CalsadoAdminEditForm").validationEngine();
        $("#SurtidoAddForm").validationEngine();
        $("#SurtidoAddForm2").validationEngine();
        
        });
</script>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/calsados/add">Registro de un nuevo art&iacute;culo</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<div id="right-side">
<div class="calsados form">
<h2>Registro nuevo art&iacute;culo</h2>
<?php echo $this->Form->create('Calsado');?>
<?php echo $this->Form->input('id');?>

<div class="first-part">
	<?php
        //echo $this->Form->input('title',array('label'=>'Nombre','class'=>'validate[required]'));
       
        echo $this->Form->input('code',array('label'=>'Referencia:','class'=>'validate[required]'));
        echo $this->Form->input('country_id',array('label'=>'Fabricado en:'));
     //   echo $this->Form->input('venta',array('label'=>'Venta:','type'=>'select','options'=>array('Todos','Mas opciones')));
        echo $this->Form->input('categoria_id',array('label'=>'Categoria*','class'=>'validate[required]','empty'=>'Seleccione'));
        echo $this->Form->input('tipo_id',array('class'=>'validate[required]','label'=>'Tipo*','type'=>'select','empty'=>'Seleccione'));
        echo $this->Form->input('subtipo_id',array('type'=>'select','empty'=>'Seleccione'));
	//	echo $this->Form->input('usuario_id',array('type'=>'hidden'));
		echo $this->Form->input('material_id');
        echo $this->Form->input('forro');
        echo $this->Form->input('suela');
        
      //  echo $this->Form->input('title');		
    //    echo $this->Form->input('Color',array('div'=>array('class'=>'multiple input'),'label'=>'Colores'));
		echo $this->Form->input('Tag',array('div'=>array('class'=>'multiple input'),'label'=>'Tags'));
        
         
         echo $this->Form->input('texto',array('rows'=>'5','style'=>'width: 200px;','label'=>'Descripci&oacute;n del producto<br><br><br><br>'));
         echo $this->Form->input('marca');
         echo $this->Form->input('activado',array('type'=>'radio','options'=>array('1'=>'Si','0'=>'No'),'default'=>'0'));
       // echo $this->Form->input('precio',array('after'=>'&euro;','class'=>'validate[required]'));
//         echo $this->Form->input('poferta',array('after'=>'&euro;','label'=>'Precio de Oferta'));
//         echo $this->Form->input('en_oferta',array('type'=>'radio','options'=>array('0'=>'No','1'=>'Si'),'class'=>'validate[required]'));
         echo $this->Form->input('servicio',array('type'=>'select','options'=>array('0'=>'Inmediato',
         '15'=>'15 dias','30'=>'30 dias','60'=>'60 dias','120'=>'120 dias')));
	?>
    <style>
    #CalsadoPrecio { width: 100px !important; }
    #CalsadoPoferta { width: 100px !important; }
    #CalsadoPrecio { width: 100px !important; }
            
    #tablilla { overflow: hidden; padding:0 0 9px 9px; width: 100%;     }
    .celda { width: 65px; float: left; }
    .celda.clon { width: 45px; }
    .celda label{ padding: 5px !important; width: 65px !important; }
    
    </style>	

<div style="display: none;">
<input id="submit1" name="step" class="btn-admin-orange" value="SALVAR" type="submit">
<input id="submit2" name="data[Calsado][step_new]" class="btn-admin-orange2" value="SALVAR Y DAR DE ALTA A OTRO ARTICULO" type="submit">
<input value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" type="button">
</div>
</div>
</form>
<hr style="margin-bottom: 5px;"/>
<a id="nuevo"> </a>
<div style="display: block; overflow: hidden;">
<h2 style="font-weight: bold; float: none;">Colores y Fotos de un Art&iacute;culo</h2>

<p style="padding-left: 15px;font-size: 11px;font-weight: bold;">La(s) imagen(es) deben tener como m&iacute;nimo la(s) dimension(es) (ancho/alto) de 800x600</p>
<div class="field btn-admin-green" style="margin: 14px; font-size: 12px; padding: 5px;">
<input name="data[Comment][img]" id="file-uploaderh1" type="hidden">
<div id="file-uploader1"><div class="qq-uploader"><div style="display: none;" class="qq-upload-drop-area"><span>Arrastra Fotos</span></div><div style="position: relative; overflow: hidden; direction: ltr;" class="qq-upload-button btn btn-success">A&ntilde;adir fotos<input style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0;" name="file" multiple="multiple" type="file"></div><ul class="qq-upload-list"></ul></div></div>                
</div>

<?php
foreach($this->data["Foto"] as $foto)
{
 //  print_r($foto);
 ?>
<div style="display: block; overflow: hidden; margin: 10px;" class="foto" id="<?php echo $foto["id"]?>">
<div class="foto" style="height: 22px; padding: 18px; width: 355px;">
<!--
Orden: <input name="orden" style="width: 20px;" value="<?php echo $foto["orden"]?>" class="foto_name" onfocus="edit_foto(this)" type="text">
--> 
Color: <input name="color" value="<?php echo $foto["title"]?>" class="foto_name" onfocus="edit_foto(this)" type="text">
</div>
<div class="foto" style="width: 200px;">
<img src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $foto["url"]?>" alt="<?php echo $foto["title"]?>"><input onclick="delete_foto(this)" class="btn-admin-red" value="ELIMINAR" style="vertical-align: top; margin: 17px 0 17px 10px;" type="button">
<input onclick="save_foto(this)" class="btn-admin-green" value="GUARDAR" style="vertical-align: top; margin: 17px 0 17px 10px; display: none;" type="button">
</div>
</div>
<?php } ?>
</div>
<hr style="margin-bottom: 5px;">

<div style="display: block; overflow: hidden;">
<h2 class="dos">Surtidos del Art&iacute;culo</h2>
<div id="admin-table" class="dos">
    <table>
        <tbody><tr>
        <th>Tipo</th>
        <th>N&uacute;meros</th><th>Descripci&oacute;n</th><th>Pares<br/>surtidos</th><th>Precio<br/>Par.</th>
        <th>Oferta</th><th>Precio<br/>Surt. <br/>Oferta.</th><th>Categoria</th><th>Tipo</th><th>Subtipo</th><th>Action</th><td class="fix"></td></tr>
        <?php foreach($this->data["Surtido"] as $surtido)
        {?>        
        <tr class="altrow">
            <td><?php echo $surtido["tipo"]?></td>
            <td>Del <?php echo $surtido["talla_inf"]?> al <?php echo $surtido["talla_sup"]?> </td>
            <td><?php echo $surtido["descripcion"]?></td><td><?php echo $surtido["pares"]?></td>
            <td><?php echo $surtido["precio_sur"]?></td><td><?php echo $surtido["oferta"]=='1'?'Si':'No'?></td>
            <td><?php echo $surtido["precio_sur_oferta"]?></td>
            <td><?php echo $surtido["categoria_nombre"]?></td>
            <td><?php echo $surtido["tipo_nombre"]?></td>
            <td><?php echo $surtido["subtipo_nombre"]?></td>
            <td class="actions">
        		<a href="<?php echo $this->webroot?>proveedor/surtidos/edit/<?php echo $surtido["id"]?>"><img alt="" src="<?php echo $this->webroot?>img/pencil.png"></a>
                <a onclick="return confirm('Esta seguro de Eliminar?')" href="<?php echo $this->webroot?>proveedor/surtidos/delete/<?php echo $surtido["id"]?>"><img alt="" src="<?php echo $this->webroot?>img/x.png"></a>
            </td>
            <td class="fix"></td>
        </tr>
  <?php }?>
        <tr class="clear">        <td colspan="8" style="height: 10px;"></td>        </tr>
    </tbody></table>
</div>

<div style="padding: 16px; overflow: hidden; width: 100%;">
<input name="step" class="btn-admin-green2" value="A&Ntilde;ADIR SURTIDO LIBRE" onclick="showw('add_surtido_libre')" type="submit">
<input name="step" class="btn-admin-green2" value="A&Ntilde;ADIR CAJAS SURTIDAS" onclick="showw('add_cajas_surtidas')" type="submit">    
</div>
 
</div>
 
 <!--  -->
 
  
 <div class="add_surtido" id="add_cajas_surtidas" style="display: none;">
 <div class="headd"><label>Cajas Surtidas</label> <input class="btn-admin-red" value="BORRAR" style="margin-left: 200px; margin-top: 17px; vertical-align: top;" onclick="hidee(this)" type="button"> </div>
 <div class="body"> 
    <form action="<?php echo $this->webroot?>proveedor/surtidos/add" style="margin:0;" id="SurtidoAddForm" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>	
    <input name="data[Surtido][calsado_id]" value="<?php echo $this->data["Calsado"]["id"]?>" id="SurtidoCalsadoId" type="hidden"/>        
            <div class="input text">
            <label>Tama&ntilde;os*</label>        
            <div style="width: 150px; display: inline;"> Del* <input name="data[Surtido][talla_inf]" onkeyup="haceralgo()" class="validate[required,custom[integer]]" style="width: 30px;" maxlength="3" id="SurtidoTallaInf" type="text"/> Al <input onkeyup="haceralgo()" name="data[Surtido][talla_sup]" class="validate[required,custom[integer]]" style="width: 30px;" maxlength="3" id="SurtidoTallaSup" type="text"/> </div>
            </div>
            <input name="data[Surtido][descripcion]" class="validate[required]" maxlength="30" id="SurtidoDescripcionnn" type="hidden"/>            
            <div id="tablilla">
                <div class="celda">
                    <label>Talla</label>
                    <label>Pares</label>
                </div>
            
            </div>
            
            <div class="input text">
                <label for="SurtidoPares">Pares*</label>
                <input class="validate[required,custom[integer]]" name="data[Surtido][pares]" style="width: 30px;" maxlength="3" id="SurtidoParesillos" type="text" readonly="readonly"/>
            </div>
            <div class="input text"><label for="SurtidoPrecioSur">Precio por Par*</label>
            <input class="validate[required]" name="data[Surtido][precio_sur]" style="width: 50px;" id="SurtidoPrecioSursdf" type="text"> &euro;</div>
            
            <div class="input text">
                <label>
                    <a style="font-size: 10px;" onclick="activaroferta(this)" class="btn-admin-green">A&ntilde;adir Oferta</a>
                </label>
            </div>
            <div style="display: none;">
            <div class="input radio"><fieldset><legend>Oferta</legend><input name="data[Surtido][oferta]" id="SurtidoOferta0" value="0" checked="checked" type="radio"><label for="SurtidoOferta0">No</label><input name="data[Surtido][oferta]" id="SurtidoOferta1" value="1" type="radio"/><label for="SurtidoOferta1">Si</label></fieldset></div>
            <div class="input text"><label for="SurtidoPrecioSurOferta">Precio par Oferta*</label>
            <input class="validate[required]" name="data[Surtido][precio_sur_oferta]" style="width: 50px;" id="SurtidoPrecioSurOferta332" type="text"> &euro;</div><input name="data[Surtido][tipo]" value="cajas_surtidas" id="SurtidoTipo" type="hidden"/>
            </div>
            <?php echo $this->Form->input('categoria_id',array("name"=>"data[Surtido][categoria_id]"));?>
            <?php echo $this->Form->input('tipo_id',array("name"=>"data[Surtido][tipo_id]"));?>
            <?php echo $this->Form->input('subtipo_id',array("name"=>"data[Surtido][subtipo_id]"));?>
            <input name="data[Surtido][tipo]" value="cajas_surtidas" id="SurtidoTipo" type="hidden"/>
    <div style="padding: 0 0 30px 10px; overflow: hidden; width: 100%;"> <input value="SALVAR" class="btn-admin-orange" name="step" type="submit"> </div>
    </form> 
 </div>
</div>


<div class="add_surtido" id="add_surtido_libre" style="display: none;">
 <div class="headd"><label>Surtido Libre</label> <input class="btn-admin-red" value="BORRAR" style="margin-left: 200px; margin-top: 17px; vertical-align: top;" onclick="hidee(this)" type="button"> </div>
     <div class="body"> 
            <form action="<?php echo $this->webroot?>proveedor/surtidos/add" style="margin:0;" id="SurtidoAddForm2" method="post" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>	<input name="data[Surtido][calsado_id]" value="<?php echo $this->data["Calsado"]["id"]?>" id="SurtidoCalsadoId" type="hidden">        
                    <div class="input text">
                        <label>Tama&ntilde;os*</label>        
                        <div style="width: 150px; display: inline;"> Del <input class="validate[required,custom[integer]]" name="data[Surtido][talla_inf]" style="width: 30px;" maxlength="3" id="SurtidoTallaInf" type="text"> Al <input class="validate[required,custom[integer]]" name="data[Surtido][talla_sup]" style="width: 30px;" maxlength="3" id="SurtidoTallaSup" type="text"> </div>
                    </div>
                    
                    <div class="input text">
                        <label for="SurtidoPares">Pares minimos*</label>
                        <input class="validate[required,custom[integer]]" name="data[Surtido][pares]" style="width: 50px;" maxlength="6" id="SurtidoParesillos" type="text"/>
                    </div>
                    
                    <input class="validate[required,custom[integer]]" name="data[Surtido][descripcion]" value="-" id="SurtidoDescripcion" type="hidden"/>
                   
                    <div class="input text"><label for="SurtidoPrecioPar">Precio Par*</label>
                    <input class="validate[required]" name="data[Surtido][precio_sur]" style="width: 50px;" id="SurtidoPrecioParasdf" type="text"> &euro;</div>
            
                    <!--
<div class="input text"><label for="SurtidoPrecioSur">Precio Surtido*</label><input class="validate[required]" name="data[Surtido][precio_sur]" style="width: 50px;" maxlength="5" id="SurtidoPrecioSur" type="text"> &euro;</div>
-->                 

                    <div class="input text">
                        <label>
                            <a style="font-size: 10px;" onclick="activaroferta(this)" class="btn-admin-green">A&ntilde;adir Oferta</a>
                        </label>
                    </div>    
                    <div style="display: none;">
                        <div class="input radio"><fieldset><legend>Oferta</legend><input name="data[Surtido][oferta]" id="SurtidoOferta0" value="0" checked="checked" type="radio"><label for="SurtidoOferta0">No</label><input name="data[Surtido][oferta]" id="SurtidoOferta1" value="1" type="radio"><label for="SurtidoOferta1">Si</label></fieldset></div>
                        <div class="input text"><label for="SurtidoPrecioParOferta">Precio Par Oferta*</label>
                        <input class="validate[required]" name="data[Surtido][precio_par_oferta]" style="width: 50px;" id="SurtidoPrecioParOferta32" type="text"> &euro;</div>
                    </div>
                    <!--
<div class="input text"><label for="SurtidoPrecioSurOferta">Precio Surtido Oferta</label><input name="data[Surtido][precio_sur_oferta]" style="width: 50px;" maxlength="5" id="SurtidoPrecioSurOferta" type="text"> &euro;</div>
-->                    
                    <?php echo $this->Form->input('categoria_id',array("name"=>"data[Surtido][categoria_id]"));?>
                    <?php echo $this->Form->input('tipo_id',array("name"=>"data[Surtido][tipo_id]"));?>
                    <?php echo $this->Form->input('subtipo_id',array("name"=>"data[Surtido][subtipo_id]"));?>
                    <input name="data[Surtido][tipo]" value="surtido_libre" id="SurtidoTipo" type="hidden"/>    <hr/>
            <div style="padding: 0 0 30px 10px; overflow: hidden; width: 100%;"> <input value="SALVAR" class="btn-admin-orange" name="step" type="submit"> </div>
            </form>
    </div>
    
    

    
    
</div> 
<hr />
    <div style="padding: 0 0 10px 10px; overflow: hidden; width: 100%;">
        <input onclick="$('#submit1').click()" name="step" class="btn-admin-orange" value="SALVAR" type="submit">
        <input onclick="$('#submit2').click()" name="step" class="btn-admin-orange2" value="SALVAR Y DAR DE ALTA A OTRO ARTICULO" type="submit">
        <input value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" type="button">
    </div>
</div>

</div>

<script>


function haceralgo()
{
    var sup=$("#SurtidoTallaSup").val();
    sup=sup*1;
    
    var inf=$("#SurtidoTallaInf").val();
    inf=inf*1;
    
    $("#tablilla").children('.celda.clon').remove();
        
    if(sup>inf)
    {
        for (var i=inf;i<sup+1;i++)
        {
            $("#tablilla").append('<div class="celda clon"><label>'+i+'</label><input id="'+i+'" name="sumadora[]['+i+']" class="sumadora validate[required,custom[integer]]" onkeyup="paresillos(this.value)" type="pares" size="3" placeholder="0"></div>');
        }
    }
    $("#SurtidoAddForm").validationEngine();
}
function paresillos(thiss)
{
    var suma=0;
    var texto="";
    $(".sumadora").each(function(){
        var xx=$(this).val();
        if (/^([0-9])*$/.test(xx)){
            suma=suma+xx*1;
            texto=texto+"-"+xx;
        }
    });
    texto = texto.substr(1,texto.length);
    $("#SurtidoDescripcionnn").val(texto);
    $("#SurtidoParesillos").val(suma);
      
}




function activaroferta(thiss)
{
    jQuery(function()
    {
     var div=$(thiss).parent("label").parent("div");
     $(div).slideUp();   
     $(div).next('div').slideDown();
    });
    
}

function delete_foto(thiss)
{
    
    if(confirm("Esta seguro de eliminar la foto?"))
    jQuery(function(){        
       var foto_id=$(thiss).parent("div").parent("div").attr("id");
       $.ajax({
       type: "GET",
       url: "<?php echo $this->webroot?>proveedor/fotos/delete/"+foto_id,
       success: function(msg){
        if(msg=='true')
        {
           $(thiss).parent("div").parent("div").slideUp();        
        }
       }
     });
});
}

function edit_foto(thiss)
{
    var div= $(thiss).parent("div").next("div");
    $(div).children(".btn-admin-green").show();
    $(div).width("290");
}
function save_foto(thiss)
{
    
       jQuery(function(){        
       var foto_id=$(thiss).parent("div").parent("div").attr("id");
       var divv=$(thiss).parent("div").prev("div");
       //var orden=$(divv).children("input[name='orden']").val();
       var color=$(divv).children("input[name='color']").val();
      
       $.ajax({
       type: "POST",
       url: "<?php echo $this->webroot?>proveedor/fotos/update/"+foto_id,
       data: 'orden='+1+'&color='+color ,
       success: function(msg){
        if(msg=='true')
        {
           $(thiss).slideUp('fast',function(){
            $(thiss).parent("div").width("200");
            
           });        
        }
       }
     });
});
    
}
function showw(div)
{
    $("#"+div).slideDown();
}
function hidee(div)
{
    $(div).parent('div').parent('div').slideUp();
}

</script>