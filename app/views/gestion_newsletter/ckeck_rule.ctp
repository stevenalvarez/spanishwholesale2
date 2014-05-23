<?php

/**
 * @author Edgardo
 * @copyright 2010
 */

?>
<table class="listado">
			<tbody><tr>
				<th><?php echo 'Email Afectado'; ?></th>
        	</tr>
	<?php
     if(!$newslettermails) echo "<tr><td>La regla no afecta a ninguno de sus suscriptores.</td></tr>";
     else
       foreach($newslettermails as $newsletter): 
       ?>
            
		   <tr>
				<td><?php echo utf8_decode($newsletter["Newsletteremail"]["email"]) ?></td> 
                 
            </tr>
           
			<?php
             endforeach; ?>
					</tbody></table>
            