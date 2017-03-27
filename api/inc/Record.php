<?php

class Record {

    public $base_url;
    public $signature_param;
    public $url_create_order;

    function __construct() {
        $this->base_url = 'https://api.4over.com';
        $this->url_create_order = $this->base_url . '/orders';
        
        $this->signature_param = 'max=1000&apikey=printsites&signature=b238bb559470cfcea113d4bb871a5481e8900a511cb8ed9dc755eaa150c9d244';
    }

    function get_entities($key, $param = null) {
        $api = $this->get_api($key, $param);
        $records = $this->request($api);
        return (isset($records->entities)) ? $records->entities : [];
    }

    function get_api($key, $param = null) {
        switch ($key) {
            case 'categories':
                $resource_uri = "printproducts/categories";
                break;

            case 'products':
                $resource_uri = "printproducts/categories/{$param['category_uuid']}/products";
                break;

//            case 'product_options':
//                return "{$this->base_url}/printproducts/products/{$param['product_uuid']}/optiongroups?{$this->signature_param}";
//                break;

            case 'specific_product':
                $resource_uri = "printproducts/products/{$param['product_uuid']}";
                break;

            case 'options':
                $resource_uri = "printproducts/optiongroups/{$param['option_group_uuid']}/options";
                break;

            case 'baseprices':
                $resource_uri = "printproducts/products/{$param['product_uuid']}/baseprices";
                break;

            case 'access_token':
                return "{$this->base_url}/oauth/v2/token?client_id=22_4pe96mgl12uccw0sg8o4wk880s8kwco00o408koggwckskgwoc&client_secret=43k8ddc1rhes408g44cw4owcw8kos8ss8ggc80408kk0o4w8ko&grant_type=client_credentials";
                break;

            case 'date':
                return "{$this->base_url}/dates?&eddm=true&access_token={$param['access_token']}";
                break;

            default:
                break;
        }

        if (isset($resource_uri)) {
            return $this->base_url . '/' . $resource_uri . '?' . $this->signature_param;
        }
        return false;
    }

    function request($api, $array = false) {

        if (!$api) {
            return false;
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $api
        ));

        $result = curl_exec($curl);
        $result = json_decode($result);
        curl_close($curl);

        if (isset($result->status) && $result->status == 'error') {
            $result->error = true;
        }

        if ($array) {
            return (array) $result;
        } else {
            return $result;
        }
    }

    function set_select_option($records, $key, $value) {

        $results = [];

        foreach ($records as $record) {

            if (isset($record->$key) && isset($record->$value)) {
                $results[$record->$key] = $record->$value;
            }
        }

        $results = array_unique($results);

        return $results;
    }

}
