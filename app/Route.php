<?php
namespace CC\App;
if (!defined('ABSPATH')) {exit;}

class Route
{

    /**
     *  init the hooks and classes
     */
    function __construct(){

        $admin = new Controllers\Admin\Admin();
        $cart = new Controllers\Frontend\Cart();
        $function = new Helpers\Functions();

        if (is_admin()) {
            add_filter('woocommerce_product_data_tabs', array($admin, 'adminProductTab'));
            add_action('woocommerce_product_data_panels', array($admin, 'AddPanel'));
            add_action('save_post', array($admin, 'savePost'));
            add_action( 'admin_notices', array($function,'woocommerceDeactivateError'));
        }

        add_action('woocommerce_after_calculate_totals', array($cart,'applyCoupon'));
        add_filter('woocommerce_get_shop_coupon_data', array($cart,'addCoupon'),10,3);
    }
}