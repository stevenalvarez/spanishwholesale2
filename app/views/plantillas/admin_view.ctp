<div class="plantillas view">
<h2><?php  echo __('Plantilla'); ?></h2>
	<dl>

        <dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($plantilla['Plantilla']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php echo $plantilla['Plantilla']['html'] ?>