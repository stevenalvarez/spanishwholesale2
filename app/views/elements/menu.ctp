<div id="menubar">
  <div class="inner">
  
  <?php
   App::import('Model', 'Categoria');
   $Categoria = new Categoria();   
   $categorias = $Categoria->find('list',array('conditions'=>array('Categoria.activo'=>'1'),'order'=>'Categoria.orden asc',
   
   'joins'=>array(
               array('table' => 'calsados',
                'alias' => 'Calsado',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.activado'=>'1', 'Calsado.dele'=>'0'
                )), 
               array('table' => 'fotos',
                'alias' => 'Foto',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.id =Foto.calsado_id'
                ))
                ,
                array('table' => 'surtidos',
                'alias' => 'Surtido',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.id =Surtido.calsado_id',
                'Surtido.categoria_id =Categoria.id',
                ))
                ,array('table' => 'usuarios',
                'alias' => 'Usuario',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.usuario_id =Usuario.id', 'Usuario.estado'=>1
                ))
                
                
                )));
   
         
        
  App::import('Model', 'Tipo');
   $Tipo = new Tipo();
   
   App::import('Model', 'Subtipo');
   $Subtipo = new Subtipo();
  
    $lasturl='';
    $ccat='';
    $sccat='';
    $ssccat='';
    
 // print_r($this);
    
  if (isset($this->viewVars["calsado"]["Categoria"]["title"]))
  { $_GET['categoria_id'] = $this->viewVars["calsado"]["Categoria"]["id"];
  if (isset($this->viewVars["calsado"]["Tipo"]["title"]))
   $_GET['tipo_id'] = $this->viewVars["calsado"]["Tipo"]["id"];
   if (isset($this->viewVars["calsado"]["Subtipo"]["title"]))
  $_GET['subtipo_id'] = $this->viewVars["calsado"]["Subtipo"]["id"];
  
  }  

