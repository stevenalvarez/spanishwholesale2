	<div class="contenido_1 clearfix">
		<?php $session->flash(); ?>
        
        
		<table class="listado table-gestion">
			<tr>
				<th>Seccion</th>
				<th>Descripcion</th>
			</tr>
			<?php foreach($seccionestabs as $tabs): 
            $css='';
            $action='';
            if($tabs["GestionNewsletter"]["nombre_seccion"]=='Lista de Suscritos'){
                $css='btn_suscriptores';
                $action='listSuscriptores';
                }
            if($tabs["GestionNewsletter"]["nombre_seccion"]=='Mensajes'){
                $css='btn_mensajes';
                $action="listMessages";
                }
            if($tabs["GestionNewsletter"]["nombre_seccion"]=='Plantillas'){
                $css='btn_plantillas';         
                $action="listPlantillas";
                }
            if($tabs["GestionNewsletter"]["nombre_seccion"]=='Backlist'){
                $css='btn_backlist';         
                $action="backList";
                }
                
            ?>
			<tr>
				<td><div class="nuevo"><?php echo $html->link("", array("action"=>$action), array("class"=>"btn_nuevo $css", "title"=>"Lista Suscritos")); ?></div></td>
                <td><?php echo $tabs["GestionNewsletter"]["descripcion"]; ?></td>
				
			</tr>
			<?php endforeach; ?>
		</table>
      	
	</div>