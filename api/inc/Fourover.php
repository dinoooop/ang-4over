<?php

class Fourover extends Record {

    public $product_sizes = [];
    public $signature;
    public $mode_product;

    function __construct() {

        parent::__construct();

        $this->mode_product = true;
        $this->category_uuid = '50a1f1a2-3567-4618-a703-074471472e8d';
        $this->today = date('m/d/Y');
        $this->stocks = ['16PT' => '16PT C2S'];
        $this->coating = [
            'matte' => 'Matte',
            'gloss_front' => 'Gloss (UV) Front only',
            'gloss_both' => 'Gloss (UV) both sizes',
        ];

        $this->color = [
            'full_color' => '4/4',
        ];

        $this->required_categories = [
            'Postcards',
            'Sell Sheets',
            'EDDM',
        ];

        $this->product_options = ['size', 'stock', 'coating', 'color', 'runsize'];

        $this->set_access_token();
        $myPrivateKey = 'zG621JEo';
        $this->signature = hash_hmac("sha256", 'POST', hash('sha256', $myPrivateKey));



        $this->product_required = [
            '16PT-PCMATT-4.5X12',
            '16PT-EDPCMATT-6X12',
            '16PT-EDPCMATT-6.5X9',
            '16PT-EDPCMATT-6.5X12',
            '16PT-EDPCMATT-8X6.5',
            '16PT-EDPCMATT-8.5X7',
            '16PT-EDPCUV-4.5X12',
            '16PT-EDPCUV-6X12',
            '16PT-EEDPCUV-6.5X9',
            '16PT-EDPCUV-6.5X12',
            '16PT-EDPCUV-8X6.5',
            '16PT-EDPCUV-8.5X7',
            '16PT-EDPCUVFR-4.5X12',
            '16PT-EDPCUVFR-6X12',
            '16PT-EDPCUVFR-6.5X9',
            '16PT-EDPCUVFR-6.5X12',
            '16PT-EDPCUVFR-8X6.5',
            '16PT-EDPCUVFR-8.5X7',
        ];
        $this->emmd_products = $this->get_products($this->category_uuid);
    }

    function set_access_token() {
        // Set access token
        $api = $this->get_api('access_token');
        $response = $this->request($api);
        $this->access_token = $response->access_token;
    }

    function get_categories() {
        $records = $this->get_entities('categories');

        $return = [];
        foreach ($records as $key => $value) {
            if (in_array($value->category_name, $this->required_categories)) {
                $return[] = $value;
            }
        }

        return $return;
    }

    function get_products($category_uuid) {
        $records = $this->get_entities('products', ['category_uuid' => $category_uuid]);

        $return = [];
        foreach ($records as $key => $value) {
            if (strpos($value->product_code, '16PT-') !== false) {
                if (in_array($value->product_code, $this->product_required)) {
                    $return[] = $value;
                }
            }
        }

        return $return;
    }

    function get_specific_product($product_uuid) {
        $api = $this->get_api('specific_product', ['product_uuid' => $product_uuid]);
        $records = $this->request($api);
        return $records;
    }

    function set_dates() {

        if (isset($this->access_token)) {
            $api = $this->get_api('date', ['access_token' => $this->access_token]);

            $records = $this->request($api);

            if (isset($records->dates)) {
                $dates = (array) $records->dates;
                $this->selectable_dates = array_keys($dates);
                $this->default_selected_date = isset($this->selectable_dates[0]) ? date('m/d/Y', strtotime($this->selectable_dates[0])) : '';
            } else {
                $this->selectable_dates = [];
                $this->default_selected_date = '';
            }
        }
    }

    function print_csv($array) {
        $row = [];
        foreach ($array as $key => $value) {
            $row[] = "'{$value}'";
        }
        return implode(',', $row);
    }

    function find_size($string) {
        preg_match('/(\d\d?.)?\d\d?X(\d\d?.)?\d\d?/', $string, $matches);
        return isset($matches[0]) ? $matches[0] : null;
    }

