<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/userlogs/index/sort:id/direction:desc">LOGS</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="admin-search">
<h2>B&uacute;squeda de logs</h2>
<form method="post" action="?search=true">
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" name="like" value="<?php echo isset($_POST["like"])?$_POST["like"]:''?>" /></td>
<td>
<select name="criterio">
    <option value="title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='title'?'selected="selected"':''  ?>>Nombre</option>
    <option value="email" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='email'?'selected="selected"':''  ?>>Email</option>
    <option value="telefonos" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='telefonos'?'selected="selected"':''  ?>>Telefonos</option>
    
</select>
</td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" />
<a style="display: inline-block; font-size: 11px; text-decoration: none; text-align: center; width: 64px;" href="<?php echo $this->webroot;?>admin/userlogs/index/" class="btn-admin-orange">LIMPIAR</a>
</td></tr>
</table>
</form>

</div>
<div class="userlogs index" id="admin-table">
	<h2><?php
    if(isset($_GET["user"]))
    {
     $current_user= current($userlogs);
      __(utf8_encode('Log histórico')); echo " de ".$current_user['Usuario']['title'];  
    }
    else   __(utf8_encode('Logs histórico'));
     ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('usuario_id');?></th>
			<th><?php echo $this->Paginator->sort('operacion');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($userlogs as $userlog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $userlog['Userlog']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $userlog['Usuario']['title']; ?>
		</td>
		<td><?php echo $userlog['Userlog']['operacion']; ?>&nbsp;</td>
		<td><?php echo $userlog['Userlog']['tim']; ?>&nbsp;</td>
		<td class="actions">
			<!--<?php echo $this->Html->link(__('View', true), array('action' => 'view', $userlog['Userlog']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $userlog['Userlog']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $userlog['Userlog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userlog['Userlog']['id'])); ?>-->
            <a onclick="<?php __('Are you sure you want to delete # %s?', true);?>" href="<?php echo $this->webroot?>admin/userlogs/delete/<?php echo $userlog['Userlog']['id'] ?>"><?php echo $html->image('x.png') ?></a>
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
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?><?php echo $this->Paginator->numbers();?><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</td></tr>





	</table>
	
</div>

</div>