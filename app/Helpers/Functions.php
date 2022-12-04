<?php
/**
 * Custom coupons for woocommerce
 *
 * @package   custom-coupons
 * @author    Kirubanithi G <kirubanithikm@gmail.com>
 * @license   GPL-3.0-or-later
 */

namespace CC\App\Helpers;
if (!defined('ABSPATH')) {exit;}

class Functions
{

    /**
     * Render template file
     * @param $file
     * @param $data
     * @param bool $print
     * @return false|string
     */
    public static function renderTemplate($file, $data, $print = true)
    {
        if (file_exists($file)) {
            ob_start();
            extract($data);
            include $file;
            $output = ob_get_clean();

            if ($print) {
                echo $output;
            }
            return $output;
        }
        return false;
    }

    /**
     * View
     * @param $path
     * @param $data
     * @param bool $print
     * @return false|string
     */
    public static function view($path, $data, $print = true)
    {
        $file = CC_PLUGIN_PATH . '/app/Views/' . $path . '.php';
        return self::renderTemplate($file, $data, $print);
    }

    /**
     * Display admin notice when woocommerce plugin is not activated
     * @hooked admin_notices
     * @return void
     */
    public function woocommerceDeactivateError()
    {
        if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            $class = 'notice notice-error';
            $message = __('Custom coupon for woocommerce require to activate woocommerce plugin.', 'sample-text-domain');
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
        }
    }
}