<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/calzados/index">Listado de Calzados</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div class="admin-search" style="height: 160px; background: none; background-color: #E7F3F8; border: 2px solid #6493A4; border-radius: 5px 5px 5px 5px; width: 695px;">
<h2>B&uacute;squeda de Calzados</h2>

<form method="post" action="?search=true">
<input type="hidden" name="tipo" value="referencia" />
<table>
<tr>
<td>
Buscar por referencia
</td>
<td>
<input type="text" placeholder="referencia" name="referencia" />
</td>
<td>
<input type="submit" class="btn-admin-orange" value="BUSCAR">
<a style="display: inline-block; font-size: 11px; text-decoration: none; text-align: center; width: 64px;" href="<?php echo $this->webroot;?>proveedor/calzados/index" class="btn-admin-orange">LIMPIAR</a>
</td>
</tr>
</table>
</form>
<!-- 
<form method="post" action="?search=true" style="display: none;">
<input type="hidden" value="termino" name="tipo" />
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" name="like" value="<?php echo isset($_POST["like"])?$_POST["like"]:''?>" /></td>
<td>
<select name="criterio">
    <option value="Calsado.title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Calsado.title'?'selected="selected"':''  ?>>Nombre</option>
    <option value="Calsado.code" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Calsado.code'?'selected="selected"':''  ?>>Referencia</option>
    <option value="Calsado.marca" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Calsado.marca'?'selected="selected"':''  ?>>Marca</option>
    <option value="Categoria.title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Categoria.title'?'selected="selected"':''  ?>>Categoria</option>
    <option value="Usuario.title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Usuario.title'?'selected="selected"':''  ?>>Proveedor</option>
    <option value="Country.title" <?php echo isset($_POST["criterio"])&&$_POST["criterio"]=='Country.title'?'selected="selected"':''  ?>>Pais</option>
</select>
</td><td><input type="submit" value="BUSCAR" class="btn-admin-orange" /></td></tr>
</table>
</form>
 -->

<h2>Filtros de Art&iacute;culos</h2>
<form method="post" action="?search=true">
<input type="hidden" value="filtro" name="tipo" />
<table>

<tr>
<td>Proveedor</td>
<td>Estado</td>
<td>Categoria</td>
<td>Tipo</td>
<td>Subtipo</td>
</tr>

<tr>
<td>
</td>
<td>
        <select name="estado_id" style="width: 120px;">
        <option value="0">Seleccione</option>
        <option <?php if(isset( $_POST["estado_id"]) && $_POST["estado_id"]=='1'){echo 'selected="slected"'; } ?> value="1" >Aprobado</option>
        <option <?php if(isset($_POST["estado_id"] ) && $_POST["estado_id"]=='p'){echo 'selected="slected"'; } ?> value="p" >Pendiente</option>        
        </select>
</td>

