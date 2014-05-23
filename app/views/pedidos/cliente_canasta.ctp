<?php
$pedidos=array();
$rep="select * from pedidos where confirmado=0 and usuario_id={$_SESSION["Auth"]["Usuario"]["id"]}";
    $rep=mysql_query($rep);
    while($pedido=mysql_fetch_array($rep))
    {
        $pedidos[]=$pedido;
    }
if(isset($_GET["pro"]) && ctype_graph($_GET["pro"]))
{
    $pedidos=array();
    $rep="select * from pedidos where proveedor={$_GET["pro"]} and confirmado=0 and usuario_id={$_SESSION["Auth"]["Usuario"]["id"]}";
    $rep=mysql_query($rep);
    while($pedido=mysql_fetch_array($rep))
    {
        $pedidos[]=$pedido;
    }
}
$tamañ=0;
$tamañ=sizeof($pedidos);

?>
<div class="container"> 
<a class="button" href="<?php echo $this->webroot?>cliente/pedidos/canasta?all=1" style="font-size: 15px; float: right; padding:10px 15px;"><?php ___("Ver pedidos cursados")?></a>
<a class="button" href="<?php echo $this->webroot?>cliente/pedidos/canasta" style="font-size: 15px; float: right; padding:10px 15px;"><?php ___("Ver pedidos sin cursar")?></a>
</div>
<div id="top-banner">

<?php if(!isset($_GET["all"])){ ?>
<div class="title"><?php ___("Pedidos sin Cursar")?></div>
 <?php }else{?> 
 	<div class="title"><?php ___("Pedidos Cursados")?></div>
 
 
 <?php }?>  
</div>


