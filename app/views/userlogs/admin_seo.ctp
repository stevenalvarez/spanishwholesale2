<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin//userlogs/seo">SEO</a></li>

</ul>
</div>
<?php echo $this->element('left-menu')?>

<div id="right-side">

<div class="userlogs index" id="admin-table">
	<h2> Seo </h2>
	<form method="post">
    <table>
    <thead>
    <tr>
    <td></td>
    <td>Espa&ntilde;ol</td>
    <td>Ingles</td>
    </thead>
     </tr>
     
     
     
    <tbody>
    <tr>
        <td>T&iacute;tulo</td>
        <td><textarea name="seo[titulo_es]"><?php echo $seo["titulo_es"]?></textarea>   </td>
        <td><textarea name="seo[titulo_en]"><?php echo $seo["titulo_en"]?></textarea>   </td>    
    </tr>
    
    <tr>
        <td>Descripci&oacute;n</td>
        <td><textarea name="seo[desc_es]"><?php echo $seo["desc_es"]?></textarea>   </td>
        <td><textarea name="seo[desc_en]"><?php echo $seo["desc_en"]?></textarea>   </td>    
    </tr>
    
    <tr>
        <td>Palabras Clave</td>
        <td><textarea name="seo[keywords_es]"><?php echo $seo["keywords_es"]?></textarea>   </td>
        <td><textarea name="seo[keywords_en]"><?php echo $seo["keywords_en"]?></textarea>   </td>    
    </tr>
    
    <tr>
    
    <td colspan="3"><input type="submit" value="guardar" /> </td>
    </tr>
    <tr><td></td></tr>
    
   </tbody>     
    
    </table>
    
    </form>
	
</div>

</div>