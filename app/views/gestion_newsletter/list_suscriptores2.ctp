<?php

/**
 * @author Edgardo
 * @copyright 2010
 */

?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#MemberGroupIdGroup').change(function(){
 
                    window.location.href='<?php echo Router::url('/')?>gestionnewsletter/listSuscriptores/'+$(this).val();    
        }
        );
    }
    );
</script>
<div class="acciones clearfix">
			<!--<div class="nuevo"><?php echo $html->link("", array("action"=>"addSuscriptor"), array("class"=>"btn_nuevo btn_newmember", "title"=>"Nuevo")); ?></div>
            <div class="nuevo"><?php echo $html->link("", array("action"=>"addGroup"), array("class"=>"btn_nuevo btn_newgroup", "title"=>"Nuevo")); ?></div>
            <div class="nuevo"><?php echo $html->link("", array("action"=>"exportCsv"), array("class"=>"btn_nuevo btn_export", "title"=>"exportar a csv")); ?></div>
            <div class="nuevo"><?php echo $html->link("", array("action"=>"import"), array("class"=>"btn_nuevo btn_import", "title"=>"exportar a csv")); ?></div>-->
              <?php 
            echo $form->input('MemberGroup.id_group',
                    array('selected' =>$selected_group,'type'=>'select','options'=>$selectGroups,'label'=>'Filtrar por grupo : ','div'=>array("class"=>"filtro"))
                );
                               
            ?>
            <form method="post">
            <label>Buscardor:</label>
            <input type="hidden" name="action" value="buscar" />
            <input type="text" name="nombre" />
            Por nombre
            <input type="radio" value="nombre" name="tipo" checked="" />
            Por email
            <input type="radio" value="email" name="tipo" />
            <input  type="submit" value="Buscar"/>
            </form>
            
            
        </div>
<table class="listado">
			<tbody><tr>				
				<th>Email</th>
                <th>Nombre</th>
				<th>Tipo/Idioma</th>
                <th>Acciones</th>
			</tr>
	<?php
  //  pr($_SERVER);
     foreach($mails as $newsletter):
//     print_r($newsletter);
//     print_r($table);
//     exit()
//     ;


     ?>
     
		   <tr>
				
			    <td><?php echo utf8_decode($newsletter["$table"]["email"]) ?></td>
                <td><?php echo $newsletter["$table"]["nombre"]?></td>
                <td><?php echo $newsletter["0"]["tipo"]?>/<?php echo isset($newsletter["$table"]["idioma"])?$newsletter["$table"]["idioma"]:"es" ?></td>
                <td><?php echo $html->link($html->image("ico/email_send.png", array("border"=>0,"alt"=>"Enviar Mail","class"=>"sendmail")), array("action"=>"sendMessageto", base64_encode($newsletter["$table"]["email"])), array("escape"=>false)); ?></td> 
            </tr>
           
			<?php endforeach; ?>
					</tbody></table>
            <?php if(!isset($tipo)){ ?>
            <div class="paginacion">
        	   <ul>
          		<?if($page>0):?>
                  <li> <a href="<? echo $this->webroot."gestionnewsletter/listSuscriptores/$grupo/"?>page:<?php echo $page-1?>"> Anterior</a></li>
          	<?endif;
              
                ?>
          		  <li> <a href="<? echo $this->webroot."gestionnewsletter/listSuscriptores/$grupo/"?>page:<?php echo $page+1?>"> Siguiente</a></li>
        	   </ul>
      	    </div>
            <?php } ?>
            <div style="float:left; margin-right:50px; margin-top:5px;">
			 <?php echo $html->link('Volver','index'); ?>
		    </div>
