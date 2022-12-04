<?php
/**
 * Custom coupons for woocommerce
 *
 * @package   custom-coupons
 * @author    Kirubanithi G <kirubanithikm@gmail.com>
 * @license   GPL-3.0-or-later
 */

namespace CC\App\Controllers\Admin;
use CC\App\Helpers\Functions;

if (!defined('ABSPATH')) {exit;}

class Admin{
    /**
     * Update or save data as array
     * @return void
     */
    function savePost()
    {
        global $post;
        $cc_data = [
            'coupon_name' => isset($_POST['cc_name']) ? sanitize_textarea_field($_POST['cc_name']) : null,
            'coupons_type' => isset($_POST['cc_type']) ? sanitize_textarea_field($_POST['cc_type']) : null,
            'coupons_value' => isset($_POST['cc_value']) ? sanitize_textarea_field($_POST['cc_value']) : null,
        ];
        update_post_meta($post->ID, "_cc_data", $cc_data);
    }

    /**
     * Create admin product tab
     * @param $tab
     * @return mixed
     */
    function adminProductTab($tab)
    {
        $tab['_cc_data'] = array(
            'label' => __('Custom coupons', 'woocommerce'),
            'target' => '_cc_data',
            'class' => array(),
            'priority' => 45,
        );
        return $tab;
    }

    /**
     * Admin panel - view file
     * @hooked woocommerce_product_data_panels
     * @return void
     */
    public function AddPanel()
    {
        $data=[];
        Functions::view('Admin/Panels',$data,true);
    }
}