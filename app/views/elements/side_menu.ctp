<?php
            App::import('Model', 'Category');
            $Category = new Category();
            $Category->recursive=1;
            $categorias=$Category->find('all');
            $togle=0;
?>           

<div class="menu">
            <ul>
                <li>
                    
                    <?php $acive='';
                    
                    
                    if($this->params["controller"]=='pages'&&$this->params["action"]=='view')
                    $acive='class="active"';?>
                    <a <?php echo $acive?> href="<?php echo $this->webroot?>">HOME</a>
                </li>
                <li class="li_submenu">
                    <a>GALLERY</a>
                    
                    <ul>
                    <li> &nbsp;</li>
                        <?php
                        foreach ($categorias as $categoria)
                        {
                        $acive='';                       
                            ?>
                                <li>
        				        <span class="categories"><?php echo $categoria["Category"]["title"]?></span>
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
                                      $x.="<li >".$this->Html->link($galery["title"]." -",array("controller"=>"galeries","action"=>"view",(rawurlencode($galery["title"]))),array("escape"=>false,'class'=>$acive2))."</li>";
                                       /////////////// 
                                    }
                                    
                                     if($acive=='active' )
                                    $display='';
                                    else
                                    $display=' display: none;';
                                    
                                                                        
                                    ?>
                                    
                                    
                                         <ul style="padding-right: 10px; border-right: 1px solid #CCCCCC; <?php echo $display ?>">
                                         <?php echo $x?>
                                         </ul>
                                       <?php
                                       }?>
                                </li>
                        <?php }?>
                    
                    
                    <li> &nbsp;</li>
                    </ul>
                    
                </li>                   
                
                <li>
                <?php $acive='';
                    if($this->params["controller"]=='pages'&&$this->params["action"]=='about')
                    $acive='class="active"';?>
                                   
                    <a <?php echo $acive?> href="<?php echo $this->webroot?>about">ABOUT ME</a>
                </li>
            </ul>
</div>
<?php if($togle)
{?>
<script>jQuery(function(){$(".li_submenu>a").toggle(function(){$(this).next("ul").slideUp("slow"); },function(){$(this).next("ul").slideDown("slow");});});</script>
<?php }
else

{ ?>
<style>#content .menu li>ul{ display: none;}</style>
<script>jQuery(function(){$(".li_submenu>a").toggle(function(){$(this).next("ul").slideDown("slow"); },function(){$(this).next("ul").slideUp("slow");});});</script>
<?php }?>
<script>

jQuery(function(){
    $(".categories").click(function()
        {
        
            if ($(this).next("ul").is(":visible"))
            $(this).next("ul").slideUp();
            else
            $(this).next("ul").slideDown();
        });
    
});
</script>





