
<?php 
if( isset($_SESSION["ok"]) && $_SESSION["ok"])
{ ?>
<script>
alert("<?php ___(utf8_encode("Este articulo ha sido añadido al pedido correctamente, cuando termine la compra vaya a Mis Pedidos para cursar su pedido. Gracias"))?>");
</script>
<?php
unset($_SESSION["ok"]);
}
else if(isset($_SESSION["ok"]))
{ ?>
<script>
alert("<?php ___(utf8_encode("Error"))?>");
</script>
<?php
unset($_SESSION["ok"]);
}
?>

<?php 
if( isset($_SESSION["errror"]) && $_SESSION["errror"]==2 )
{ ?>
<script>
alert("<?php ___("El minimo de pares para este surtido son "); echo $_SESSION["errror_min"]?>");
</script>
<?php
unset($_SESSION["errror"]);
}

if( isset($_SESSION["errror"]))
{ ?>
<script>
alert("<?php ___("Faltan datos en su pedido")?>");
</script>
<?php
unset($_SESSION["errror"]);
}
?>
<div class="container">
    <!--Shop product info-->
	<div class="span-24 product-info last">	
        <div class="span-7" id="opctionesdevcolore">
        <?php
        $optcolores='';
        $n=1; 
        $after_echo='';          
        foreach($calsado["Foto"] as $key => $colorz ){
            $t=$colorz["title"]?$colorz["title"]:___("Foto",true)." ".$n;             
            if($this->passedArgs["2"]==$colorz["title"] || sizeof($calsado)==1 || ($this->passedArgs["2"] == "random" && $key=="0"))
            {?>
            <div class="span-7 visual lupa">
            	<a title="<?php $colorz["title"]?>" class="view" href="<?php echo $this->webroot?>img/Foto/orig/<?php echo $colorz["url"] ?>" rel="<?php echo $colorz["title"].$calsado["Calsado"]["id"].$colorz["title"]?>">
                    <img id="fotoprincipal" lang="<?php echo $colorz["title"]?>" src="<?php echo $this->webroot?>img/Foto/max/<?php echo $colorz["url"] ?>" width="270" alt="<?php ___($colorz["title"]) ?>" />
                </a>
            </div>
            
            <div class='visual thumbnail <?php echo $this->passedArgs["2"]==$colorz["title"] || ($this->passedArgs["2"] == "random" && $key=="0") ? "activo" : ""; ?>' style='height: 95px; width: 125px; margin: 4px; overflow: hidden; float: left'>
            	<a title='<?php $colorz["title"]?>' lang="<?php echo $colorz["url"]?>" onclick='cambiarfoto2(this);return false;' class='<?php echo $colorz["title"]?>' href='<?php echo $this->webroot?>img/Foto/orig/<?php echo $colorz["url"] ?>'>
                    <img lang='<?php echo $colorz["title"]?>' src='<?php echo $this->webroot?>img/Foto/orig/<?php echo $colorz["url"] ?>' width='132' alt='<?php ___($colorz["title"]) ?>'/>
                </a>
            </div>
            <?php } 
            else{ $colorz["title"]?$colorz["title"]:___("Foto",true)." ".$n;
            $activo = $this->passedArgs["2"]==$colorz["title"] || ($this->passedArgs["2"] == "random" && $key=="0") ? "activo" : "";
            $after_echo.="<div class='visual thumbnail $activo' style='height: 95px; width: 125px; margin: 4px; overflow: hidden; float: left'>
            	<a title='$t' lang='{$colorz["url"]}'  onclick='cambiarfoto2(this);return false;' class='{$colorz["title"]}' href='{$this->webroot}img/Foto/orig/{$colorz["url"]}'>
                    <img lang='{$colorz["title"]}' src='{$this->webroot}img/Foto/orig/{$colorz["url"]}?>' width='132' alt='$t'/>
                </a>
             </div>";}       
         $optcolores.="<option value='{$colorz["id"]}'>$t</option>";
         $n++;
         }
         echo $after_echo;
         ?>
            
		</div>
        <div class="span-17 last main">
        	<div class="title"><?php echo $calsado["Calsado"]["code"]?>
            
            <a style="float: right; font-size: 12px;" href="javascript:void(0)" onclick="window.history.back()" class="button buy"> < <?php ___("Volver")?></a>
            </div>
            <div class="description">
            	<p><?php echo $calsado["Calsado"]["texto"]?>.</p>
            </div>
            <table class="tablilla">
            <tr>
                <td style="width: 470px;">
                
                <table class="model" style="width: 100%;">
            	<tbody>
<!--
                	<tr>
                    	<td><strong><?php ___("Disponible") ?></strong></td>
                        <td><?php echo $calsado["Calsado"]["venta"]?></td>
                    </tr>
-->
                    <tr>
                    	<td><strong><?php ___("Hecho en")?> </strong> </td>
                         <td>
                           <?php 
                           if($_SESSION["cake_lang"]=='eng')
                           {
                              echo $calsado["Country"]["title_en"];
                           }else
                             echo $calsado["Country"]["title"]?>
                         </td>
                        
                    </tr>
                    <tr>
                    	<td><strong><?php ___("Proveedor")?></strong></td>
                        <td>
                        <?php echo $calsado["Usuario"]["title"]?>
                        </td>
                    </tr>                    


                    <tr>
                    	<td>
                            <img style="max-width: 200px; max-height: 250px;" src="<?php echo $this->webroot?>img/prov/<?php echo $calsado["Usuario"]["img"]?>" />
                        </td>
                        <td>
                            <a class="button buy" href="<?php echo $this->webroot?>?provider=<?php echo $calsado["Usuario"]["title"]?>"><?php ___("Revisar el catalogo del proveedor")?></a>
                            <?if( isset($_SESSION["Auth"]["Usuario"])){ ?>
                            <a class="button buy fancyboxx" href="#contacto"><?php ___("Contactar con el proveedor")?></a>
                            
                            <div style="display: none;">
                            <div id="contacto">
                                <h2><?php ___("Contactar con el Proveedor")?></h2>
                                
                                <table class="table model" style="min-width: 600px;">
                                    <tr>
                                        <td><strong><?php ___("Persona de contacto")?>:</strong></td>
                                        <td><?php echo $calsado["Usuario"]["persona_contacto"] ?></td>
                                        <td rowspan="4" width='40'> </td>
                                        <td rowspan="4" style="padding-left: 20px !important;">
                                        <form method="post" action="<?php echo $this->webroot?>usuarios/contacto2/">
                                        
                                        <input type="hidden" name="proveedor" value="<?php echo $calsado["Usuario"]["id"] ?>" />
                                        <input type="hidden" name="calsado" value="<?php echo $calsado["Calsado"]["id"] ?>" />
                                            <textarea style="margin-bottom: 10px;" name="pregunta" cols="30" rows="5" placeholder="<?php ___("Escribe tu consulta")?>" ></textarea><br />
                                            <button class="button buy" type="post" style="clear: both;">
                                                <?php ___("Enviar consulta") ?>
                                            </button>
                                        </form>
                                        </td>
                                        
                                    </tr>
                                    <!--  
                                    <tr>
                                        <td><strong><?php ___(utf8_encode("Dirección"))?></strong></td>
                                        <td><?php echo $calsado["Usuario"]["direccion"] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php ___(utf8_encode("Teléfono"))?></strong></td>
                                        <td><?php echo $calsado["Usuario"]["telefonos"] ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php ___(utf8_encode("Fax"))?></strong></td>
                                        <td><?php echo $calsado["Usuario"]["fax"] ?></td>
                                    </tr>-->
                                </table>
                                                            
                            </div>
                            </div>
                            <?php }else{ ?>
                            
                            <?php }?>
                        </td>
                    </tr>
                    <?php if(isset($calsado["Calsado"]["material"]) && $calsado["Calsado"]["material"]){ ?>
                     <tr>
                    	<td><strong><?php ___("Material")?></strong></td>
                        <td><?php echo $calsado["Calsado"]["material"]?></td>
                    </tr>
                    <?php }?>

                    <tr style="display: none;">
                    	<td><strong><?php ___("Categor&iacute;a")?></strong></td>
                        <td><?php                                    
                         echo $calsado["Categoria"]["title"]." - ".$calsado["Tipo"]["title"]." - ".$calsado["Subtipo"]["title"]?></td>
                    </tr>
                    <?php if($calsado["Calsado"]["forro"]){ ?>
                     <tr>
                    	<td><strong><?php ___("Forro")?></strong></td>
                        <td><?php echo $calsado["Calsado"]["forro"]?></td>
                    </tr>
                    <?php }?>
                    <?php if($calsado["Calsado"]["suela"]){ ?>
                     <tr>
                    	<td><strong><?php ___("Suela")?></strong></td>
                        <td><?php echo $calsado["Calsado"]["suela"]?></td>
                    </tr>
                    <?php }?>
                    
                    <?php if($calsado["Calsado"]["marca"]){ ?>
                    <tr>
                    	<td><strong><?php ___("Marca")?></strong></td>
                        <td><?php echo $calsado["Calsado"]["marca"]?></td>
                    </tr>
                    <?php }?>                                        
                    <tr>
                    	<td><strong><?php ___("Item no")?></strong></td>
                        <td><?php echo $calsado["Calsado"]["code"]?></td>
                    </tr>
                    <tr>
                    	<td><strong><?php ___("Servicio")?></strong></td>
                        <td><?php 
                        if(!$calsado["Calsado"]["servicio"])
                        {___("Inmediato");}
                        else if($calsado["Calsado"]["servicio"]=='91')
                       { ___( utf8_encode( "más de 90 días"));}
                        else
                        {echo $calsado["Calsado"]["servicio"]." "; ___(utf8_encode("días")); }
                        ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>
                
                </td>
                <td style="vertical-align: top;">
                      <?php
              
                 if( isset($_SESSION["Auth"]["Usuario"]))
                {
                ?>
                    <table>
                    <thead>                    
                        <tr>
                            <th><?php ___("Portes")?></th>
                        </tr>
                    </thead>                  
                        <tr>
                            <td>
                                <?php
                                ___("BULTOS Caja o 12 Pares/LI");
                                echo "<br><br>";
                            
                                
                                $precio=deserializar($calsado["Usuario"]["portes_txt"]);
                                if($calsado["Usuario"]["portes"]=='precio')
                                {
                                   
                                    ___("PAGADOS en pedidos superiores a");
                                   echo " ".intval($precio["mayor"])."&euro; ";
                                    ___("en pedidos inferiores");
                                   echo " ".intval($precio["porenvio"])."&euro; ".___("por env&iacute;o",1);
    
                                }
                                else
                                {
                                    if($precio)
                                    foreach($precio as $k=>$v)
                                    {
                                        if($k==1)
                                        echo  $k." ".___("Bulto",1)." $v&euro;<br>";
                                        else
                                        echo  $k." ".___("Bultos",1)." $v&euro;<br>";
                                    }
                                }
                                
                               //  echo  nl2br($calsado["Usuario"]["portes_txt"])?>
                            </td>
                        </tr>      
                    </table>
                    
                    <?php }?>
                    
                    
                    <div>
                    
                    <a class="view" title="SpanishWholesale.com" href="<?php echo $this->webroot?>img/conversion.png" ><?php ___("Tabla aproximada de tallas")?> </a>
                    
                    </div>
                    </td>
                
                
                </tr>
            
            
            
            </table>
            <div class="product-options">
            	<h4><?php ___("Opciones del Producto - Surtidos")?></h4>
                
                <?php
              
                 if( isset($_SESSION["Auth"]["Usuario"]))
                {
                ?>
                
                <?php 
                //revisar si hay surtidos libres o cajas
                $libre=0;
                $cajas=0;
                foreach  ($calsado["Surtido"] as $surtido)
                {
                    
                    if( $surtido["tipo"]=="surtido_libre")
                        $libre=1;
                    if( $surtido["tipo"]=="cajas_surtidas")
                        $cajas=1;
                }
                if($libre){
                
                foreach  ($calsado["Surtido"] as $surtido){
                      if($surtido["tipo"]=="surtido_libre") {
                        
                      $colspan=$surtido["talla_sup"]-$surtido["talla_inf"];
                        
                ?>
                <form action="<?php echo $this->webroot?>cliente/pedidos/check" method="post">
                <input type="hidden" name="surtido" value="<?php echo $surtido["id"]?>"/>
                <table style="width: 100%;">
                <thead>
                <tr>
                    <td style="border-bottom: 1px solid #590000; font-size: 14px;" colspan="<?php echo $colspan +7?>" style="text-align: center;"><?php ___("Surtido Libre")?></td>
                </tr> 
                <tr>
                    <th>Color</th>
                    <th><?php ___("Tama&ntilde;os")?>  <?php echo $surtido["talla_inf"] ?> -> <?php echo $surtido["talla_sup"] ?> </th>
  
                        <th><?php ___("Precio par")?> &euro;</th><th><?php ___("Total pares") ?> </th><th><?php ___("Precio total")?> &euro;</th><th> </th>
                </tr>
                </thead>
                <tbody>
                         <tr>
                                <td>
                                   <select class="colors" name="color" onchange="cambiarfoto(this)">
                                        <?php foreach($calsado["Foto"] as $colorz){
                                          
                                          $selected='';
                                          if($this->passedArgs["2"]==$colorz["title"])
                                          $selected="selected='selected'";
                                            
                                            ?>
                                            <option <?php echo $selected?>  class="<?php echo $colorz["title"]?>" lang="<?php echo $colorz["url"]?>" value="<?php echo $colorz["id"]?>"><?php ___($colorz["title"])?></option>
                                        <?php $selected=''; }?>
                                   </select>
                                </td>
                                  
                                <td>
                                
                                             <?php 
for($i=$surtido["talla_inf"];$i<$surtido["talla_sup"]+1;$i++)
{?> 

<div style="width: 25px; float: left; text-align: center; padding: 3px; margin: 0;">
<label style="display: block; width: 100%;" ><?php echo $i?></label>
<input onkeyup="calcular(this)" onfocus="this.value=''" type="text" value="0" size="2" style="width: 20px;" name="talla[<?php echo $i?>]"/>
</div>  
<?php } ?>    
                    
                    
                                
                                
                                </td>                          
                                <td class="precio">
                                    <?php 
                                        $p=$surtido['oferta']=='1'?$surtido['precio_sur_oferta']:$surtido["precio_sur"];
                                        $precio=number_format(($p+$p*$calsado["Usuario"]["comision"]/100),2,".","");
                                        echo $precio
                                     ?>&euro;
                                     <input type="hidden" value="<?php echo $precio?>"/>
                                     
                                </td>
                                <td class="pares">                                    
                                </td>
                                <td class="total">                                
                                </td>
                                <td>
                                    <input class="button buy" type="submit" value="<?php ___(utf8_encode('Añadir al carro'))?>" />
                                </td>
                         </tr>
                             </tbody>
                  </table>
                </form>
                    <?php } }?>
                
               <?php }
                if($cajas){
                foreach  ($calsado["Surtido"] as $surtido){
                      if($surtido["tipo"]=="cajas_surtidas") {
                        
                      $colspan=$surtido["talla_sup"]-$surtido["talla_inf"];
                ?>
                <form action="<?php echo $this->webroot?>cliente/pedidos/check" method="post">
                <input type="hidden" name="surtido" value="<?php echo $surtido["id"]?>"/>                
                <table style="width: 100%;">
                <thead>
                <tr>
                    <td style="border-bottom: 1px solid #590000;  font-size: 14px;" colspan="<?php echo $colspan +8?>" style="text-align: center;"><?php ___("Caja Surtida")?></td>
                </tr> 
                <tr>
                    <th>Color</th>
                    <th><?php ___("Detalle")?> <?php echo $surtido["talla_inf"]?> -> <?php echo $surtido["talla_sup"]?></th>

                        <th><?php ___("Pares surtido")?></th><th><?php ___("Precio par")?> &euro;</th><th><?php ___("Precio Caja")?> &euro;</th><th><?php ___("Cajas")?></th><th><?php ___("Precio total")?> &euro;</th><th></th>
                </tr>
                </thead>
                <tbody>
                         <tr>
                                <td>
                                   <select class="colors" name="color" onchange="cambiarfoto(this)">
                                        <?php foreach($calsado["Foto"] as $colorz){
                                          $selected='';
                                          if($this->passedArgs["2"]==$colorz["title"])
                                          $selected="selected='selected'";
                                            ?>
                                            <option <?php echo $selected?>  class="<?php echo $colorz["title"]?>" lang="<?php echo $colorz["url"]?>" value="<?php echo $colorz["id"]?>"><?php ___($colorz["title"])?></option>
                                        <?php $selected = ''; }?>
                                   </select>
                                </td>
                               
                               <td>
                                <?php
                                $iii=0;
                                $desc=(explode("-",$surtido["descripcion"]) );
                                for($i=$surtido["talla_inf"];$i<$surtido["talla_sup"]+1;$i++)
                                {
                                    
                                    if (isset($desc[$iii])){
                                    ?>
                                
                                <div style="width: 24px; float: left; text-align: center; padding: 3px 0; margin: 0;">
                                <label style="display: block; width: 100%;" ><?php echo $i?></label>
                                <input style="background-color: #ECEDED;width: 18px;padding: 0.3em 0.2em 0.15em 0.2em;text-align: center;" disabled="true" type="text" size="2" style="width: 20px;" value="<?php echo $desc[$iii]?>"/>
                                </div> 
     
                                <?php 
                                }
                                $iii++;
                                } ?> 
                                
                                </td>
                                <td>
                                    <?php echo $surtido['pares']?>
                                </td>                          
                                <td>
                                    <?php 
                                        $p=$surtido['oferta']=='1'?$surtido['precio_sur_oferta']:$surtido["precio_sur"];
                                        echo $p=number_format(($p+$p*$calsado["Usuario"]["comision"]/100),2,".","");
                                                                        
                                     ?>&euro;
                                </td>
                                <td class="precio">
                                <?php echo number_format($surtido['pares']*$p,2,".","") ?>&euro;
                                <input type="hidden" value="<?php echo number_format($surtido['pares']*$p,2,".","") ?>"/>
                                </td>
                                <td>
                                    <input onkeyup="calcular2(this)" type="text" size="2" id="total" style="width: 20px;" name="cajas"/>
                                </td>
                                <td class="total">&nbsp;</td>
                                <td>
                                    <input class="button buy" type="submit" value="<?php ___(utf8_encode('Añadir al carro'))?>" />
                                </td>
                         </tr>
                         </tbody>
                  </table>
                </form>
                    <?php } }?>
                    
               <?php }?>
               
               <?php }
               else
               {?>
               
               <table style="width: 100%;">
                <thead>
                <tr>
                    <td style="border-bottom: 1px solid #590000;  font-size: 14px;" style="text-align: center;"><?php ___("Debes registrarte para poder ver m&aacute;s informaci&oacute;n de un art&iacute;culo")?> <br /> <a href="<?php echo $this->webroot?>cliente/usuarios/add">pincha aqu&iacute; para registrarte</a></td>
                    
                </tr> 
                </thead>
                </table>
                
              <?php }
               ?>
            </div>
            <!--
<div class="cart">
            	<div class="price">$23.00</div>
                <input type="text" value="1"/>
                <a href="#" class="button">ADD TO CART</a>
            </div>
-->
        </div>       
    </div>
 </div>
 <style>
.button.buy{
    background-color: #590000;
    border-radius: 4px 4px 4px 4px; 
    border: 0px;
    color: white;
    padding: 3px 9px;}
    .button.buy:hover
    {
        text-decoration: underline;
    }
   th, td {
    padding: 0.4em !important;
    vertical-align: middle;
    text-align: center;
}
table.model td
{ 
    text-align: left;
}
.tablilla { border: 0; }
.tablilla tr,th,td,table { border: 0 !important; }




</style>
<script>
    function calcular(thiss)
    {
        
        var unidades=0;
        jQuery(function(){
            $(thiss).parent("div").parent("td").children("div").children("input").each(function()
            {
                var x=$(this).val();
                unidades=unidades+x*1;
                
            });
            
            $(thiss).parent("div").parent("td").parent("tr").children("td.pares").html(unidades);
            var precio=$(thiss).parent("div").parent("td").parent("tr").children("td.precio").children("input").val();
            var total=unidades*(precio*1);
            total=total.toFixed(2);
            $(thiss).parent("div").parent("td").parent("tr").children("td.total").html(total);
                        
        });   
    }
    function calcular2(thiss)
    {
        var unidades = 0;
        var precio = $(thiss).parent().parent("tr").children("td.precio").children("input").val();
        if (/^([0-9])*$/.test(thiss.value)){
            unidades = thiss.value;
            var total=unidades*(precio*1);
            total=total.toFixed(2);
            $(thiss).parent().parent("tr").children("td.total").html(total);
        }else{
            $(thiss).parent().parent("tr").children("td.total").html("");
        }
    }    
    function cambiarfoto(thiss)
    {
        jQuery(function(){
            
            var color_ant = $("#fotoprincipal").attr("lang");
            var href_old = $("#fotoprincipal").attr("src");
            
            var url = $(thiss).children('option:selected').attr('lang');
            var color_nuevo = $(thiss).children('option:selected').attr('class');
            
            $("#fotoprincipal").attr('src','<?php echo $this->webroot?>img/Foto/max/'+url);
            $("#fotoprincipal").attr('lang',color_nuevo);
            $("#fotoprincipal").parent('a').attr('href','<?php echo $this->webroot?>img/Foto/max/'+url);
            
            //var img = $("#opctionesdevcolore").find(".img[lang='" + color_nuevo + "']");
            $("#opctionesdevcolore").find(".thumbnail").removeClass("activo");
            var img = $("#opctionesdevcolore").find(".thumbnail img[lang='" + color_nuevo + "']");
            
            //$(img).attr('src',href_old);
            //$(img).attr('lang',color_ant);
            //$(img).parent('a').attr('href',href_old);
            $(img).parent().parent().addClass("activo");
            
            //selected
            $("select.colors").find("option").removeAttr("selected");
            $("select.colors").find("option."+color_nuevo).attr("selected","selected");
            
        });
    }
    
    function cambiarfoto2(thiss)
    {
        jQuery(function(){
            
            var url = $(thiss).attr('lang');
            var color_nuevo = $(thiss).attr('class');
            
            $("#fotoprincipal").attr('src','<?php echo $this->webroot?>img/Foto/max/'+url);
            $("#fotoprincipal").attr('lang',color_nuevo);
            $("#fotoprincipal").parent('a').attr('href','<?php echo $this->webroot?>img/Foto/max/'+url);
            
            //var img = $("#opctionesdevcolore").find(".img[lang='" + color_nuevo + "']");
            $("#opctionesdevcolore").find(".thumbnail").removeClass("activo");
            var img = $("#opctionesdevcolore").find(".thumbnail img[lang='" + color_nuevo + "']");
            
            $(img).parent().parent().addClass("activo");
            
            //selected
            $("select.colors").find("option").removeAttr("selected");
            $("select.colors").find("option."+color_nuevo).attr("selected","selected");
        });
    }
    
    jQuery(function(){
        
        $(".fancyboxx").fancybox();
        
    });
    
    
</script>
 
    