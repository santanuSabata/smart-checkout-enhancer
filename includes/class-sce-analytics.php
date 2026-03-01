<?php

class SCE_Analytics {

    public static function store_checkout_data($order_id) {

        $order = wc_get_order($order_id);

        $data = [
            'order_id' => $order_id,
            'total' => $order->get_total(),
            'country' => $order->get_billing_country(),
            'items_count' => $order->get_item_count(),
            'timestamp' => current_time('mysql')
        ];

        update_post_meta($order_id, '_sce_checkout_analytics', $data);

        SCE_Logger::log('Checkout analytics stored for order ' . $order_id);
    }
}