function setParticipa(id_ronda,id_amateur){
    $.ajax({
      type: "POST",
      url: "votaciones_rondamarca.php",
      data: "participar=true&id_ronda="+id_ronda+"&id_amateur="+id_amateur
    }).done(function( msg ) {
        if(parseInt(msg)){
            window.location.reload();
        }
    });
}

function setVotacion(id_ronda,id_user,puntos,id_amateur){
    jQuery("#ranking_ronda"+id_amateur+" .content_vota_puntua .content_votacion ul.votacion").hide();
    jQuery("#ranking_ronda"+id_amateur+" .content_vota_puntua .content_votacion h5").text("cargando...");
    $.ajax({
      type: "POST",
      url: "ajax_votaciones_rondamarca.php",
      data: "votar=true&id_ronda="+id_ronda+"&id_amateur="+id_amateur+"&puntos="+puntos+"&id_user="+id_user
    }).done(function( msg ) {
        if(parseInt(msg)){
            jQuery(".box_votaciones_marcas#ranking_ronda"+id_amateur+" ul.votacion li a").each(function(i){
              if(i<puntos)
                    jQuery(this).addClass("selected");
              jQuery(this).unbind('mouseenter mouseleave');
              jQuery(this).attr("href","javascript:void(0)");

          });
          
          jQuery(".box_votaciones_marcas#ranking_ronda"+id_amateur+" ul.votacion").unbind('mouseenter mouseleave');
          jQuery("#ranking_ronda"+id_amateur+" .content_votacion h5").text("!Ya ha votado hoy!");
          
          total_puntos=parseInt(jQuery("#ranking_ronda"+id_amateur).parent("li").find(".puntos").find("span").text()) ;
          total_puntos=total_puntos+puntos;
          jQuery("#ranking_ronda"+id_amateur).parent("li").find(".puntos").find("span").text(""+total_puntos);
          jQuery("#ranking_ronda"+id_amateur+" .content_vota_puntua .content_votacion h5").text("!Voto efectuado!");
          jQuery("#ranking_ronda"+id_amateur+" .content_vota_puntua .content_votacion ul.votacion").show();
        }
        else{
             jQuery("#lightbox_aviso a.info_fancy").click();
             jQuery("#ranking_ronda"+id_amateur+" .content_vota_puntua .content_votacion h5").text(msg);
        }
    });
}

function setActionVoto(id_amateur){
    jQuery(document).ready(function()
    {
        jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion li a").hover(function(){
            //alert("asd");
              var  position=parseInt(jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion li a").index(jQuery(this)));
              jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion li a").each(function(i){
                if(i<position || i==position)
                    jQuery(this).addClass("selected");
                else
                    jQuery(this).removeClass("selected");
              });
        },function(){
            
        } );
        
        jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion").hover(function(){},function(){ jQuery(this).find("a").removeClass("selected")});
    }
    );
}

function unBindVoto(id_amateur){
     jQuery(document).ready(function()
    {
        jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion").unbind('mouseenter mouseleave');
        jQuery("#ranking_ronda"+id_amateur+".box_votaciones_marcas ul.votacion li a").unbind('mouseenter mouseleave');
    }
    );
}