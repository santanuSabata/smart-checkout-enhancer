<?php

if (!defined('ABSPATH')) exit;

class SCE_Admin {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_settings_page']);
        add_action('admin_init', [__CLASS__, 'register_settings']);
    }

    public static function add_settings_page() {  
        add_submenu_page(
            'woocommerce',
            'Smart Checkout Enhancer',
            'Smart Checkout Enhancer',
            'manage_options',
            'sce-settings',
            [__CLASS__, 'render_settings_page']
        );
    }

    public static function register_settings() {

        register_setting('sce_settings_group', 'sce_fee_amount', [
            'type' => 'number',
            'description' => 'Conditional fee amount',
            'default' => 50,
        ]);

        register_setting('sce_settings_group', 'sce_fee_country', [
            'type' => 'string',
            'description' => 'Country for conditional fee',
            'default' => 'IN',
        ]);

        register_setting('sce_settings_group', 'sce_cart_min_total', [
            'type' => 'number',
            'description' => 'Minimum cart total for fee',
            'default' => 500,
        ]);

        register_setting('sce_settings_group', 'sce_modify_cart_price', [
            'type' => 'boolean',
            'description' => 'Enable dynamic cart price modification',
            'default' => true,
        ]);
    }

    public static function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Smart Checkout Enhancer Settings</h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields('sce_settings_group');
                    do_settings_sections('sce_settings_group');
                ?>
                <table class="form-table">
                    <tr>
                        <th>Conditional Fee Amount</th>
                        <td><input type="number" name="sce_fee_amount" value="<?php echo esc_attr(get_option('sce_fee_amount', 50)); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Fee Country</th>
                        <td><input type="text" name="sce_fee_country" value="<?php echo esc_attr(get_option('sce_fee_country', 'IN')); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Minimum Cart Total</th>
                        <td><input type="number" name="sce_cart_min_total" value="<?php echo esc_attr(get_option('sce_cart_min_total', 500)); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Enable Dynamic Cart Price Modification</th>
                        <td><input type="checkbox" name="sce_modify_cart_price" value="1" <?php checked(1, get_option('sce_modify_cart_price', 1)); ?> /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}

SCE_Admin::init();