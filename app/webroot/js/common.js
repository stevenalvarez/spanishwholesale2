jQuery(document).ready(function(){
    jQuery("a.info_fancy").fancybox({padding:0,overlayOpacity:0.9,overlayColor:'#000'});
   
   jQuery(".wrapper_main_menu").waypoint(function(event, direction) {
       if (direction === 'down') {
          //alert("poner en header");
          jQuery(this).parent("#main_wrapper").addClass("sticky");
          jQuery(this).parent("#main_wrapper").siblings("#header").addClass("sticky");
       }
       else {
          jQuery(this).parent("#main_wrapper").removeClass("sticky");
          jQuery(this).parent("#main_wrapper").siblings("#header").removeClass("sticky");
       }
    },{offset: '16'});
    
    jQuery(".text_input.select select").change(function(){
        jQuery(this).siblings("span").children("b").text(jQuery(this).find("option:selected").text());
    });
    jQuery(".text_input.file .input_text a").click(function(){
        jQuery(this).siblings("input").click();
        
    });
});

function toogleLogin(){
    jQuery("#wrapper_login").slideToggle("speed");
    jQuery("#wrapper_get_pass").slideUp("speed");
    jQuery("#wrapper_get_buscador").slideUp("speed");
}

function toogleResetPass(){
    jQuery("#wrapper_get_pass").slideToggle("speed");
    jQuery("#wrapper_login").slideToggle("speed");
    
}

function toogleBuscadorDep(){
    jQuery("#wrapper_get_buscador").slideToggle("speed");
    jQuery("#wrapper_login").slideUp("speed");
    jQuery("#wrapper_get_pass").slideUp("speed");
}

function getNewRegisters(){
    jQuery(".list_amateurs").find(".ajax_loader").show();
    $.ajax({
          type: "POST",
          url: "ajax_deportistas_home.php",
          data: "get_new_reg=true"
        }).done(function( msg ) {
            jQuery("#list_amateurs_news").html(msg);
            jQuery(".list_amateurs").find(".ajax_loader").hide();
        });
}
