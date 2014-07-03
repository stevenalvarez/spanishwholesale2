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

<form method="post">
    <div id="right-side">
        <div class="seo index" id="admin-table">
            <h2> Seo - HOME</h2>
            <p style="padding: 10px 5px 5px 5px;color:#590000; font-style: italic;font-weight: bold;">Ingrese los t&iacute;tulos y etiquetas META para la Home o Portada</p>
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
                            <input size="41" name="seo[titulo_esp]" value="<?php echo isset($seo["titulo_esp"]) ? $seo["titulo_esp"] : ""; ?>"/>
                        </td>
                        <td>
                            <input size="41" name="seo[titulo_eng]" value="<?php echo isset($seo["titulo_eng"]) ? $seo["titulo_eng"] : ""; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta Descripci&oacute;n</b>
                        </td>
                        <td>
                            <textarea style="width: 265px;" rows="5" name="seo[descripcion_esp]"><?php echo isset($seo["descripcion_esp"]) ? $seo["descripcion_esp"] : ""; ?></textarea>
                        </td>
                        <td>
                            <textarea style="width: 265px;" rows="5" name="seo[descripcion_eng]"><?php echo isset($seo["descripcion_eng"]) ? $seo["descripcion_eng"] : ""; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta Keywords</b>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_esp]" value="<?php echo isset($seo["keywords_esp"]) ? $seo["keywords_esp"] : ""; ?>"/>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_eng]" value="<?php echo isset($seo["keywords_eng"]) ? $seo["keywords_eng"] : ""; ?>"/>
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
        </div>
        
        <div>&nbsp;</div>
        
        <div class="seo index" id="admin-table">
            <h2> Seo - ARTICULOS</h2>
            <table>
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3">
                            <p style="padding: 10px 2px 10px 2px;color:#590000; font-style: italic;font-weight: bold;line-height: 15px;">
                                El Meta T&iacute;tulo y Meta Descripci&oacute;n para los articulos son tomados de los campos <b style="color: red;">Referencia</b> y <b style="color: red;">Descripci&oacute;n del producto</b>, respectivamente.
                            </p>
                            <p style="padding: 10px 2px 10px 2;color:#590000; font-style: italic;font-weight: bold;line-height: 15px;">
                                Los Meta Keywords, se forman en base a los campos <b style="color: red;">Material</b>, <b style="color: red;">Marca</b> y <b style="color: red;">Tag</b>. Pero adicionalmente puede ingresar los Keywords, para los articulos
                                estos se contactenar&aacute;n al final. Por ejemplo si introduce: "calzados de calidad", entonces el resultado ser&aacute;: <b style="color: green;">calzados de calidad + MATERIAL, MARCA y TAG</b>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>                    
                    <tr>
                        <td>
                            <b style="font-size: 13px;">Meta Keywords</b>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_articulo_esp]" value="<?php echo isset($seo["keywords_articulo_esp"]) ? $seo["keywords_articulo_esp"] : ""; ?>"/>
                        </td>
                        <td>
                            <input size="41" name="seo[keywords_articulo_eng]" value="<?php echo isset($seo["keywords_articulo_eng"]) ? $seo["keywords_articulo_eng"] : ""; ?>"/>
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
        </div>    
    </div>
</form>