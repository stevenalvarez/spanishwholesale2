<table cellpadding="0" cellspacing="0" width="100%">
<tbody>
	<tr>
		<td bgcolor="#660000" height="38" width="100%"><!-- newsletter --></td>
	</tr>

	<tr>
		<td style="border-bottom: 2px solid #660000;" align="center" valign="top">
<table width="800">
<tbody>
	<tr>
		<td><a href="http://spanishwholesale.com" target="_blank" title="SpanishWholesale"><img style="border: 0px;" src="http://spanishwholesale.com/img/logoe.png" height="93" width="244"></a></td>
	</tr>
</tbody>
</table>
</td>
	</tr>

	<tr>
		<td align="center" valign="top">
<table width="750">
<tbody>
	<tr>
		<td><h1 style="font-family: Myriad Pro; font-size: 32px; color: #660000; font-weight: normal;">Bienvenido a SpanishWholesale</h1>
<h2 style="font-family: Arial; font-size: 19px; color: #2d2d2d; font-weight: bold; ">La web de venta de calzados de todo tipo.</h2>

<p style="font-family: Arial; color: #2d2d2d; font-size: 19px;"> 

-Pedido confirmado<br>
 <strong>Pedido:</strong> nº  <?php echo $pedido["Pedido"]["id"] ?> <strong>Proveedor:</strong> <?php echo $proveedor["Usuario"]["title"] ?>    <strong>Fecha:</strong> <?php echo $date ?>&nbsp;<br>
 Su pedido ha sido revisado por el proveedor <?php echo $proveedor["Usuario"]["title"] ?>, quedando la mercancía reservada. A continuación le indicamos el importe y nº de cuenta bancaria para que realice el pago de este pedido y proceder a su envio.<br><br>
 
 <strong>Importe:</strong> <?php echo $total ?> euros <br>
 <strong>Nº cuenta:</strong> <?php echo $serializado["ncuenta"] ?>, <strong>SWIFT:</strong> <?php echo $serializado["cswift"] ?>  <strong>IBAN:</strong> <?php echo $serializado["Iban"] ?> <br><br>
 
Le informamos que este pedido queda reservado durante 72 horas en espera de recibir el pago del mismo, transcurrido ese plazo no podemos garantizar la disponibilidad de estos artículos. Para agilizar el envio del pedido puede remitirnos la copia de la transferencia al siguiente email  <?php echo $proveedor["Usuario"]["email"] ?>.</p><p style="font-family: Arial; color: #2d2d2d; font-size: 19px;">Gracias por su confianza.</p><p style="font-family: Arial; color: #2d2d2d; font-size: 19px;">
Un saludo<br>
<br><br>
</p>
</td>
	</tr>
</tbody>
</table>
</td>
	</tr>

	<tr>
		<td align="center" bgcolor="#2d2d2d" valign="top">
<table width="800">
<tbody>
	<tr>
		<td><a style="float: right;" href="http://spanishwholesale.com" target="_blank" title="SpanishWholesale"><img style="border: 0px;" src="http://spanishwholesale.com/img/logof.png" height="67" width="159"></a></td>
	</tr>
</tbody>
</table>
</td>
	</tr>

	<tr>
		<td align="center" valign="top">
<table width="800">
<tbody>
	<tr>
		<td><h3 style="text-align: center; font-size: 19px; color: #000000; font-family: arial; padding-top: 10px; "> info@spanishwholesale.com</h3>
</td>
	</tr>
</tbody>
</table>
</td>
	</tr>
</tbody>
</table>