<td>
        <select name="categoria_id" style="width: 120px;">
        
        <option value="0">Seleccione</option>
        <?php foreach($categorias as $k=>$v)
        {
        ?><option  <?php if(isset($_POST["categoria_id"] ) && $_POST["categoria_id"]==$k){echo 'selected="slected"';} ?>  value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
</td>
<td>
        <select name="tipo_id" style="width: 120px;">
        <option value="0">Seleccione</option>
        <?php foreach($tipos as $k=>$v)
        {
        ?><option  <?php if(isset($_POST["tipo_id"]) && $_POST["tipo_id"]==$k){echo 'selected="slected"';} ?>  value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
</td>

<td>
        <select name="subtipo_id" style="width: 120px;">
        <option value="0">Seleccione</option>
        <?php foreach($subtipos as $k=>$v)
        {
        ?><option <?php if(isset($_POST["subtipo_id"]) && $_POST["subtipo_id"]==$k){echo 'selected="slected"';} ?> value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
</td>
<td>
<input type="submit" class="btn-admin-orange" value="BUSCAR"/>
</td>
</tr>
</table>
</form>



</div>
<div style="color: #194D65;">
<?php
	echo $this->Paginator->counter(array(
	'format' => __('Total de articulos: %count%', true)
	));
?></div>
<div id="admin-table">
<h2>Listado de Art&iacute;culos</h2>


<?php 
$par=0;
if($calsados){
foreach($calsados as $calsado)
{
 //   print_r($calsado);
?>

<div class="articulo">
<?php
$tipo="";
if($par%2==0)
$tipo="par";
?>
<table class="<?php echo $tipo?>">
<tr>
   <th>Referencia</th> <th>Categor&iacute;a</th><th>Tipos</th>
   <th>Subtipos</th>
   
   <th></th><th></th><th></th><th></th><th class="fix"></th>
</tr>
<tr>
   <td><?php echo $calsado['Calsado']['code']?></td>
   <td>
        <select name="categoria_id" style="width: 120px;" onchange="changee(this,'Calsado',<?php echo $calsado['Calsado']['id'] ?>)">
        <?php foreach($categorias as $k=>$v)
        {
        ?><option <?php echo $k==$calsado['Calsado']['categoria_id']?'selected="true"':'' ?> value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
    </td>
    <td>
    <select name="tipo_id" style="width: 120px;" onchange="changee(this,'Calsado',<?php echo $calsado['Calsado']['id'] ?>)">
        <?php foreach($tipos as $k=>$v)
        {
        ?><option <?php echo $k==$calsado['Calsado']['tipo_id']?'selected="true"':'' ?> value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
    </td>
    <td>
    
      
    <select name="subtipo_id" style="width: 120px;" onchange="changee(this,'Calsado',<?php echo $calsado['Calsado']['id'] ?>)">
    <option value="">Seleccione</option>
        <?php foreach($subtipos as $k=>$v)
        {
        ?><option <?php echo $k==$calsado['Calsado']['subtipo_id']?'selected="true"':'' ?> value="<?php echo $k?>" ><?php echo $v?></option>
        <?php }?>
        </select>
    </td>

   <th class="fix"></th>
</tr>

<tr>
   <th>Tipo</th>
   <th>N&uacute;meros</th><th>Descripci&oacute;n</th><th>Pares</th><th>Precio</th><th class="fix"></th>
</tr>


    <tr class="colspan">
<!--
    <td rowspan="<?php echo sizeof($calsado["Surtido"])+1; ?>"></td>
        
        <td rowspan="<?php echo sizeof($calsado["Surtido"])+1; ?>">
        </td>
-->
    </tr>
<?php foreach($calsado["Surtido"] as $surtido)
{?>
    <tr>
    
        <td><?php echo str_replace("_"," ",$surtido["tipo"])?></td>
        <td>Del
        <input size="2" name="talla_inf" type="text" value="<?php echo $surtido["talla_inf"]?>"  onchange="changee(this,'Surtido',<?php echo $surtido["id"]?>)"/> 
        al <input size="2" name="talla_sup" type="text" value="<?php echo $surtido["talla_sup"]?>"  onchange="changee(this,'Surtido',<?php echo $surtido["id"]?>)"/>
        </td>
        <td>
            <?php if($surtido["tipo"]=='cajas_surtidas'){ ?>
            <input name="descripcion" type="text" value="<?php echo $surtido["descripcion"]?>"  onchange="changee(this,'Surtido',<?php echo $surtido["id"]?>)"/>
            <?php } ?>
        </td>
        <td>
            <?php if($surtido["tipo"]=='surtido_libre'){?>
            <input size="pares" name="pares" type="text" value="<?php echo $surtido["pares"]?>"  onchange="changee(this,'Surtido',<?php echo $surtido["id"]?>)"/>
            <?php } ?>
        </td>
        <td>
        
        <input size="5" name="precio_sur" type="text" value="<?php echo $surtido["precio_sur"]?>"  onchange="changee(this,'Surtido',<?php echo $surtido["id"]?>)"/>
        </td>
        <td>
            <a href="javascript:void(0)" onclick="deletee(this,'surtido',<?php echo $surtido["id"]?>)">
                <img alt="eliminar" src="<?php echo $this->webroot?>img/x.png"/>
            </a>
        </td>
    </tr>
<?php }?>
<tr>
    <th>
        Colores / Fotografias
    </th>
</tr>

<tr>

    <td colspan="7">
        <?php
        
        foreach($calsado["Foto"] as $foto)
        {?>
        <div style="float: left; width: 90px;">
        <img src="<?php echo $this->webroot?>img/Foto/mini/<?php echo $foto["url"] ?>" />
        <input size="8" name="title" width="70" type="text" value="<?php echo $foto["title"]?>" onchange="changee(this,'Foto',<?php echo $foto["id"]?>)" />
        
        
            <div style="display: inline;">
                <a href="javascript:void(0)" onclick="deletee(this,'foto',<?php echo $foto["id"]?>)">
                    <img alt="eliminar" src="<?php echo $this->webroot?>img/x.png"/>
                </a>
            </div>
        </div>
        <?php }?> 
    </td>
</tr>
<tr>
    <td colspan="7">
        <div>
        <div class="hrgreen" style="width: 700px;">
        </div>
                <label style="color: #1F476F; font-size: 13px; font-weight: bold;">Estado:</label>
                <a class="hay" href="<?php echo $this->webroot?>proveedor/calsados/<?php echo $calsado['Calsado']['activado']=='1'?'desactivar':'activar'?>/<?php echo $calsado['Calsado']['id'] ?>">
                        <?php echo $calsado['Calsado']['activado']=='1'?'<span class="aprobado">Aprobado</span>':'<span class="pendiente">Pendiente</span>'; ?>
                </a>
                
                <div style="float: right; padding-right: 10px;">
                <input type="button" onclick="window.location.href='<?php echo $this->webroot?>proveedor/calsados/edit/<?php echo $calsado['Calsado']['id'] ?>'" value="Editar" class="btn-admin-green"/>
                <input type="button" class="btn-admin-red" onclick="deletee(this,'calzado',<?php echo $calsado['Calsado']['id'] ?>)" value="Eliminar"/>                
                </div>
                
        </div>
    </td>
</tr>
<tr>
    <td colspan="7"></td>
</tr>

</table>
</div>
<?php
$par++;
 }?>
 <table>
 <tr class="clear">
<td colspan="9">
<?php
	echo $this->Paginator->counter(array(
	'format' => __('P&aacute;gina %page% de %pages%', true)
	));
	?>
	<div class="paging">
		<?php echo $this->Paginator->prev("<img src='".$this->webroot."img/admin-previus.png'/>", array('escape'=>false,'class'=>'nav_btn'), null, array('class'=>'disabled'));?>
        <?php echo $this->Paginator->numbers(array('separator'=>'&nbsp;&nbsp;'));?>
        <?php echo $this->Paginator->next("<img src='".$this->webroot."img/admin-next.png'/>" , array('escape'=>false,'class'=>'nav_btn'), null, array('class' => 'disabled'));?>
	</div>


</td></tr>
</table>
 <?php
 
 }
 else
 {
    echo "<tr> no hay resultados</tr>";
 }


?>

	
</div>

    </div>
    

<script>
function deletee(thiss,tipo,id)
{
    jQuery(function(){
       var eliminar=confirm("Esta seguro de eliminar "+tipo);
       if(eliminar)
       {
        if(tipo=='calzado')        
            tipo='calsado';
        
            $.ajax({type:"get",url:"<?php echo $this->webroot?>proveedor/"+tipo+"s/ajaxdelete/"+id,
            dataType:"text",context: thiss}).done(function(msg) {eval(msg);});
       }
       });
}


function changee(thiss,controller,id)
{
    jQuery(function(){
       //var eliminar=confirm("Esta seguro de eliminar "+tipo);
//       if(eliminar)
//       {
            $(thiss).css('background-color','white');
            var value = $(thiss).val();
            var descripcion = value.split("-");
            if (/^([0-9])*$/.test(parseInt(descripcion[descripcion.length - 1]))){
                $(thiss).css('background-color','red');
                $.ajax({type:"post",url:"<?php echo $this->webroot?>proveedor/calsados/ajaxedit/"+id,
                data:"val="+$(thiss).val()+"&controller="+controller+"&name="+$(thiss).attr('name'),
                dataType:"text",context: thiss}).done(function(msg) {eval(msg);  $(thiss).css('background-color','#CCF179');});
            }else{
                alert("Ingrese solo numero enteros");
                $(thiss).val(value.split("-").slice(0,-1).join("-"));
            }

       //}
       });
}


jQuery(function(){
    $("#call").click(function(){
        $(".check_aprove").attr('checked','cheked');
    });
        $("#uall").click(function(){
        $(".check_aprove").removeAttr("checked");
    });
    
});
</script>

<style>
.hay { cursor: pointer; }
.hay label { cursor: pointer; }
</style>

