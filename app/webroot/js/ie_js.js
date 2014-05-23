jQuery(document).ready(function(){
    jQuery(".menu_actividad a,.menu_patrocinios a,.buttons_ronda a").corner("5px");
    jQuery("#loginForm a.button_black,.list_patrocinados a.button_red").corner("5px");
   
    //jQuery.waypoints('destroy');
    jQuery(".wrapper_main_menu").waypoint('destroy')
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
    },{offset: '23'});
    
})