<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/gestionnewsletter/listMessages">Mails</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div style="padding: 0 0 16px 0; overflow: hidden; width: 100%;">
<?php echo $html->link("Enviar Correo", array("action"=>"sendMessage"), array("class"=>"btn-admin-orange", "title"=>"Nuevo",'style'=>'padding:5px; display: block;')); ?>   
</div>


<div class="colors form" style="margin-bottom: 20px; display: none;">

<script type="text/javascript">
		Shadowbox.init({
			player:"html",
			overlayOpacity: 0.8
		});
	</script>

        <h2>Archivo de mensajes</h2>

    <hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</form>
</div>

<div id="admin-table">
	<h2>Mails</h2>
	<table cellpadding="0" cellspacing="0">
    <tr>
				<th><?php echo $paginator->sort('Asunto', 'title_spa'); ?></th>
			

               <!--
 <th><?php echo $paginator->sort('en cola', 'title_spa'); ?></th>
-->
                <th><?php echo $paginator->sort('grupo', 'title_spa'); ?></th>
                <th><?php echo $paginator->sort('mails enviados', 'title_spa'); ?></th>
               	<th><?php echo $paginator->sort('Fecha', 'title_spa'); ?></th>
                <td class="fix"></td>
			</tr>

	<?php
	$i = 0;
	  foreach($messages as $message):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
         else
        {
            	$class = ' class="noaltrow"';
        }
	?>
     <tr>
				<td><?php echo $message["Message"]["subject"]; ?></td>

                
              <!--
  <td><?php echo $message["Message"]["queued"]; ?></td>
-->
                <td><?php echo $message["Message"]["grupo"]; ?></td>
                <td><?php echo $message["Message"]["envios"]; ?></td>
                
                <td><?php echo $message["Message"]["created"]; ?></td>
                <td class="fix"></td>
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