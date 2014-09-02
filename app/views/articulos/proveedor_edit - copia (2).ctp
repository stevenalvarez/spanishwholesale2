<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/categorias/add">Registro nueva categor&iacute;a de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="calsados form">
<h2>Pedido # <?php echo $this->data["Articulo"]["id"] ?></h2>

<div class="first-part" style="width: 100%;">
    <div id="pedido">
        <div>
            <strong>
                Detalle del Pedido <?php echo $this->data["Articulo"]["id"] ?>
            </strong>
            <div style="float: right;">
                <a href="<?php echo $this->webroot?>admin/articulos/delete/<?php echo $this->data["Articulo"]["id"]?>" onclick="confirm('Esta seguro de eliminar??')">
                    <img src="<?php echo $this->webroot?>img/x.png" /> Delete
                </a>
                
            </div>
            
        </div>
        <div>
            <strong>Cursado en <?php echo $this->data["Articulo"]["tim"] ?></strong>
            <div class="floatright">
            <strong>Comprobando Existencias</strong> <input type="checkbox"/>
                       
            <a>
                <img src="<?php echo $this->webroot?>img/print.png" /> Print
            </a>
            </div> 
        </div>
        <hr />
        <div class="tcenter">
        
        <form action="<?php echo $this->webroot?>admin/mensajes/add" style="margin: 0;" method="post">
        <input type="hidden" name="data[Mensaje][articulo_id]" value="<?php echo $this->data["Articulo"]["id"]?>" />
        <input type="hidden" name="data[Mensaje][tipo_mensaje]" value="comentario" />
        <textarea name="data[Mensaje][mensaje]" rows="4" onfocus="if(this.value='Enviar comentarios al Cliente')this.value=''">Enviar comentarios al Cliente</textarea>
        <div class="tcenter">
        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
        </div>
        </form>

        </div>
        <div>
           <strong>Contacto:</strong> <label><?php echo $this->data["Cliente"]["Usuario"]["title"]?></label>
        </div>
        <div>
            <div style="width: 45%; float: left;">
                <label><strong>Direcci&oacute;n de Facturaci&oacute;n</strong></label>
                <textarea rows="5"><?php echo $this->data["Pedido"]["di_factura"]?></textarea>
            </div>
            <div style="width: 45%; float: right;">
                <label><strong>Direcci&oacute;n de Env&iacute;o</strong></label>
                <textarea rows="5"><?php echo $this->data["Pedido"]["di_envio"]?></textarea>
            </div>
        </div>
        
        <div>
            <strong>Comentarios</strong>
                <textarea readonly="true" rows="5"><?php
              foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='Proveedor' || $mensaje['tipo_mensaje']=='Cliente'){ 
                    echo "*".$mensaje['tipo_mensaje']." ".$mensaje['tim'].": ".$mensaje["mensaje"]?>
                    
<?php 
                     } ?>
               </textarea>
        </div>
        <form method="post" action="<?echo $this->webroot?>admin/articulos/edit/<?php echo $this->data["Articulo"]["id"]?>" style="margin-top: 20px;">
        <input type="hidden" name="data[Articulo][id]" value="<?php echo $this->data["Articulo"]["id"]?>" />
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
                        Precio <?php  echo $this->data["Surtido"]["tipo"]=='surtido_libre'?'par':'caja'?>
                    </th>
                    <th>
                        Precio Total
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img width="185" src="<?php echo $this->webroot?>img/Foto/mini/<?php echo $this->data["Foto"]["Foto"]["url"]?>" />
                    </td>
                    <td>
                        <p>
                            <strong>Ref:</strong> <label><?php echo $this->data["Calsado"]["Calsado"]["code"]?></label><br />                        
                            <strong>Color:</strong> <label><?php echo $this->data["Foto"]["Foto"]["title"]?></label><br />
                            <strong>Tama&ntilde;os:</strong>de <input style="width: auto;" onchange="return calcular()" type="text" size="1" name="data[Articulo][talla_inf]" value="<?php echo $this->data["Articulo"]["talla_inf"]?>"/> a 
                                                                        <input onchange="return calcular()" style="width: auto;" onfocus="focus(this)" type="text" size="1" name="data[Articulo][talla_sup]" value="<?php echo $this->data["Articulo"]["talla_sup"]?>"/><br />
                                                                        <input onchange="return calcular()" style="width: 160px; margin: 5px 0;" type="text" name="data[Articulo][especificacion]" value="<?php echo $this->data["Articulo"]["especificacion"]?>" />
                                                                        
                                                                        <br />
                            <strong>Pares:</strong> <label><?php echo $this->data["Surtido"]["pares"]?></label>
                        </p>
                    </td>
                    <td>
                        <input style="width: 30px;" onchange="return calcular()"  name="data[Articulo][cantidad]" id="cajas" type="text" value="<?php echo $this->data["Articulo"]["cantidad"]?>" /> <?php  echo $this->data["Surtido"]["tipo"]=='surtido_libre'?'pares':'cajas'?>
                    </td>
                    <td>
                        <input readonly="" style="width: 50px;" onchange="return calcular()" name="data[Articulo][precio_unitario]" id="precio_unitario" type="text" value="<?php echo round($this->data["Articulo"]["precio_unitario"]*1,2)?>" /> &euro;
                    </td>
                    <td>
                        <input disabled="true" style="width: 50px;" id="subtotal1" type="text" value="<?php echo round($this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["precio_unitario"]*1,2) ?>" /> &euro;
                    </td>                    
                </tr>
                <tr>
                    <td colspan="3">
                    <input type="button" class="btn-admin-orange2" value="RESTABLECER VALORES POR DEFECTO" onclick="window.location.href=('<?php echo $this->webroot?>admin/articulos/edit/<?php echo $this->data["Articulo"]["id"]?>')"  /> 
                    <input type="button" value="CALCULAR" class="btn-admin-green floatright" onclick="return calcular()"/>
                    
                    </td>
                    <td><input onchange="return calcular()" type="text" size="1" style="width: auto;" name="data[Articulo][bultos]" value="<?php echo $this->data["Articulo"]["bultos"]?>" /> bultos</td>
                     <td> <b>Suma <label id="subtotal"><?php echo round($this->data["Articulo"]["cantidad"]*$this->data["Articulo"]["precio_unitario"]*1,2) ?></label> &euro;</b></td>
                    
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td colspan="3">
                <strong>Forma de Pago</strong>
                    <select style="width: 250px;" name="data[Articulo][f_pago]" onchange="return calcular()">
                        <option <?php $this->data["Articulo"]["f_pago"]=='Transferencia Bancaria'?'selected="selected"':'' ?>>Transferencia Bancaria</option>
                        <option <?php $this->data["Articulo"]["f_pago"]=='PayPal'?'selected="selected"':'' ?>>PayPal</option>
                    </select>
                </td>
                
                </tr>
                              
            </tbody>
        </table>
        
        <div style="text-align: center;">
        <hr />
            <input type="submit" value="GUARDAR" class="btn-admin-orange" id="gcamios"  />
            <label></label>
        <hr />
        </div>
        </div>
        
        <table>
            <thead>
             <tr>
                <th>
                    Portes 
                </th>
                <th>
                    Base Imponible + Manejo
                </th>
                <th>
                   <?php ___("I.V.A ")?><?php $tax=Configure::read('tax'); echo $tax["iva"] ?>% 
                   <select style="width: 45px;" name="data[Articulo][iva]" id="Articuloiva" onchange="return calcular()" >
                        <option value="1" <?php echo $this->data["Articulo"]["iva"]=='1'?'selected="selected"':'' ?>>Si</option>
                        <option value="0" <?php echo $this->data["Articulo"]["iva"]=='0'?'selected="selected"':'' ?>>No</option>
                   </select>
                </th>
                <th>
                    <?php ___("RE")?> <?php echo $tax["re"]?>% 
                    <select style="width: 45px;" name="data[Articulo][re]" id="Articulore" onchange="return calcular()">
                        <option value="1" <?php echo $this->data["Articulo"]["re"]=='1'?'selected="selected"':'' ?>>Si</option>
                        <option value="0" <?php echo $this->data["Articulo"]["re"]=='0'?'selected="selected"':'' ?> >No</option>
                    </select>
                </th>
                <th>
                    <?php ___("Suma Total")?>
                </th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="data[Articulo][portes]" onchange="return calcular()"  id="portes" style="width: 50px;" value="<?php echo round($this->data["Articulo"]["portes"]*1,2) ?>" /> &euro;
                    </td>
                    <td>
                   <label id="base_imponible"><?php echo $base_imp=round($this->data["Articulo"]["base_imponible"]*1,2)?> </label> &euro;
                    </td>
                    <td><!-- iva -->
                        <label id="iva_tax"><?php echo $this->data["Articulo"]["iva"]=='1'?($iva=round($base_imp*$tax["iva"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td><!-- re -->
                        <label id="re_tax"><?php echo $this->data["Articulo"]["re"]=='1'?($iva=round($base_imp*$tax["re"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td>
                    <label id="suma_total"><?php echo $this->data["Articulo"]["total_pedidos"]?> &euro;</label>                      
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>TOTAL PEDIDOS</strong></td>
                    <td><strong id="total_pedido2"><?php echo ($this->data["Articulo"]["total_pedidos"])?> &euro;</strong></td>
                    
                </tr>
            </tbody>
        
        </table>
        
        </form>
        
        
        <hr />
        <a id="second"></a>
        
        <div id="pedidopart2">
            <strong>Estado del Pedido</strong>
            <div style="overflow: hidden;">
            <div style="width: 45%;" class="floatleft">
            <?php echo $this->Form->create('Articulo',array('class'=>'noob','action'=>'mensajeobserva'));
                echo $this->Form->input('id');?>
                <div>
                    <label>Confirmado</label>
                    <select name="confirmado">
                        <option value="1" <?php echo $this->data["Articulo"]["confirmado"]==1?'selected="seleted"':''?>>Si</option>
                        <option value="0" <?php echo $this->data["Articulo"]["confirmado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a orden de pago en cuenta
                </div>
                <div>
                    <textarea name="texto" rows="4" onfocus="if(this.value=='Observaciones para el cliente')this.value=''"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='observa'){ 
                    echo "*".$mensaje['tim'].": ".$mensaje["mensaje"]?>
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo "Observaciones para el cliente";
                     ?></textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                    </form>
                </div>
            </div>
            <div class="floatright" style="width: 45%;">
                <?php echo $this->Form->create('Articulo',array('class'=>'noob','action'=>'mensajeesperando'));
                echo $this->Form->input('id');?> 
                <div>
                    <label>Esperando entrada de la mercanc&iacute;a</label>
                    <select name="confirmado">
                        <option value="1" <?php echo $this->data["Articulo"]["esperando_mercancia"]==1?'selected="seleted"':''?>>Si</option>
                        <option value="0" <?php echo $this->data["Articulo"]["esperando_mercancia"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a al cliente aviso
                </div>
                <div>
                    <textarea name="texto" rows="4" onfocus="if(this.value=='Fecha de entrada y observaciones para el cliente')this.value=''"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='esperando'){ 
                    echo "*".$mensaje['tim'].": ".$mensaje["mensaje"]?>
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo "Fecha de entrada y observaciones para el cliente";
                     ?></textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                    </form>
                </div>
            </div>
            </div>
            
            <div style="overflow: hidden; padding-top: 20px;">
            <div style="width: 45%;" class="floatleft">
            <?php echo $this->Form->create('Articulo',array('class'=>'noob','action'=>'enviado'));
                echo $this->Form->input('id');?>
                <div>
                    <strong>Enviado</strong> <select name="confirmado">
                        <option value="1" <?php echo $this->data["Articulo"]["enviado"]==1?'selected="seleted"':''?>>Si</option>
                        <option value="0" <?php echo $this->data["Articulo"]["enviado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <?php
                    //print_r($transportistas);
                    //echo $this->Form->input('empresa_transporte',array('type'=>'select','options'=>$transportistas,'default'=>$this->data["Articulo"]["empresa_transporte"],"label"=>"Empresa de Transporte:",'escape'=>true));
                    ?>
                    
                    <strong>Empresa Transporte:</strong> 
                    <select name="empresa_transporte" style="float: right;">
                        <option value="0">
                            Seleccione
                        </option>
                        <?php
                        
                        foreach($transportistas as $key=>$transporte){
                            if($key==$this->data["Articulo"]["empresa_transporte"])
                                echo "<option selected value='".$key."'>".$transporte."</option>";
                            else
                                echo "<option value='".$key."'>".$transporte."</option>";
                        }
                        ?>
                    </select>
                    <!--<input type="text" style="width: 155px;" name="empresa_transporte" value="<?php echo $this->data["Articulo"]["empresa_transporte"]?>" />-->
                </div>
                <div>
                    <strong>Fecha de Salida:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    <input type="text" style="width: 155px;"  name="fecha_salida" value="<?php echo $this->data["Articulo"]["fecha_salida"]?>" />
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                
                </div>
                </form> 
            </div>
            <div style="width: 45%;" class="floatright">
            <?php echo $this->Form->create('Articulo',array('class'=>'noob','action'=>'anulado'));
                echo $this->Form->input('id');?>
            
                <div>
                    <strong>Anulado</strong> 
                    <select name="confirmado">
                    <option value="1" <?php echo $this->data["Articulo"]["anulado"]==1?'selected="seleted"':''?>>Si</option>
                    <option value="0" <?php echo $this->data["Articulo"]["anulado"]==0?'selected="seleted"':''?>>No</option>
                    </select>
                </div>
                <div>
                    <strong>SI,</strong> envia al cliente aviso
                </div>
                <div>
                    <strong>Causa de la anulaci&oacute;n </strong> <input style="width: 155px;" type="text" name="causa_anulacion" value="<?php echo $this->data["Articulo"]["causa_anulacion"]?>" />
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
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
        var suma=$("#cajas").val()*$("#precio_unitario").val();
        $("#subtotal1").val(suma);
        $("#subtotal").text(suma);
        
    var ivatax=0;
    var retax=0;
    var iva=<?php echo $tax["iva"];?>;
    var re=<?php echo $tax["re"];?>;    
    var portes=$("#portes").val();
    
    var comision=<?php echo $this->data["Articulo"]["comision"]?>*1;
     
    var base_imponible= portes*1 +suma*1 + suma*comision/100;
   
    $("#base_imponible").text(base_imponible);        
        
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
    
    sumatotal=base_imponible+ivatax+retax
    sumatotal=sumatotal.toFixed(2);   
        
     $("#suma_total").text(sumatotal);  
     $("#total_pedido2").text(sumatotal);  
     
     $("#gcamios").next('label').html("<br>Se realizaron cambios, gu&aacute;rdelos si desea conservarlos")
     
        
    });
    
    
  
    
    
    return false;
}

</script>

<style>
.noob { margin: 0 !important; }
</style>



