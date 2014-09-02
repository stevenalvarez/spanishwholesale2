<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/translates/index">Inicio</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">


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

	<h2><?php __('Traducciones');?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>

<th><?php echo $this->Paginator->sort('num','id');?></th>

			<th><?php echo $this->Paginator->sort('Espa','esp');?></th>
			<th><?php echo $this->Paginator->sort('Eng','eng');?></th>
			<th class="actions"><?php __('Opciones');?></th>
            <td class="fix"></td>
	</thead>
	<?php
	$i = 0;
	foreach ($translates as $translate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	<td><?php echo $translate['Translate']['id']; ?>&nbsp;</td>

		<td><?php echo $translate['Translate']['esp']; ?>&nbsp;</td>
		<td><?php echo $translate['Translate']['eng']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(utf8_encode('Traducción'), array('action' => 'edit', $translate['Translate']['id']),array("class"=>"btn-admin-orange",'encode'=>'false')); ?>
		</td>
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

