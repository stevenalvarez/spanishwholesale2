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
<?php echo $this->Form->create('Calsado');?>
<div class="first-part">
    <div id="pedido">
        <div>
            <strong>
                Detalle del Pedido <?php echo $this->data["Articulo"]["id"] ?>
            </strong>
            <div style="float: right;">
                <a href="#">
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
        <?php ?>        
        <textarea rows="4">Enviar Comentarios al Cliente</textarea>
        <div class="tcenter">
        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
        </div>
        <??>
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
                <textarea rows="5"></textarea>
        </div>
        
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
                        Precio Unidad
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
                            <strong>Tama&ntilde;os:</strong> <label> de <?php echo $this->data["Surtido"]["talla_inf"]?> a <?php echo $this->data["Surtido"]["talla_sup"]?></label><br />
                            <strong>Surtido:</strong> <label><?php echo $this->data["Articulo"]["especificacion"]?></label><br />
                            <strong>Pares:</strong> <label><?php echo $this->data["Surtido"]["pares"]?></label>
                        </p>
                    </td>
                    <td>
                        <input style="width: 30px;"  type="text" value="<?php echo $this->data["Articulo"]["cantidad"]?>" /><?php  echo $this->data["Surtido"]["tipo"]=='surtido_libre'?'pares':'cajas'?>
                    </td>
                    <td>
                        <input style="width: 50px;" type="text" value="<?php echo $this->data["Articulo"]["precio_unitario"]?>" />&euro;
                    </td>
                    <td>
                        <input style="width: 50px;" type="text" value="<?php echo $this->data["Articulo"]["subtotal"]?>" />&euro;
                    </td>                    
                </tr>
                <tr>
                    <td colspan="2"><input type="button" class="btn-admin-orange2" value="RESTABLECER VALORES POR DEFECTO"  /> </td>
                    <td colspan="3">
                    <strong>Forma de Pago</strong>
                    <select style="width: 250px;">
                        <option>Ingreso o Transferencia Bancaria</option>
                        <option>PayPal</option>
                        <option>Venta Directa</option>
                        <option>Mas Opciones</option>                        
                    </select>
                    </td>
                </tr>                
            </tbody>
        </table>
        
        <div style="text-align: center;">
        <hr />
            <input type="submit" value="GUARDAR" class="btn-admin-orange"  />
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
                    Base Imponible
                </th>
                <th>
                    <?php ___("I.V.A ")?><?php $tax=Configure::read('tax'); echo $tax["iva"] ?>% <select style="width: 45px;" name="iva"><option value="1">Si</option><option value="0">No</option></select>
                </th>
                <th>
                    <?php ___("RE")?> <?php echo $tax["re"]?>% <select style="width: 45px;" name="re"><option value="1">Si</option><option value="0">No</option></select>
                </th>
                <th>
                    <?php ___("Suma Total")?>
                </th>
             </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="portes" style=" width: 50px;" /> &euro;
                    </td>
                    <td>
                    <?php echo ($this->data["Articulo"]["subtotal"])?> &euro;
                    </td>
                    <td>
                        <?php echo ($this->data["Articulo"]["subtotal"]*$tax["iva"])/100 ?> &euro;
                    </td>
                    <td>
                        <?php echo ($this->data["Articulo"]["subtotal"]*$tax["re"])/100 ?> &euro;
                    </td>
                    <td>
                       <?php echo ($this->data["Articulo"]["subtotal"])?> &euro;
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
                    <td><strong><?php echo ($this->data["Articulo"]["subtotal"])?> &euro;</strong></td>
                    
                </tr>
            </tbody>
        
        </table>
        
        <hr />
        
        <div id="pedidopart2">
            <strong>Estado del Pedido</strong>
            <div style="overflow: hidden;">
            <div style="width: 45%;" class="floatleft">
                <div>
                    <label>Confirmado</label>
                    <select><option>Si</option><option>No</option></select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a orden de pago en cuenta
                </div>
                <div>
                    <textarea rows="4">Observaciones para el cliente</textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                </div>
            </div>
            <div class="floatright" style="width: 45%;">
                <div>
                    <label>Esperando entrada de la meracancia</label>
                    <select><option>Si</option><option>No</option></select>
                </div>
                <div>
                    <strong>SI,</strong> env&iacute;a al cliente aviso
                </div>
                <div>
                    <textarea rows="4">Fecha de entrada y observaciones  para el cliente</textarea>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                </div>
            </div>
            </div>
            
            <div style="overflow: hidden; padding-top: 20px;">
            <div style="width: 45%;" class="floatleft">
                <div>
                    <strong>Enviado</strong> <select><option>Si</option><option>No</option></select>
                </div>
                <div>
                    <strong>Empresa de Transporte:</strong> <select style="width: 150px;" ><option>Empresa</option><option>Ups</option></select>
                </div>
                <div>
                    <strong>Fecha de Salida:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> <input style="width: 150px;" type="text" value="" />
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                
                </div>  
            </div>
            <div style="width: 45%;" class="floatright">
                <div>
                    <strong>Anulado</strong> <select><option>Si</option><option>No</option></select>
                </div>
                <div>
                    <strong>SI,</strong> envia al cliente aviso
                </div>
                <div>
                    <strong>Causa de la anulaci&oacute;n </strong> <select><option>Causa</option><option>Stock insufuciente</option></select>
                </div>
                <div>
                    <div class="tcenter">
                        <input style="margin: 10px;" type="submit" class="btn-admin-orange" value="ENVIAR" />
                    </div>
                
                </div>
            </div>
            </div>                   
        </div>
        </div>
    </div>
</div>
</div>






