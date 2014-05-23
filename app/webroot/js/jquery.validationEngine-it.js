var alertText_ajaxUsuario = "* Questa e-mail e' gia' in uso";
var alertText_ajaxInvitacion = "* Questa e-mail e' gia' stato invitato";

(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* Campo obbligatorio",
                    "alertTextCheckboxMultiple": "* Seleziona un'opzione",
                    "alertTextCheckboxe": "* Checkbox obbligatorio"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Minimo di ",
                    "alertText2": " caratteri autorizzati"
                },
"groupRequired": {
                    "regex": "none",
                    "alertText": "* You must fill one of the following fields"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Massimo di ",
                    "alertText2": " caratteri autorizzati"
                },
"min": {
                    "regex": "none",
                    "alertText": "* Il valore minimo e' "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Il valore massimo e' "
                },
"past": {
                    "regex": "none",
                    "alertText": "* Data anteriore a "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Data successiva a  "
                },
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Ha superato il numero di operazioni consentite"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Si prega di selezionare il ",
                    "alertText2": " di opzioni"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* I campi non corrispondono"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/,
                    "alertText": "* Numero di telefono non valido"
                },
                "email": {
                    // Shamelessly lifted from Scott Gonzalez via the Bassistance Validation plugin http://projects.scottsplayground.com/email_address_validation/
                    "regex": /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i,
                    "alertText": "* Email non valido"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Non e' un valore intero valido"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?(([0-9]+)([\.,]([0-9]+))?|([\.,]([0-9]+))?)$/,
                    "alertText": "* Non e' un valore decimale valido"
                },
                "date": {
					"regex": /(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)/,
                    "alertText": "* Data non valida, si prega di utilizzare il formato GG/MM/AAAA"
                },
                "ipv4": {
                 "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* Indirizzo IP non valido"
                },
                "youtube": {
                 "regex": /((http|https):\/\/)?(www\.)?(youtube\.com)(\/)?([a-zA-Z0-9\-\.]+)\/?/,
                    "alertText": "* Indirizzo non valido (solo YouTube)"
                },
                "twitter": {
                 "regex": /@([A-Za-z0-9_]+)/,
                    "alertText": "* Nome profilo non valido (p.es. @mazzelsponsor)"
                },				
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* URL non valida (p.es. http://www.mazzelpatrocinio.com)"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Solo numeri"
                },
"onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* Solo lettere"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* Caratteri speciali non sono permessi"
                },
                "ajaxNews": {
                    "url": "ajax_validarusuario.php",
                    "extraData": "newsletter",
                    "alertTextLoad": "* Convalida, si prega di attendere",
                    "alertText": "* Questa e-mail e' gia' iscritto"
                },
                "ajaxInvitacion": {
                    "url": "ajax_validarusuario.php",
                    "extraData": "invitacion",
                    "alertTextLoad": "* Convalida, si prega di attendere",
                    "alertText": "* Questa e-mail e' gia' stato invitato"
                },
                "ajaxUsuario": {
                    "url": "ajax_validarusuario.php",
                    "extraData": "usuario",
                    "alertTextLoad": "* Convalida, si prega di attendere",
                    "alertText": "* Questa e-mail e' gia' in uso"
                },
                "ajaxAmateur": {
                    "url": "ajax_validarusuario.php",
                    "extraData": "amateur",
                    "alertTextLoad": "* Convalida, si prega di attendere",
                    "alertText": "* Questa e-mail e' gia' in uso"
                }
            };
            
        }
    };
    $.validationEngineLanguage.newLang();
})(jQuery);