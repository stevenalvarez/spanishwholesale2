
jQuery(document).ready(function(){
    jQuery(".menu_patrocinios a").click(function(){
        var idd=$(this).attr("href")
        jQuery(this).parent("li").siblings("li").removeClass("active");
        jQuery(this).parent("li").addClass("active");
        
        jQuery(".patrocinios .ajax_loader").show();
            $.ajax({
            type: "POST",
            url: BASE_URL+"usuarios/ajax_deportistas/",
            data:"ajax_call=true&type="+idd,
            success: function(data){
                jQuery(".patrocinios .list_patrocinados,.patrocinios .ajax_loader").fadeOut("fast",function(){
                    jQuery(".patrocinios .list_usuario").html(data);
                    jQuery(".patrocinios .list_usuario").fadeIn("fast");
                    
                    if(idd=="#destacados")
                       jQuery("#link_destacados").show();
                    else  
                        jQuery("#link_destacados").hide(); 

                });
            } 
            });   
    });
    
    
    $(".patrocinios .slide_prev,.patrocinios .slide_next").click(function(){
        var idd=$(".menu_patrocinios").children("li.active").children("a").attr("href")
        jQuery(this).parent("li").siblings("li").removeClass("active");
        jQuery(this).parent("li").addClass("active");
        
        jQuery(".patrocinios .ajax_loader").show();
            $.ajax({
            type: "POST",
            url: "ajax_patrociname_home.php",
            data:"ajax_call=true&type="+idd,
            success: function(data){
                jQuery(".patrocinios .list_patrocinados,.patrocinios .ajax_loader").fadeOut("fast",function(){
                    jQuery(".patrocinios .list_patrocinados").html(data);
                    jQuery(".patrocinios .list_patrocinados").fadeIn("fast");
                });
            } 
            });   
    });
    
    /*en la home*/
    $(".menu_dep_segui li").each(function()
    {
        $(this).click(function()
    {
        $(this).siblings('li').removeClass('active');
        $(this).addClass('active');
    });
        
    });
    
    
    $(".menu_dep_segui li").each(function()
    {
        $(this).click(
        function()
        {
            $(this).siblings('li').removeClass('active');
            $(this).addClass('active');
            load_user_content($('.dep_segui .submenu1 a.active').attr("href"),$(this).children('a').attr("href"));
        });
        
    });
    /*izq*/
        $(".dep_segui .submenu1 a").each(function()
    {
        $(this).click(
        function()
        {
            $(this).siblings('a').removeClass('active');
            $(this).addClass('active');
            load_user_content($(this).attr("href"),$('.dep_segui .menu_dep_segui li.active a').attr("href"));
 
            
        });
        
    });
    
    function  load_user_content(usertipe,discr)
    
    {     $(".dep_segui .ajax_loader").fadeIn('fast');        
            $.ajax({
            type: "POST",
            url: BASE_URL+"usuarios/ajax_usuarios/",
            data:"usertype="+usertipe+"&disc="+discr,
            success: function(data){
                $(".descripcion_dep_segui.deportistass ul").html(data);
                $(".dep_segui .ajax_loader").fadeOut();
                
            } 
            });
    }  
    
    
    
    
});
