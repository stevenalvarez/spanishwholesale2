<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>
    function haceralgo(thiss){
        var descripcion = '';
        if($(thiss).val() != undefined){
            var value = $(thiss).val();
            descripcion = value.split("-");
            if (/^([0-9])*$/.test(parseInt(descripcion[descripcion.length - 1]))){
            }else if(descripcion[descripcion.length - 1] != ""){
                alert('<?php echo ___("Ingrese solo numero enteros")?>');
                delete descripcion[descripcion.length - 1];
            }
        }else{
            descripcion = '<?php echo $this->data['Surtido']['descripcion'];?>';
            descripcion = descripcion.split("-");
        }
        var tipo = '<?php echo $this->data['Surtido']['tipo'];?>';
        var sup=$("#SurtidoTallaSup").val();
        sup=sup*1;
        
        var inf=$("#SurtidoTallaInf").val();
        inf=inf*1;
        
        $("#tablilla").children('.celda.clon').remove();
            
        if(sup>inf)
        {
            var contador = 0;
            var value = "";
            for (var i=1;i<descripcion.length+1;i++)
            {
                value = descripcion[contador++];
                if(value == undefined){
                    value = "";
                }
                $("#tablilla").append('<div class="celda clon"><label>'+(inf++)+'</label><input id="'+i+'" name="sumadora[]['+i+']" class="sumadora validate[required,custom[integer]]" onkeyup="paresillos()" type="pares" size="3" placeholder="0" value="'+value+'" ></div>');
            }
        }
        $("form").validationEngine();
        if(tipo == "cajas_surtidas") paresillos();
    }
    
    function paresillos(){
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
        $("#SurtidoDescripcion").val(texto);
        $("#SurtidoPares").val(suma);
          
    }
</script>
<script>jQuery(document).ready(function(){
        jQuery("form").validationEngine();
        haceralgo("");
    });
</script>
<style>
    #tablilla { overflow: hidden; padding:0 0 24px 9px; width: 100%;     }
    .celda { width: 152px; float: left; }
    .celda.clon { width: 45px; }
    .celda label{ padding: 5px !important; width: 65px !important; }
</style>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="#">Editar Surtido </a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">


<div class="surtidos form">
<div class="first-part">
<h2>Editar Surtido (<?php echo str_replace('_',' ',$this->data["Surtido"]["tipo"])?>)</h2>
<?php echo $this->Form->create('Surtido');?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('talla_inf',array('label'=>'Talla Inferior*','class'=>'validate[required,custom[integer]]', 'onkeyup'=>'haceralgo("")'));
		echo $this->Form->input('talla_sup',array('label'=>'Talla Superior*','class'=>'validate[required,custom[integer]]', 'onkeyup'=>'haceralgo("")'));
        
        if($this->data["Surtido"]["tipo"]!='surtido_libre'){ ?>
            <div id="tablilla">
                <div class="input celda">
                    <label>Talla</label>
                    <label>Pares</label>
                </div>
            
            </div>
        <?php            
            echo $this->Form->input('descripcion',array('label'=>'Descripci&oacute;n*', 'onkeyup'=>'haceralgo(this)'));
            echo $this->Form->input('pares',array('label'=>'Pares*','class'=>'validate[required,custom[integer]]'));
        }
        else{
            echo $this->Form->input('pares',array('label'=>utf8_encode('Pares mínimos*'),'class'=>'validate[required,custom[integer]]'));
        }
        
	//	echo $this->Form->input('precio_par');
		echo $this->Form->input('precio_sur',array('label'=>'Precio por Par*','class'=>'validate[required,custom[integer]]'));
		echo $this->Form->input('oferta',array('type'=>'radio','options'=>array('0'=>'No','1'=>'Si')));
	//	echo $this->Form->input('precio_par_oferta');
		echo $this->Form->input('precio_sur_oferta',array('label'=>'Precio Oferta*'));
        echo $this->Form->input('categoria_id');
        echo $this->Form->input('tipo_id');
        echo $this->Form->input('subtipo_id');
	?>

<div style="padding:30px 15px; width: 100%;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>

</div>
</div>
</div>