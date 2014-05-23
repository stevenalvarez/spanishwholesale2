<div class="grid_4">	
	<div class="box">			
				<h2>
			<a href="#" id="toggle-admin-actions">Actions</a>
		</h2>
		<div class="block" id="admin-actions">			
			<h5>Emailslogs</h5>
			<ul class="menu">
				<li><?php echo $this->Html->link(sprintf(__('New %s', true), __('Emailslog', true)), array('action' => 'add')); ?></li>
			</ul>
					</div>
	</div>
</div>

<div class="grid_12">
    <h2 id="page-heading"><?php __('Emailslogs');?></h2>
	
		
	<table cellpadding="0" cellspacing="0">
    <?php $tableHeaders = $html->tableHeaders(array($paginator->sort('id'),$paginator->sort('tipo'),$paginator->sort('para'),$paginator->sort('texto'),$paginator->sort('fechahora'),$paginator->sort('asunto'),__('Actions', true),));
echo '<thead>'.$tableHeaders.'</thead>'; ?>

<?php
	$i = 0;
	foreach ($emailslogs as $emailslog):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $emailslog['Emailslog']['id']; ?>&nbsp;</td>
		<td><?php echo $emailslog['Emailslog']['tipo']; ?>&nbsp;</td>
		<td><?php echo $emailslog['Emailslog']['para']; ?>&nbsp;</td>
		<td><?php echo $emailslog['Emailslog']['texto']; ?>&nbsp;</td>
		<td><?php echo $emailslog['Emailslog']['fechahora']; ?>&nbsp;</td>
		<td><?php echo $emailslog['Emailslog']['asunto']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $emailslog['Emailslog']['id'])); ?>
			<?php echo ' | ' . $this->Html->link(__('Edit', true), array('action' => 'edit', $emailslog['Emailslog']['id'])); ?>
			<?php echo ' | ' . $this->Html->link(__('Delete', true), array('action' => 'delete', $emailslog['Emailslog']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $emailslog['Emailslog']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
<?php echo '<tfoot class=\'dark\'>'.$tableHeaders.'</tfoot>'; ?>    </table>
    
          
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
	</div>
		
</div>
<div class="clear"></div>
