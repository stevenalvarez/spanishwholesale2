<div class="grid_4">	
	<div class="box">			
				<h2>
			<a href="#" id="toggle-admin-actions">Actions</a>
		</h2>
		<div class="block" id="admin-actions">			
			<h5>Emailslogs</h5>
			<ul class="menu">
								<li><?php echo $this->Html->link(sprintf(__('List %s', true), __('Emailslogs', true)), array('action' => 'index'));?></li>
			</ul>
					</div>
	</div>
</div>

<div class="grid_12">
    <h2 id="page-heading"><?php printf(__('Add %s', true), __('Emailslog', true)); ?></h2>
    
	<div class="emailslogs form">
	<?php echo $this->Form->create('Emailslog');?>
		<fieldset>
	 		<legend><?php printf(__('Emailslog Record', true)); ?></legend>
		<?php
		echo $this->Form->input('tipo');
		echo $this->Form->input('para');
		echo $this->Form->input('texto');
		echo $this->Form->input('fechahora');
		echo $this->Form->input('asunto');
	?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit', true));?>
	</div>

</div>
<div class="clear"></div>
