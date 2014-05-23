<div class="Paginas view">
<h2><?php  echo __('Pagina'); ?></h2>
	<dl>

        <dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($Pagina['Pagina']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php echo $Pagina['Pagina']['html'] ?>