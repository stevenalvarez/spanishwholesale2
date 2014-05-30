<?php  echo $this->Session->flash(); ?>
<div id="left-menus">
<?php
 if($_SESSION["Auth"]["Usuario"]["rol"]=='admin')
 {
 ?>
<div id="left-menu">
<h2>Administrador</h2>
<ul>
<li class="tile">PROVEEDORES</li>
<li><a href="<?php echo $this->webroot?>admin/usuarios/addproveedor">Nuevo Proveedor</a></li>
<li class="last"><a href="<?php echo $this->webroot?>admin/usuarios/proveedores">Listado de proveedores</a></li>
</ul>
</div>


<div id="left-menu">
<h2>Proveedores</h2>
<ul>
<li class="tile">CATEGOR&Iacute;AS</li>
<li><a href="<?php echo $this->webroot?>admin/categorias/index">Lista de Categor&iacute;as de art&iacute;culos</a></li>
<li><a href="<?php echo $this->webroot?>admin/categorias/add">Nueva categor&iacute;a de articulos </a></li>

<li class="tile">ART&Iacute;CULOS</li>

<li><a href="<?php echo $this->webroot?>admin/calsados/index">Lista de art&iacute;culos</a></li>
<li><a href="<?php echo $this->webroot?>admin/calsados/add">Registro nuevo art&iacute;culo</a></li>
<li><a href="<?php echo $this->webroot?>admin/materials/index">Materiales</a></li>
<li><a href="<?php echo $this->webroot?>admin/tags/index">Tags</a></li>
<li><a href="<?php echo $this->webroot?>admin/tipos/index">Tipos</a></li>
<li><a href="<?php echo $this->webroot?>admin/subtipos/index">Subtipos</a></li>
<li><a href="<?php echo $this->webroot?>admin/precios/index">Rangos de precios</a></li>

<!--f
<li><a href="<?php echo $this->webroot?>admin/subtipos/index">Lista de subtipos de art&iacute;culos</a></li>
-->

<!--
<li><a href="<?php echo $this->webroot?>admin/materials/add">Registro nuevo material</a></li>
<li><a href="<?php echo $this->webroot?>admin/materials/index">Lista de tipos de materiales</a></li>
-->
<li class="tile">CLIENTES</li>
<li><a href="<?php echo $this->webroot?>admin/userlogs/logueados/sort:tim/direction:desc">Listado de clientes logueados</a></li>
<li><a href="<?php echo $this->webroot?>admin/usuarios/clientes">Lista de clientes</a></li>
<li class="tile">PEDIDOS</li>

<li><a href="<?php echo $this->webroot?>admin/pedidos/index/direction:desc/sort:id">Lista de pedidos</a></li>
<li><a href="<?php echo $this->webroot?>admin/pedidos/incomplete/direction:desc/sort:id">Lista de pedidos eliminados</a></li>
<!--
<li><a href="#">Registro nuevo cliente</a></li>
-->

<!--
<li><a href="#">Registro nuevo pedido</a></li>
-->

<!--
<li><a href="<?php echo $this->webroot?>admin/colors/index">Colores</a></li>
-->
<li class="tile">MAILS</li>
<li><a href="<?php echo $this->webroot?>admin/gestionnewsletter/listMessages">Mails</a></li>
<li><a href="<?php echo $this->webroot?>admin/plantillas/index">Plantillas de mails</a></li>
<li><a href="<?php echo $this->webroot?>admin/emailslogs/index/sort:id/direction:desc">Logs</a></li>

<li class="tile">TRADUCCIONES</li>
<li><a href="<?php echo $this->webroot?>admin/translates/index">Traducciones</a></li>
<li><a href="<?php echo $this->webroot?>admin/paginas/index">Paginas</a></li>
<!--
<li><a href="<?php echo $this->webroot?>admin/translates/traducir">Traducir desde el front</a></li>
-->

<li class="tile">TRANSPORTISTAS</li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/transportistas">Listado de transportistas</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/addtransportista">Nuevo transportista</a></li>
<li class="tile">LOG</li>
<li > <a href="<?php echo $this->webroot?>admin/userlogs/index/sort:id/direction:desc">Log hist&oacute;rico</a></li>

<li class="tile">SEO</li>
<li class="last" > <a href="<?php echo $this->webroot?>admin/userlogs/seo">Modificar</a></li>
</ul>
</div>


<?php }
else if($_SESSION["Auth"]["Usuario"]["rol"]=='proveedor')
{ ?>

<div id="left-menu">
<h2>Proveedor</h2>
<ul>
<li class="tile">ART&Iacute;CULOS</li>
<li><a href="<?php echo $this->webroot?>proveedor/calsados/add">Registrar un art&iacute;culo</a></li>
<li><a href="<?php echo $this->webroot?>proveedor/calzados/index">Mis art&iacute;culos</a></li>

<li class="tile">CLIENTES</li>
<li><a href="<?php echo $this->webroot?>proveedor/articulos/clientes">Mis clientes</a></li>
<?php

if(isset($_SESSION["Auth"]["Usuario"]["id"]) && $_SESSION["Auth"]["Usuario"]["id"]){
     App::import('Model', 'Usuario');
     $Usuario = new Usuario();
     $id=$_SESSION["Auth"]["Usuario"]["id"];
     $res = $Usuario->query("select count(*) as x from pedidos where proveedor=$id and enviado=0 and confirmado=1 and anulado=0");
     $consultas = $Usuario->query("select count(*) as x from consultas where usuario_prov_id=$id and revisado='0'");
}

?>
<li><a href="<?php echo $this->webroot?>proveedor/consultas/index">Nuevas Consutas <b>(<?php echo $consultas["0"]["0"]["x"]; ?>)</b></a></li>
<li><a href="<?php echo $this->webroot?>proveedor/consultas/lista">Listado de Consultas</a></li>
<li><a href="<?php echo $this->webroot?>proveedor/pedidos/index">Nuevos Pedidos <b>(<?php echo $res["0"]["0"]["x"]; ?>)</b></a></li>
<li class="last"><a href="<?php echo $this->webroot?>proveedor/pedidos/lista">Listado de Pedidos</a></li>

</ul>
</div>
 <?php }?>
</div>

<style>a[href*="/<?php echo $this->params["controller"].'/'.end(explode("_",$this->params["action"])); ?>"] { font-weight: bold; }

#left-menu li a[href*="/<?php echo $this->params["controller"].'/'.end(explode("_",$this->params["action"])); ?>"] { font-weight: bold; background: url('<?echo $this->webroot?>img/hooveer.png'); padding-top: 9px !important; padding-left: 31px !important; color: white !important; }

<?php if($this->params["controller"]=='calsados') {?>

#left-menu li a[href*="/<?php echo 'calzados/'.end(explode("_",$this->params["action"])); ?>"] { font-weight: bold; background: url('<?echo $this->webroot?>img/hooveer.png'); padding-top: 9px !important; padding-left: 31px !important; color: white !important; }
<?php }?>
</style>