<?php

/**
 * @author Edgardo
 * @copyright 2010
 */

 	$csv->addRow(array('NOMBRE','APELLIDO','E-MAIL','EMPRESA'));
foreach ($newslettermails as $order){
	$csv->addRow(array(utf8_decode($order['Newsletteremail']['nombre']),utf8_decode($order['Newsletteremail']['apellido']),$order['Newsletteremail']['email'],utf8_decode($order['Newsletteremail']['empresa'])));
}
$filename='Newsletteremail';
echo $csv->render($filename);

?>
