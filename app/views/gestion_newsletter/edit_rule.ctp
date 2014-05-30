<script>

    $(document).ready(function() {
            $("#btn_check").click(
               function (){
                    
                     var new_rule=$("#BacklistsReglaBacklist").val();
                    if(new_rule)
                    {$("#sb-loading").show();
                    $("#affected_rule").children("table.listado").replaceWith("");
                    $.ajax({
                      type: "GET",
                        url: "<?php echo Router::url('/')?>gestionnewsletter/ckeckRule/"+new_rule,
                        success: function(datos){
                            $("#sb-loading").hide();
                            $("#affected_rule").append(datos);
                        }
                    });
                    }
                    else{
                        alert('<?php echo ___("Introduzca una regla v&aacute;lida")?>');
                    }
                }
            );

         }
        
    );
</script>
<div class="contenido_2 clearfix">
		<?php $session->flash(); ?>
        <?php echo $form->create('', array('action'=>'editRule/'.$form->data['Backlists']['id'])); ?>
        <?php echo $form->hidden("Backlists.id");?>
		<div class="cont">
        <p>Para evitar que un usuario espec&iacute;fico pueda registrarse, introduzca su direcci&oacute;n de correo electr&oacute;nico. 
        Tambi&eacute;n puede evitar un dominio espec&iacute;fico (ej. @aol.com, @ yahoo.com), o incluso un dominio de primer nivel completo (por ejemplo .com,.net,.org). 
        Utilice el boton de "comprobar regla", para ver si la regla que desea crear afectar&aacute; a algunos o a todos
        los miembros existentes.</p>
        
			<h3>Nueva Regla : </h3>
			<?php echo $form->input('Backlists.regla_backlist',array('label'=>'')); ?><br />
        <a class="btn_nuevo btn_checkrule" id="btn_check" href="javascript:checkRule()"></a>
        	
		</div>
        <div id="affected_rule">
            <div id="sb-loading" style="display: none;"><div id="sb-loading-inner"><span style="color:#000">cargando</span></div></div>
        </div>
        
        <div style="float:left; margin-right:50px; margin-top:5px;">
			<?php echo $html->link('Volver','backList'); ?>
		</div>
		<?php echo $form->end('Guardar Cambios'); ?>
</div>