FB.init({appId: "378569528879624", status: true, cookie: true});
/*FB.init({appId: "264101523692851", status: true, cookie: false});//beta*/
var titulo_s="";
var texto_s="";
var tipo_s="";
var shared_content_type=false;    
var extra_data="";
var isset_shared_fbk=false;
var isset_shared_twi=false;
(function($){
    $.oauthpopup = function(options)
    {
        if (!options || !options.path) {
            throw new Error("options.path must not be empty");
        }
        options = $.extend({
            windowName: 'ConnectWithOAuth'
          , windowOptions: 'location=0,status=0,width=800,height=400'
          , callback: function(){ window.location.reload();}
        }, options);

        var oauthWindow = window.open(options.path, options.windowName, options.windowOptions);
        var oauthInterval = window.setInterval(function(){
            if (oauthWindow.closed) {
                window.clearInterval(oauthInterval);
                options.callback();
            }
        }, 1000);
    };
})(jQuery);
        
function setShareSocialTWI(){
    $is_checked_sh=jQuery("#set_shared_twitter").attr("checked");
    if(shared_content_type){
        $is_checked_sh="checked";
    }
    if($is_checked_sh=="checked"){
        $.oauthpopup({
                path: 'ajax_shared_twitter.php?set_shared_twitter=true&set_shared_twitter='+$is_checked_sh,
                callback: function(){
                    if(shared_content_type){
                        sharedSocialTWI(titulo_s,texto_s,tipo_s);
                        jQuery.fancybox.close();
                    }    
                    if(!shared_content_type)
                        alert("Ya puedes compartir contenidos en twitter");
                }
        });
    }
    else
    {
      jQuery(".ajax_loader").show();
                $.ajax({
                type: "POST",
                cache: false,
                url: "ajax_shared_twitter.php?set_shared_twitter=true",
                data:"set_shared_twitter="+$is_checked_sh,
                success: function(data){
                    if(data=="save"){
                        if(!shared_content_type)
                            alert("Ya puedes compartir contenidos en facebook");
                        if(shared_content_type){
                            jQuery.fancybox.close();
                            sharedSocialTWI(titulo_s,texto_s,tipo_s);
                        }
                    }
                    else if(data=="delete")
                            alert("Ya no puedes compartir contenidos en twitter");
                    jQuery(".ajax_loader").hide();
                } 
      });  
    }
}

function setShareSocialFBK(){
    
    $is_checked_sh=jQuery("#set_share_social").attr("checked");
    if(shared_content_type){
        $is_checked_sh="checked";
    }
    if($is_checked_sh=="checked"){
    /*setTimeout('', 800);*/
    FB.api('/me', function(response){
            if(parseInt(response.id))
            {
                jQuery(".ajax_loader").show();
                if(shared_content_type){
                    jQuery.fancybox.close();
                }
                $.ajax({
                type: "POST",
                cache: false,
                url: "ajax_shared_social.php",
                data:"set_share_social="+$is_checked_sh+"&id_social_m="+response.id,
                success: function(data){
                    if(data=="save"){
                        if(!shared_content_type)
                            alert("Ya puedes compartir contenidos en facebook");
                        if(shared_content_type)
                            sharedSocialFBK(titulo_s,texto_s,tipo_s);
                    }
                    else if(data=="delete")
                            alert("Ya no puedes compartir contenidos en facebook");
                    
                    jQuery(".ajax_loader").hide();
                } 
                });
            }
            else{
                FB.login(function(response) {
                    if (response.status === "connected") {
                        setShareSocialFBK();
                    } else {
                        alert('Error de login');
                    }
                },{scope: 'email,offline_access,publish_stream,user_about_me,user_hometown'});
            }
    });
  }
  else{
    jQuery(".ajax_loader").show();
                $.ajax({
                type: "POST",
                cache: false,
                url: "ajax_shared_social.php",
                data:"set_share_social="+jQuery("#set_share_social").attr("checked"),
                success: function(data){
                    if(data=="save"){
                        if(!shared_content_type)
                            alert("Ya puedes compartir contenidos en facebook");
                        if(shared_content_type)
                            sharedSocialFBK(titulo_s,texto_s,tipo_s);
                    }
                    else if(data=="delete")
                            alert("Ya no puedes compartir contenidos en facebook");
                    jQuery(".ajax_loader").hide();
                } 
                });
  } 
}


function sharedSocialFBK(titulo,texto,tipo){
    if(titulo && texto && tipo){
    $.ajax({
            type: "POST",
            cache: false,
            url: "ajax_shared_social.php",
            data:"send_shared_social=true&titulo="+titulo+"&texto="+texto+"&tipo="+tipo+"&"+extra_data,
            success: function(data){
                if(parseInt(data) && shared_content_type){
                    alert("Se ha compartido correctamente tu contenido");
                    isset_shared_fbk=true;
                    shared_content_type=false;
                }
                if(!isset_shared_fbk && parseInt(data))
                    isset_shared_twi=true;
               /* else    
                    alert("Error al compartir el contenido en las redes sociales");*/
            } 
        });
    }
}

function sharedSocialTWI(titulo,texto,tipo){
    if(titulo && texto && tipo){
    $.ajax({
            type: "POST",
            cache: false,
            url: "ajax_shared_twitter.php",
            data:"send_shared_social=true&titulo="+titulo+"&texto="+texto+"&tipo="+tipo+"&"+extra_data,
            success: function(data){
                if(parseInt(data) && shared_content_type){
                   alert("Se ha compartido correctamente tu contenido");
                   shared_content_type=false;
                   isset_shared_twi=true;
                }
                if(!isset_shared_twi && parseInt(data))
                    isset_shared_twi=true;
                /*else    
                    alert("Error al compartir el contenido en las redes sociales");*/
            } 
        });
    }
}
              

function sharedSocialContent(titulo,texto,tipo,facebook,twitter){
    if(titulo && texto && tipo){
         titulo_s=titulo;
         texto_s=texto;
         tipo_s=tipo;   
        if(facebook=="" || twitter==""){
            /*if(!isset_shared_fbk || !isset_shared_twi)
                jQuery("#trigger_social_shared_lightbox").click(); //deshabilitador por el momentos, salta el light cuando no tiene activado la casillas de compartir automatico */
            if(facebook.trim() || isset_shared_fbk)
            {
                jQuery("#social_shared_lightbox #fbk_twitter_options_shared a.option_facebook").hide();
                if(isset_shared_fbk)
                    sharedSocialFBK(titulo,texto,tipo);
            }
                
            if(twitter.trim() || isset_shared_twi){
                jQuery("#social_shared_lightbox #fbk_twitter_options_shared a.option_twitter").hide();
                if(isset_shared_fbk)
                    sharedSocialTWI(titulo,texto,tipo);
            }
        }
        if(facebook){
          sharedSocialFBK(titulo,texto,tipo);
        }
        if(twitter)
        {
          sharedSocialTWI(titulo,texto,tipo);
        }
                  
                 
        
   } 
}

function sharedAndSetSocial(red){
    shared_content_type=true;
    if(red=='facebook'){
        setShareSocialFBK();
    }
    if(red=='twitter'){
        setShareSocialTWI();
    }    
}