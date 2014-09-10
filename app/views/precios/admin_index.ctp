<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/precios/index">Gesti&oacute;n de precios(menu)</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div style="padding: 0 0 16px 0; overflow: hidden; width: 100%;">
<input id="showbutton" type="submit" onclick="$('.form').slideDown('',function(){$('#showbutton').parent().slideUp()})" value="A&Ntilde;ADIR PRECIO NUEVO" class="btn-admin-orange2" name="step">   
</div>

<div class="colors form" style="margin-bottom: 20px; display: none;">
<h2>Registro nuevo rango de precios</h2>
<?php echo $this->Form->create('Precio',array('action'=>'add'));?>
	<fieldset>
	<?php
	echo $this->Form->input('de',array('label'=>'precio inferior &euro;*','class'=>'validate[required]'));
		echo $this->Form->input('a',array('label'=>'precio superior &euro;*','class'=>'validate[required]'));
	?>
	</fieldset>
    <hr />
<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SALVAR" />
</div>
</form>
</div>

<div id="admin-table">
	<h2>Rangos de precios</h2>
    
    <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Precio Inferior','de');?></th>
			<th><?php echo $this->Paginator->sort('Precio Superior','a');?></th>
			<th class="actions"><?php __('Acciones');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($precios as $precio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $precio['Precio']['id']; ?>&nbsp;</td>
		<td><?php echo $precio['Precio']['de']; ?>&nbsp;&euro;</td>
		<td><?php echo $precio['Precio']['a']; ?>&nbsp;&euro;</td>
		  <td class="actions">
		<a href="<?php echo $this->webroot?>admin/precios/edit/<?php  echo $precio['Precio']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>        
        <a onclick="return confirm('Esta seguro de eliminar el color <?php echo $precio['Precio']['id']; ?>')" href="<?php echo $this->webroot?>admin/precios/delete/<?php echo  $precio['Precio']['id'] ?>"><?php echo $html->image('x.png') ?></a>	
		</td>
        <td class="fix"></td>
	</tr>
    <tr></tr>
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
    
 
	
