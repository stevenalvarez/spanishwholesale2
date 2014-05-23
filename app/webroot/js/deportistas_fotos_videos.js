jQuery(function(){
    $("#fotos ul.nav_pagination li").each(function(i){
        $(this).click(function(){
          $(".fotos_box .ajax_loader").show();
          $("#fotos ul.nav_pagination li").removeClass("active");  
           $(this).addClass("active"); 
            $.ajax({
            url: "ajax_fotos_deportistas.php?dep="+$(".content_main").attr('id')+"&page="+i,
            success: function(data){
                $("#fotos ul.list_fotos").html(data);
                $(".fotos_box .ajax_loader").hide();
                jQuery(".list_fotos a.info_fancy").fancybox({padding:0,overlayOpacity:0.9,overlayColor:'#000'});
                } 
            });
            
            
        });
    });
    
    $("#videos ul.nav_pagination li").each(function(i){
        $(this).click(function(){
          $(".fotos_box .ajax_loader").show();
          $("#videos ul.nav_pagination li").removeClass("active");  
           $(this).addClass("active"); 
            $.ajax({
            url: "ajax_videos_deportistas.php?dep="+$(".content_main").attr('id')+"&page="+i,
            success: function(data){
                $("#videos ul.list_fotos").html(data);
                $(".fotos_box .ajax_loader").hide();
                } 
            });
            
            
        });
    });
    
    jQuery(".list_fotos li a.info_fancy").click(function(){
        jQuery("#fancybox-wrap").addClass("image_galerie");    
    });
    
    jQuery("#btn_patrociname").click(function(){jQuery("#fancybox-wrap.image_galerie").removeClass("image_galerie");});
    
    
});









function change_media(thiss,type)
{
$(".fotos_box .ajax_loader").show();
$('.media').fadeOut('slow',function(){$('#'+type).fadeIn('slow',function(){ $(".fotos_box .ajax_loader").fadeOut('slow');})}); 
$(thiss).parent('li').parent('ul').children('li').removeClass('active'); 
$(thiss).parent('li').addClass('active');
jQuery(".list_fotos a.info_fancy").fancybox({padding:0,overlayOpacity:0.9,overlayColor:'#000'});
} 