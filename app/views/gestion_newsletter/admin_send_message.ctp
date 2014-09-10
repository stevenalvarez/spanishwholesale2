<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/articulos/index">Gesti&oacute;n de tags de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div class="colors form">
<h2>Enviar Correo</h2>
<div class="contenido_2 clearfix">
		<?php $session->flash(); ?>      
		<div class="cont" style="padding: 10px;">
         <form method="post" enctype="application/x-www-form-urlencoded;charset=UTF-8">  
         	<label>Asunto : </label>
			<input type="text" name="data[Message][asunto]" value=""/><br />       <br />      
            <label class="id_message_p">Grupo:</label>     
            <select id='select_plantillas' class="select_plantillas" name="data[Message][grupo]">
            <option value="0">Seleccione Grupo</option>
             <?php  foreach($selectGroups as $k=>$v):
             ?> <option value="<?php echo $k?>">
                <?php echo $v?></option>
                <?php endforeach; ?>
            </select>
                    
        <div class="nuevo">
            

          Simular Envio?? <input type="checkbox" name="simular" />
		</div>
            
            <br />  <br />  

        
        <div id="sb-loading" style="display: none;margin-bottom:15px;"><div id="sb-loading-inner"><span style="color:#000">cargando plantilla</span></div></div>
        <div id="preview_plantilla" style="border: solid 1px; height: 500px;">
        <?php  echo $fck->fckeditor(array('Message','message'), $html->base); ?>
        </div>
	<br />
		<input type="submit" value="Enviar" class="btn-admin-orange" />
        <br />
        </form>    
		</div>
</div>
</div>
</div>


</div>
    
 
	




