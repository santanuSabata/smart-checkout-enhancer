<?php

class SCE_Background {

    public static function schedule_background_job($order_id) {

        if (!wp_next_scheduled('sce_process_order', [$order_id])) {
            wp_schedule_single_event(time() + 60, 'sce_process_order', [$order_id]);
        }

        SCE_Logger::log('Background job scheduled for order ' . $order_id);
    }
}

add_action('sce_process_order', function($order_id) {

    // Example heavy processing
    sleep(2);

    SCE_Logger::log('Background job executed for order ' . $order_id);

});