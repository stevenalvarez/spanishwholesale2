<script>
 $(document).ready(function() {
 $("#idiomas").children("input").each(function()
 {
    $(this).click(function(){
    $("div.active").slideUp().removeClass("active");
    $("div#"+$(this).attr("lang")).slideDown().addClass("active");    
    });
 });   
    
 });
</script>
<div class="contenido_2 clearfix">
		<?php $session->flash(); ?>
        <?php echo $form->create('', array('action'=>'editPlantilla/'.$form->data['Plantillasnews']['id'])); ?>
        <?php echo $form->hidden("Plantillasnews.id");?>
        <div id="idiomas">
        <input type="button" value="Español" lang="es"/>
        <input type="button" value="Ingles" lang="en"/>
        <input type="button" value="Italiano" lang="it"/>
        </div>
        
		<div class="cont active" id="es">
			<h3>Nombre de la Plantilla (es): </h3>
			<?php echo $form->input('Plantillasnews.titleesp_pnewsletter',array('label'=>'')); ?><br />
		<!--
	<h3>Link: </h3>
			<?php echo $form->input('Plantillasnews.link_pnewsletter', array('label'=>'')); ?><br />
-->
            <h3>Contenido HTML de la Plantilla: </h3>
			<?php echo $fck->fckeditor(array('Plantillasnews', 'bodyesp_html'), $html->base,$form->data['Plantillasnews']['bodyesp_html']); 
          
            ?>
            
		</div>
        
        		<div class="cont" id="en" style="display: none;">
			<h3>Nombre de la Plantilla (en): </h3>
			<?php echo $form->input('Plantillasnews.titleeng_pnewsletter',array('label'=>'')); ?><br />
		<!--
	<h3>Link: </h3>
			<?php echo $form->input('Plantillasnews.link_pnewsletter', array('label'=>'')); ?><br />
-->
            <h3>Contenido HTML de la Plantilla: </h3>
			<?php echo $fck->fckeditor(array('Plantillasnews', 'bodyeng_html'), $html->base,$form->data['Plantillasnews']['bodyeng_html']); 
          
            ?>
            
		</div>
        
        		<div class="cont" id="it" style="display: none;">
			<h3>Nombre de la Plantilla (it): </h3>
			<?php echo $form->input('Plantillasnews.titleita_pnewsletter',array('label'=>'')); ?><br />
		<!--
	<h3>Link: </h3>
			<?php echo $form->input('Plantillasnews.link_pnewsletter', array('label'=>'')); ?><br />
-->
            <h3>Contenido HTML de la Plantilla: </h3>
			<?php echo $fck->fckeditor(array('Plantillasnews', 'bodyita_html'), $html->base,$form->data['Plantillasnews']['bodyita_html']); 
          
            ?>
            
		</div>
		<div style="float:left; margin-right:50px; margin-top:5px;">
			<?php echo $html->link('Volver','listPlantillas'); ?>
		</div>
		<?php echo $form->end('Guardar Cambios'); ?>
</div>