
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/paginas/index">Listado de p&aacute;ginas</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div style="padding: 0 0 16px 0; overflow: hidden; width: 100%;">

<a  style="display: block; padding: 6px; text-align: center;"  class="btn-admin-orange2" href="<?php echo $this->webroot?>admin/Paginas/add">Nueva Pagina</a>   
</div>

<div id="admin-table" class="userlogs index">
	<h2>Paginas</h2>



<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
		
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($Paginas as $Pagina): ?>
	<tr>
		<td><?php echo $Pagina['Pagina']['id']; ?>&nbsp;</td>
	
		<td><?php echo $Pagina['Pagina']['nombre']; ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link('<i class="icon-search icon-white"></i> Ver', array('action' => 'view', $Pagina['Pagina']['id']),array('class'=>'iframe btn btn-info','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="icon-edit"></i> Editar', array('action' => 'edit', $Pagina['Pagina']['id']),array('class'=>'iframe btn btn','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="icon-search icon-remove"></i> Eliminar', array('action' => 'delete', $Pagina['Pagina']['id']),array('class'=>'btn btn-danger','escape'=>false), __('Are you sure you want to delete # %s?', $Pagina['Pagina']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div></div>