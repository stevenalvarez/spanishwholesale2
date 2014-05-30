<div class="container">
<h2><?php  ___('Pedido');?></h2>

	<div class="span-12">
    <dl class="span-12"><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('N&uacute;mero de pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Cliente'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pedido['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'micuenta', $pedido['Usuario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
    </div>
    <div class="span-12 last">
    <dl  class="span-12 last">	
        
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Total Pedido'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['total_pedido']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Forma Pago'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['forma_pago']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n de Facturac&oacute;n'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['di_factura']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n de Env&iacute;o'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pedido['Pedido']['di_envio']; ?>
			&nbsp;
		</dd>
	</dl>
    </div>
</div>

<div class="container">
	<h3><?php __('Art&iacute;culos del pedido');?></h3>
	<?php if (!empty($pedido['Articulo'])):?>
	<table cellpadding = "0" cellspacing = "0">
	 <thead><tr>
	
		<th><?php ___('Item'); ?></th>
        <th><?php ___('Nombre'); ?></th>
        <th><?php ___('Foto'); ?></th>
		
		<th><?php ___('Cantidad'); ?></th>
		<th><?php ___('Especificacion'); ?></th>
		<th><?php ___('Descuento'); ?></th>
        <th><?php ___('Art&iacute;culo Subtotal'); ?></th>
	</tr>
    </thead>
	<?php
		$i = 0;
         App::import('Model', 'Calsado');
       $Calsado = new Calsado();
       $total=0; 
		foreach ($pedido['Articulo'] as $articulo):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
//       
//       App::import('Model', 'Calsado');
//       $Calsado = new Calsado();   
       $Calsad = $Calsado->find('first',array('conditions'=>array('Surtido.id'=>$articulo['surtido_id']),'joins'=>array(
               array('table' => 'surtidos',
                'alias' => 'Surtido',
                'type' => 'RIGHT',
                'conditions' => array('Calsado.id =Surtido.calsado_id')),),));
    //   print_r($Calsado);     
		?>
		<tr<?php echo $class;?>>			
            <td><a href="<?php echo $this->webroot?>item/<?php echo $Calsad['Calsado']['id'] ?>">  <?php echo $Calsad['Calsado']['code'];?> </a></td>
			<td><?php echo $Calsad['Calsado']['title'];?></td>
            <td><img src="<?php echo $this->webroot?>img/Foto/mini/<?php echo $Calsad["Foto"]["0"]["url"]?>"/> </td>
			<td><?php echo $articulo['cantidad'];?></td>
			<td><?php echo $articulo['especificacion'];?></td>
			<td><?php echo $articulo['descuento']?___("Si"):"No";?></td>
            <td><?php echo $articulo['subtotal'];?></td>
		</tr>
	<?php 
    $total=$total+$articulo['subtotal'];
    
    endforeach; ?>
        <tr><td colspan="5">  </td><td>SubTotal</td><td><?php echo $total?></td> </tr>
    <tr><td colspan="5">  </td><td>Impuestos</td><td><?php echo $total*($pedido['Pedido']['iva']+$pedido['Pedido']['re'])/100?></td> </tr>
    <tr><td colspan="5">  </td><td>Total</td><td><?php echo $pedido['Pedido']['total_pedido']?></td> </tr>
            
    
	</table>
<?php endif;

// print_r($pedido);
 ?>

</div>
