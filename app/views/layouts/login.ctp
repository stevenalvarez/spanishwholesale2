<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('ING Sports:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
  
    <?php
		echo $this->Html->meta('icon');
        echo $this->Html->css('core');
        echo $this->Html->css('core2');
        echo $this->Html->script("jquery-1.7.1.min");
        echo $this->Html->css('../js/fancybox/jquery.fancybox-1.3.4.css');
        echo $this->Html->script("fancybox/jquery.fancybox-1.3.4.js");
        echo $this->Html->script("fancybox/jquery.easing-1.3.pack.js");
    	echo $scripts_for_layout;
	?>
 
    
</head>
<body>
	<div id="container">
		<div id="header">
		    <div class="content_header">
            
            <h2>Practica deporte!</h2>
            
            <?php
            
         //   print_r($this->Session->read('Auth.User'));
            
            
            if($this->Session->read('Auth.User.id'))
            {?>
                  <div class="login">
                  
                  <p>
                  <label>BIENVENIDO</label> <?php echo up($this->Session->read('Auth.User.first_name')." ".$this->Session->read('Auth.User.last_name'))?>
                  
                  <a href="<?php echo $this->webroot?>micuenta">MI CUENTA</a> 
                  <a href="<?php echo $this->webroot?>users/logout">SALIR</a>
                   </p>
                  </div>
                
               <? 
            }
            else{
             ?>
            
            <div class="login">
            <form action="<?php echo $this->webroot?>users/login" method="post">
            <table>
            <tr><td></td><td>Email</td><td>Contraseña</td><td></td></tr>
            <tr><td style="font-weight: bold; width: 135px;">Acceso Registrados</td><td width="198"><input type="text" name="data[User][email]"/></td><td width="166"><input type="password" style="width: 148px;" name="data[User][password]" /></td><td><input type="submit" value="Entrar" /></td></tr>
            <tr><td></td><td><input type="checkbox" style="margin-top: 2px;" />Recordar datos en este equipo </td><td><a href="<?php echo $this->webroot?>Users/recuperar" style="padding: 0; text-decoration: none; cursor: pointer;">¿Olvidaste tu Contraseña?</a></td><td></td></tr>
            </table>
            <input type="hidden" name="redirect" value="<?php echo urlencode($this->webroot."home")  ?>" />          
            </form>
            </div>
            
            <?php
         }
            
            ?>
            
            
            </div>
            
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
            <?php echo $session->flash('auth');?>

			<?php echo $content_for_layout; ?>

		</div>
		<?php echo $this->element("clausula")?>
        
        <div id="footer">
		
        <p><a href="javascript:void(0)" class="show_terms_conditions">Términos y condiciones generales</a> - Información: <a href="mailto:info@ingnnsports.com">info@ingnnsports.com</a> - 692 927 506</p>
        <?php echo $this->element('clausula'); ?>
        
		</div>
        
        
        
        
        
        
        
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>