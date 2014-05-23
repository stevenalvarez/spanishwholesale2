
<div class="container fix">    

    <div class="span-18">
    	<div class="span-9">
        	<h2><?php ___("Nuevo Cliente")?></h2>
            <p><strong><?php ___("Registro de Cuenta")?></strong><br/>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu nibh vitae risus scelerisque commodo. Fusce sodales sollicitudin leo sit amet feugiat. Etiam nisl tortor, vulputate quis sodales vel, congue id ligula.</p>
            <a href="<?php echo $this->webroot?>cliente/usuarios/add" class="button"><?php ___("Crear cuenta")?></a>
        </div>
        <div class="span-9 last">
        	<h2>Login</h2>
            <?php echo $this->Form->create('Usuario');?>                       
            <div>
                <label>E-mail</label><br/>
                <?php echo $this->Form->input('email',array('label'=>false,'div'=>false)); ?>
            </div>
            <div>
                <label>Password</label><br/>
                <?php echo $this->Form->input('password',array('label'=>false,'div'=>false));?>
            </div>
            <div id="contactform">
            <?php echo $this->Form->end(array('label'=>'Login','class'=>'send'));?>
            </div>
        </div>
    </div>
    
    
    
    <!--Sidebar-->
    <div class="span-6 sidebar last">
        
        <!--Text widget-->
        <div class="span-6 widget text">
        	<div class="title"><h3>Sobre SpanishWholesale</h3></div>
            <p>Crazy Shoes is a premium, HTML template with an accent on ecommerce content. It comes with a Nivo Slider, many jQuery features, unique design and it's easy to customize plus many demo pages.</p>
        </div>
                
    </div>
</div>

<div id="top-banner">

	
	<div class="title"><?php ___("Registrese y compre al mejor precio")?></div>
</div>
<div id="top-banner">

	<img src="<?php echo $this->webroot?>img/mela.png" width="970" height="300" alt="Banner" />
	
</div>
