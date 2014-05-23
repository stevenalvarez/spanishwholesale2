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
        <div class="nuevo">
            <?php echo $html->link("", array("action"=>"addRule"), array("class"=>"btn_nuevo", "title"=>"Nuevo")); ?></div>
		</div>
        <h3>Lista Actual de reglas</h3>
<table class="listado">
			<tbody>
            <tr>
				<th><?php echo $paginator->sort('REGLA', 'title_spa'); ?></th>
				<th><?php echo 'ACCIONES'; ?></th>
			</tr>
	<?php
     foreach($rules as $rule): 
     ?>
		    <tr>
				<td><?php echo $html->link($rule["Backlists"]["regla_backlist"],array("controller"=>"gestionnewsletter", "action"=>"editRule",$rule["Backlists"]["id"])); ?>
                </td>
                <td><?php echo $html->link($html->image("ico/btn_eliminar.gif", array("border"=>0)), array("action"=>"deleteRule", $rule["Backlists"]["id"]), array("escape"=>false)); ?></td>
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
