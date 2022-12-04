<?php
/**
 * Custom coupons for woocommerce
 *
 * @package   custom-coupons
 * @author    Kirubanithi G <kirubanithikm@gmail.com>
 * @license   GPL-3.0-or-later
 */

namespace CC\App\Controllers\Frontend;

if (!defined('ABSPATH')) {exit;}

class Cart
{
    /**
     * Create coupon code
     * @hooked woocommerce_get_shop_coupon_data
     * @param $false
     * @param $data
     * @param $that
     * @return array|mixed
     */
    function addCoupon($false, $data, $that)
    {

        $cc_retrieve_data = WC()->session->get('coupons_values');
        foreach ($cc_retrieve_data as $coupon_key => $coupon_value){

            if($coupon_value['coupon_name'] == $data){
                $data = array(
                    'code' => $coupon_value['coupon_name'],
                    'amount' => $coupon_value['coupon_value'],
                    'status' => null,
                    'date_created' => null,
                    'date_modified' => null,
                    'date_expires' => null,
                    'discount_type' => $coupon_value['coupon_type'],
                    'description' => '',
                    'usage_count' => 0,
                    'individual_use' => false,
                    'product_ids' => array($coupon_value['product_id']),
                    'excluded_product_ids' => array(),
                    'usage_limit' => 0,
                    'usage_limit_per_user' => 0,
                    'limit_usage_to_x_items' => null,
                    'free_shipping' => false,
                    'product_categories' => array(),
                    'excluded_product_categories' => array(),
                    'exclude_sale_items' => false,
                    'minimum_amount' => '',
                    'maximum_amount' => '',
                    'email_restrictions' => array(),
                    'used_by' => array(),
                    'virtual' => false,
                );
                return $data;
            }
        }
        return $false;
    }

    /**
     * Apply coupon code in cart page
     * @hooked woocommerce_after_calculate_totals
     * @param $cart_object
     * @return void
     */
    public static function applyCoupon($cart_object)
    {

        $coupons_data = [];
        foreach ($cart_object->cart_contents as $key => $cart_item) {
            $product_id = $cart_item['product_id'];
            $cc_data = get_post_meta($product_id, '_cc_data', true);

            if (!empty($cc_data)) {
                $cc_name = $cc_data['coupon_name'];
                $cc_type = $cc_data['coupons_type'];
                $cc_value = $cc_data['coupons_value'];

                $coupons_data[] = array(
                    'product_id' => $product_id,
                    'coupon_name' => $cc_name,
                    'coupon_type' => $cc_type,
                    'coupon_value' => $cc_value,
                );
            }
        }

        WC()->session->set('coupons_values' , $coupons_data);

        foreach ($coupons_data as $array_row => $array_column){
            $coupon_code = $array_column['coupon_name'];
            if (WC()->cart->has_discount($coupon_code)) return;
            WC()->cart->apply_coupon($coupon_code);
            wc_print_notices();
        }
    }
}