<?php

class TestCtrl extends Record {

    function __construct() {
        parent::__construct();
    }

    function init() {
        $action = (isset($_GET['ac'])) ? $_GET['ac'] : 'test';
        $this->$action();
    }

    function test() {
        echo 'Hello Mic Test';
    }

    function routegroups() {
        $api = 'https://api.4over.com/routegroups/4117df35-d1e5-48d1-b15b-1660f97d42f6?' . $this->signature_param;
        $str = file_get_contents($api);
        $price = json_decode($str, true);
        echo '<pre>', print_r($price), '</pre>';
        exit();
    }
    function carrierroutes() {
        $api = 'https://api.4over.com/routegroups/4117df35-d1e5-48d1-b15b-1660f97d42f6/carrierroutes?' . $this->signature_param;
        $str = file_get_contents($api);
        $price = json_decode($str, true);
        echo '<pre>', print_r($price), '</pre>';
        exit();
    }

    function user() {
        $api = 'https://api.4over.com/users/cb51b9fc-6a6e-4b98-885f-5d21041c1403?' . $this->signature_param;
        $str = file_get_contents($api);
        $price = json_decode($str, true);
        echo '<pre>', print_r($price), '</pre>';
        exit();
    }
    
    function product() {
        
    }

}
