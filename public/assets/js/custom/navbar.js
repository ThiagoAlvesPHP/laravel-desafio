$(function(){
    // fechar navbar
    $(document).on('click', '.navbar__mobileshow .navbar__close', function(){
        $(this).parent().addClass('navbar__mobileclose');
        $(this).parent().removeClass('navbar__mobileshow');
    });

    // abrir navbar
    $(document).on('click', '.navbar__mobile .show', function(){
        $('.navbar__links').addClass('navbar__mobileshow');
        $('.navbar__links').removeClass('navbar__mobileclose');
    });
});
