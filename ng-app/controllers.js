app.controller('mainFormController', function ($scope, $window, appData, WebService, appEnv) {

    $scope.isDev = appEnv.isDev;
    $scope.appForm = {};

    $scope.dataCoating = appData.coating;
    $scope.dataStock = appData.stock;
    $scope.dataColor = appData.color;
    $scope.dataRunsize = appData.runsize;
    $scope.stock = appData.stock[0].key;
    $scope.color = appData.color[0].key;

    WebService.getData(appConst.apiRequest, {action: 'get_disabled_dates'}).success(function (response) {
//        console.log(response.data.disabled_dates);
        $scope.disabled_dates = response.data.disabled_dates;
        $scope.ready = true;

        $scope.start_date = response.data.start_date;
        $scope.end_date = response.data.end_date;
    });

    $scope.onChangeCoating = function () {
        $scope.headSize = appData.size.getObj('key', $scope.coating).data.value;
    }

    $scope.onChangeSize = function () {

        $scope.dataRunsize = appData.runsize;
        if ($scope.size == '8.5X7') {
            $scope.dataRunsize = $scope.dataRunsize.collectiveRemove('value', '100');
        }

    }

    $scope.buttonLoader = false;
    $scope.onSubmitForm = function () {
        
        // FIND PRODUCT UUID
        if ($scope.coating == 'EDPCMATT' && $scope.size == '4.5X12') {
            $scope.name_coating = 'PCMATT';
        } else {
            $scope.name_coating = $scope.coating;
        }

        $scope.product_chosen = $scope.stock + '-' + $scope.name_coating + '-' + $scope.size;
        var productChosen = appData.products.getObj('value', $scope.product_chosen).data;

        if (productChosen != null) {
            $scope.product_chosen_uuid = productChosen.key;
        }

        // REDIRECT TO MAP
        $scope.buttonLoader = true;
        WebService.getData(appConst.apiRequest, {action: 'get_product_option', id: $scope.product_chosen_uuid}).success(function (response) {
            var param = "product=" + $scope.product_chosen_uuid + "&target_in_mailbox_date=" + $scope.appForm.mail_delivery_date + "&size=" + response.data.size + "&stock=" + response.data.stock + "&coating=" + response.data.coating + "&color=" + $scope.color + "&runsize=" + $scope.runsize + "&job_name=test&phone=&address=";
            $window.location.href = appConst.apiMap + '?' + param;
        });
    }



});