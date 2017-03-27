<?php

require_once 'inc/init.php';

if (!isset($_GET['action'])) {
    exit();
}

$action = $_GET['action'];

if ($action == 'get_products') {
    $record = $main->get_products($_GET['id']);
    $options = $main->set_select_option($record, 'product_uuid', 'product_code');
    echo $html->select_option($options);
    die();
} elseif ($action == 'get_product_option') {
    /**
     * 
     * 
     * Get a specific product
     * e.g action=get_product&pid=5abb8dd5-3a3b-4032-9d26-7ba87d1dcb6b
     */
    $product = $main->get_specific_product($_GET['id']);
    $fields = $main->get_options($product);

    $records = [];
    foreach ($fields as $key => $value) {
        foreach ($value['options'] as $key => $val) {
            $records[$value['name']] = $key;   
        }
    }

    $response = ['status' => 'valid', 'data' => $records];

    echo json_encode($response);
    exit();
} elseif ($action == 'get_options') {
    /**
     * 
     * 
     * 
     */
    $product = $main->get_specific_product($_GET['id']);
    $fields = $main->get_options($product);

    foreach ($fields as $key => $value) {
        echo $html->set_options($value);
    }
    die();
} elseif ($action == 'get_baseprice') {
    $baseprices = $main->get_baseprices($_GET['id']); //product_uuid

    $selection = $_GET['selection'];
    $price = $main->get_product_baseprices($baseprices, $selection);
    echo $html->order_summery($price);

    die();
} elseif ($action == 'get_disabled_dates') {
//    echo '<pre>', print_r($main->selectable_dates), '</pre>';
//    $date1 = '2017-04-04';
//    $date2 = '2017-05-22';
    $return['disabled_dates'] = $main->get_disabled_dates();
    $return['disabled_dates'] = $main->change_date_format($return['disabled_dates']);
    
    $return['start_date'] = $main->change_date_format($main->selectable_dates[0]);
    $return['end_date'] = $main->change_date_format(end($main->selectable_dates));
    $response = ['status' => 'valid', 'data' => $return];
    echo json_encode($response);
    exit();
}