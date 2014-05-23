<div id="nav-menu">
<ul>
<li> <a href="#">Inicio</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">
<div class="colors form">
<div id="admin-table">
	<h2>Traducir</h2>
    <div style="padding: 15px;">
	<?php echo $this->Form->create('Translate');?>

	<?php
		echo $this->Form->input('id');
        
       // pr($this->data["Translate"]["esp"]);
    ?>
    
    
    

    
        <p> <b>Espa&ntilde;ol:</b> 
         <?php echo $this->data["Translate"]["esp"] ?>
        </p>
        <br />
        <p> <b>Ingl&eacute;s</b> 
         
        </p>
   

    <?php    
		//echo $this->Form->input('esp',array('type'=>'textarea'));
		echo $this->Form->input('eng',array('type'=>'textarea','label'=>'' ));
	?>

<input type="submit" value="Traducir" class="btn-admin-orange" />
</form>
</div>
    </div>
    </div>    </div>
    <style>
    textarea { width: 100%; }
    </style>