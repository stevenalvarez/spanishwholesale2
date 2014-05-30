<?php
$Provedor=mysql_fetch_assoc(mysql_query("select * from usuarios where id={$this->data["Pedido"]["proveedor"]}"));
?>

 <script language="javascript" type="text/javascript">
        function printDiv(divID) {            
            var oldPage = document.body.innerHTML;
            document.body.innerHTML ="<html><head><title></title></head><body>" +document.getElementById(divID).innerHTML + "</body>";            
            window.print();
            document.body.innerHTML = oldPage;
        }
    </script>


<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/pedidos/index/sort:id/direction:desc">Inicio</a></li>
<!--<li> <a href="#">Detalle del pedido</a></li>-->
<li> <a href="<?php echo $this->webroot?>proveedor/pedidos/lista">Listado de Pedidos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="calsados form">
<h2>Pedido # <?php echo $this->data["Pedido"]["id"] ?></h2>
<?php
    $class = ''; 
    $enviado = $this->data["Pedido"]["enviado"];
    $anulado = $this->data["Pedido"]["anulado"];
    if($enviado && $anulado == '0'){
        $class = 'this_disabled';
    }
 ?>

<div id="imprimite" class="first-part" style="width: 100%;">
    <div id="pedido" style="width: 705px;"> 
        <div>
            <strong>
                Detalle del Pedido <?php echo $this->data["Pedido"]["id"] ?>  <br /><?php print_r($Provedor["title"]) ?>
            </strong>
            <div style="float: right;">
                <a href="<?php echo $this->webroot?>proveedor/pedidos/delete/<?php echo $this->data["Pedido"]["id"]?>" onclick="return confirm('Esta seguro de eliminar el pedido?')">
                    <img src="<?php echo $this->webroot?>img/x.png" /> Delete
                </a>
            </div>
        </div>
        <div>
            <strong>Cursado en <?php echo $this->data["Pedido"]["tim"] ?></strong>
            <div class="floatright" style="text-align: right;">
            <a href="javascript:void(0)" onclick="printDiv('imprimite')"><img src="<?php echo $this->webroot?>img/print.png" /> Print </a>
            <br />
               Comprobando existencias <input <?php echo $this->data["Pedido"]["existencias"]?"checked='checked'":"" ?>  type="checkbox" name="comprobando" onclick="comprobando(this)"  />
                <script>
                    function comprobando(thiss)
                    {
                        var est=0;
                        if($(thiss).is(':checked'))
                        var est=1;
                        jQuery(function()
                            {  
                                $.ajax({
                                url: "<?php echo $this->webroot?>proveedor/pedidos/existencias/<?php echo $this->data["Pedido"]["id"] ?>/"+est,
                                type: "GET",                                
                                });
                            });
                    }
              </script>
            </div> 
        </div>
        <hr />
        <div class="tcenter">
        
        <form action="<?php echo $this->webroot?>proveedor/mensajes/add" style="margin: 0;" method="post">
        <input type="hidden" name="data[Mensaje][pedido_id]" value="<?php echo $this->data["Pedido"]["id"]?>" />
        <input type="hidden" name="data[Mensaje][tipo_mensaje]" value="comentario" />
        <textarea style="width: 97%;" name="data[Mensaje][mensaje]" rows="4" onfocus="if(this.value='Enviar comentarios al Cliente')this.value=''">Enviar comentarios al Cliente</textarea>
        <div class="tcenter">
        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="GUARDAR" />
        </div>
        </form>
        <div style="text-align: left;">
            <?php if($this->data["Mensaje"]){?>        
            <div class="comentarios">
                <strong>Comentarios:</strong><br />
                    <?php
                    foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='Cliente' || $mensaje['tipo_mensaje']=='Proveedor'){ ?>
                        <p class="<?php echo strtolower($mensaje['tipo_mensaje']) ?>">
                            <b>*<?php echo $mensaje['tipo_mensaje']; ?> <?php echo $mensaje['tim'] ?></b>: <?php echo $mensaje["mensaje"];?>
                        </p>
                    <?php } ?>
            </div>
            <?php } ?>
        </div>
        </div>
        <div>
           <strong>Contacto:</strong> <label><?php echo $this->data["Usuario"]["title"]?></label>
        </div>
        <form method="post" action="<?echo $this->webroot?>proveedor/pedidos/edit/<?php echo $this->data["Pedido"]["id"]?>#editarea" style="margin-top: 20px;">
        
        <div style="width: 705px;"> 
            <div style="width: 45%; float: left;">
                <label><strong>Direcci&oacute;n de Facturaci&oacute;n</strong></label>
                <textarea name="di_factura" style="width: 100%;background: silver;" rows="5" readonly="readonly"><?php echo trim($this->data["Pedido"]["di_factura"]);?></textarea>
            </div>
            <div style="width: 45%; float: right;">
                <label><strong>Direcci&oacute;n de Env&iacute;o</strong></label>
                <textarea name="di_envio" style="width: 100%;background: silver;" rows="5" readonly="readonly"><?php echo trim($this->data["Pedido"]["di_envio"]);?></textarea>
            </div>
        </div>
        <a id="editarea" > </a>
