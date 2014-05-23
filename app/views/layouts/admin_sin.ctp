<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset('UTF-8'); ?>
       <?php
    if ($title_for_layout=='Calsados')
    $title_for_layout=___("Calzados",1);
    
    ?>
	<title>
		SpanishWholesale - <?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php
		echo $this->Html->meta('icon');
	
		echo $this->Html->script(array('jquery-1.7.2.min'));        
		echo $scripts_for_layout;
    ?>
    
                    
</head>

<body>
  <?php // echo $this->element('admin/main_menu2'); ?>
  <div id="container">

    <?php // echo $this->Session->flash(); ?>
    <div id="content"><?php echo $content_for_layout; ?></div>
    <div id="footer"></div>
  </div>
 
<script>
jQuery(function(){
   setTimeout(function(){$("#flashMessage").slideUp()},1000);
 });
</script>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>