    function get_baseprices($product_uuid) {
        $api = $this->get_api('baseprices', ['product_uuid' => $product_uuid]);
        $records = $this->request($api);
        return (isset($records->entities)) ? $records->entities : [];
    }

    function get_product_baseprices($baseprices, $selection) {

        foreach ($baseprices as $key => $value) {
            if ($value->product_uuid == $selection['product_uuid']) {
                if ($value->colorspec_uuid == $selection['colorspec_uuid']) {
                    if ($value->runsize_uuid == $selection['runsize_uuid']) {
                        return $value;
                    }
                }
            }
        }

        return false;
    }

    function get_options($product) {

        if (!isset($product->product_option_groups)) {
            return false;
        }


        $fields = [];

        foreach ($product->product_option_groups as $key => $value) {

            if ($value->product_option_group_name == 'Size') {
//                $api = $this->get_api('options', ['option_group_uuid' => $value->product_option_group_uuid]);
//                $return['size'] = $this->request($api);
                $row = [];
                $row['name'] = 'size';
                $row['label'] = 'Size';
                $row['options'] = $this->set_select_option($value->options, 'option_uuid', 'option_name');
                $fields[] = $row;
            }

            if ($value->product_option_group_name == 'Stock') {
                $row = [];
                $row['name'] = 'stock';
                $row['label'] = 'Stock';
                $row['options'] = $this->set_select_option($value->options, 'option_uuid', 'option_name');
                $fields[] = $row;
            }

            if ($value->product_option_group_name == 'Coating') {
                $row = [];
                $row['name'] = 'coating';
                $row['label'] = 'Coating';
                $row['options'] = $this->set_select_option($value->options, 'option_uuid', 'option_name');
                $fields[] = $row;
            }

            if ($value->product_option_group_name == 'Colorspec') {
                $row = [];
                $row['name'] = 'color';
                $row['label'] = 'Color';
                $row['options'] = $this->set_select_option($value->options, 'option_uuid', 'option_name');
                $fields[] = $row;
            }
            if ($value->product_option_group_name == 'Runsize') {
                $row = [];
                $row['name'] = 'runsize';
                $row['label'] = 'Runsize';
                $row['options'] = $this->set_select_option($value->options, 'option_uuid', 'option_name');
                $fields[] = $row;
            }
        }

        return $fields;
    }

    function http_get_map() {
        $return = [];
        foreach ($this->product_options as $key => $value) {
            $options[$value] = isset($_GET[$value]) ? $_GET[$value] : '';
        }

        $return['product_options'] = $options;
        $return['access_token'] = $this->access_token;
        $return['date'] = date('Y-m-d', strtotime($_GET['target_in_mailbox_date']));

        $return['string_product_options'] = '&options[]=' . implode('&options[]=', $options);

        $return['product_uuid'] = $_GET['product'];
        $return['signature'] = $this->signature;
        $return['url_create_order'] = $this->url_create_order;
        $return['job_name'] = 'job002-001';

        return $return;
    }

    function get_date_range($date1, $date2) {

        $dup = $date1;

        $date_range = [];

        while ($dup <= $date2) {
            $date_range[] = $dup;
            $dup = date('Y-m-d', strtotime("{$dup} +1 days"));
        }

        return $date_range;
    }

    function get_disabled_dates() {
        $start_date = $this->selectable_dates[0];
        $end_date = end($this->selectable_dates);
        $total_dates = $this->get_date_range($start_date, $end_date);

        $disabled = array_diff($total_dates, $this->selectable_dates);
        sort($disabled);
        return $disabled;
    }

    /**
     * 
     * @param array $dates a list of dates in format Y-m-d conver to MM/dd/yyyy (for ng- date picker)
     * @return array 
     */
    function change_date_format($dates) {

        if (is_array($dates)) {
            $return = [];
            foreach ($dates as $key => $value) {
                $return[] = date('m/d/Y', strtotime($value));
            }

            return $return;
        }else{
            return date('m/d/Y', strtotime($dates));
        }
    }

}
