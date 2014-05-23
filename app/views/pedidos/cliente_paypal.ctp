<?php
/********************************************************
GetExpressCheckoutDetails.php

This functionality is called after the buyer returns from
PayPal and has authorized the payment.

Displays the payer details returned by the
GetExpressCheckoutDetails response and calls
DoExpressCheckoutPayment.php to complete the payment
authorization.

Called by ReviewOrder.php.

Calls DoExpressCheckoutPayment.php and APIError.php.

********************************************************/
if (!isset($_SESSION)) 
session_start();

/* Collect the necessary information to complete the
   authorization for the PayPal payment
   */

$_SESSION['token']=$_REQUEST['token'];
$_SESSION['payer_id'] = $_REQUEST['PayerID'];

$_SESSION['paymentAmount']=isset($_REQUEST['paymentAmount'])?$_REQUEST['paymentAmount']:null;
$_SESSION['currCodeType']=$_REQUEST['currencyCodeType'];
$_SESSION['paymentType']=$_REQUEST['paymentType'];

$resArray=$_SESSION['reshash'];
$_SESSION['TotalAmount']= $resArray['AMT'] + $resArray['SHIPDISCAMT'];

/* Display the  API response back to the browser .
   If the response from PayPal was a success, display the response parameters
   */

?>

<div class="container">
<center>
	<font size=2 color=black face=Verdana><b>Order Review</b></font>
	<br><br></center>
	<form action="<?php echo $this->webroot?>cliente/pedidos/expresscheckoutpayment" method="POST">
	 <center>
           <table width =270>
             <tr>
		               <td colspan="2" class="header">
		                   Step 3: DoExpressCheckoutPayment
		               </td>
          </tr>
            <tr>
                <td><b>Order Total:</b></td>
                <td>
                  <?php  echo $_REQUEST['currencyCodeType'];   echo $resArray['AMT'] + $resArray['SHIPDISCAMT'] ?></td>
            </tr>
              <table class="api" width=400>
            	        	<?php 
                		foreach($resArray as $key => $value) {
                			
                			echo "<tr><td> $key:</td><td>$value</td>";
                			}	
                   			?>
              </table>
          
            <tr>
                <td class="thinfield">
                     <input type="submit" value="Pay" />
                </td>
            </tr>
        </table>
    </center>
    </form>

</div>