?>
    
        <ul class="navigation">
        <!--  <li <?php echo $this->params["pass"]?'':'class="current"'?>><a href="<?php echo $this->webroot?>"><?php ___("Inicio")?></a>
          	<ul>
            	<li><a href="index.html">Home style</a></li>
                               
                 <li><a href="index-1.html">Home style 1</a></li>
                                <li><a href="index-2.html">Home style 2</a></li>
               
            </ul> 
          </li>-->
          <?php foreach($categorias as $k=>$v)
            {
              $tipos=$Tipo->find('list',array('conditions'=>array('activo'=>'1','Surtido.categoria_id'=>$k),'order'=>'Tipo.orden asc','joins'=>array(
               array('table' => 'calsados',
                'alias' => 'Calsado',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.activado'=>'1', 'Calsado.dele'=>'0'
                )), 
               array('table' => 'fotos',
                'alias' => 'Foto',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.id =Foto.calsado_id'
                ))
                ,
                array('table' => 'surtidos',
                'alias' => 'Surtido',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.id =Surtido.calsado_id',
                'Surtido.tipo_id =Tipo.id'
                ))
                ,array('table' => 'usuarios',
                'alias' => 'Usuario',
                'type' => 'RIGHT',
                'conditions' => array(
                'Calsado.usuario_id =Usuario.id', 'Usuario.estado'=>1
                ))
                )));
          ?>
          <?php

          if( isset($_GET['categoria_id'])&&$_GET['categoria_id']==$k )          
          $ccat = $v;?>
          
          <li <?php echo isset($_GET['categoria_id'])&&$_GET['categoria_id']==$k?'class="current"':''?>><a href="<?php echo $this->webroot?>cat/<?php echo $k?>/<?php echo($v)?><?php echo $lasturl?>"><?php ___($v)?></a>
          	<ul>            
                <?php foreach($tipos as $kk=>$vv)
                {                    
                     $Subtipos=$Subtipo->find('list',array('conditions'=>array('activo'=>'1','Surtido.categoria_id'=>$k,'Surtido.tipo_id'=>$kk),'order'=>'Subtipo.orden asc','joins'=>array(
                    array('table' => 'calsados',
                    'alias' => 'Calsado',
                    'type' => 'RIGHT',
                    'conditions' => array(
                    'Calsado.activado'=>'1','Calsado.dele'=>'0'
                    )), 
                    array('table' => 'fotos',
                    'alias' => 'Foto',
                    'type' => 'RIGHT',
                    'conditions' => array(
                    'Calsado.id =Foto.calsado_id'
                    ))                    ,
                    array('table' => 'surtidos',
                    'alias' => 'Surtido',
                    'type' => 'RIGHT',
                    'conditions' => array(
                    'Calsado.id =Surtido.calsado_id',
                    'Surtido.subtipo_id =Subtipo.id'
                    ))
                    ,array('table' => 'usuarios',
                    'alias' => 'Usuario',
                    'type' => 'RIGHT',
                    'conditions' => array(
                    'Calsado.usuario_id =Usuario.id', 'Usuario.estado'=>1
                    ))
                    )));
                    ?>
                    <?php
                      
                      if(isset($_GET['tipo_id'])&&$_GET['tipo_id']==$kk )          
                      $sccat = $vv;           ?>
                    
                    <li <?php echo isset($_GET['categoria_id'])&&isset($_GET['tipo_id'])&&$_GET['tipo_id']==$kk&&$_GET['categoria_id']==$k?'class="current"':''?>><a href="<?php echo $this->webroot?>subcat/<?php echo $k?>/<?php echo $kk?>/<?php echo($v)?>/<?php echo($vv)?><?php echo $lasturl?>"><?php ___($vv)?></a>
                    <?php 
                    if ($Subtipos)
                        {
                            ?>
                            <ul>
                            <?php foreach($Subtipos as $kkk=>$vvv){?>
                            
                            <?php
                              
                              if(isset($_GET['subtipo_id'])&&$_GET['subtipo_id']==$kkk )          
                              $ssccat = $vvv;           ?>
                            
                            <li <?php echo isset($_GET['categoria_id'])&&isset($_GET['tipo_id'])&&isset($_GET['subtipo_id'])&&$_GET['subtipo_id']==$kkk&&$_GET['categoria_id']==$k&&$_GET['tipo_id']==$kk?'class="current"':''?>><a href="<?php echo $this->webroot?>subtype/<?php echo $k."/".$kk."/".$kkk."/".$v."/".$vv."/".$vvv?><?php echo $lasturl?>"><?php ___($vvv)?></a></li>
                            <?php }?>
                            </ul>
                            <?
                        }?>
                    
                    </li>
                    <?php
               ?>   
               <?php }
    
               ?>
               <li><a href="<?php echo $this->webroot?>cat/<?php echo $k?>/<?php echo($v)?><?php echo $lasturl?>"><?php echo ___("Todo");?></a></li>
            </ul>
          </li>          
            <?php }?>

        </ul>
        <div style="float: right; margin-top: 13px; border: 1px solid #CCCCCC; padding-right: 5px;">
         <form action="<?php echo $this->webroot?>calsados/buscar" method="post">
            <input style="float: right; padding: 0; border:none" type="image" src="<?php echo $this->webroot?>img/lupa.png" />
            <input style="float: right; border: none; height: 17px; background-color: #FAFAFA;"  name="buscar" type="text" class="searchre"  placeholder="<?php ___("ref")?>"/>
                       
            </form>
       </div> 
  </div>
  
  <div class="inner" style="background: #F6F6F4 !important; padding-top: 5px; font-size: 18px; color: #590000;">
  <?php 
  if($ccat )
  {
   ___($ccat);
   if($sccat)
   {
        echo "<b style=''> > </b>"; ___($sccat);
        if($ssccat)
        echo "<b style=''> > </b>"; ___($ssccat);
   }
  }
  
  ?>
  </div>
  
</div>