<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/consultas/index/sort:id/direction:desc">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/consultas/lista">Listado de Consultas</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side" style="padding: 0;">
<div id="admin-table" style="min-height: 100px;">
<h2>Consulta</h2>
	<table cellpadding="0" cellspacing="0">
	<tr class="clear">
        <td colspan="7" style="padding-left: 0;">
            <div class="respuesta">
                <p><?php echo nl2br($consulta['Consulta']['consulta']);?></p>
            </div>
        </td>
	</tr>
    </table>
</div>

<div id="admin-table" style="clear: both;margin-top:10px">

	<h2>Listado de Respuestas</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort( utf8_encode('Numero'),'id');?></th>
            <th>Asunto</th>
			<th>Respuesta</th>
            <th><?php echo $this->Paginator->sort('fecha respuesta','tim');?></th>
            <th>Re-Enviado</th>
            <th class="actions">Acciones</th>
	</tr>
	<?php
	$i = 0;
    
	foreach ($respuestas as $respuesta):
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
		<td><?php echo $respuesta['Respuesta']['id']; ?>&nbsp;</td>        
		<td><?php echo $respuesta['Respuesta']['title']; ?></td>
        <td><?php echo $respuesta['Respuesta']['respuesta']; ?></td>
        <td><?php echo $respuesta['Respuesta']['tim'] ?>&nbsp;</td>
        <td style="text-align: center;">
            <?php if($respuesta['Respuesta']['reenviado']){ ?>
                <b style="color: green;">SI</b>
            <?php }else{ ?>
                NO
            <?php } ?>
        &nbsp;</td>
        <td class="actions" style="text-align: center;">
            <a style="color: #590000;font-weight: bold;" title="RE-ENVIAR RESPUESTA" onclick="return confirm('Esta seguro de quieres re-enviar la respuesta <?php echo $respuesta['Respuesta']['id']; ?>')" href="<?php echo $this->webroot?><?echo $_SESSION["Auth"]["Usuario"]["rol"]?>/respuestas/reenviar/<?php echo $respuesta['Respuesta']['id'] ?>">
                <?php if($respuesta['Respuesta']['reenviado']){ ?>
                    <b style="color: green;">Re-Enviar</b>
                <?php }else{ ?>
                    Re-Enviar
                <?php } ?>
            </a>            
		</td>
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