<?php
            App::import('Model', 'Category');
            $Category = new Category();
            $Category->recursive=1;
            $categorias=$Category->find('all');
            $togle=0;
            
            
            
?>           

<div class="main_menu menu">
            <ul>
                <li>
                    
                    <?php $acive='';
                    if($this->params["controller"]=='pages'&&$this->params["action"]=='view')
                    $acive='class="active"';?>
                    <a <?php echo $acive?> href="<?php echo $this->webroot?>" data-ajax="false" >HOME</a>
                </li>
                <li class="li_submenu" id="galeryy">
                    <a>GALLERY</a>                    
                </li>
                <li>
                <?php $acive='';
                    if($this->params["controller"]=='pages'&&$this->params["action"]=='about')
                    $acive='class="active"';?>
                    <a <?php echo $acive?> href="<?php echo $this->webroot?>about">ABOUT ME</a>
                </li>
            </ul>
</div>

<div class="menu submenu" style="display: none;">
<ul>
                    
                        <?php
                        foreach ($categorias as $categoria)
                        {
                         $acive='';
                            ?>
                                <li class="categoriesli">
        				        <span> <?php echo $categoria["Category"]["title"]; ?></span>
                                <?php                                 
                                if($categoria['Galery'][0]){           
                                    $x='';   
                                    foreach ($categoria['Galery'] as $galery)
                                     {                                    
                                      /////// 
                                       $acive2=''; 
                                      if($this->params["controller"]=='galeries' && $this->params["action"]=='view' && $this->params["pass"][0]==$galery["title"])
                                      {
                                       $acive2='active';
                                       $acive='active';
                                       $togle=1;
                                       $sub='true';
                                      }
                                      $x.="<li >".$this->Html->link("-".$galery["title"],array("controller"=>"galeries","action"=>"view",urlencode($galery["title"])),array("escape"=>false,'class'=>$acive2))."</li>";
                                       /////////////// 
                                    }                                   
                                     if($acive=='active' )
                                    $display='';
                                    else
                                    $display=' display: none;';                                                                       
                                    ?>                            
                                    
                                         <ul class="subsubmenu" style="<?php echo $display ?>">
                                         <?php echo $x?>
                                         </ul>
                                       <?php
                                       }?>
                                </li>
                        <?php }?>
</ul></div>
<script>
$("#galeryy").toggle(function(){
  $(".submenu").slideDown();},function(){
  $(".submenu").slideUp();});

$(".categoriesli").click(function(){
   $(this).children("ul").slideDown();
    
});

</script>