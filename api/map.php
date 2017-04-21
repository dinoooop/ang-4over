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
           // console.log(serverData);
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
            
            var runsize = [
                {key: '8a3a0fd1-38ae-49a0-8736-3fedadc3dc93', value: '100'},
                {key: '6237a36b-b046-4ef6-8fed-6cb9c22a5ece', value: '250'},
                {key: 'f593fda3-2d5c-4b9e-9c2c-6197b899ae74', value: '500'},
                {key: '52e3d710-0e8f-4d4d-8560-7d4d8655be69', value: '1000'},
                {key: '02d8d163-ee8f-41cc-acce-9863ad0deb38', value: '2500'},
                {key: 'e824bf9f-d22d-4070-926d-42c6dd5ef515', value: '5000'},
                {key: '64880f6e-cc7a-4974-838c-92be09e9eb52', value: '7500'},
                {key: '4c29185a-ec98-4488-8729-c2ae0e5f5fe1', value: '10000'},
                {key: '8055b2b4-3fe2-4c57-beaf-a64ec10aed49', value: '15000'},
                {key: '889aa9a1-d0cc-4fb2-869c-73e1fe60855b', value: '20000'},
                {key: 'b7d68b88-db18-469d-97df-9c11d710ed32', value: '25000'},
            ];
           

            function search(nameKey, myArray){
                for (var i=0; i < myArray.length; i++) {
                    if (myArray[i].value === nameKey) {
                        return myArray[i];
                    }
                }
            }
            
            
            window.addEventListener('message', function (event) {

                // console.log('message receiving');
                var result = event.data;
                
                if (result.type == "map_event_data_sync") {
                   
                    if(result.data.tot_cnt!=0){
                        switch (true) {
                            case (result.data.tot_cnt <= 100):
                               var value = "100"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 100 && result.data.tot_cnt <= 250):
                               var value = "250"; 
                               var resultObject = search(value, runsize);
                               break; 
                            case (result.data.tot_cnt > 250 && result.data.tot_cnt <= 500):
                               var value = "500"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 500 && result.data.tot_cnt <= 1000):
                               var value = "1000"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 1000 && result.data.tot_cnt <= 2500):
                               var value = "2500"; 
                               var resultObject = search(value, runsize);
                               break; 
                            case (result.data.tot_cnt > 2500 && result.data.tot_cnt <= 5000):
                               var value = "5000"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 5000 && result.data.tot_cnt <= 7500):
                               var value = "7500"; 
                               var resultObject = search(value, runsize);
                               break; 
                            case (result.data.tot_cnt > 7500 && result.data.tot_cnt <= 10000):
                               var value = "10000"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 10000 && result.data.tot_cnt <= 15000):
                               var value = "15000"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 10000 && result.data.tot_cnt <= 15000):
                               var value = "15000"; 
                               var resultObject = search(value, runsize);
                               break;
                            case (result.data.tot_cnt > 20000 && result.data.tot_cnt <= 25000):
                               var value = "25000"; 
                               var resultObject = search(value, runsize);
                               break;
                            default:
                                console.log("none");
                                break;
                        }
                       
                        data_create_order.jobs[0].runsize_uuid=resultObject.key;
                        
                    }
                   
                }
                 
                if (result.type == "next_button_sync") {

                    console.log("Button pressed");
                   
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
                            console.log(data);
                            console.log(data.payment_response);
                            // console.log("success result");
                            // window.location = appConst.apiBase + '/order-created.php?pid=' + data.payment_response.payment_uuid;
                        }
                    });
                }

            });


        </script>


    </body>
</html>
