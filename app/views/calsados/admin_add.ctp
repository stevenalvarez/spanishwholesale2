<link href="<?php echo $this->webroot?>css/validationEngine.jquery.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $this->webroot?>js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script>jQuery(document).ready(function(){jQuery("form").validationEngine();});</script>

<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/calsados/add">Registro de un calzado </a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="calsados form">
<h2>Registro nuevo art&iacute;culo</h2>
<?php echo $this->Form->create('Calsado');?>

<div class="first-part">

<?php echo $this->Form->input('usuario_id',array('label'=>'proveedor'));?><br />

<hr />

	<?php
    
    
       // echo $this->Form->input('title',array('label'=>'Nombre*','class'=>'validate[required]'));
       
        echo $this->Form->input('code',array('label'=>'Referencia*','class'=>'validate[required]'));
        echo $this->Form->input('country_id',array('label'=>'Fabricado en','class'=>'validate[required]','default'=>'28'));
     //   echo $this->Form->input('venta',array('label'=>'Venta','type'=>'select','options'=>array('Todos','Mas opciones')));
        echo $this->Form->input('categoria_id',array('label'=>'Categoria*','class'=>'validate[required]','empty'=>'Seleccione'));
        echo $this->Form->input('tipo_id',array('class'=>'validate[required]','label'=>'Tipo*','type'=>'select','empty'=>'Seleccione'));
        echo $this->Form->input('subtipo_id',array('type'=>'select','empty'=>'Seleccione'));
		//echo $this->Form->input('usuario_id');
		echo $this->Form->input('material_id');
        echo $this->Form->input('forro');
        echo $this->Form->input('suela');               
        echo $this->Form->input('Tag',array('div'=>array('class'=>'multiple input'),'label'=>'Tags'));
         echo $this->Form->input('texto',array('rows'=>'5','style'=>'width: 200px;','label'=>'Descripci&oacute;n del producto<br><br><br><br>'));
         echo $this->Form->input('marca');
         echo $this->Form->input('activado',array('type'=>'radio','options'=>array('1'=>'Si','0'=>'No'),'default'=>'0'));
       // echo $this->Form->input('precio',array('after'=>'&euro;','class'=>'validate[required]'));
//         echo $this->Form->input('poferta',array('after'=>'&euro;','label'=>'Precio de Oferta'));
//         echo $this->Form->input('en_oferta',array('type'=>'radio','options'=>array('0'=>'No','1'=>'Si'),'class'=>'validate[required]'));
         echo $this->Form->input('servicio',array('type'=>'select','options'=>array('0'=>'Inmediato',
         '15'=>'15 dias','30'=>'30 dias','60'=>'60 dias','120'=>'120 dias')));
	?>
    <style>
    #CalsadoPrecio { width: 100px !important; }
    #CalsadoPoferta { width: 100px !important; }
    #CalsadoPrecio { width: 100px !important; }
            
    #tablilla { overflow: hidden; padding:0 0 9px 9px; width: 100%;     }
    .celda { width: 65px; float: left; }
    .celda.clon { width: 45px; }
    .celda label{ padding: 5px !important; width: 65px !important; }
    </style>
    
</div>
<hr/>

<div style="padding: 0 0 30px 10px;">
<input type="submit" name="step" class="btn-admin-orange"  value="SIGUIENTE" />
<input type="button" value="CANCELAR" onclick="window.history.back()" class="btn-admin-red" />
</div>
</div>
</div>