<div style="clear: both; padding: 5px;"></div>
        <?php
        /** *****************/
        App::import('Model', 'Calsado');
        $CalsadoModel = new Calsado();
           
        App::import('Model', 'Pedido');
        $PedidoModel = new Pedido();
        
        $precio_total = $bultos_total = 0;
        
        foreach($this->data["Articulo"] as $pedido)
        {
          if($pedido["tipo"]=='cajas_surtidas')
          $pedido["base_imponible"]=$pedido["precio_unitario"]*$pedido["unidades"]*$pedido["bultos"];
          else
          $pedido["base_imponible"]=$pedido["precio_unitario"]*$pedido["unidades"];
            
            ?>
        
        <input type="hidden" name="data[Pedido][Articulo][<?php echo $pedido["id"]?>][id]" value="<?php echo $pedido["id"]?>" />
        <div>        
        <table>
            <thead>
                <tr>
                    <th>
                        Modelo
                    </th>
                    <th>
                        Descripci&oacute;n
                    </th>
                    <th>
                        Cantidad
                    </th>
                    <th>
                        Precio <?php  echo $pedido["tipo"]=='surtido_libre'?'par':'caja'?>
                    </th>
                    <th>
                        Precio Total
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                    <?php
                    // en el articulo se guarda la foto id, entoces con eso podemos tener la url
                    $sql="select url,title from fotos where id={$pedido["foto_id"]}";
                    $res =  mysql_query($sql);
                    $res = mysql_fetch_assoc($res);                    
                    $Calsado =  $CalsadoModel->query("select Calsado.code from calsados Calsado, surtidos Surtido where Calsado.id=Surtido.calsado_id and Surtido.id={$pedido["surtido_id"]}");
                ?>  
                    <img width="185" src="<?php echo $this->webroot?>img/Foto/orig/<?php echo $res["url"]?>" />
                    </td>
                    <td>
                        <p>
                            <strong>Ref:</strong> <label><?php  echo $Calsado['0']['Calsado']['code']?></label><br />                        
                            <strong>Color:</strong> <label><?php echo $res["title"]?></label><br />
                            
                            
                            <strong>Tipo:</strong><label><?php echo$pedido["tipo"]?></label><br />
                            <strong>Detalle:</strong>
                            <?php 
                            $detalles=json_decode($pedido["especificacion"]);
                            foreach($detalles as $k=>$v)
                            {
                                $pares='pares';
                                if($v==1)
                                $pares='par';
                                
                                if($v>0)                                
                                echo "<br>talla $k/$v $pares";
                            }
                            ?>   <br />        
                            <?php
                            if($pedido["tipo"]=='cajas_surtidas')
                            {?>                   
                            <input type="text" name="" readonly="true"  id="pares_caja" value="<?php echo $pedido["unidades"]?>" size="2" style="width: 30px; background: silver;" /> pares a
                            <input type="text" name="data[Pedido][Articulo][<?php echo $pedido["id"]?>][precio_unitario]" id="precio_unitario" class="<?php echo $class; ?>" value="<?php echo $pedido["precio_unitario"]?>" size="2" style="width: 50px;" />&euro; el par.                            
                            <?php }?>
                        </p>
                    </td>
                    <td>
                    <?php
                    // calculo de bultos
                    if($pedido["tipo"]=="surtido_libre")
                    {
                    $bultos=$pedido["unidades"]/12;
                    }else{
                    $bultos=$pedido["bultos"];
                    }
                    $bultos=ceil($bultos);
                    $bultos_total = $bultos_total+$bultos;
                    
                    if($pedido["tipo"]=="cajas_surtidas")
                    {?>
                    <input style="width: 30px; text-align: center;" name="data[Pedido][Articulo][<?php echo $pedido["id"]?>][bultos]" id="unidades" class="<?php echo $class; ?>" type="text" value="<?php echo $bultos?>" /> <?php  echo $pedido["tipo"]=='surtido_libre'?'pares':'cajas'?>    
                    <?php }else{ ?>
                    <input style="width: 30px; text-align: center; background: silver;" name="" id="cajas" type="text" value="<?php echo $pedido["unidades"]?>" /> <?php  echo $pedido["tipo"]=='surtido_libre'?'pares':'cajas'?>
                  <?php }  
                    ?>
                    
                        
                    </td>
                    <td><?php
                         if($pedido["tipo"]=='cajas_surtidas')
                        {?> 
                            
                        <input readonly="" style="width: 50px; background: silver;" name="" id="precio_caja" type="text" value="<?php echo round($pedido["precio_unitario"]*1*$pedido["unidades"],2)?>" /> &euro;    
                        <?php } else
                        {?>
                        <input style="width: 50px;" name="data[Pedido][Articulo][<?php echo $pedido["id"]?>][precio_unitario]" id="precio_unitario" type="text" value="<?php echo round($pedido["precio_unitario"]*1,2)?>" /> &euro;
                        <?php }?>
                    </td>
                    <td>
                        <?php $precio = round($pedido["base_imponible"]*1,2); $precio_total = $precio_total+$precio;?>
                        <input disabled="true" style="width: 50px; background: silver;" id="subtotal1" type="text" value="<?php echo $precio; ?>" /> &euro;
                    </td>                    
                </tr>
            </tbody>
        </table>
        </div>
        <hr />
        
        <?php } ?>
        <!-- restablecer los valores originales -->
        <table style="margin-bottom: 10px;">
            <tr>
                <td style="width: 76%;">
                    <input type="button" class="btn-admin-orange2" value="<?php echo ___('Restablecer los valores originales del pedido'); ?>" onclick="confirm('<?php ___('**Importante, si restablece los valores originales remplazar&aacute; a los actuales**'); ?>') ? window.location.href=('<?echo $this->webroot?>proveedor/pedidos/restablecer_valores_originales/<?php echo $this->data["Pedido"]["id"]?>') : ''"  /> 
                    <input type="submit" value="<?php echo ___('Guardar cambios')?>" class="btn-admin-green floatright" style="background-size: 100px 21px;width: 100px;"/>
                </td>
                <td style="text-align: center;">
                    <input type="text" size="1" style="width: auto; text-align: center; background: silver;" disabled="true" name="data[Articulo][bultos]" value="<?php echo $bultos_total;?>" /> <?php ___('bultos');?>
                </td>
                <td>
                    <b><?php ___('Suma');?> <br /><label id="subtotal" style="color: #C11A21;"><?php echo round($precio_total,2) ?></label> &euro;</b>
                </td>
            </tr>
        </table>
        
        <!-- pago -->
        <table style="margin-bottom: 10px;">
        <tr>
            <td>
                  <select style="width: 250px; float: right;" name="">
                        <option>Transferencia Bancaria</option>
                       <!--
                       <option selected="selected"':'' ?>>PayPal</option>
                        -->
                  </select>
            </td>
        
        </tr>
        
        </table>
        
        <input type="hidden" name="data[Pedido][id]" value="<?php echo  $this->data["Pedido"]["id"]?>"/>
        <table>
            <thead>
             <tr>
                <th>
                    Portes 
                </th>
                <th>
                    Base Imponible
                </th>
                <th>
                    I.V.A <?php $tax=Configure::read('tax'); echo $tax["iva"] ?>% 
                   <select style="width: 45px;" name="data[Pedido][iva]" id="Articuloiva" >
                        <option value="1" <?php echo $this->data["Pedido"]["iva"]?'selected="selected"':'' ?>>Si</option>
                        <option value="0" <?php echo !$this->data["Pedido"]["iva"]?'selected="selected"':'' ?>>No</option>
                   </select>
                </th>
                <th>
                    RE <?php echo $tax["re"]?>% 
                    <?php echo $this->data["Pedido"]["re"]?>
                    <select style="width: 45px;" name="data[Pedido][re]" id="Articulore">
                        <option value="1" <?php echo $this->data["Pedido"]["re"]?'selected="selected"':'' ?>>Si</option>
                        <option value="0" <?php echo !$this->data["Pedido"]["re"]?'selected="selected"':'' ?> >No</option>
                    </select>
                </th>
                <th>
                    Suma Total
                </th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="data[Pedido][portes]" id="portes" class="<?php echo $class; ?>" style="width: 50px;" 
                        value="<?php 
                        if($this->data["Pedido"]["portes"])
                         $portes=round($this->data["Pedido"]["portes"]*1,2);
                       else
                        {
                          $portes = $PedidoModel->calcularPortes($this->data["Pedido"]["id"]);
                            
                        } 
                        echo $portes =  number_format($portes,2,",",".");
                         ?>" /> &euro;
                    </td>
                    <td>
                   <label id="base_imponible"><?php
                   
                   $base_imp = $PedidoModel->calcularTotalneto($this->data["Pedido"]["id"]);
                   
                   echo  $base_imp;
                   ?> </label> &euro;
                    </td>
                    <td><!-- iva -->
                        <label id="iva_tax"><?php echo $ivaim=$this->data["Pedido"]["iva"]?(round($base_imp*$tax["iva"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td><!-- re -->
                        <label id="re_tax"><?php echo $reimp= $this->data["Pedido"]["re"]?(round($base_imp*$tax["re"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td>
                    <label id="suma_total"><?php
                    echo $total= number_format($base_imp+$ivaim+$reimp,2,",",".");
                    
                    ?> &euro;</label>                      
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"> 
                        <label> Gastos de contra reembolso 5% m&iacute;nimo 5 &euro;</label>
                    </td>
                    <td>
                        0.00 &euro;
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>TOTAL PEDIDOS</strong></td>
                    <td><strong id="total_pedido2"><?php echo $total?> &euro;</strong></td>
                    
                </tr>
            </tbody>
        
        </table>
        
        <div style="text-align: center;">
        <hr />
            <input type="submit" value="GUARDAR" class="btn-admin-orange" id="gcamios"  />
        <hr />
        </div>
        
        </form>
        
        
        <a id="second"></a>
        
        <div id="pedidopart2">
            <strong>Estado del Pedido</strong>
            <div style="overflow: hidden;">
            <div style="width: 45%;" class="floatleft">
            <div style="float: right;">
                    Pagado:  <input name="pagado" onchange="setpagado(this)" type="checkbox" <?php echo $this->data["Pedido"]["pagado"]==1?'checked="checked"':'';?> />
                    <script>
                    function setpagado(thiss)
                    {
                        var est=0;
                        if($(thiss).is(':checked'))
                        var est=1;
                        jQuery(function()
                            {  
                                $.ajax({
                                url: "<?php echo $this->webroot?>proveedor/pedidos/pedidopagado/<?php echo $this->data["Pedido"]["id"]?>/"+est,
                                type: "GET",                                
                                });
                            });
                    }
                    </script>
                </div>
            <?php echo $this->Form->create('Pedido',array('class'=>'noob','action'=>'mensajeobserva'));
                echo $this->Form->input('id');?>
                
                <div>
                    <label>Confirmado</label>
                    <select name="confirmado">
                        <option value="1" <?php echo $this->data["Pedido"]["estado"]==1?'selected="seleted"':''?>>Si</option>
                        <option value="0" <?php echo $this->data["Pedido"]["estado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a orden de pago en cuenta
                </div>
                <div>
                    <textarea name="texto" rows="4" placeholder="Observaciones para el cliente"></textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="GUARDAR" />
                    </div>
                    <?php
                    $flag=0;
                    foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='observa')
                    { 
                        echo "*<b>".$mensaje['tim'].":</b> ".$mensaje["mensaje"]?>
                        <?php 
                        echo "<br>";
                    }?>
                    
                    </form>
                </div>
            </div>
            <div class="floatright" style="width: 45%;">
                <?php echo $this->Form->create('Pedido',array('class'=>'noob','action'=>'mensajeesperando'));
                echo $this->Form->input('id');?> 
                <div>
                    <label>Esperando entrada de la mercanc&iacute;a</label>
                    <select name="confirmado">
                        <option value="1" <?php echo $this->data["Pedido"]["esperando_mercancia"]==1?'selected="seleted"':''?>>Si</option>
                        <!--<option value="0" <?php echo $this->data["Pedido"]["esperando_mercancia"]==0?'selected="seleted"':''?>>No</option>-->
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a al cliente aviso
                </div>
                <div>
                    <textarea placeholder="Fecha de entrada y observaciones para el cliente" name="texto" rows="4"></textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="GUARDAR" />
                    </div>
                    <?php
                  
                    foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='esperando'){ 
                   echo "*<b>".$mensaje['tim'].":</b> ".$mensaje["mensaje"]?><br />
                    <?php 
                    
                    }
                   ?>
                    </form>
                </div>
            </div>
            </div>
            
            <div style="overflow: hidden; padding-top: 20px;">
            <div style="width: 45%;" class="floatleft">
            <?php echo $this->Form->create('Pedido',array('class'=>'noob','action'=>'enviado'));
                echo $this->Form->input('id');?>
                <div>
                    <strong>Enviado</strong> <select name="confirmado">
                        <option value="1" <?php echo $this->data["Pedido"]["enviado"]==1?'selected="seleted"':''?>>Si</option>
                        <option value="0" <?php echo $this->data["Pedido"]["enviado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                               <div>
                    <?php
                    //print_r($transportistas);
                    //echo $this->Form->input('empresa_transporte',array('type'=>'select','options'=>$transportistas,'default'=>$this->data["Pedido"]["empresa_transporte"],"label"=>"Empresa de Transporte:",'escape'=>true));
                    ?>
                    
                    <strong>Empresa Transporte:</strong> 
                    <select name="empresa_transporte" style="float: right;">
                        <option value="">
                            Seleccione
                        </option>
                        <?php
                        
                        foreach($transportistas as $key=>$transporte){
                            if($key==$this->data["Pedido"]["empresa_transporte"])
                                echo "<option selected='selected' value='".$key."'>".$transporte."</option>";
                            else
                                echo "<option value='".$key."'>".$transporte."</option>";
                        }
                        ?>
                    </select>
                    <!--<input type="text" style="width: 155px;" name="empresa_transporte" value="<?php echo $this->data["Pedido"]["empresa_transporte"]?>" />-->
                </div>
                <div>
                    <strong>Fecha de Salida:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    <input class="calendar" type="text" style="width: 155px;"  name="fecha_salida" value="<?php echo trim($this->data["Pedido"]["fecha_salida"]) != "" ? $this->data["Pedido"]["fecha_salida"] : date('d/m/Y');?>" />
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="GUARDAR" />
                    </div>
                
                </div>
                </form> 
            </div>
            <div style="width: 45%;" class="floatright">
            <?php echo $this->Form->create('Pedido',array('class'=>'noob','action'=>'anulado'));
                echo $this->Form->input('id');?>
            
                <div>
                    <strong>Anulado</strong> 
                    <select name="confirmado">
                    <option value="1" <?php echo $this->data["Pedido"]["anulado"]==1?'selected="seleted"':''?>>Si</option>
                    <option value="0" <?php echo $this->data["Pedido"]["anulado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> envia al cliente aviso
                </div>
                <div>
                    <strong>Causa de la anulaci&oacute;n </strong> <input style="width: 155px;" type="text" name="causa_anulacion" value="<?php echo $this->data["Pedido"]["causa_anulacion"]?>" />
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="GUARDAR" />
                    </div>
                
                </div>
                </form>
            </div>
            </div>                   
        </div>
        </div>
    </div>
</div>
</div>







<script>
function calcular()
{
    jQuery(function(){

    <?php /*
    if($this->data["Surtido"]["tipo"]=='cajas_surtidas')
    { ?>
    var pcaja=$("#pares_caja").val()*$("#precio_unitario").val()*1;
    $("#precio_caja").val(pcaja.toFixed(2));
    var suma=$("#cajas").val()*$("#precio_caja").val();   
    <?php 
    }else
    {?>
    var suma=$("#cajas").val()*$("#precio_unitario").val();
    <?php } */?>    
    
    $("#subtotal1").val(suma);
        
    var ivatax=0;
    var retax=0;
    var iva=<?php echo $tax["iva"];?>;
    var re=<?php echo $tax["re"];?>;    
    var portes=$("#portes").val();
    
 //   var comision=<?php // echo $this->data["Articulo"]["comision"]?>*1;
     
    var base_imponible= suma;
   
    $("#base_imponible").text(base_imponible.toFixed(2));        
        
    if($("#Articuloiva").val()=='1')
    {
        ivatax=base_imponible*iva/100;
        $("#iva_tax").text(ivatax.toFixed(2));       
    }
    else
    { $("#iva_tax").text('0');}     
    if($("#Articulore").val()=='1')
    {
        retax=base_imponible*re/100;
        $("#re_tax").text(retax.toFixed(2));          
    }
    else
    {$("#re_tax").text('0');  }
    
    sumatotal=base_imponible+ivatax+retax+portes*1;
    sumatotal=sumatotal.toFixed(2);   
        
     $("#suma_total").text(sumatotal);  
     $("#total_pedido2").text(sumatotal);  
     
     $("#gcamios").next('label').html("<br>Se realizaron cambios, gu&aacute;rdelos si desea conservarlos")
     
        
    });
    return false;
}

</script>

<style>
textarea{ resize:none } 
.noob { margin: 0 !important; }
</style>

	<link href="<?php echo $this->webroot?>css/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet"/>
	<script src="<?php echo $this->webroot?>js/jquery-ui-1.8.16.custom.min.js"></script>
    <script>
    $(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sab'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
    
    </script>
    
<script>
jQuery(function(){
    		
		$( ".calendar" ).datepicker({
			inline: true
		});
        
        $(".this_disabled").attr("readonly","readonly");
        $(".this_disabled").css("background","silver");
    
});
</script>

