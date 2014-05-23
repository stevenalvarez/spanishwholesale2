<?php
//
//seo=$this->Userlog->query("select v from seo where k='seo'");
//    //   echo base64_decode($seo[0]["seo"]["v"]);

//
//       $this->set('seo',$seo);
 App::import('Model', 'Categoria');
 $Categoria = new Categoria();   
           
$seo=mysql_query("select v from seo where k='seo'");
$seo=mysql_fetch_assoc($seo);
$seo= unserialize(base64_decode($seo["v"]));

if(!isset($_SESSION["cake_lang"]))
$_SESSION["cake_lang"]='eng';
        
if(isset($_SESSION["cake_lang"]) && $_SESSION["cake_lang"]=='eng')
 {
    $lang='eng';
    $lan='en';
 }
 else
 {
    $lang='esp';
    $lan='es';
 }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!--Web description and keywords-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="etgardo@gmail.com" />
<?php if(isset(  $calsado    )){    ?>
<?php
$desc='';

if($calsado["Categoria"]["title"])
{
  $desc.=  $calsado["Categoria"]["title"].",";
}

if($calsado["Country"]["title"])
{
  $desc.=  $calsado["Country"]["title"].",";
}
if(isset($calsado["Calsado"]["material"]) && $calsado["Calsado"]["material"])
{
  $desc.=  $calsado["Calsado"]["material"].",";
}
if($calsado["Tipo"]["title"])
{
  $desc.=  $calsado["Tipo"]["title"].",";
}
if($calsado["Subtipo"]["title"])
{
  $desc.=  $calsado["Subtipo"]["title"].",";
}

if($calsado["Usuario"]["title"])
{
  $desc.=  $calsado["Usuario"]["title"].",";
}

if($calsado["Calsado"]["marca"])
{
  $desc.=  $calsado["Calsado"]["marca"].",";
}

if($calsado["Calsado"]["code"])
{
  $desc.=  $calsado["Calsado"]["code"].",";
}


foreach( $calsado["Tag"] as $c)
{

$desc.=___($c["title"],1).",";    
}

foreach( $calsado["Foto"] as $c)
{
$desc.=___($c["title"],1).",";    
}
$desc=$desc."SpanishWholesale.com";
?>

<meta name="keywords" content="<?php echo $desc?>" />

<meta name="description" content="<?php echo $calsado["Calsado"]["texto"]?>" />
<meta name="robots" content="noindex,follow" />
<meta name="title" content="<?php echo $calsado["Calsado"]["code"]?>" />

<?php }else{?>
<meta name="keywords" content="<?php echo $seo["keywords_".$lan]?>" />
<meta name="description" content="<?php echo $seo["desc_".$lan]?>" />
<meta name="robots" content="noindex,follow" />
<meta name="title" content="<?php echo $seo["titulo_".$lan]?>" />
<?php }?>
<!--Web description and keywords-->

	<?php echo $this->Html->charset('UTF-8'); ?>
    <?php
    if ($title_for_layout=='Calsados')
    $title_for_layout=___("Calzados",1);
    
    ?>
    
	<title>
		SpanishWholesale - <?php
        if(isset($calsado)){            
          echo $calsado["Calsado"]["code"];            
        }
        else
         echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('style2','prettyPhoto'));
		echo $this->Html->script(array('jquery-1.7.2.min','jquery.carousel','jquery.superfish','jquery.intent','jquery.nivoslider','jquery.prettyphoto','jquery.functions'));
		echo $scripts_for_layout;
        

      
        
      //  $_SESSION["cake_lang"]='eng';
    ?>
    <!--[if IE]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" />
    <![endif]-->
<link href="<?php echo $this->webroot?>css/jquery.fancybox-1.3.4.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $this->webroot?>js/fancybox/jquery.fancybox-1.3.4.pack.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>

