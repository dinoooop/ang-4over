<?php
require_once 'inc/init.php';

if (!isset($_GET['product'])) {
    return false;
}

$options = $main->http_get_map();

$myPrivateKey = 'zG621JEo';
$signature = hash_hmac("sha256", 'POST', hash('sha256', $myPrivateKey));
?><!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/appConst.js"></script>

        <title>EDDM Map</title>
    </head>
    <body>

        <iframe src="https://EDDMeasy.com" id="eddmIframe" style="width: 100%; min-height: 660px; height: 100%;">
            <p>Your browser does not support iframes.</p>
        </iframe>

        <script type="text/javascript">
            var serverData = <?php echo json_encode($options); ?>;
            console.log(serverData);
        </script>

        <script type="text/javascript">

            var sign = '<?php echo $signature; ?>';

            var iframe = document.getElementById('eddmIframe');

            iframe.onload = function () {
                var domain = 'https://EDDMeasy.com';
                var iframeApp = iframe.contentWindow;

                var data = {
                    access_token: serverData.access_token,
                    date: serverData.date,
                    product_options: serverData.string_product_options,
                    product_uuid: serverData.product_uuid,
                    type: "eddm_start"
                };

                iframeApp.postMessage(data, domain);
            };


            var data_create_order = {
                "order_id": "test001",
                "is_test_order": true,
                "jobs": [
                    {
                        "product_uuid": serverData.product_uuid,
                        "runsize_uuid": serverData.product_options.runsize,
                        "colorspec_uuid": serverData.product_options.color,
                        "option_uuids": [
                            serverData.product_options.size,
                            serverData.product_options.stock,
                            serverData.product_options.coating,
                            serverData.product_options.color,
                            serverData.product_options.runsize,
                        ],
                        "dropship": false,
                        "skip_files": true,
                        "job_name": serverData.job_name,
                        "ship_to": null,
                        "ship_from": [],
                        "shipper": {
                            "shipping_method": "USPS EDDM",
                            "shipping_code": "EDDM"
                        }
                    }
                ]
            };

            window.addEventListener('message', function (event) {

                // console.log('message receiving');
                var result = event.data;


                if (result.type == "next_button_sync") {

                    console.log("Button pressed");
                    console.log(result);
                    console.log(result.data.total_price);

                    data_create_order.payment = {
                        "requested_amount": result.data.total_price,
                        "requested_currency": {
                            "currency_code": "USD"
                        },
                        "credit_card": {
                            "account_number": "4111111111111111",
                            "month": "09",
                            "year": "2018",
                            "ccv": "123"
                        },
                        "billing_info": {
                            "first_name": "John",
                            "last_name": "Doe",
                            "address1": "123 street",
                            "address2": "",
                            "city": "Glendale",
                            "state": "CA",
                            "zip": "91202",
                            "country": "USA"
                        },
                        "order_id": "12345",
                        "comments": "This is a sample payment"
                    };

                    console.log(data_create_order);

                    $.ajax({
                        url: serverData.url_create_order,
                        type: 'post',
                        data: data_create_order,
                        headers: {
                            "Authorize": "API postcardsrus:" + sign,
                            "Authorization": "API postcardsrus:" + sign
                        },
                        dataType: 'json',
                        success: function (data) {
                            // console.log("success result");
                            window.location = appConst.apiBase + '/order-created.php?pid=' + data.payment_response.payment_uuid;
                        }
                    });
                }

            });


        </script>


    </body>
</html>
