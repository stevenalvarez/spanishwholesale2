<?php
//print_r($articulos);
//exit();
//
?>
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/articulos/index">Mi lista de Pedidos </a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div id="admin-table" style="margin-bottom: 20px;">
	<h2>Pedidos</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('#','id');?></th>
            <th><?php echo $this->Paginator->sort('Registro','tim');?></th>
			<th><?php echo $this->Paginator->sort('Calsado','surtido_id');?></th>
            
		    <th><?php echo $this->Paginator->sort('cliente','Usuario.title');?></th>  
		      <th><?php echo $this->Paginator->sort('importe','subtotal');?></th>
		
            <th>Proveedor</th>
		    <th>Estado</th>
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
    App::import('Model', 'Calsado');    
    $CalsadoM = new Calsado();
    
    
    
	foreach ($articulos as $articulo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        	$class = ' class="noaltrow"';
      //  print_r($calsado);
        
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $articulo['Articulo']['id']; ?>&nbsp;</td>
        <td><?php echo $articulo['Articulo']['tim']; ?>&nbsp;</td>
		<td>
			<?php
            $CalsadoM->recursive=0;
            $calsado=$CalsadoM->find( 'first',array('conditions'=>array('Calsado.id'=>$articulo['Surtido']['calsado_id'])));
                 
             echo $calsado['Calsado']['title'];
             
              ?>
             
		</td>
        <td><?php echo $articulo['Pedido']['Usuario']['title']; ?>&nbsp;</td>

		<td><?php echo $articulo['Articulo']['total_pedidos']; ?>&nbsp;&euro;</td>
        <td><?php echo $calsado['Usuario']['title']; ?>&nbsp;</td>
        <td><?php 
        $estado="<label style='color: #9c00ff;'>Revisar</label>";
        if($articulo['Articulo']['confirmado']=='1')
        $estado="<label style='color: #9cb864;'>Confirmado</label>";
        if($articulo['Articulo']['esperando_mercancia']=='1')
        $estado="<label style='color: #ff9c00;'>Esperando Mercanc&iacute;a</label>";
        if($articulo['Articulo']['enviado']=='1')
        $estado="<label>Enviado</label>";
        if($articulo['Articulo']['anulado']=='1')
        $estado="<label style='color: #ff0000;'>Anulado</label>";
        echo $estado; 
         ?>&nbsp;</td>
	
		<td class="actions">
			<a href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/articulos/edit/<?php echo $articulo['Articulo']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>
            <a title="mail al cliente" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/usuarios/smail/<?php echo $articulo['Pedido']['Usuario']['id'] ?>"><?php echo $html->image('letter.png') ?></a>
            <a href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/articulos/delete/<?php echo $articulo['Articulo']['id'] ?>"><?php echo $html->image('x.png') ?></a>
		</td>
        <td class="fix"></td>
	</tr>
<?php endforeach; ?>


        <tr class="clear">
            <td colspan="9">
            <?php
            	echo $this->Paginator->counter(array(
            	'format' => __('P&aacute;gina %page% de %pages%', true)
            	));
            	?>
            	<div class="paging">
            		<?php echo $this->Paginator->prev("<img src='".$this->webroot."img/admin-previus.png'/>", array('escape'=>false,'class'=>'nav_btn'), null, array('class'=>'disabled'));?>
                    <?php echo $this->Paginator->numbers(array('separator'=>'&nbsp;&nbsp;'));?>
                    <?php echo $this->Paginator->next("<img src='".$this->webroot."img/admin-next.png'/>" , array('escape'=>false,'class'=>'nav_btn'), null, array('class' => 'disabled'));?>
            	</div>
            
            
            </td>
        </tr>
        <tr class="clear">
            <td colspan="9">
            <p style="text-align: center; font-size: 13px; font-weight: bold; color: #1f476f; font-family: Arial;">
            TOTAL PEDIDOS = <?php echo $cuantos ?>&nbsp;&nbsp;&nbsp; /&nbsp;&nbsp;&nbsp; SUMA = <?php echo $suma ?> &nbsp;&nbsp;&nbsp; /  &nbsp;&nbsp;&nbsp;5% <?php echo ($suma*5)/100 ?>
            </p>
            </td>
        </tr>
	</table>
	</div>    
    <div class="admin-search pedidos">
        <h2>B&uacute;squeda de Pedidos</h2>
        <form method="post" action="?search=1">
        <h3>Pedidos de Clientes</h3>
            <table>
                <tr><td>Id Cliente</td><td>Nombre de Cliente</td><td></td><td></td> </tr>
                <tr><td><input size="30" name="cliente_id" type="text" /></td><td> <input size="30" name="cliente_nombre" type="text" /> </td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" /></td></tr>
            </table>
        </form>
        
        <h3>Por n&uacute;mero de pedido</h3>
        <table>
        <tr>
        <td>
            <input type="text" />&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="BUSCAR" class="btn-admin-orange" />
          </td>  
        </tr> </table>           
        </div>
        
            
              
    </div>
    
    