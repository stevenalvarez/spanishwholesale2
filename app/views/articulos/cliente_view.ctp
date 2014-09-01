<div class="container">
<h2>Pedido # <?php echo $this->data["Articulo"]["id"] ?></h2>
    <div id="pedido">
        <div>
            <strong>
                Detalle del Pedido <?php echo $this->data["Articulo"]["id"] ?>
            </strong>
          
        </div>
        <hr />
        <div style="text-align: left;" class="span-24">
        
        <form action="<?php echo $this->webroot?>cliente/mensajes/add" style="margin: 0;" method="post">
        <input type="hidden" name="data[Mensaje][articulo_id]" value="<?php echo $this->data["Articulo"]["id"]?>" />
        <input type="hidden" name="data[Mensaje][tipo_mensaje]" value="comentario" />
        <textarea style="width: 80%;"  name="data[Mensaje][mensaje]" rows="4" onfocus="if(this.value='Enviar comentarios al Proveedor')this.value=''">Enviar comentarios al Proveedor</textarea>
        <div class="tcenter">
        <input style="margin: 10px;" type="submit" class="senda" value="ENVIAR" />
        </div>
        </form>
        </div>
        
        <?php if($this->data["Mensaje"]){?>        
        <div>
            <strong>Comentarios:</strong><br />
                <?php
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='Cliente' || $mensaje['tipo_mensaje']=='Proveedor'){ 
                    echo "<b>*".$mensaje['tipo_mensaje']." ".$mensaje['tim']."</b>: ".$mensaje["mensaje"]?><br />
                    <?php } ?>
        </div>
        <?php }?>
        <hr />
        <div class="span-24">
            <div style=" float: left;" class="span-12">
                <label><strong>Direcci&oacute;n de Facturaci&oacute;n:</strong></label>
               <?php echo $this->data["Pedido"]["di_factura"]?>
            </div>
            <div style=" float: left;" class="span-12 last">
                <label><strong>Direcci&oacute;n de Env&iacute;o:</strong></label>
                <?php echo $this->data["Pedido"]["di_envio"]?>
            </div>
        </div>

      <hr />
              <div class="span-24">
            
                <label><strong>Forma de Pago</strong></label>
               <?php echo $this->data["Articulo"]["f_pago"]?>
           
            </div>
        </div>
       <hr />
         <div class="span-24">      
        <table width="100%">
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
                        <img width="185" src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $this->data["Foto"]["Foto"]["url"]?>" />
                    </td>
                    <td>
                        <p>
                            <strong>Ref:</strong> <label><?php echo $this->data["Calsado"]["Calsado"]["code"]?></label><br />
                            <strong>Ref:</strong> <label><?php echo $this->data["Calsado"]["Calsado"]["title"]?></label><br />                      
                            <strong>Color:</strong> <label><?php echo $this->data["Foto"]["Foto"]["title"]?></label><br />
                             <strong>Especificaci&oacute;n:</strong>
                             <label><?php
                             $esp=json_decode($this->data["Articulo"]["especificacion"]);
                             foreach($esp as $k=>$v) 
                             {
                                $pares="Pares";
                                if($v=='1')
                                $pares="Par";
                                
                                if($v>0)
                                echo "<br>*".___("Talla",1)." $k/$v ".___("Pares",1);
                             } 
                             
                             ?></label><br />
                             <strong>Tipo:</strong> <label><?php echo str_replace("_"," ",$this->data["Articulo"]["tipo"])?></label><br />
                             <strong>Bultos:</strong> <label><?php echo $this->data["Articulo"]["bultos"]?></label>
                             
                        </p>
                    </td>
                    <td>
                        <?php 
                            echo $this->data["Articulo"]["cantidad"]   ?> <?php  echo $this->data["Surtido"]["tipo"]=='surtido_libre'?'pares':'cajas';
                        ?>
                    </td>
                    <td>
                       <?php
                       
                       if($this->data["Surtido"]["tipo"]=='surtido_libre')
                       {
                        echo round(($this->data["Articulo"]["precio_unitario"]),2);     
                       }
                       else
                       {
                        echo round(($this->data["Articulo"]["precio_unitario"]*$this->data["Articulo"]["pares_caja"] ),2);
                       }
                       ?> &euro;
                    </td>
                    <td>
                        <?php echo $total=round($this->data["Articulo"]["base_imponible"],2) ?> &euro;
                    </td>                    
                </tr>
                             
            </tbody>
        </table>
        
        
        <table width="100%">
            <thead>
             <tr>
                <th>
                    Portes 
                </th>
                <th>
                    Base Imponible
                </th>
                <th>
                   <?php ___("I.V.A ")?><?php $tax=Configure::read('tax'); echo $tax["iva"] ?>% 
                   <?php echo $this->data["Articulo"]["iva"]=='1'?'Si':'No' ?>
                   
                </th>
                <th>
                   <?php ___("RE")?> <?php echo $tax["re"]?>% 
                   <?php echo $this->data["Articulo"]["re"]=='1'?'Si':'No' ?>
                </th>
                <th>
                    <?php ___("Suma Total")?>
                </th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo  round(($this->data["Articulo"]["portes"] ),2) ?> &euro;
                    </td>
                    <td>
                   <label id="base_imponible"><?php echo  round(($base_imp=($this->data["Articulo"]["base_imponible"])  ),2) ?> </label> &euro;
                    </td>
                    <td><!-- iva -->
                        <label id="iva_tax"><?php echo $this->data["Articulo"]["iva"]=='1'?($iva=round($base_imp*$tax["iva"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td><!-- re -->
                        <label id="re_tax"><?php echo $this->data["Articulo"]["re"]=='1'?($iva=round($base_imp*$tax["re"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td>
                    <label id="suma_total"><?php echo round(($this->data["Articulo"]["total_pedidos"]),2)?> &euro;</label>                      
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
                    <td><strong id="total_pedido2"><?php echo round(($this->data["Articulo"]["total_pedidos"]),2)?> &euro;</strong></td>
                    
                </tr>
            </tbody>
        
        </table>
 <hr />
       
       </div>
       <h2>Estado del Pedido</h2>
        <div id="pedidopart2" class="span-12">
            
            <label>Confirmado: </label><?php echo $this->data["Articulo"]["confirmado"]==1?'Si':'No'?><br />
            
                    
                    <textarea readonly="yes" style="width: 80%;" name="texto" rows="4"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='observa'){ 
                    echo "*".$mensaje['tim'].": ".$mensaje["mensaje"]?>
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo "Observaciones del proveedor";
                     ?></textarea>
                
        </div>
        <div class="span-12 last">
         <label>Esperando entrada de la mercanc&iacute;a: </label><?php echo $this->data["Articulo"]["esperando_mercancia"]==1?'Si"':'No'?><br />
                    <textarea readonly="yes" style="width: 80%;" name="texto" rows="4"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='esperando'){ 
                    echo "*".$mensaje['tim'].": ".$mensaje["mensaje"]?>
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo "Fecha de entrada y observaciones del proveedor";
                     ?></textarea>
         </div>
         <div class="span-24" style="margin-top: 10px;"><hr /></div>
        <div class="span-12">
                    <strong>Enviado: </strong> <?php echo $this->data["Articulo"]["enviado"]==1?'Si':'No'?><br />
                    <strong>Empresa de Transporte:</strong> <?php echo $this->data["Articulo"]["empresa_transporte"]?><br />
                    <strong>Fecha de Salida:</strong> <?php echo $this->data["Articulo"]["fecha_salida"]?><br />
        </div>

           <div class="span-12 last">
                    <strong>Anulado:</strong> <?php echo $this->data["Articulo"]["anulado"]==1?'Si':'No'?><br />
                    <strong>Causa de la anulaci&oacute;n: </strong> <?php echo $this->data["Articulo"]["causa_anulacion"]?>

            </div>
            <div class="span-24" style="margin-top: 10px;"><hr /></div>
</div>                   

