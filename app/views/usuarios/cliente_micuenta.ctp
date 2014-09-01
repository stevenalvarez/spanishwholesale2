<link href="<?php echo $this->webroot?>css/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>

<script>

jQuery(function(){
    $(".fancybox").fancybox();
    $("#cambiarpassword").validationEngine();
    
    //marcamos la final de otro color
    $("#consultas_realizadas").find("span.marcar").css("font-weight","bold");
    $("#consultas_realizadas").find("span.marcar").parent().parent().css("background","#ddd");
    
    });
</script>

<div class="container" style="margin: auto;  margin: auto;    padding-left: 10px;    width: 960px;">
<div class="span-24">
<div class="span-12"style="padding-left: 20px;">
<h2><?php  ___('Cliente');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
	
    	<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Compa&ntilde;ia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['company'] != "" ? $usuario['Usuario']['company'] : "-"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Nombres y apellidos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['title'] != "" ? $usuario['Usuario']['title'] : "-"; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['email'] != "" ? $usuario['Usuario']['email'] : "-"; ?>
			&nbsp;
		</dd>
        <!--
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['direccion'] != "" ? $usuario['Usuario']['direccion'] : "-"; ?>
			&nbsp;
		</dd>
                		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n 2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['direccion2'] != "" ? $usuario['Usuario']['direccion2'] : "-"; ?>
			&nbsp;
		</dd>
        -->
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Pais'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['country'] != "" ? $usuario['Usuario']['country'] : "-"; ?>
			&nbsp;
		</dd>

        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Ciudad/Pueblo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['city'] != "" ? $usuario['Usuario']['city'] : "-"; ?>
			&nbsp;
		</dd> 
        <!--
                		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Condado/Provincia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['countyprovince'] != "" ? $usuario['Usuario']['countyprovince'] : "-"; ?>
			&nbsp;
		</dd> 
        -->
        
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('C&oacute;digo Postal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['codigo_postal'] != "" ? $usuario['Usuario']['codigo_postal'] : "-"; ?>
			&nbsp;
		</dd>

        
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Tel&eacute;fono'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['telefonos'] != "" ? $usuario['Usuario']['telefonos'] : "-"; ?>
			&nbsp;
		</dd>
        
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['fax'] != "" ? $usuario['Usuario']['fax'] : "-"; ?>
			&nbsp;
		</dd>
        
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('IVA'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['nit'] != "" ? $usuario['Usuario']['nit'] : "-"; ?>
			&nbsp;
		</dd>
        
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n de envio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['denv'] != "" ? $usuario['Usuario']['denv'] : "-"; ?>
			&nbsp;
		</dd>
        		<dt<?php if ($i % 2 == 0) echo $class;?>><?php ___('Direcci&oacute;n de Facturaci&oacute;n'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usuario['Usuario']['dfac'] != "" ? $usuario['Usuario']['dfac'] : "-"; ?>
			&nbsp;
		</dd>

        
	</dl>

</div>

<a class="button buy" href="<?php echo $this->webroot?>cliente/usuarios/edit"><?php ___("Editar mis datos")?></a>
<a class="button buy fancybox" href="#cambiar"><?php ___("Cambiar mis password")?></a>

    <div style="display: none;">
    <div id="cambiar">
        <form id="cambiarpassword" method="post">
        <table>
            <tr><td>Antiguo password</td>  <td> <input value="" class="validate[required]" id="asdfas" name="old_p" type="password"/></td></tr>
            <tr><td>Password</td><td>           <input class="validate[required]" id="UsuarioPasswordUsuarioPassword" name="new_p" type="password"/></td></tr>
            <tr><td>Repite tu password</td><td> <input class="validate[required,equals[UsuarioPasswordUsuarioPassword]]" id="asdf" name="new_p" type="password"/></td></tr>
        </table>
        <a class="button" title="comprar" onclick="$(this).parent('form').submit();"><?php echo ___("Cambiar")?></a>
        </form>
        </div>
    </div>
</div>

<div class="related" style="display: none;">

	<?php if (!empty($pedidos)):?>
    	<h3><?php __('Pedidos Cursados');?></h3>
	<table cellpadding = "0" cellspacing = "0" style="width: 95%;">
	<tr>
		<th><?php ___('# Pedido'); ?></th>	
		<th><?php ___('Total Pedido'); ?> <br />(<?php ___("Base imponible")?>)</th>
     <!--
   <th>Articulo</th>
-->
		
		<th><?php ___('Confirmado'); ?></th>
		<th><?php ___('Esperando Mercancia'); ?></th>
		<th><?php ___('Enviado'); ?></th>
		<th><?php ___('Anulado'); ?></th>
		
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
            $total=mysql_query("select sum(base_imponible) as c from articulos where pedido_id={$pedido['id']}");
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
            <img src="<?php echo $this->webroot?>img/Foto/mini/<?php echo $fotarra["Foto"]["url"]?>" /><br />
            <?php echo $fotarra["Calsado"]["title"]; ?>
            </div>
            <?php }?>
            </td>
		
			<td><?php echo $pedido['confirmado']=='1'?___('Si'):"No";?></td>
			<td><?php echo $pedido['esperando_mercancia']=='1'?___('Si'):"No";?></td>
			<td><?php echo $pedido['enviado']=='1'?___('Si'):"No";?></td>
			<td><?php echo $pedido['anulado']=='1'?___('Si'):"No";?></td>
			<td class="actions">
			<?php // echo $this->Html->link(___('Ver Detalle', true), array('controller' => 'articulos', 'action' => 'view', $pedido['id'])); ?>
            <?php  echo $this->Html->link(___('Ver Detalle', true), array('controller' => 'pedidos', 'action' => 'view', $pedido['id'])); ?>

			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>

<?php if(!empty($consultas)): ?>
    <div id="consultas_realizadas" class="span-12"style="padding-left: 20px;width: 100%;">
    <h2><?php  ___('Consultas');?></h2>
    	<table cellpadding="0" cellspacing="0" style="width: 95%;">
    	<tr>
    			<th><?php echo __('id');?></th>
    			<th><?php echo __('usuario');?></th>
    			<th><?php echo __('proveedor');?></th>
    			<th><?php echo __('calsado');?></th>
    			<th><?php echo __('consulta');?></th>
    			<th><?php echo __('Fecha Hora');?></th>
    			<th class="actions"><?php __('Actions');?></th>
    	</tr>
    	<?php
    	$i = 0;
    	foreach ($consultas as $consulta):
    		$class = null;
    		if ($i++ % 2 == 0) {
    			$class = ' class="altrow"';
    		}
    	?>
    	<tr<?php echo $class;?>>
    		<td><?php echo $consulta['Consulta']['id']; ?>&nbsp;</td>
    		<td>
    			<?php echo $this->Html->link($consulta['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'micuenta')); ?>
    		</td>
    		<td>
                <a href="<?php echo $this->webroot?>?provider=<?php echo $consulta['Proveedor']['title'];?>"><?php echo $consulta['Proveedor']['title']; ?></a>
    		</td>
    		<td>
                <a href="<?php echo $this->webroot?>item/<?php echo $consulta["Calsado"]["id"] ?>/<?php echo $consulta["Calsado"]["code"]?>/<?php echo "random"?>"><?php echo $consulta["Calsado"]["code"];?></a>
            </td>
    		<td><?php echo $consulta['Consulta']['consulta']; ?>&nbsp;</td>
    		<td><?php echo $consulta['Consulta']['tim']; ?>&nbsp;</td>
    		<td>
    			<?php echo $this->Html->link(__('Eliminar', true), array('cliente' => true, 'controller' => 'consultas', 'action' => 'delete', $consulta['Consulta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consulta['Consulta']['id'])); ?>
    		</td>
    	</tr>
            <?php if(!empty($consulta["Respuesta"])):?>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="color: #000;font-weight: bold;"><?php echo ___("respuestas");?></td>
                    <td>
                    <?php foreach($consulta["Respuesta"] as $key => $respuesta): ?>
                        <span class="<?php echo $respuesta["leido"] == "0" ? "marcar":""?>">
                        <?php echo ($key+1); ?>.- <?php echo $respuesta["respuesta"]; ?><br />
                        </span>
                    <?php endforeach; ?>
                    </td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    	</table>
    </div>
<?php endif; ?>

</div>