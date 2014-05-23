<?php

/**
 * @author Edgardo
 * @copyright 2010
 */

?>
<script type="text/javascript">
		Shadowbox.init({
			player:"html",
			overlayOpacity: 0.8
		});
	</script>
<div class="acciones clearfix">
			<div class="nuevo"><?php echo $html->link("", array("action"=>"addPlantilla"), array("class"=>"btn_nuevo btn_newplantilla", "title"=>"Nuevo")); ?></div>
		</div>
<table class="listado">
			<tbody>
            <tr>
				<th><?php echo $paginator->sort('Plantilla', 'title_spa'); ?></th>
				<th><?php echo $paginator->sort('Publicado', 'title_spa'); ?></th>
			    <th>Acciones</th>
			</tr>
	<?php
     foreach($plantillasnewsletter as $plantilla): 
     ?>
		   <tr>
				<td><?php echo $html->link($plantilla["Plantillasnews"]["titleesp_pnewsletter"],array("controller"=>"gestionnewsletter", "action"=>"editPlantilla",$plantilla["Plantillasnews"]["id"])); ?></td>
                <td><?php echo strftime("%d/%m/%Y",strtotime($plantilla["Plantillasnews"]["date_pnewsletter"])); ?></td>
                <td><?php echo $html->link($html->image("ico/btn_eliminar.gif", array("border"=>0)), array("action"=>"deletePlantilla", $plantilla["Plantillasnews"]["id"]), array("escape"=>false)); ?>
                </td>
                </td>
            </tr>
           
			<?php endforeach; ?>
					</tbody></table>
            <div class="paginacion">
        	   <ul>
          		<li><?php echo $paginator->prev('Anterior'); ?></li>
          		<?php echo $paginator->numbers(array('tag'=>"li", 'separator' => '')); ?>
          		<li><?php echo $paginator->next('Siguiente'); ?></li>
        	   </ul>
      	    </div>
            <div style="float:left; margin-right:50px; margin-top:5px;">
			 <?php echo $html->link('Volver','index'); ?>
		    </div>
