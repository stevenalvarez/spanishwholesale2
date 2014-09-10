
<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/plantillas/index">Listado de plantillas de mails</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<a style="display: block; clear: both; padding: 6px; text-align: center;  " class="btn-admin-orange2" href="<?php echo $this->webroot?>admin/plantillas/add">Nueva plantilla</a>
<br />
<div id="admin-table" class="userlogs index">
	<h2>Plantillas</h2>



<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
		
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($plantillas as $plantilla): ?>
	<tr>
		<td><?php echo $plantilla['Plantilla']['id']; ?>&nbsp;</td>
	
		<td><?php echo $plantilla['Plantilla']['nombre']; ?>&nbsp;</td>
		
		<td>
			<?php echo $this->Html->link('<i class="icon-search icon-white"></i> Ver', array('action' => 'view', $plantilla['Plantilla']['id']),array('class'=>'iframe btn btn-info','escape'=>false)); ?>
			<?php echo $this->Html->link('<i class="icon-edit"></i> Editar', array('action' => 'edit', $plantilla['Plantilla']['id']),array('class'=>'iframe btn btn','escape'=>false,'target'=>'_blank')); ?>
			<?php echo $this->Html->link('<i class="icon-search icon-remove"></i> Eliminar', array('action' => 'delete', $plantilla['Plantilla']['id']),array('class'=>'btn btn-danger','escape'=>false), __('Are you sure you want to delete # %s?', $plantilla['Plantilla']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>

</div></div>