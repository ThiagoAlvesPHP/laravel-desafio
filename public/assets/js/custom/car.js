$(function(){
    // fechar navbar
    $(document).on('change', '#brand_id', function(){
        let brand_id = $(this).val();

        $.ajax({
            type: "GET",
            url: `${_url}?brand_id=${brand_id}`,
            success: function(data) {
                if (!data.error) {
                    $('#model_id option').remove();

                    $(data.list).each(function(index, item) {
                        $('#model_id').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
