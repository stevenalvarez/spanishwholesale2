<ul class="nav main">
	<li>
      
        <?php echo $this->Html->link('Galerias',array("controller"=>"galeries","action"=>"index",'sort:orden/direction:asc') ); ?>
		
        <ul>
        
            <?php
            App::import('Model', 'Galery');
            $Galery = new Galery();
            $Galery->recursive=0;
            $galerias=$Galery->find('all');
         //   print_r($galerias);
            
            foreach ($galerias as $galeria)
            {
                ?>
                <li>
				 <?php echo $this->Html->link($galeria["Galery"]["title"],array("controller"=>"galeries","action"=>"view",$galeria["Galery"]["id"]),array("escape"=>false)); ?>
			    </li>
                
                <?php
            } 
            ?>
        
        
			<li>
				 <?php echo $this->Html->link(__('Añadir Galeria', true),array("controller"=>"galeries","action"=>"add"),array("escape"=>false) ); ?>
			</li>
            
		</ul>
      
	</li>
    

	<li>
		<?php echo $this->Html->link('Home',array("controller"=>"pages","action"=>"edit",1) ); ?>		
	</li>
  
  
  	<li>
		<?php echo $this->Html->link('About',array("controller"=>"pages","action"=>"about",2) ); ?>		
	</li>

    <li class="secondary"><?php echo $this->Html->link(__('Salir', true),array("controller"=>"users","action"=>"logout"),array("escape"=>false) ); ?></li>
    
 
</ul>