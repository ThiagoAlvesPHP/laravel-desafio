$(function() {
    if(sessionStorage.getItem('cart')){
        let cart = JSON.parse(sessionStorage.getItem('cart'));
        let amount = 0;

        $(cart).each(function(key, item){
            amount += parseFloat(item.price);
            $(`#service_id${item.service_id}`).attr("checked", true);
        });

        $('.userservice__amountprice').text(`R$ ${parseFloat(amount).toLocaleString("pt-BR", {minimumFractionDigits:2})}`);

        $('.userservice__action').show();
    }

    // fechar navbar
    $(document).on('click', '.service_id', function(){
        let service_id = $(this).val();
        let price = $(this).parent().parent().parent().find('.userservice__price').val();
        let amount = 0;

        if(sessionStorage.getItem('cart')) {
            let cart = JSON.parse(sessionStorage.getItem('cart'));

            if ($(this).is(":checked")) {
                cart.push({'service_id':service_id, 'price':price});

                $(cart).each(function(key, item){
                    amount += parseFloat(item.price);
                });

                $('.userservice__amountprice').text(`R$ ${parseFloat(amount).toLocaleString("pt-BR", {minimumFractionDigits:2})}`);
                sessionStorage.setItem('cart', JSON.stringify(cart));
                $('.userservice__action').show();
            } else {
                cart = cart.filter((item, key) => item.service_id !== service_id)

                $(cart).each(function(key, item){
                    amount += parseFloat(item.price);
                });

                $('.userservice__amountprice').text(`R$ ${parseFloat(amount).toLocaleString("pt-BR", {minimumFractionDigits:2})}`);

                if (cart.length === 0) {
                    $('.userservice__action').hide();
                    sessionStorage.removeItem('cart');
                } else {
                    sessionStorage.setItem('cart', JSON.stringify(cart));
                }
            }
        } else {
            let cart = [
                {'service_id':service_id, 'price':price}
            ];
            $('.userservice__amountprice').text(`R$ ${parseFloat(price).toLocaleString("pt-BR", {minimumFractionDigits:2})}`);
            sessionStorage.setItem('cart', JSON.stringify(cart));
            $('.userservice__action').show();
        }

    });
});
