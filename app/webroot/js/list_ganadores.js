jQuery(document).ready(function(){
    jQuery(".list_ganadores a.slide_prev,.list_ganadores a.slide_next").click(
        function(){
            jQuery(".list_ganadores .ajax_loader").show();
            $.ajax({
            type: "POST",
            url: "ajax_ganadores_home.php",
            data:"ajax_call=true&next_prev="+jQuery(this).attr('id')+"&group="+jQuery("#num_group_ganadores").val() ,
            success: function(data){
                jQuery(".list_ganadores ul#group_ganadores,.list_ganadores .ajax_loader").fadeOut("slow",function(){jQuery(".list_ganadores ul#group_ganadores").html(data)});
                jQuery(".list_ganadores ul#group_ganadores").fadeIn("slow",function(){jQuery("a.info_fancy").fancybox({padding:0,overlayOpacity:0.9,overlayColor:'#000'});});
            } 
            });   
        }
    );
});