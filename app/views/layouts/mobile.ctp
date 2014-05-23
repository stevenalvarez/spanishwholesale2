<!DOCTYPE html> 
<html> 
<head>
	<?php echo $this->Html->charset('UTF-8'); ?>
	<title>
		SpanishWholesale - <?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
	<?php
		echo $this->Html->meta('icon');	   
        echo $this->Html->css('reset');
      //  echo $this->Html->css('jquery.mobile-1.1.0.min');
        echo $this->Html->css('mobile_site');        
      //   echo $this->Html->script(array('jquery-1.7.2.min','jquery.mobile-1.1.0.min'));
         echo $this->Html->script(array('jquery-1.7.2.min'));
		echo $scripts_for_layout;
    ?>
</head>
<body>
<div id="container" data-role="page">
    <div id="header">
        <a href="<?php echo $this->webroot?>"><?php  echo  $this->Html->image('rickyblanco200.png', array('alt' => 'RICKY BLANCO' , 'title' => 'RICKY BLANCO', 'width'=>'200' ))?></a>
    </div>
    <div id="content">
       
    <?php echo $this->element('side_menu_mobile');?>
    <?php echo $content_for_layout; ?> 
   </div>
    <div id="footer">
    <p>
    E: <a href="mailto:info@rickyblanco.es">info@rickyblanco.es</a> - T: 605843887
    </p>
    </div>

</div>
</body>
</html>
