<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/pedidos/index/sort:id/direction:desc">Nuevo Pedidos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side" style="padding: 0;">

<div id="admin-table" style="margin-bottom: 20px; clear: both;">
<h2>  Busquedas de pedidos</h2>
<table>
    <tr>
    <td colspan="3"></td>
    </tr>
    <tr >
        <td style="vertical-align: top;">
        <form style="text-align: center;" method="post">
        <input  type="hidden" name="form" value="1"/>
            id de cliente<br />
            <input value="<?php echo isset($_POST["cliente_id"])?$_POST["cliente_id"]:'' ?>"  type="text " name="cliente_id"/><br /><br />
            nombre de cliente<br />
            <input value="<?php echo isset($_POST["cliente"])?$_POST["cliente"]:'' ?>"  type="text " name="cliente"/><br /><br />
            <input type="submit" value="BUSCAR" class="btn-admin-orange"/>
        </form>        
        </td>
        <td width='333' style="vertical-align: top;">
        <form method="post">
        <input  type="hidden" name="form" value="2"/>
        <div style="width: 50%; float: left; text-align: center;">
        Meses<br />
            <select name="mes" >
            <option value="">Seleccione</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='01'?'selected="selected"':'' ?> value="01">Enero</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='02'?'selected="selected"':'' ?> value="02">Febrero</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='03'?'selected="selected"':'' ?> value="03">Marzo</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='04'?'selected="selected"':'' ?> value="04">Abril</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='05'?'selected="selected"':'' ?> value="05">Mayo</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='06'?'selected="selected"':'' ?> value="06">Junio</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='07'?'selected="selected"':'' ?> value="07">Julio</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='08'?'selected="selected"':'' ?> value="08">Agosto</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='09'?'selected="selected"':'' ?> value="09">Septiembre</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='10'?'selected="selected"':'' ?> value="10">Octubre</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='11'?'selected="selected"':'' ?> value="11">Noviembre</option>
            <option <?php echo isset($_POST["mes"])&&$_POST["mes"]=='12'?'selected="selected"':'' ?> value="12">Diciembre</option>
            </select>     
            <br /><br />
            
            Confirmaciones <br />
            <select name="confimado" >
                <option value="">Todos</option>
                <option <?php echo isset($_POST["confimado"])&&$_POST["confimado"]=='1'?'selected="selected"':'' ?> value="1">Confirmados</option>
                <option <?php echo isset($_POST["confimado"])&&$_POST["confimado"]=='n'?'selected="selected"':'' ?> value="n">Sin confirmar</option>            
            </select>
            <br /><br />
            Envios <br />
            <select name="enviado" >
                <option value="">Todos</option>
                <option <?php echo isset($_POST["enviado"])&&$_POST["enviado"]=='1'?'selected="selected"':'' ?> value="1">Enviados</option>
                <option <?php echo isset($_POST["enviado"])&&$_POST["enviado"]=='n'?'selected="selected"':'' ?> value="n">No enviados</option>            
            </select>            
            
            
        </div>
        <div style="width: 50%; float: left; text-align: center;">
        A&ntilde;o<br />
            <select name="ano" >
            <option value="">Seleccione</option>
                <option <?php echo isset($_POST["ano"])&&$_POST["ano"]=='2013'?'selected="selected"':'' ?> value="2013">2013</option>
                <option <?php echo isset($_POST["ano"])&&$_POST["ano"]=='2014'?'selected="selected"':'' ?> value="2014">2014</option>
                <option <?php echo isset($_POST["ano"])&&$_POST["ano"]=='2015'?'selected="selected"':'' ?> value="2015">2015</option>            
            </select>
            <br /><br />
        Cobros <br />
            <select name="cobrado" >
                <option value="">Todos</option>
                <option <?php echo isset($_POST["cobrado"])&&$_POST["cobrado"]=='1'?'selected="selected"':'' ?> value="1">Cobrados</option>
                <option <?php echo isset($_POST["cobrado"])&&$_POST["cobrado"]=='n'?'selected="selected"':'' ?> value="n">No cobrados</option>            
            </select>    
            
         <br /><br />
            Anulados <br />
            <select name="anulado" >
                <option value="">Todos</option>
                <option <?php echo isset($_POST["anulado"])&&$_POST["anulado"]=='1'?'selected="selected"':'' ?> value="1">Anulados</option>
                <option <?php echo isset($_POST["anulado"])&&$_POST["anulado"]=='n'?'selected="selected"':'' ?> value="n">No anulados</option>            
            </select>      
            
        
        </div>
       
        <div style="text-align: center; clear: both;"> <br />
        Proveedor<br />
        <?php

        $value='';
        if(isset($_POST["data"]["proveedor"]))
        $value=$_POST["data"]["proveedor"];
        
        echo $this->Form->select('proveedor',$proveedores,null,array('value'=>$value,'empty'=>'Seleccione'));?>
        <br />
        <br />
        <input type="submit" value="BUSCAR" class="btn-admin-orange">
        </div>       
        
        </form>         
        </td>
        <td style="vertical-align: top;">
      <form style="text-align: center;" method="post">
        <input  type="hidden" name="form" value="3"/>
        B&uacute;squeda por n&uacute;mero de pedido<br />
        
        <input  type="text" value="<?php echo isset($_POST["pedido"])?$_POST["pedido"]:'' ?>" name="pedido"/><br /><br />
        
        <input type="submit" value="BUSCAR" class="btn-admin-orange">
        </form>     
        
        </td>
    </tr>
    <tr class="clear">
    <td colspan="3"><a style="display: inline-block;color:#fff; font-size: 11px; text-decoration: none; text-align: center; width: 64px;" href="<?php echo $this->webroot;?>proveedor/pedidos/index/page:0/sort:id/direction:desc" class="btn-admin-orange">LIMPIAR</a></td>
    </tr>
