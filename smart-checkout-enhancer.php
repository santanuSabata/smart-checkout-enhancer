<?php 
/*
Plugin Name: Smart Checkout Enhancer
Description: Advanced checkout enhancements for WooCommerce.
Plugin URI: https://github.com/santanuSabata/smart-checkout-enhancer
Version: 1.0.0
Requires at least: 5.8
Tested up to: 6.9
Requires PHP: 7.4
Author: Santanu Sabata
Author URI: https://santanusabata.netlify.app
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: smart-checkout-enhancer
Domain Path: /languages
*/

if (!defined('ABSPATH')) {
    exit;
}

define('SCE_PATH', plugin_dir_path(__FILE__));

require_once SCE_PATH . 'includes/class-sce-conditions.php';
require_once SCE_PATH . 'includes/class-sce-analytics.php';
require_once SCE_PATH . 'includes/class-sce-background.php';
require_once SCE_PATH . 'includes/class-sce-logger.php';
require_once SCE_PATH . 'includes/class-sce-admin.php';
 
class Smart_Checkout_Enhancer { 

    public function __construct() {
        add_action('woocommerce_cart_calculate_fees', [$this, 'add_conditional_fee']);
        add_action('woocommerce_before_calculate_totals', [$this, 'modify_cart_prices']);
        add_action('woocommerce_checkout_order_processed', ['SCE_Analytics', 'store_checkout_data']);
        add_action('woocommerce_order_status_completed', ['SCE_Background', 'schedule_background_job']);
    }

    public function add_conditional_fee($cart) {

        if (SCE_Conditions::should_apply_fee($cart)) {
            $fee_amount = get_option('sce_fee_amount', 50);
            $cart->add_fee('Smart Subscription Fee', $fee_amount);
            //$cart->add_fee('Smart Subscription Fee', 50);
            SCE_Logger::log('Conditional fee applied.');
        }
    }

    public function modify_cart_prices($cart) {

        if (is_admin() && !defined(constant_name: 'DOING_AJAX')) return;

        foreach ($cart->get_cart() as $cart_item) {
            if ($cart_item['data']->get_price() > 100) {
                $cart_item['data']->set_price(
                    $cart_item['data']->get_price() * 0.9
                );
                SCE_Logger::log('Cart item price modified.');
            }
        }
    }
}

new Smart_Checkout_Enhancer();