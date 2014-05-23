<script>
    $(document).ready(function() {
        
        $("#select_plantillas").change(
            function (){
                
              //  var iframe = document.getElementById('data[Message][message]___Frame');
//                var text_area= iframe.contentWindow.document.getElementById('xEditingArea');
//                var toolbar=iframe.contentWindow.document.getElementById('xExpanded');
                /*var frame = $("#data[Message][message]___Frame").contentDocument;
                var button=$('iframe').contents().find(".TB_Button_Off");
                var buttons=$('iframe').contents().find(".TB_Button_Off").removeClass('TB_Button_Off').addClass('TB_Button_Disabled');
                alert($(button).html());*/
                
                if($(this).val()!='0'){
                //$(iframe).hide();
                $("#sb-loading").show();
                $.ajax({
                        type: "GET",
                        url: "<?php echo Router::url('/')?>gestionnewsletter/previewPlantilla/"+($(this).val()),
                        success: function(datos){
                        $("#preview_plantilla").html(datos);
                        //$("#title_plant,#preview_plantilla").show();
//                        $(text_area).html('<textarea class="SourceField" dir="ltr" style="width: 100%; height: 122px; border: medium none; outline: medium none;">'+datos+'</textarea>');
//                        $(toolbar).hide();
//                           iframe.style.height= "400px";
//                           $(text_area).children("textarea").attr("style","width: 100%; height: 397px; border: medium none; outline: medium none;");
                        $("#sb-loading").hide();
                }
                });
                }

                
            }
        );
    });
</script>
<div class="contenido_2 clearfix">
		<?php $session->flash(); 
        
        ?>
        <?php echo $form->create('', array('action'=>'sendMessage'.$id_member)); ?>
		<div class="cont">
            
           
        <h3 style="display: none;" id="title_plant">Vista previa de Plantilla : </h3>
        <!--
			<h3>Asunto : </h3>
			<?php echo $form->input('Message.subject',array('label'=>'')); ?><br />-->
            <?php 
            if(!$name_member){
			 
             
            echo "<h3>A Grupo: </h3>";
            echo $form->input('MemberGroup.id_group',
                    array('type'=>'select','options'=>$selectGroups,'label'=>'','div'=>array("class"=>"group_message"))
                );
            }
            else
                echo "<h3>A : <span>".$name_member."</span> </h3>";
            ?>
            
            <h3 class="id_message_p">Mensaje : </h3>
            <select id='select_plantillas' name="data[Plantillasnews][plantilla]" class="select_plantillas">
            <option value="0">Seleccione Plantilla</option>
            <?php
     foreach($plantillas as $plantilla):
     ?>
        <option value="<?php echo $plantilla["Plantillasnews"]["id"]?>">
        <?php echo $plantilla["Plantillasnews"]["titleesp_pnewsletter"]?></option>
         
            
     	<?php endforeach; ?>
        </select>
        
        <div class="acciones clearfix" style="overflow: hidden;">
        <div class="nuevo">
            <input type="submit" class="btn_nuevo btn_send_message" value="Enviar" />
            
          </div>
		</div>
        
        <div id="sb-loading" style="display: none;margin-bottom:15px;"><div id="sb-loading-inner"><span style="color:#000">cargando plantilla</span></div></div>
        <div id="preview_plantilla" style="border: solid 1px;">
        
        </div>
			<?php  // echo $fck->fckeditor(array('Message', 'message'), $html->base); ?>
          
        </form>    
		</div>
</div>