</table>
</div>



<div id="admin-table" style="clear: both;">





	<h2>Listado de Pedidos</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort( utf8_encode('Número'),'id');?></th>
            <th><?php echo $this->Paginator->sort('fecha pedido','tim');?></th>
			<th><?php echo $this->Paginator->sort('Cliente','usuario_id');?></th>
		<!--
	<th><?php echo $this->Paginator->sort('re');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('portes');?></th>
-->
			<th>Base imponible</th>
            <th>Total</th>
		    <th>Recibo</th>
			<th>Estado</th>
			<th class="actions">Acciones</th>
            <td char="fix"></td>
	</tr>
	<?php
	$i = 0;
    
     App::import('Model', 'Pedido');
    $PedidoModel = new Pedido();   
    
	foreach ($pedidos as $pedido):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        {
            	$class = ' class="noaltrow"';
        }
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pedido['Pedido']['id']; ?>&nbsp;</td>
        <td><?php echo $pedido['Pedido']['tim'] ?>&nbsp;</td>
		<td>
			<?php echo $pedido['Usuario']['title'] ?>
		</td>
        
	<!--
	<td><?php echo $pedido['Pedido']['re']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['iva']; ?>&nbsp;</td>
		<td><?php echo $pedido['Pedido']['portes']; ?>&nbsp;</td>
-->
		<td><?php
        echo $PedidoModel->calcularTotalneto($pedido['Pedido']['id']);
        ?> &euro;</td>
		<td style="width: 60px;"><?php
        echo $PedidoModel->calcularTotal($pedido['Pedido']['id']);
        ?> &euro;</td>        
    <td>
    <?php
    $prov=$PedidoModel->query("Select title from usuarios where id={$pedido['Pedido']['proveedor']}");
    echo   $prov[0]['usuarios']['title'];
    ?>
    </td>
    <td>
    
    <?php
      $estado='Confirmar';
   if($pedido['Pedido']["confirmado"]=='1')// confirmado por el cliente
    $estado='<label style="color: red;">Confirmar</label>';
   
   if($pedido['Pedido']["existencias"]=='1')// confirmado por el cliente
    $estado='<label style="color:#AA30CA;">Revisando</label>';
    
   if($pedido['Pedido']["estado"]=='1')// confirmado por el procv
    $estado='<label style="color:green;">P.Ingreso</label>'; 
   
   if($pedido['Pedido']["esperando_mercancia"]=='1')// confirmado por el procv
    $estado='<label style="color:#E4C88F;">Mercanc&iacute;a pendiente</label>';
   
   if($pedido['Pedido']["enviado"]=='1')// confirmado por el procv
    $estado='<label style="color:blue;">Terminado</label>'; 
    
   if($pedido['Pedido']["anulado"]=='1')// confirmado por el procv
    $estado='<label style="color:black; font-weight:bold;">Anulado</label>';
    echo $estado;
    
    ?>
    
    </td>
    
        <td class="actions">
			<a href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/pedidos/edit/<?php echo $pedido['Pedido']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>
            <a title="mail al cliente" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/usuarios/smail/<?php echo $pedido['Usuario']['id'] ?>"><?php echo $html->image('letter.png') ?></a>
            <a onclick="return confirm('Esta seguro de eliminar el pedido <?php echo $pedido['Pedido']['id']; ?>')" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/pedidos/delete/<?php echo $pedido['Pedido']['id'] ?>"><?php echo $html->image('x.png') ?></a>
            <?php if($pedido['Pedido']["mensaje"]=='1'){ ?>
            <img src="<?php echo $this->webroot?>img/mail.gif" width="12"/><?php } ?>
            
		</td>
        
        <td char="fix"></td>
	</tr>
<?php endforeach; ?>

<tr class="clear">
<td colspan="7">
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

</td></tr>

	</table>
</div>

</div>
















