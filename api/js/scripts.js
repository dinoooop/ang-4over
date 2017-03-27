$(function () {

    /**
     * 
     * 
     * Get the products on cheng category
     */

    $("[name='eddm_category']").on('change', function () {

        var data = {
            action: 'get_products',
            id: $(this).val(),
        };
        $('[name="product"]').val("");
        $('[name="runsize"]').val("");
        $.get(appConst.url_ajax, data, function (response) {
            $('[name="product"]').html(response);

        }, 'html');

    });

    /**
     * 
     * On change product get run size
     */

    $("[name='product']").on('change', function () {

        var data = {action: 'get_options', id: $(this).val()};

        $.get(appConst.url_ajax, data, function (response) {
            $('.product-options').html(response);
            // refresh_price();
        }, 'html')
    });
    $("body").on('change', "[name='color']", function () {
        // refresh_price();
    });

    /**
     * 
     * On change runsize
     */
    $("body").on('change', "[name='runsize']", function () {
        // refresh_price();
    });


    function refresh_price() {

        var puuid = $("[name='product']").val();
        
        var selection = {
            product_uuid: puuid,
            colorspec_uuid: $("[name='color']").val(),
            runsize_uuid: $("[name='runsize']").val(),
        };
        var data = {
            action: 'get_baseprice',
            id: puuid,
            selection: selection,
        };
        $.get(appConst.url_ajax, data, function (response) {
            $('.order-summery').html(response);

        }, 'html')
    }

});
