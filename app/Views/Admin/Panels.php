<?php global $post;?>
<div id="_cc_data" class="panel woocommerce_options_panel hidden">
    <p class="form-field">
        <label ><?php esc_html_e('Coupons name', 'woocommerce');?></label>
    <form method="post" id="_cc_data" class="selected_value" >
        <?php
        $cc_data = get_post_meta($post->ID, '_cc_data', true);
        if (!empty($cc_data)) {
            $name = $cc_data['coupon_name'];
            $type = $cc_data['coupons_type'];
            $value = $cc_data['coupons_value'];
        }
        $default_name = get_option('cc_name');
        if ($default_name == "" && !empty($name)) {
            $default_name = $name;
        }
        $default_input = get_option('cc_value');
        if ($default_input == "" && !empty($value)) {
            $default_input = $value;
        } ?>

        <input type="text" id="cc_name_id" name="cc_name"
               value="<?php if(!empty($name)){
                   echo esc_html($default_name);
               } ?>"
        >
        <div id="cc_offer_type">
            <h4> <?php esc_html_e('Please select the coupon type', 'woocommerce');?> </h4>
            <select name="cc_type" id="cc_type_id">
                <option value="" hidden >choose</option>
                <option
                    <?php if (!empty($type) && $type == "percent") {
                        echo esc_html("selected");
                    } ?>
                        value="percent">percentage</option>
                <option
                    <?php if (!empty($type) && $type == "fixed_cart") {
                        echo esc_html("selected");
                    } ?>
                        value="fixed_cart">Fixed price</option>
            </select>
        </div>
        <div id="cc_discount_value">
            <br>
            <h4> <?php esc_html_e('Enter discount value', 'woocommerce');?> </h4>
            <input id="cc_discount_input_id" type="number" name="cc_value" placeholder="Enter discount value" min="1"
                <?php if (!empty($type) && $type == "percent") {
                    ?>
                    max="100"
                    <?php
                }?>
                   value="<?php echo esc_html($default_input) ?>" >
        </div>
    </form>
    </p>
</div>