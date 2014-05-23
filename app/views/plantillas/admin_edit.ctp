


<!-- side -->

<div id="right-side">

<link rel="stylesheet" href="<?php echo $this->webroot?>css/redactor/redactor.css" />
<style type="text/css">
form .required {font-weight: normal;}
     
     form {margin: 0 !important;  height: auto !important; }
     .plantillas {height: 1000px !important;}
</style>

<script src="<?php echo $this->webroot?>js/redactor/redactor.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('textarea').redactor({
        imageUpload: '<?php echo $this->webroot?>admin/plantillas/image_upload/'
    });
});
</script>
    
<div class="plantillas form">
<?php echo $this->Form->create('Plantilla'); ?>


		<h2>Editar Plantilla</h2>
    
        <input type="submit" value="Guardar" />
	<?php
    	echo $this->Form->input('id');
        echo $this->Form->input('nombre');
		echo $this->Form->input('html',array('label'=>''));
	
		echo $this->Form->input('fechahora',array('type'=>'hidden'));
	?>

    <br />

</div>

</div>