<?php if(!isset($_GET["all"])){ ?>
<div class="container">   
<?php
 App::import('Model', 'Categoria');
 $Categoria = new Categoria();   
           

foreach($pedidos as $pedido)
{
    $articulos=array();
    
    $sql="select * from usuarios where id={$pedido["proveedor"]}";
    $provider=mysql_fetch_assoc(mysql_query($sql));
    
    $query="select * from articulos where pedido_id={$pedido["id"]}";
    $query=mysql_query($query);
    while($articulo=mysql_fetch_assoc($query))
    $articulos[]=$articulo;
    
    
?>
    <div class="span-24 last" style="margin-left: 10px;">
    	<table style="width:100%">
        	<thead>
            <tr>
           	<tr>
                <td colspan="6" style="background-color: #590000; color: white; font-size: 18px;">
                <?php ___("Pedido")?> <?php echo $pedido["id"] ?> -  <?php ___("Proveedor")?>:  <?php  echo ($provider["title"]);?> </td>
            </tr>
            
            	<tr>
                	<td><?php ___("Color")?></td>
                     <td><?php ___("Detalle")?></td>
                    <td><?php ___("Art&iacute;culo")?></td>
                    <td><?php ___("Cantidad")?></td>
                    <td><?php ___("Precio unitario")?></td>
                   <!-- <td><?php ___("Subtotal")?></td>
                    
<td><?php ___("Portes")?></td>
-->
                    <td class="text-right"><?php ___("Total")?></td>
                </tr>
            </thead>            
            <tbody>
            <?php 
            $total=0;
            $comision=0;
            $portres=0;
            $cajillas_portes=0;
            App::import('Model', 'Usuario');
            $Usuario = new Usuario();
             
           if($articulos)
            foreach($articulos as $articulo)
            {
              $res=mysql_query("select * from fotos where id={$articulo["foto_id"]}");
              $foto=mysql_fetch_assoc($res);
              
              $res=mysql_query("select * from surtidos s,calsados c where s.calsado_id=c.id  and  s.id={$articulo["surtido_id"]}");
              $surtido=mysql_fetch_assoc($res);

            ?>
            	<tr>
                <td>
                <?php echo $foto["title"]?>
                </td>
                    <td><img src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $foto["url"]?>" width="100" alt="<?php echo $foto["title"]?>" /></td>
                  	<td><?php echo $surtido["code"]?></td>                   
                    <td>
                    <?php 
                    if($articulo["tipo"]=="surtido_libre")
                    {
                        echo $articulo["unidades"]?>&nbsp;<?php ___("pares") ;
                    }
                    else
                    {
                        echo $articulo["bultos"]." ";
                            ___("cajas");
                        echo "/".$articulo["unidades"]." ".___("pares",1);
                    }?>
                    <div class="plus_minus">
                    
                    
                   <!--
                   <a href="<?php echo $this->webroot?>cliente/pedidos/minus/<?php echo $item?>"><img src="<?php echo $this->webroot?>images/list/ul-minus.png" title="<?php ___("Quitar")?>"/></a>
                    <a href="<?php echo $this->webroot?>cliente/pedidos/plus/<?php echo $item?>"><img src="<?php echo $this->webroot?>images/list/ul-plus.png" title="<?php ___("Aumentar")?>"/></a>--> 
                    </div>
                    </td>  
                    <td><?php echo $articulo["precio_unitario"]?> &euro;</td>
                    <td class="text-right">
                    <?php           
                    echo $t=get_total($articulo);
                    $total=$total+$t;?> &euro; 
                    <a style="cursor: pointer; overflow: hidden;" onclick="return confirm('<?php ___("Esta seguro de eliminar el Pedido")?>')" href="<?php echo $this->webroot?>cliente/articulos/delete/<?php echo $articulo["id"]?>">                    
                     &nbsp;   <img src="<?php echo $this->webroot?>images/list/ul-delete.png" title="<?php ___("Borrar")?>"/>
                    </a>
                    </td>                    
                </tr>
                <tr>
                <th colspan="6" style="background-color: #ECEDED;">
                <?php ___("Detalle cantidad")?>
                </th>
                </tr>
                <tr>
                <td colspan="6">
                    <?php
                    $ptm='';
                    $especificacion=json_decode($articulo["especificacion"]);                  
                    foreach($especificacion as $k=>$v)
                    $ptm.=$k."/".$v.", ";                    
                    echo substr($ptm,0,-2);
                  
                    ?>
                </td>
                </tr>
             <?php /* para los portes*/
             if($articulo["tipo"]=="surtido_libre")
             {
                $cajillas_portes=$cajillas_portes+$articulo["unidades"]/12;
             }else{
                $cajillas_portes=$cajillas_portes+$articulo["bultos"];
             }
             }?>
             </tbody>
            <tfoot>
            	<tr>                   
                    <td colspan="5"></td>
                    <td>
                    <div class="floatleft">                       
                         
                    	<strong>Sub total</strong><br/>
                        <?php
                     $taxx=Configure::read('tax'); $iva=0; $re=0;
                    if($_SESSION["Auth"]["Usuario"]["iva"]!='0')
                    {
                      $iva=$taxx["iva"];   
                    }                    
                     if($_SESSION["Auth"]["Usuario"]["re"]!='0')
                    {
                      $re=$taxx["re"];
                    }   
                        if($_SESSION["Auth"]["Usuario"]["iva"]=='0')
                         {
                            
                            $tax=$iva;
                            $taxtext="IVA";                            
                         }
                        if($_SESSION["Auth"]["Usuario"]["re"]=='0')
                         {
                            $tax=$iva+$re;
                            $taxtext="IVA + RE";
                         } 
                        
                        ?>
                        <strong><?php ___("Portes")?></strong><br />
                        <strong><?php ___("Impuesto")?> (<?php echo $taxtext?>) (<?php echo $tax?>%)</strong><br/>
                        
                        <strong style="font-size: 16px;">Total</strong>
                    </div>
                    <div class="floatright text-right">
                    	<?php echo number_format($total,2)?> &euro;<br/>
                        
                        <?php 
                         /*calculo de portes*/
                         $serializadoo = $provider["portes_txt"];
                        $serializadoo=unserialize($serializadoo);
                        
                         if($provider["portes"]=='bultos')
                         {
                            
                            ksort($serializadoo);    
                         
                            $cajillas_portes=ceil($cajillas_portes);
                            $cajillas_portes_orig=ceil($cajillas_portes);                            
                            $bandera=1;
                            $portres=0;
                            $reajustar=0;
                            while($bandera && $cajillas_portes>0)
                            {
                                if(isset($serializadoo[$cajillas_portes]) && $serializadoo[$cajillas_portes])
                                {
                                    $portres=$serializadoo[$cajillas_portes]*$cajillas_portes;
                                    $bandera=0;
                                }
                                else
                                {
                                $reajustar=1;
                                $cajillas_portes--;    
                                }
                                
                            }
                            
                            if($reajustar)
                            {
                                if($cajillas_portes*$cajillas_portes_orig > 0){
                                    $portres=$portres/$cajillas_portes*$cajillas_portes_orig;
                                }
                            }
                            
                         }
                         else
                         {
                            if(intval($total)>=intval($serializadoo["mayor"]))
                            {
                                $portres=0;
                            }
                            else
                            $portres=intval($serializadoo["porenvio"]);
                         }
                         echo number_format($portres,2);?> &euro;<br />
                      
                        
                         <?php 
                         $total=$total+$portres;
                         $impuesto=$total*$tax/100;
                         echo number_format($impuesto,2);?> &euro;<br />
                            
                        <label style="font-size: 16px;">
                         <?php echo number_format($total+$impuesto,2)?> &euro;
                         </label> 
                    </div>
                    <?  if($tamañ>1){?>
                    <br style="clear: both;" /> <br style="clear: both;" />
                     <a  style="clear: both; float: right; margin: 0;" class="button" href="<?php echo $this->webroot?>cliente/pedidos/canasta?pro=<?php echo $pedido["proveedor"]?>"><?php ___("Continuar")?></a>
                     <?php }?>
                  </td>
                </tr>
            </tfoot>
        </table>
        <?php

         if($tamañ<2)
        {        
         ?>
        <form  action="<?php echo $this->webroot?>cliente/pedidos/checkout" id="fform" method="post">
        <?php $Usuario->id=$_SESSION["Auth"]["Usuario"]["id"];?>
         <input type="hidden" name="proovedor" value="<?php echo $pedido["proveedor"]?>" />   
         <input type="hidden" name="pedido_id" value="<?php echo $pedido["id"]?>" />
              <table id="noborder">
              <tr>
                  <td><label><?php ___("Direc. de Fact.")?>:</label></td>
                  <td><textarea name="factura"><?php
                  echo trim($Usuario->field("dfac"));
                  ?></textarea></td>
                  <td><label><?php ___("Direc. de Entrega")?>:</label></td>
                  <td><textarea name="entrega"><?php
                  echo trim($Usuario->field("denv"));
                   ?></textarea></td>
                  <td><label><?php ___("Forma de Pago")?>:</label></td>
                  <td><select name="pay_method">
                       <!--
 <option><?php ___("Tarjeta de Cr&eacute;dito")?></option>
                        <option>PayPal</option>
-->
                        <option value="Transferencia Bancaria"><?php ___("Transferencia Bancaria")?></option>
                    </select>
                  </td>
               </tr>
               <tr>
               <td colspan="5"></td>
               <td>
               
               <a class="button" style="float: right;"  href="<?php echo $this->webroot?>"><?php ___("SEGUIR COMPRANDO")?></a>
              
                <a onclick="$('#fform').submit()" class="button" style="float: right;"><?php ___("PROCESAR ESTE PEDIDO")?></a>
              
                
               </td>
               </tr>
              </table>
              
        </form>
        <?php }?>
        <style>
        #noborder td,#noborder tr,#noborder tbody, #noborder { border: 0;}
        </style>
        
    </div>
    <?php }?>
      
</div>

 <?php }else{?> 
<div class="container">    


<div class="related" style=" padding: 20px;">

	<?php
     App::import('Model', 'Pedido');
     $Pedido = new Pedido();   
     $pedidos = $Pedido->find('all',array('conditions'=>array('Pedido.usuario_id'=>$_SESSION["Auth"]["Usuario"]["id"]
     ,'Pedido.confirmado'=>'1'),'order'=>'Pedido.id desc'));
     
     if (!empty($pedidos)):?>
    
	<table cellpadding = "0" cellspacing = "0" style="width: 100%;">
	<tr>
		<th><?php ___('# Pedido'); ?></th>	
        	<th><?php ___('Proveedor'); ?></th>
		<th><?php ___('Total Pedido'); ?> <br />(<?php ___("Base imponible")?>)</th>
        
        	<th><?php ___('Fecha Hora pedido'); ?></th>
            
     <!--
   <th>Articulo</th>
-->
		
		<th><?php ___('Estado'); ?></th>
		
		
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pedidos as $pedido):
        
			$pedido=$pedido["Pedido"];
            $class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pedido['id'];?></td>
            
            <td><?php 
            $sql="select title from usuarios where id={$pedido["proveedor"]}";
            $title=(mysql_fetch_assoc(mysql_query($sql)));
            echo $title["title"];?> 
            </td>
            
			<td><?php 
            $total=mysql_query("select sum(unidades*precio_unitario*bultos) as c from articulos where pedido_id={$pedido['id']}");
            $total=mysql_fetch_assoc($total);
            echo $total["c"]
            ?> &euro;</td>
            <td style="display: none;">
            <?php 
            App::import('Model', 'Foto');
            $Foto = new Foto();
            
            $total=mysql_query("select foto_id from articulos where pedido_id={$pedido['id']}");
                        
            while($foto=mysql_fetch_assoc($total))
            {
            $fotarra=$Foto->findbyId($foto['foto_id']);
            ?>
            <div style="overflow: hidden;">
            <img src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $fotarra["Foto"]["url"]?>" /><br />
            <?php echo $fotarra["Calsado"]["title"]; ?>
            </div>
            <?php }?>
            </td>
            <td><?php echo $pedido["tim"] ?> </td>
			<td>
              <?php
    $estado=___("Confirmar",1);
   if($pedido["confirmado"]=='1')// confirmado por el cliente
    $estado='<label style="color: red;">'.___("Confirmar",1).'</label>';
   
   if($pedido["existencias"]=='1')// confirmado por el cliente
    $estado='<label style="color:#AA30CA;">'.___("Revisando",1).'</label>';
    
   if($pedido["estado"]=='1')// confirmado por el procv
    $estado='<label style="color:green;">'.___("P.Ingreso",1).'</label>'; 
   
   if($pedido["esperando_mercancia"]=='1')// confirmado por el procv
    $estado='<label style="color:#E4C88F;">'.___("Mercanc&iacute;a pendiente",1).'</label>';
   
   if($pedido["enviado"]=='1')// confirmado por el procv
    $estado='<label style="color:blue;">'.___("Terminado",1).'</label>'; 
    
    if($pedido["anulado"]=='1')// confirmado por el procv
    $estado='<label style="color:black;">'.___("Anulado",1).'</label>';
    
    echo $estado;
    
    ?>
    
            </td>
			<td class="actions">
			<?php // echo $this->Html->link(___('Ver Detalle', true), array('controller' => 'articulos', 'action' => 'view', $pedido['id'])); ?>
            <?php  echo $this->Html->link(___('Ver Detalle', true), array('controller' => 'pedidos', 'action' => 'view', $pedido['id'])); ?>

			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>


</div>
<?php }?>
