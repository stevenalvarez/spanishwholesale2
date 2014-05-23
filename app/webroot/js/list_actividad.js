
jQuery(document).ready(function(){
    jQuery(".menu_actividad a").click(function(){
        jQuery(".list_actividad .content_actividad ul").hide();
        jQuery(".list_actividad ul"+jQuery(this).attr("rel")).show();
        jQuery(this).parent("li").siblings("li").removeClass("active");
        jQuery(this).parent("li").addClass("active");
        
        jQuery(".list_actividad .ajax_loader").show();
            $.ajax({
            type: "POST",
            url: "ajax_actividad_home.php",
            data:actividad="actividad="+jQuery(this).attr("rel").replace("#",""),
            success: function(data){
                jQuery(".list_actividad div.content_actividad ul,.list_actividad .ajax_loader").fadeOut("fast");
                jQuery(".list_actividad .content_actividad").html(data);
                jQuery(".list_actividad .content_actividad ul").fadeIn("slow");
                
                $(".list_actividad .nav_actividad li").removeClass("active");
                $(".list_actividad .nav_actividad li:first").addClass("active");
               
            } 
            });   
        
    });
    
    $("ul.nav_actividad li").each(function(i){
     $(this).click(function(){
         $(".list_actividad .nav_actividad li").removeClass("active");
        $(this).addClass("active");
        
        
         jQuery(".list_actividad .content_actividad ul").hide();
        jQuery(".list_actividad ul"+jQuery(this).attr("rel")).show();
        jQuery(this).parent("li").siblings("li").removeClass("active");
        jQuery(this).parent("li").addClass("active");
        
        jQuery(".list_actividad .ajax_loader").show();
            $.ajax({
            type: "POST",
            url: "ajax_actividad_home.php",
            data:actividad="actividad="+$(".menu_actividad li.active a").attr("rel").replace("#","")+"&n="+i,
            success: function(data){
                jQuery(".list_actividad div.content_actividad ul,.list_actividad .ajax_loader").fadeOut("fast");
                jQuery(".list_actividad .content_actividad").html(data);
                jQuery(".list_actividad .content_actividad ul").fadeIn("slow");
                              
            } 
            });
        
     });   
    
        
    });
    
    
});
