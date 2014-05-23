<div class="groupContacts index">
<h2><?php __('Grupos de Suscriptores');?></h2>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('', true), array('action' => 'add'),array('class'=>'btn_nuevo')); ?></li>
	</ul>
</div>
<br /><br /><br /><br />
<table cellpadding="0" cellspacing="0" class="listado">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name_group');?></th>
	<th><?php echo $paginator->sort('sql');?></th>
	<th><?php echo $paginator->sort('table');?></th>
	<th><?php echo $paginator->sort('descripcion');?></th>
	<th><?php echo $paginator->sort('replaces');?>/chars</th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($groupContacts as $groupContact):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $groupContact['GroupContact']['id']; ?>
		</td>
		<td>
			<?php echo $groupContact['GroupContact']['name_group']; ?>
		</td>
		<td>
			<?php echo $groupContact['GroupContact']['sql']; ?>
		</td>
		<td>
			<?php echo $groupContact['GroupContact']['table']; ?>
		</td>
		<td>
			<?php echo $groupContact['GroupContact']['descripcion']; ?>
		</td>
		<td>
			<?php echo $groupContact['GroupContact']['replaces']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $groupContact['GroupContact']['id'])); ?>
            <?php echo $html->link(__('Ver', true), array('controller'=>'gestionnewsletter', 'action' => 'listSuscriptores', $groupContact['GroupContact']['id'])); ?>
			<?php echo $html->link(__('Eliminar', true), array('action' => 'delete', $groupContact['GroupContact']['id']), null, sprintf(__('Al eliminar este grupo también eliminara todos los emails de este grupo', true), $groupContact['GroupContact']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paginacion">
        	   <ul>
          		<li><?php echo $paginator->prev('Anterior'); ?></li>
          		<?php echo $paginator->numbers(array('tag'=>"li", 'separator' => '')); ?>
          		<li><?php echo $paginator->next('Siguiente'); ?></li>
        	   </ul>
      	    </div>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Páguina %page% de %pages%, mostrando %current% registros de un total de %count%, empezando en el registro %start%, y terminando en %end%', true)
));
?></p>

