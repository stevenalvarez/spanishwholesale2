<style type="text/css">
    .red{font-weight: bold; color: #590000;}
</style>
<?php
$Provedor=mysql_fetch_assoc(mysql_query("select * from usuarios where id={$this->data["Pedido"]["proveedor"]}"));

 App::import('Model', 'Pedido');
 $Pedido = new Pedido(); 

?>

<div class="container fix">
<a style="float: right;" class="button" href="<?php echo $this->webroot?>cliente/pedidos/canasta?all=1">
       <?php   ___("Volver")?>  
        </a>
<h2 class="red" style="float: left;"><?php ___("Pedido")?> <?php echo $this->data["Pedido"]["id"] ?> <br /><?php print_r($Provedor["title"]) ?></h2>

    <div id="pedido" style="clear: both;">
        <div>
            <strong class="red">
               <?php ___("Detalle del Pedido")?>  <?php echo $this->data["Pedido"]["id"] ?>
            </strong>          
        </div>
        <hr />
        <div style="text-align: left;" class="span-24">
        
        <form onsubmit="return revisar(this)" action="<?php echo $this->webroot?>cliente/mensajes/add" style="margin: 0;" method="post">
        <input type="hidden" name="data[Mensaje][pedido_id]" value="<?php echo $this->data["Pedido"]["id"]?>" />
        <input type="hidden" name="data[Mensaje][tipo_mensaje]" value="comentario" />
            <textarea id="textareadelmensajeaenviar" style="width: 80%;" name="data[Mensaje][mensaje]" rows="4" placeholder="<?php ___("Enviar comentarios al Proveedor")?>"></textarea>
        <div class="tcenter">
        <input style="margin: 10px;" type="submit" class="senda" value="<?php ___("Enviar")?>" />
        </div>
        </form>
        
        <script>
        function revisar(form)
        {
            jQuery(function(){})
            {
                if($.trim($("#textareadelmensajeaenviar").val()).length>=2)
                {
                    return true;
                }
                else
                {
                    alert("<?php ___("El mensaje debe contener al menos 2 caracteres")?>");
                    return false;
                    
                    
                }
                
            }
            
        }
        
        </script>
        
        </div>
        
        <?php if($this->data["Mensaje"]){?>        
        <div class="comentarios">
            <strong class="red">Comentarios:</strong><br />
                <?php
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='Cliente' || $mensaje['tipo_mensaje']=='Proveedor'){ ?>
                    <p class="<?php echo strtolower($mensaje['tipo_mensaje']) ?>">
                        <b>*<?php echo $mensaje['tipo_mensaje']; ?> <?php echo $mensaje['tim'] ?></b>: <?php echo $mensaje["mensaje"];?>
                    </p>
                <?php } ?>
        </div>
        <?php }?>
        <hr />
        <div class="span-24">
            <div style=" float: left;" class="span-12">
                <label><strong class="red"><?php ___("Direcci&oacute;n de Facturaci&oacute;n:")?></strong></label>
               <?php echo $this->data["Pedido"]["di_factura"]?>
            </div>
            <div style=" float: left;" class="span-12 last">
                <label><strong class="red"><?php ___("Direcci&oacute;n de Env&iacute;o:")?></strong></label>
                <?php echo $this->data["Pedido"]["di_envio"]?>
            </div>
        </div>

      <hr />
              <div class="span-24">
            
                <label><strong class="red"><?php ___("Forma de Pago")?>:</strong></label>
               <?php ___("Transferencia Bancaria")?>
           
            </div>
        </div>
       <hr />
         <div class="span-24">   
         
         <?php

         foreach($this->data["Articulo"] as $articulo)
         {  
            $Foto=mysql_fetch_assoc(mysql_query("select * from fotos where id={$articulo["foto_id"]}"));
            $Surtido=mysql_fetch_assoc(mysql_query("select * from surtidos where id={$articulo["surtido_id"]}"));
            $Calsado=mysql_fetch_assoc(mysql_query("select * from calsados where id={$Surtido["calsado_id"]}"));
         ?> 
        <table width="100%">
            <thead>
                <tr>
                    <th>
                        <?php ___("Modelo")?>
                    </th>
            
                    <th>
                        <?php ___("Cantidad")?>
                    </th>
                    <th>
                        <?php ___("Precio")?> <?php  echo $articulo["tipo"]=='surtido_libre'?___('par',1):___('caja',1) ?>
                    </th>
                    <th>
                        <?php ___("Precio Total")?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img width="185" src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $Foto["url"]?>" />
                    </td>

                    <td>
                        <?php 
                       if($Surtido["tipo"]=='surtido_libre')
                       { echo $articulo["unidades"]?>  pares <?php }
                       else
                       { echo $articulo["bultos"]?> cajas<?php }?>
                    </td>
                    <td>
                       <?php
                       
                       if($Surtido["tipo"]=='surtido_libre')
                       {
                        echo round(($articulo["precio_unitario"]),2);     
                       }
                       else
                       {
                        echo round(($articulo["precio_unitario"]*$articulo["unidades"] ),2);
                       }
                       ?> &euro;
                    </td>
                    <td>
                        <?php 
                        
                        
                        echo $total=round(get_total($articulo),2) ?> &euro;
                    </td>                    
                </tr>
                <thead>
                <tr>
                    <th colspan="4">
                    <?php ___("Descripci&oacute;n")?>
                    </th>
                </tr>
                </thead>
                <tr>
                    <td colspan="4">
                        <p>
                            <strong class="red"><?php ___("Ref:")?></strong> <label><?php echo $Calsado["code"]?></label>  &nbsp; |  &nbsp;
                            
                            <strong class="red"><?php ___("Color:")?></strong> <label><?php echo $Foto["title"]?></label>  &nbsp; |  &nbsp;
                             <strong class="red"><?php ___("Especificaci&oacute;n:")?></strong>
                             <label><?php
                             $esp=json_decode($articulo["especificacion"]);
                             $tes='';
                             foreach($esp as $k=>$v) 
                             {
                                $pares="Pares";
                                if($v=='1')
                                $pares="Par";                                
                                if($v>0)
                                $tes.="$k/$v, ";                              
                                
                             } 
                             echo substr($tes,0,-2);
                             ?></label> &nbsp; |  &nbsp;
                             <strong class="red"><?php ___("Tipo:")?></strong> <label><?php echo str_replace("_"," ",$articulo["tipo"])?></label> &nbsp; |  &nbsp;
                             <strong class="red"><?php ___("Bultos:")?></strong> <label><?php 
                              
                       if($Surtido["tipo"]=='surtido_libre')
                       {
                        echo ceil($articulo["unidades"]/12);     
                       }
                       else
                       {
                       echo $articulo["bultos"];
                       }
                             ?></label>
                             
                        </p>
                    </td>
                </tr>
                
                             
            </tbody>
        </table>
        
        <?php }?>
        <table width="100%">
            <thead>
             <tr>
                <th>
                    <?php ___("Portes")?>
                </th>
                <th>
                    <?php ___("Base Imponible")?>
                </th>
                <th>
                    <?php ___("I.V.A ")?><?php $tax=Configure::read('tax'); echo $tax["iva"] ?>% 
                   <?php echo $this->data["Pedido"]["iva"]=='1'?___('Si',1):'No' ?>
                   
                </th>
                <th>
                    <?php ___("RE")?> <?php echo $tax["re"]?>% 
                   <?php echo $this->data["Pedido"]["re"]=='1'?___('Si',1):'No' ?>
                </th>
                <th>
                    <?php ___("Suma Total")?>
                </th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php 
                       if($this->data["Pedido"]["portes"])
                        echo $portes=round($this->data["Pedido"]["portes"]*1,2);
                       else
                        {
                            echo $portes=$Pedido->calcularPortes($this->data["Pedido"]["id"]);
                        } 
                        ?> &euro;
                    </td>
                    <td>
                   <label id="base_imponible"><?php
                   echo $base_imp=$Pedido->calcularTotalneto($this->data["Pedido"]["id"]);?> </label> &euro;
                    </td>
                   <td><!-- iva -->
                        <label id="iva_tax"><?php echo $ivaim=$this->data["Pedido"]["iva"]=='1'?(round($base_imp*$tax["iva"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td><!-- re -->
                        <label id="re_tax"><?php echo $reimp= $this->data["Pedido"]["re"]=='1'?(round($base_imp*$tax["re"]/100 ,2)):'0' ?></label> &euro;
                    </td>
                    <td>
                    <label id="suma_total"><?php  $totalimp = round(($reimp + $ivaim),2); 
                                    echo  $total=round(($totalimp + $base_imp),2)
                    ?> &euro;</label>                      
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"> 
                        <label> <?php ___("Gastos de contra reembolso 5% m&iacute;nimo 5 &euro;")?></label>
                    </td>
                    <td>
                        0.00 &euro;
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"><strong><?php ___("TOTAL PEDIDOS")?></strong></td>
                    <td><strong id="total_pedido2"><?php echo round($total,2)?> &euro;</strong></td>                    
                </tr>
            </tbody>
        
        </table>
 <hr />
       
       </div>
       <h2 class="red"><?php ___("Estado del Pedido")?></h2>
        <div id="pedidopart2" class="span-12">
            
            <label><strong><?php ___("Confirmado:")?></strong> </label><?php echo $this->data["Pedido"]["estado"]==1?___('Si',1):'No'?><br />
            
            <label><strong><?php ___("Pagado:")?></strong> </label><?php echo $this->data["Pedido"]["pagado"]==1?___('Si',1):'No'?><br />
            
                    
                   <div style="border: solid 1px; padding: 5px;"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='observa'){ 
                    echo "<b>*".$mensaje['tim'].":</b> ".$mensaje["mensaje"]?><br />
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo ___("Observaciones del proveedor",1);
                     ?></div>
                
        </div>
        <div class="span-12 last">
         <label><strong><?php ___("Esperando entrada de la mercanc&iacute;a:")?></strong></label>
         <?php echo $this->data["Pedido"]["esperando_mercancia"]==1?___('Si',1):'No'?><br /><br />
                    <div style="border: solid 1px; padding: 5px;"><?php
                    $flag=0;
                foreach($this->data["Mensaje"] as $mensaje)if($mensaje['tipo_mensaje']=='esperando'){ 
                    echo "<b>*".$mensaje['tim'].":</b> ".$mensaje["mensaje"]?><br />
                    <?php 
                    $flag=1;
                    }
                    if(!$flag)
                    echo ___("Fecha de entrada y observaciones del proveedor",1);
                     ?></div>
         </div>
         <div class="span-24" style="margin-top: 10px;"><hr /></div>
        <div class="span-12">
                    <strong><?php ___("Enviado:")?> </strong> <?php echo $this->data["Pedido"]["enviado"]==1?___('Si',1):'No'?><br />
                    <strong><?php ___("Empresa de Transporte:")?></strong> <?php
                    if ($this->data["Pedido"]["empresa_transporte"])
                    {$sql="select title from usuarios where id={$this->data["Pedido"]["empresa_transporte"]}";
                    $trams= mysql_fetch_assoc(mysql_query($sql));
                  
                    echo $trams["title"]; } ?><br />
                    <strong><?php ___("Fecha de Salida:")?></strong> <?php echo $this->data["Pedido"]["fecha_salida"]?><br />
        </div>
        <?php if($this->data["Pedido"]["anulado"]==1){ ?>
           <div class="span-12 last">
                    <strong><?php ___("Anulado:")?></strong> <?php echo $this->data["Pedido"]["anulado"]==1?___('Si',1):'No'?><br />
                    <strong><?php ___("Causa de la anulaci&oacute;n:")?> </strong> <?php echo $this->data["Pedido"]["causa_anulacion"]?>

            </div>
        <?php }?>    
            <div class="span-24" style="margin-top: 10px;"><hr /></div>
</div>                   

