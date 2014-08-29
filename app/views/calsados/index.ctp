
        
<script>
function soloespain()
    {window.location.href='<?php echo $this->webroot?>calsados/enspain';}
</script>

<!--Nivo slider-->
<?php if(!isset($_SESSION["Auth"]["Usuario"]["rol"])){  //session ?>
<div id="slider" class="nivoSlider">
	<img src="<?php echo $this->webroot?>img/mela.png" alt="" data-transition="sliceUpDown"/> 
	<img src="<?php echo $this->webroot?>img/mela.png" alt="" data-transition="sliceUpDown"/>
</div>
<?php }?>
	
<!--Main body-->
<div class="container">
<?php

$style='padding-left:27px; width:935px; ';
 if( isset($_SESSION["Auth"]["Usuario"]["id"])){?>
    <div class="span-7 sidebar last">
        <!--Banner widget-->
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Productos hechos en:")?>        
            </h3>
            <ul>
                <li>
                     <input type="checkbox" onclick="soloespain(this)" <?php echo !isset($_SESSION["hechoen"])?'checked="true"':''?> /> <label><?php ___("Todos los paises")?></label>
                </li>
                <li>
                     <input type="checkbox" onclick="soloespain(this)" <?php echo isset($_SESSION["hechoen"])?'checked="true"':''?> /> <label><?php ___("Espa&ntilde;a")?></label>
                </li>
                                
            </ul>                       
        </div>
        <!--  -->
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Proveedores")?>
            </h3>
            <ul>
           <?php
           App::import('Model', 'Usuario');
           $Usuario = new Usuario();
            $Categoria='';
          //  $Categoria=isset($_GET["categoria_id"])&&$_GET["categoria_id"] ?"and `calsados`.`categoria_id`={$_GET["categoria_id"]} ":' ';
            $Categoria.=isset($_SESSION["hechoen"])?" and calsados.country_id='28' ":' ';
                
           $marcas = $Usuario->query("SELECT COUNT(*) as c, title from (
            select `usuarios`.`title` from calsados, `surtidos`, `fotos`,`usuarios`
            where 
            usuarios.estado=1 and `calsados`.dele=0 $Categoria and
            `calsados`.`usuario_id` =usuarios.id and 
            `calsados`.id = `surtidos`.`calsado_id` and
            `calsados`.id = `fotos`.`calsado_id` and
            `calsados`.`activado`= 1 GROUP by `fotos`.`id`) as provedores group by title");
           
           foreach($marcas as $k=>$v)
            {
                
            $c=$v["0"]["c"];
            $v=$v["provedores"]["title"];
            
            if(!$v)
            continue;
            /*query biult*/    
            $params = $_GET;
            unset($params["provider"]);
             unset($params["categoria_id"]);
             unset($params["subtipo_id"]);                                      
            unset($params["brand"]);
            unset($params["url"]);
            unset($params["tipo_id"]);
            unset($params["tag"]);            
            $params["provider"] = $v;
            $new_query_string = http_build_query($params);
                
            ?>
            <li 
            <?php echo isset($_GET['provider'])&&$v==$_GET['provider']?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php echo $v?> </a>
       	    </li>          
            <?php 
            }?>
            </ul>
        </div> 
        
        
                <?php
         if( isset($_SESSION["Auth"]["Usuario"]["rol"]) &&   $_SESSION["Auth"]["Usuario"]["rol"]=='cliente')
        { ?>  
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Rango de Precios")?>
            </h3>
            <ul>
            <li>
            <a href="<?php echo $this->webroot?>?<?php
            $params = $_GET;
            unset($params["url"]);
            unset($params["f"]);
            unset($params["from"]);
            unset($params["to"]);
            unset($params["tipo_id"]);
            $new_query_string =http_build_query($params);
            
             echo $new_query_string?>">
            <?php ___("Todos") ?>
            </a>
       	    </li>
            
           <?php
           App::import('Model', 'Precio');
           $Precioo = new Precio();   
           $precios = $Precioo->find('all');
           
           $filtro='';
           if(isset($_GET["provider"]) && $_GET["provider"])
           $filtro=" usuarios.title ='".mysql_escape_string($_GET["provider"])."' and ";
           
           if(isset($_GET["categoria_id"]) && $_GET["categoria_id"])
           $filtro.=" surtidos.categoria_id ='".mysql_escape_string($_GET["categoria_id"])."' and ";
           
           foreach($precios as $precioz)
           {
            
            
           $hay = $Precioo->query("select count(*) as c from calsados, `surtidos`, `fotos`,usuarios
            where $filtro
            usuarios.id=calsados.usuario_id and 
            usuarios.estado=1 and
            `calsados`.dele=0 and
            `calsados`.id = `surtidos`.`calsado_id` and
            `calsados`.id = `fotos`.`calsado_id` and
            `calsados`.`activado`= 1 and
            (surtidos.precio_sur + surtidos.precio_sur*usuarios.comision/100) BETWEEN {$precioz["Precio"]["de"]} and {$precioz["Precio"]["a"]} 
            GROUP by `fotos`.`id`"); 
            
           if(!isset($hay["0"]["0"]["c"]) ||  !$hay["0"]["0"]["c"]>0)
           continue;
            
            $params = $_GET;
            unset($params["url"]);
            $params["f"]='price';
            $params["from"]=$precioz["Precio"]["de"];
            $params["to"]=$precioz["Precio"]["a"];
            $new_query_string =http_build_query($params);
            ?>
            <li <?php echo isset($_GET["from"])&&$_GET["from"]==$precioz["Precio"]["de"]&&isset($_GET["to"])&&$_GET["to"]==$precioz["Precio"]["a"]?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>">
            <?php echo $precioz ["Precio"]["de"]?>&euro; - <?php echo $precioz["Precio"]["a"]?>&euro;
            </a>
       	    </li>          
           <?php }?>
           </ul>
        </div>
        <?php
        }?>
        
        <?php if(!isset($_GET["provider"])){ ?>
        
        <?php if(isset($_GET["categoria_id"])){
        ?>
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Productos Destacados")?>        
            </h3>
         <ul>
           <?php  
           
           App::import('Model', 'Categoria');
           $Categoria = new Categoria();   
           $categorias = $Categoria->id=$_GET["categoria_id"];
           $cat=$Categoria->field("title");     
                   
           App::import('Model', 'Tipo');
           $Tipo = new Tipo();
           $cat_id=intval($_GET["categoria_id"]); 
           
           $sqlp='';
           $params=array();
           if(isset($_GET["provider"]) && $_GET["provider"] )
           {           
                $title = mysql_escape_string($_GET["provider"]);                                                              
                $sql="select id from usuarios where title='$title' and rol = 'proveedor'";                
                $res = mysql_fetch_assoc(mysql_query($sql));
                $res= $res["id"];
                if($res)
                $sqlp=" and  c.`usuario_id`=$res ";
           $params["provider"]=$_GET["provider"];
           }
           $sql="select t.* from calsados c, fotos f, surtidos s, `tipos` t
           where c.`id`=f.`calsado_id` and c.`id`=s.`calsado_id` and s.`tipo_id`= t.id and
           c.`activado`=1 $sqlp and s.`categoria_id`=$cat_id  and t.`activo`=1 GROUP by t.id";
           
           $tipos=$Tipo->query($sql);
            $new_query_string = http_build_query($params);
             foreach($tipos as $kk=>$vv)
                {
                    $kk=$vv["t"]["id"];
                    $vv=$vv["t"]["title"];
                    ?>
              <li <?php echo isset($_GET["tipo_id"])&&$_GET["tipo_id"]==$kk?'class="current"':''?>><a href="<?php echo $this->webroot?>subcat/<?php echo $_GET["categoria_id"]?>/<?php echo $kk?>/<?php echo $cat?>/<?php echo $vv?>?<?php echo $new_query_string?>  "><?php ___($vv)?></a>  
              </li> 
                      
            <?php }?>
        </ul>               
        </div>
        <?php } ?>  
        
         <?php
        if(isset($_GET["categoria_id"])){
            
            App::import('Model', 'Categoria');
           $Categoria = new Categoria();   
           $categorias = $Categoria->id=$_GET["categoria_id"];
           $cat=$Categoria->field("title");
            
           $tallagrande=$Categoria->field("tallagrande");
           $tallachica=$Categoria->field("tallachica");
         if($tallagrande && $tallachica){
         
         ?>
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Tallas")?>        
            </h3>
         <ul>
         <?php
        $params = $_GET;
        unset($params["sizema"]);
        unset($params["sizeme"]);
        unset($params["brand"]);
        unset($params["tipo_id"]);
        unset($params["url"]);
        unset($params["tag"]);
        $params["sizema"]=$tallagrande;
        $new_query_string = http_build_query($params);
         ?>
         <li <?php echo isset($_GET['sizema'])&&$tallagrande==$_GET['sizema']?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php ___("Tallas grandes")?></a>
       	 </li>
         <?php
            unset($params["sizema"]);
            $params["sizeme"]=$tallachica;
            $new_query_string = http_build_query($params);
          ?>         
         <li <?php echo isset($_GET['sizeme'])&&$tallachica==$_GET['sizeme']?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php ___(utf8_encode("Tallas pequeñas"))?></a>
       	 </li>
        </ul>               
        </div>
        
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Pieles")?>
            </h3>
            <ul>
           <?php
           App::import('Model', 'Calsado');
           $Calsado = new Calsado();   
           $marcas = $Calsado->query('
            SELECT COUNT(*) as c, material_id, title from(
            select `calsados`.`material_id`, materials.title from calsados, `surtidos`, `fotos`,usuarios, materials
            where
            usuarios.id=calsados.usuario_id and usuarios.estado=1 and
            `calsados`.dele=0 and
            `surtidos`.`categoria_id`='.$_GET["categoria_id"].' and
            `calsados`.id = `surtidos`.`calsado_id` and
            `calsados`.id = `fotos`.`calsado_id` and
            `calsados`.`activado`= 1 and materials.id = `calsados`.`material_id` GROUP by `calsados`.`id`) as marcas group by material_id');

            foreach($marcas as $k=>$v)
            {
         
     
            $c=$v["0"]["c"];
            $v=$v["marcas"]["title"];
            if(!$v)
            {
                continue;
            }
              
                /*query biult*/    
            $params = $_GET;
            unset($params["provider"]);
            unset($params["brand"]);
            unset($params["url"]);
            unset($params["tag"]);
            unset($params["tipo_id"]);
            unset($params["material_id"]);
            
            
            $params["material_id"] = $v;
            $new_query_string = http_build_query($params);
            ?>
            <li 
            <?php echo isset($_GET["material_id"])&&$_GET["material_id"]==$v?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php echo $v?> (<?php echo $c?>)</a>
       	    </li>          
            <?php 
            }?>
        </ul>
        </div>
        <?php }} ?>
        
        <?php if (isset($_GET["categoria_id"]))  { ?>
        <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Tags")?>
            </h3>
            <ul>
           <?php
           App::import('Model', 'tag');
           $Tag = new Tag();   
           
           if($_GET["categoria_id"])
           $marcas = $Tag->query('select * from tags as Tag where Tag.activo=1 order by Tag.orden asc');
            
            if($marcas)
            foreach($marcas as $k=>$v)
            {
                
                $Categoria=$_GET["categoria_id"]?"and `surtidos`.`categoria_id`={$_GET["categoria_id"]} ":' ';
                $Categoria.=isset($_SESSION["hechoen"])?" and calsados.country_id='28' ":' ';
                
                $sql="select COUNT(*) as x from
                (select fotos.id
                from calsados, `surtidos`, `fotos`, tags, `calsados_tags`,usuarios 
                where 
                `calsados`.dele<>1 and usuarios.estado=1 
                and usuarios.id=calsados.usuario_id 
                and `calsados`.id = `surtidos`.`calsado_id` 
                and `calsados`.id = `fotos`.`calsado_id` 
                and `calsados`.`activado`= 1 $Categoria and `calsados`.id = `calsados_tags`.`calsado_id` 
                and `calsados_tags`.`tag_id` = tags.`id` 
                and `tags`.`activo` = 1 and `tags`.`id` = {$v["Tag"]["id"]} GROUP by `fotos`.id) as t";
                
                $c = $Tag->query($sql);
                
                if(!$c["0"]["0"]["x"])
                continue;
                $v=$v["Tag"]["title"];
                
                
                
            $params = $_GET;
            unset($params["f"]);
            unset($params["from"]);
            unset($params["to"]);
            unset($params["provider"]);
            unset($params["brand"]);
            unset($params["url"]);
            unset($params["tag"]);
            unset($params["tipo_id"]);
            $params["tag"]=$v;
            $new_query_string =http_build_query($params);
            ?>
                <li <?php echo isset($_GET["tag"])&&$_GET["tag"]==$v?'class="current"':''?>>
                <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php echo $v?> (<?php echo $c["0"]["0"]["x"];?>) </a>
           	    </li>          
            <?php 
            }?>
        </ul>
        </div>
        
        <?php
        // if( isset($_SESSION["Auth"]["Usuario"]))
        if(1)
         {
        ?>
       <div class="span-6 widget leftmenu">
            <h3>
            <?php ___("Marcas Disponibles")?>
            </h3>
            <ul>
           <?php
           App::import('Model', 'Calsado');
           $Calsado = new Calsado();   
           $marcas = $Calsado->query('
            SELECT COUNT(*) as c, marca from(
            select `calsados`.`marca` from calsados,usuarios,  `surtidos`, `fotos`
            where 
            `calsados`.dele=0 and usuarios.id=calsados.usuario_id and usuarios.estado=1 and
            `surtidos`.`categoria_id`='.$_GET["categoria_id"].' and
            `calsados`.id = `surtidos`.`calsado_id` and
            `calsados`.id = `fotos`.`calsado_id` and
            `calsados`.`activado`= 1 GROUP by `calsados`.`id`) as marcas group by marca');

           
            foreach($marcas as $k=>$v)
            {
            $c=$v["0"]["c"];
            $v=$v["marcas"]["marca"];  
                /*query biult*/    
            $params = $_GET;
            unset($params["provider"]);
            unset($params["brand"]);
            unset($params["url"]);
            unset($params["tag"]);
            unset($params["tipo_id"]);
            
            $params["brand"] = $v;
            $new_query_string = http_build_query($params);
            
            if(!$v)
            continue;    
                
            ?>
            <li 
            <?php echo isset($_GET["brand"])&&$_GET["brand"]==$v?'class="current"':''?>>
            <a href="<?php echo $this->webroot?>?<?php echo $new_query_string?>"><?php echo $v?> (<?php echo $c?>)</a>
       	    </li>          
            <?php 
            }?>
        </ul>
        </div>
        
        
        <?php }?>
       <?php }?>
        <?php }?>  
            
    </div>
<?php
$style='width: 700px;';
 }?>
	<div class="span-17 shop-category last" style="<?php echo $style?>">
    <?php
    if(isset($_GET["provider"])) // para los proveedores
    {
               
        $title = mysql_escape_string($_GET["provider"]);                                                              
        $sql="select * from usuarios where title='$title' and rol = 'proveedor'";                
        $res = mysql_fetch_assoc(mysql_query($sql));
        
        ?>
        <div class="thumb" style="text-align: center; padding-bottom: 10px;">
        <h2 style="font-family: YanoneKaffeesatzBold;"><?php ___("Proveedor:")?> <?php echo $res["title"]?></h2>
        <?php if(file_exists('img/prov/'.$res["img"])) : ?>
            <img style="max-width: 150px; max-height: 65px;margin-bottom: 10px;" src="<?php echo $this->webroot?>img/prov/<?php echo $res["img"]?>" />
            <br />
        <?php endif; ?> 
            
            
                   
        
        
        <?php
        $sql="select DISTINCT `categorias`.`title` as cat ,`tipos`.`title` as tipo 
        ,`categorias`.`id` as cat_id, `tipos`.`id` as tipo_id
        from categorias, `usuarios`, calsados, surtidos, `fotos`,tipos
            where calsados.dele<>1 
            and usuarios.estado=1 
            and usuarios.id=calsados.usuario_id 
            and `calsados`.id = `surtidos`.`calsado_id` 
            and `calsados`.id = `fotos`.`calsado_id` 
            and `calsados`.`activado`= 1 
            and `tipos`.id = `surtidos`.`tipo_id`
            and `categorias`.id = `surtidos`.`categoria_id`
            and `usuarios`.`title` = '$title'
            GROUP by `calsados`.id
            ORDER by `categorias`.`orden` desc";
      $resultados = mysql_query($sql);      
      ?>
      <?php ___("Buscar por:")?> <select name="tipos" onchange="cambiar(this)">
      <option cat="0" tipo="0"><?php ___(utf8_encode("Últimas incorporaciones"))?> </option>
      <?php
      $cat='';
      while($res = mysql_fetch_assoc($resultados))
      {
        if($cat!=$res["cat"])
        { 
            if($cat) 
            echo "</optgroup>"; 
            ?>
      <optgroup label="<?php ___($res["cat"])?>">
        <?php
        $cat=$res["cat"];
        }
        $sel='';
        if( isset($_GET["categoria_id"]) &&  isset($_GET["tipo_id"]) && $_GET["categoria_id"]==$res["cat_id"] && $_GET["tipo_id"]==$res["tipo_id"] )
        $sel='selected="selected"';
      ?>
      <option <?php echo $sel?> cat="<?php echo $res["cat_id"]?>" tipo="<?php echo $res["tipo_id"]?>" > <?php  ___($res["tipo"]) ?> </option>
      <?php } ?>
      </optgroup>
      </select>
      <div style="float: left;"><?php if (sizeof($calsados)>0){
            echo sizeof($calsados)." ";
            if (sizeof($calsados)>1)
            ___(utf8_encode("Artículos"));
            else
            ___(utf8_encode("Artículo"));} ?></div>
      </div>
      <script>
      function cambiar(select)
      {
        
        jQuery(function(){
          window.location.href='<?php echo $this->webroot?>?provider=<?php echo $title?>&categoria_id='+$(select).find("option:selected").attr('cat')+'&tipo_id='+$(select).find("option:selected").attr('tipo')+'';
        });
      }
      </script>
<?php }else{
?>
<div><?php
if (sizeof($calsados)>0){
  echo sizeof($calsados)." ";
  if (sizeof($calsados)>1)
   ___(utf8_encode("Artículos"));
  else
    ___(utf8_encode("Artículo"));  
} ?></div>
<?php
      }  
        if(isset($_GET["p"]) && $_GET["p"])
        $p=$_GET["p"];
        else
        $p=0;
        
        if(isset($_GET["n"]))
        $n=$_GET["n"];
        else
        $n=15;
        
        $i=1;        
         /**  para cada calzado */
        $items=sizeof($calsados); 
         
         if($calsados)
         {
            if($p)
            {
                 $c=array_slice($calsados,$p*$n);
                if(sizeof($c)>0)
                $calsados=$c;
            }
            

            //sacamos solo lo items requeridos
            if(isset($_GET["n"]))
            $n=$_GET["n"];
            else
            $n=15;
            
            $output = array_slice($calsados, 0, $n); 

                                    
          foreach($output as $calsado)
           {
            $foto=$calsado["Foto"];
            /*reviso que tenga proveedor*/
            $precio=0;
            /*paguinador*/        
            if($i>$n)
            break;
            /**/
            $last='';
            if($i%3=='0')
            $last=' last';?>
                    <!--Product-->
                    <div class="span-5x shop-product<?php echo $last?>">
        
                        <a href="<?php echo $this->webroot?>item/<?php echo $calsado["Calsado"]["id"] ?>/<?php echo $calsado["Calsado"]["code"]?>/<?php echo $foto["title"]?>">                    
                            <div class="thumb">
                            <img src="<?php echo $this->webroot?>img/Foto/mid/<?php echo $foto["url"]?>" width="195" alt="Shoe" />
                            </div>
                        </a>
                        <div class="title">
                            <a style="font-family: arial; color: #590000; font-weight: bold; font-size: 13px;" href="<?php echo $this->webroot?>item/<?php echo $calsado["Calsado"]["id"] ?>/<?php echo $calsado["Calsado"]["code"]?>/<?php echo $foto["title"]?>"><?php echo strlen($calsado["Calsado"]["code"]) >= 25 && !isset($_SESSION["Auth"]["Usuario"]["id"]) ? mb_strimwidth($calsado["Calsado"]["code"], 0, 21, "...") : $calsado["Calsado"]["code"];?></a>
                            &nbsp; <?php echo $foto['title'];?>&nbsp;
                        </div>
                        
                        
                        <?php if( isset($_SESSION["Auth"]["Usuario"]["rol"])){
                         
                         /*requerimiento primero aparecen las cajas surtidas*/
                        $surtidos=array(); 
                        $precios=array();// el precio mas bajo
                        $sql="Select * from surtidos where calsado_id={$calsado["Calsado"]["id"]}";
                        $sql=mysql_query($sql);
                        while($surtido = mysql_fetch_assoc($sql))
                        $surtidos[]=$surtido;
                         
                        foreach($surtidos  as $surtido)
                         {  
                           if($surtido["oferta"]=='1' && $surtido["precio_sur_oferta"]<$surtido["precio_sur"] && $surtido["precio_sur_oferta"])
                            $p=$surtido["precio_sur_oferta"];
                           else if( $surtido["precio_sur"])
                            $p=$surtido["precio_sur"];
                           else
                           continue; // no hay precios
                            $p=$p+$p*$calsado["Usuario"]["comision"]/100;
                           ?>
                            <div style="width: 200px; line-height: 12px; overflow: hidden;">
                            <div style="float: left;">
                            <?php 
                            $parez='pares';
                            if($surtido["pares"]==1)
                            $parez='par';
                            
                              if($surtido["tipo"]=='cajas_surtidas')
                              echo $surtido["talla_inf"]."x".$surtido["talla_sup"]." - ".$surtido["pares"]." ".___($parez,1)." <br>";
                              else
                              echo $surtido["talla_inf"]."x".$surtido["talla_sup"]." - ".$surtido["pares"]." ".___($parez,1)." <br>";?>
                            </div>
                            </div>                              
                            <?php $precios[]=$p; }
                            
                            sort($precios);
                            $precio=$precios[0];
                            if( isset($_GET["f"]) && $_GET["f"] == 'price')
                            {
                                foreach($precios as $preciox)                                
                                if($preciox>=$_GET["from"] && $preciox<=$_GET["to"]  )
                                $precio=$preciox;
                            }
                            
                
                             ___("Precio por par:"); echo "     <b>".number_format($precio,2)." &euro;</b>";
                            /**/
                            $p=0;//clear
                            ?>
                             <div class="view_more" style="float: right; padding: 0; margin-right: 20px;">
                                <a href="<?php echo $this->webroot?>item/<?php echo $calsado["Calsado"]["id"] ?>/<?php echo $calsado["Calsado"]["code"]?>/<?php echo $foto["title"]?>" class="buy"><?php ___("Ver mas")?></a>                 
                       	    </div>
                    
                    <?php
                     $i++;
                 }?>
                 </div>
                 
                  <?php if(isset($_SESSION["Auth"]["Usuario"]["rol"]) && $last==' last'){ ?>
                 <div style="width: 100%; clear: both;"></div>
                 <?php } ?>

                 <?php
        }}
        else
        {   
            if(isset($buscar))
            {
                ___("No se encontraron artículos en la busqueda");
            }
                ___("No hay art&iacute;culos para esta categor&iacute;a");
        }
        if($items>$n || ($items != 0 && count($items) > 0)){
        ?>
        <!--Product-->
        
        <div class="span-17 shop-category" style="width: <?php echo isset($_SESSION["Auth"]["Usuario"]["rol"]) ? "675px" : "97%"?>;">
        
        <form method="GET" style="float: left;">
<?php

 ___("Mostrar") ?>:
<?php

if(isset($_GET["p"]) && $_GET["p"])
{
    $pp=intval($_GET["p"]);
}
else
{
    $pp=0;
}

?>
        
        <input name="p" type="hidden" value="<?php echo $pp?>" />
        <select name="n" onchange="$(this).parent().submit();" >
        
        
            <option <?php echo $n==15?'selected="selected"':''?> value="15">15</option>
            <option <?php echo $n==30?'selected="selected"':''?> value="30">30</option>
            <option <?php echo $n==60?'selected="selected"':''?> value="60">60</option>
        </select>
        <?php ___("Productos") ?>
        </form>
        
        <div style="float: right;">
        
        <div style="float: left;padding-top: 6px;">
        <?php ___("P&aacute;gina")?> &nbsp; 
        </div>
        <?php
        if($n)
        $pages=ceil($items/$n);
        $r=0;
       
        while($r<$pages)
        { 
          
          
          $params = $_GET;
          $params["p"]=$r;
          $params["n"]=$n;
          unset($params["url"]);
          $string=http_build_query($params);
          
            ?>
            <a class="button buy <?php echo $r==$pp?'black':'' ?>" 
            href="?<?php echo $string?>"><?php echo $r+1?></a>
                   
        <?php
        $r++;
         }
         
         
         ?>
        
        
        </div>
        
        </div>
        <?php }?>
       
<!--
     <div class="span-17 shop-category" style="width: 700px;">
    <br />
    <h3> <b>About online shopping!</b></h3>
    <p>Etiam sed tortor sit amet risus semper ornare. Nam porta semper posuere. Praesent vel nisl sed ipsum pellentesque vestibulum vitae ut libero. Cras pharetra viverra placerat. Praesent ac ipsum at nisl mattis aliquet ut vitae lorem. 
Morbi nec purus vel nunc placerat ornare quis id tellus.
    
    <p>Praesent vel nisl sed ipsum pellentesque vestibulum vitae ut libero. Cras pharetra viverra placerat. Praesent ac ipsum at nisl mattis aliquet ut vitae lorem. </p>
    </p> 
    </div> 
-->                    
	</div>
     

    
    <!--Sidebar-->
 

</div>