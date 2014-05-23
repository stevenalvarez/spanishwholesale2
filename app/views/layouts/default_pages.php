<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!--Web description and keywords-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="etgardo@gmail.com" />
<meta name="keywords" content="tienda zapatos, calzados, tenis, cuero" />
<meta name="description" content="tienda de zapatos" />
<meta name="robots" content="noindex,follow" />
<!--Web description and keywords-->

	<?php echo $this->Html->charset('UTF-8'); ?>
	<title>
		SpanishWholesale - <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('style2','prettyPhoto'));
		echo $this->Html->script(array('jquery-1.7.2.min','jquery.carousel','jquery.superfish','jquery.intent','jquery.nivoslider','jquery.prettyphoto','jquery.functions'));
		echo $scripts_for_layout;
        
        if(isset($_SESSION["cake_lang"]) && $_SESSION["cake_lang"]=='eng')
         {
            $lang='eng';
         }
         else
         {
            $lang='esp';
         }
            
        
      //  $_SESSION["cake_lang"]='eng';
    ?>
    <!--[if IE]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" />
    <![endif]-->

</head>
<body>

<!--Header-->
<div id="header">
<div class="top_header">
    <div class="menu_header">
    <ul>
      
        <li><a href="<?php echo $this->webroot?>pages/contacto_<?echo $lang?>"><?php ___("Contacto")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/privacidad_<?echo $lang?>"><?php ___("Privacidad")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/teminos_<?echo $lang?>"><?php ___("T&eacute;rminos Legales")?></a></li>   
        <li><a href="<?php echo $this->webroot?>pages/nosotros_<?echo $lang?>"><?php ___("Sobre Nosotros")?></a></li>
        
         <li style="float: right;">
         <?php
         if(isset($_SESSION["cake_lang"]) && $_SESSION["cake_lang"]=='eng')
         {?>
          <a href="<?php echo $this->webroot?>translates/change/esp"><?php ___("Espa&ntilde;ol");?></a>    
         <?php }
         else
         {?>
           <a href="<?php echo $this->webroot?>translates/change/eng"><?php ___("English");?></a>
        <?php }
         
         ?>
         <!--

         <a href="#">Help</a></li>  
-->   
    </ul>
    </div>
</div>


	<div class="inner">
  
        <!--Logo-->
        <div class="logo">
        <a href="<?php echo $this->webroot?>">
        	<img src="<?php echo $this->webroot?>img/logo.png" width="257" height="96" alt="Crazy Shoes" />
        </a>
      	</div>
        
    	<!--Options-->
        <div class="options">        
        	   
           
            <?php
       //     print_r($_SESSION["Auth"]);
            
            if( isset($_SESSION["Auth"]["Usuario"]["rol"]) && $_SESSION["Auth"]["Usuario"]["rol"]=='cliente')
            {            
            ?> 
            
           <div class="user_info">
            	Hola <?php echo $_SESSION["Auth"]["Usuario"]["title"]?> | <a href="<?php echo $this->webroot?>cliente/usuarios/logout">Log Out</a>
            </div>       
            <div class="login plomo">
            	<a href="<?php echo $this->webroot?>cliente/usuarios/micuenta">My account</a>
            </div>
            <div class="login plomo">
            	<a href="<?php echo $this->webroot?>cliente/pedidos/canasta"><?php ___("Mi Carrito")?></a>
            	<span class="price"><?php echo isset($_SESSION["total"])?$_SESSION["total"]:'0' ?> &euro;</span>
            </div>          
            <?php }
            if( isset($_SESSION["Auth"]["Usuario"]["rol"]) && $_SESSION["Auth"]["Usuario"]["rol"]=='proveedor')
            {
                ?>
                <div class="user_info">
            	Proveedor <?php echo $_SESSION["Auth"]["Usuario"]["title"]?> | <a href="<?php echo $this->webroot?>cliente/usuarios/logout">Log Out</a>
            </div> 
                <?php
                
            }
            if( isset($_SESSION["Auth"]["Usuario"]["rol"]) && $_SESSION["Auth"]["Usuario"]["rol"]=='admin')
            {
                ?>
                <div class="user_info">
            	Admin <?php echo $_SESSION["Auth"]["Usuario"]["title"]?> | <a href="<?php echo $this->webroot?>cliente/usuarios/logout">Log Out</a>
            </div> 
                <?php
                
            }
            if (!isset($_SESSION["Auth"]["Usuario"]["rol"])){ 
            ?>
            <div class="login plomo">
            	<a class="ncos" href="<?php echo $this->webroot?>cliente/usuarios/add">New Costumer Register</a>
            </div>            
            <div class="login plomo">
            	<a onclick="$('#login_area').fadeIn()" href="#">Sing in</a>
            </div>

            <?php }?>
<!--
            <form style="display: none;">
            <input type="text" class="searchre" value="Search by Referrence..." onfocus="if(this.value='Search by Referrence...')this.value=''" />
            
            </form> 
-->           
        </div>
        <!-- login -->
        <?php             if( ! isset($_SESSION["Auth"]["Usuario"]["rol"]))
            { ?>
        <div class="options" style="display: none;" id="login_area">   
              <div class="login plomo log">
                <div>
                <form accept-charset="utf-8" method="post" id="UsuarioClienteLoginForm" action="<?php echo $this->webroot?>cliente/usuarios/login">
                <input type="hidden" value="POST" name="_method"/>
                <input type="text" id="UsuarioEmail" maxlength="50" name="data[Usuario][email]" value="Email" onfocus="if(this.value=='Email')this.value=''"/>
                <input type="password" id="UsuarioPassword" name="data[Usuario][password]" value="111111" onfocus="if(this.value=='111111')this.value=''"/>
                </div>
                <div class="submit">
                <!--<a href="#"><?php ___(utf8_encode("HE OLVIDADO MI CONTRASEÑA"))?></a>-->
                <input type="submit" value="<?php ___("Entrar")?>"/>
                </form>
                </div>             
            </div>
        </div>
        <?php }?>
        
	</div>
</div>

<!--Menu and search bar-->
<?php echo $this->element('menu')?>


<?php echo $content_for_layout; ?>

<!--Footer-->
<div id="footer">
	<div class="inner">
    	<div class="container">
            <div class="span-15 in">
            <div class="span-15">	
                <ul class="footer-ul">
                	<li><a href="#">Home</a></li>
                    <li><a href="#">Mens</a></li>
                    <li><a href="#">Women</a></li>
                    <li><a href="#">Store Products</a></li>
                    <li class="last" style="border: 0;"><a  href="#">Afiliate Products</a></li>
                </ul>
            </div>
            
            <div class="span-15">
            Copyright &copy; 2012. All Rights Reserved by <a href="<?php echo $this->webroot?>" style="color: white;">spanishwholesale </a> 	
            </div>
            
            </div>
            <div class="span-8 last" style="float: right;">
            <img class="floatright" src="<?php echo $this->webroot?>img/footer.png" />
            </div>
            
        </div>
    </div>
</div>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>

<script>
if(document.body.offsetHeight<window.innerHeight)
{
    $("#container").css("min-height",window.innerHeight-50);
}

function traducir(thiss)
{
    jQuery(function(){
        var trad = prompt("Traduce '"+$(thiss).text()+"'");
        if(trad)
        {
            
            $.ajax({type:"post",url:"<?php echo $this->webroot?>admin/translates/ajaxedit/",
            data:"val="+$(thiss).text   ()+"&trad="+trad,
            dataType:"text",context: thiss});
            $(thiss).text(trad);
        }
        
            
    });
    
} 

</script>
