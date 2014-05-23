
<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/categorias/index">Listado de categor&iacute;as de art&iacute;culos</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<link rel="stylesheet" href="<?php echo $this->webroot?>css/redactor/redactor.css" />
<style type="text/css">
form .required {font-weight: normal;}
     
     form {margin: 0 !important;  height: auto !important; }
     .Paginas {height: 1000px !important;}
</style>

<script src="<?php echo $this->webroot?>js/redactor/redactor.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('textarea').redactor({
        imageUpload: '<?php echo $this->webroot?>admin/Plantillas/image_upload/'
    });
});
</script>
    
<div class="Paginas form">
<?php echo $this->Form->create('Pagina'); ?>


		<h2>Editar Pagina</h2>
    
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