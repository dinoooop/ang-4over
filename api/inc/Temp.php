<?php

class Temp extends Record {

    function __construct() {
        
    }

    function select_option($options, $empty = true) {

        ob_start();
        ?>
        <?php if ($empty): ?>
            <option value=""></option>
        <?php endif; ?>
        <?php foreach ($options as $key => $value): ?>
            <option value="<?php echo $key; ?>"><?php echo $value ?></option>
        <?php endforeach; ?>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    function order_summery($options) {
        $html = '<p>Pricing will be available once routes are selected.</p>';
        if (!isset($options->product_baseprice)) {
            return $html;
        }
        ob_start();
        ?>
        <h4>Base Price:  $<?php echo $options->product_baseprice; ?></h4>
        <input type="hidden" name="base_price_uuid" value="<?php echo $options->base_price_uuid; ?>">
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    function set_options($option) {

        $option['class'] = isset($option['class']) ? $option['class'] : '';

        ob_start();
        ?>
        <div class="form-group">
            <label for="<?php echo $option['name']; ?>"><?php echo $option['label']; ?></label>
            <select name="<?php echo $option['name']; ?>" class="form-control <?php echo $option['class']; ?>" id="<?php echo $option['name']; ?>">
                <?php echo $this->select_option($option['options'], false); ?>
            </select>
        </div>
        <?php
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

}
