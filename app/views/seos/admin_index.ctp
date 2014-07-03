<style type="text/css">
    td{
        padding: 2px;
    }
    textarea {
        resize: none;
    }    
</style>
<div id="nav-menu">
    <ul>
        <li><a href="<?php echo $this->webroot?>admin/">Inicio</a></li>
        <li><a href="<?php echo $this->webroot?>admin/seos/index">SEO</a></li>
    </ul>
</div>

<?php echo $this->element('left-menu')?>

<div id="right-side">
    <div class="seo index" id="admin-table">
        <h2> Seo - HOME</h2>
        <p style="padding: 10px 5px 5px 5px;color:#590000; font-style: italic;font-weight: bold;">Ingrese los t&iacute;tulos y etiquetas META para la Home o Portada</p>
        <form method="post">
            <table>
                <thead>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <b style="font-size: 15px;">&nbsp;Espa&ntilde;ol</b>
                        </td>
                        <td>
                            <b style="font-size: 15px;">&nbsp;Ingles</b>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta T&iacute;tulo</b>
                        </td>
                        <td>
                            <input size="41" name="seo[titulo_es]" value="<?php echo $seo["titulo_es"];?>"/>
                        </td>
                        <td>
                            <input size="41" name="seo[titulo_en]" value="<?php echo $seo["titulo_en"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta Descripci&oacute;n</b>
                        </td>
                        <td>
                            <textarea cols="42" rows="5" name="seo[desc_es]"><?php echo $seo["desc_es"]?></textarea>
                        </td>
                        <td>
                            <textarea cols="42" rows="5" name="seo[desc_en]"><?php echo $seo["desc_en"]?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta Keywords</b>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_es]" value="<?php echo $seo["keywords_es"];?>"/>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_en]" value="<?php echo $seo["keywords_en"];?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <br />
                            <input style="float: right;margin-right: 8px;" class="btn-admin-orange" type="submit" value="Guardar" />
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    
    <div>&nbsp;</div>
    
    <div class="seo index" id="admin-table">
        <h2> Seo - ARTICULOS</h2>
        <p style="padding: 10px 5px 5px 5px;color:#590000; font-style: italic;font-weight: bold;">Ingrese los t&iacute;tulos y etiquetas META para la Home o Portada</p>
        <form method="post">
            <table>
                <thead>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </form>
    </div>    
</div>