<!--Header-->
<div id="header">
<div class="top_header">
    <div class="menu_header">
    <ul >
      
        <li><a href="<?php echo $this->webroot?>"><?php ___("Home")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/nosotros_<?echo $lang?>"><?php ___("Quienes Somos")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/terminos_<?echo $lang?>"><?php ___("T&eacute;rminos Legales")?></a></li>
        <li><a href="<?php echo $this->webroot?>calzados/contacto"><?php ___("Contacto")?></a></li>
        
         <li style="float: right; font-size: 11px; text-align: right; padding: 10px 0px;font-weight: normal;">
         
        "We use cookies to provide you with a better customer and browsing experience. <br/>By using our site, you are accepting our use of  <a style="color: white;font-weight: bold;" href="<?php echo $this->webroot?>pages/terminos_<?php echo $lang?>">cookies</a>."
         <!--
         <a href="<?php echo $this->webroot?>translates/change/eng"><img <?php if($_SESSION["cake_lang"]!='eng'){ echo "style='opacity: 0.7;'";}?> src="<?php echo $this->webroot?>img/eng.png" /></a>
           <a href="<?php echo $this->webroot?>translates/change/esp"><img <?php if($_SESSION["cake_lang"]=='eng'){ echo "style='opacity: 0.7;'";}?> src="<?php echo $this->webroot?>img/esp.png" /></a> -->
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
        	<img src="<?php echo $this->webroot?>img/logo.png" height="96" alt="Crazy Shoes" />
        </a>
      	</div>
        <div class="options">        
        	   
           
            <?php
            if( isset($_SESSION["Auth"]["Usuario"]["rol"]) && $_SESSION["Auth"]["Usuario"]["rol"]=='cliente')
            {   
                $rep="select * from pedidos where confirmado=0 and usuario_id={$_SESSION["Auth"]["Usuario"]["id"]}";
                $rep=mysql_query($rep);
                while($pedido=mysql_fetch_array($rep))
                {
                    $pedidos[]=$pedido;
                }
            ?> 
            
           <div class="user_info">
            <?php ___("Hola")?>	<?php echo $_SESSION["Auth"]["Usuario"]["title"]?> | <a href="<?php echo $this->webroot?>cliente/usuarios/logout">Log Out</a>
            </div>       
            <div class="login plomo">
            	<a href="<?php echo $this->webroot?>cliente/usuarios/micuenta"><?php ___("Mi Cuenta")?></a>
            </div>
            <div class="login plomo">
            	<a href="<?php echo $this->webroot?>cliente/pedidos/canasta"><?php ___("Mis pedidos")?></a>
                 <?php
                 if(isset($pedidos) && sizeof($pedidos))
                 {?>/<span class="price"><?php echo sizeof($pedidos) ?> <?php ___("pedidos")?></span>
                 <?php }?>
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
            	<a class="ncos" href="<?php echo $this->webroot?>cliente/usuarios/add"><?php ___(utf8_encode("Reg�strate"))?></a>
            </div>            
            <div class="login plomo">
            	<a onclick="$('#login_area').fadeIn()" href="javascript:void(0)"><?php ___(utf8_encode("Acceder"))?></a>
            </div>

            <?php }?>

        </div>
        <!-- login -->
        <?php             if( ! isset($_SESSION["Auth"]["Usuario"]["rol"]))
            { ?>
            <div class="options" style="display: none;" id="login_area">   
            	<div class="login plomo log">
            		<form accept-charset="utf-8" method="post" id="UsuarioClienteLoginForm" action="<?php echo $this->webroot?>cliente/usuarios/login">
            			<input type="hidden" value="POST" name="_method"/>
            			<input type="text" id="UsuarioEmail" maxlength="50" name="data[Usuario][email]" value="Email" onfocus="if(this.value=='Email')this.value=''"/>
            			<input type="password" id="UsuarioPassword" name="data[Usuario][password]" value="111111" onfocus="if(this.value=='111111')this.value=''"/>
            			<div class="submit">
            				<a style="font-size: 10px; display: block; float: left; padding-top:25px ;" href="<?php echo $this->webroot?>cliente/usuarios/recuperar"><?php ___(utf8_encode("HE OLVIDADO MI CONTRASE�A"))?></a>
            				<input style="float: right;margin-top: 5px;" type="submit" value="<?php ___("Entrar")?>"/>
            			</div>
            		</form>
            	</div>
            </div>
        <?php }?>
        
	</div>
</div>

<!--Menu and search bar-->
<?php echo $this->element('menu')?>
<?php $msj=$this->Session->flash();
if($msj)
     { ?>
        <div style="display: none;">
        <?php  echo $msj; ?>
        <script>
        jQuery(function(){
            alert($("#flashMessage").text());
        });
        </script>
        </div>
    <?php }?>
<?php
if($this->params["controller"]=='pages')//solo si viene desde el pages controller
{?>
<div class="container">    
    <?php  echo $content_for_layout;?>
</div>
<?php    
}
else
 echo $content_for_layout; ?>

<!--Footer-->
<div id="footer">
	<div class="inner">
    	<div class="container">
            <div class="span-15 in">
            <div class="span-15">	
                <ul class="footer-ul">
                <li><a href="<?php echo $this->webroot?>"><?php ___("Home")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/nosotros_<?echo $lang?>"><?php ___("Quienes Somos")?></a></li>
        <li><a href="<?php echo $this->webroot?>pages/terminos_<?echo $lang?>"><?php ___("T&eacute;rminos Legales")?></a></li>
        <li><a href="<?php echo $this->webroot?>calzados/contacto"><?php ___("Contacto")?></a></li>
                </ul>
            </div>
            
            <div class="span-15">
            Copyright &copy; 2012. All Rights Reserved by <a href="http://www.spanishwholesale.com/" style="color: white;">SpanishWholesale.com</a> 	
            </div>
            
            </div>
            <div class="span-8 last" style="float: right;">
            <img height="96" class="floatright" src="<?php echo $this->webroot?>img/footer.png" />
            </div>
            
        </div>
    </div>
    
    <div>
    <!--<div class="inner">
    	<div class="container">
    "We use cookies to provide you with a better customer and browsing experience. By using our site, you are accepting our use of  <a style="color: white;" href="<?php echo $this->webroot?>pages/terminos_<?php echo $lang?>">cookies</a>."
    </div></div>-->
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


$("q").each(function(){
    
    $(this).click(function(){
        
        var trad = prompt("Traduce '"+$(this).text()+"'");
        if(trad)
        {   
            $.ajax({type:"post",url:"<?php echo $this->webroot?>admin/translates/ajaxedit/",
            data:"val="+$(this).text()+"&trad="+trad,
            dataType:"text"});
            $(this).text(trad);
        }   
        
    });
});

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-40291003-1', 'spanishwholesale.com');
  ga('send', 'pageview');


</script>