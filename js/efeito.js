//EFEITOS MENU ATIVOS
$(function(){
    $("#menu li").hover(function(){
       $(this).children('a:first') .addClass('hover');
   },function(){
       $(this).children('a:first').removeClass('hover');
    });
});

//EFEITOS TAB NAV ATIVOS
$(function(){
    $(".tab:first").show();
    $("#tab-nav a").click(function(){
     $("#tab-nav li a").removeClass('ativo');
     $("this").addClass('ativo');
     $(".tab").hide();
     var div = $(this).attr('href');
     $(div).fadeIn('slow');
     return false;
    })
})


