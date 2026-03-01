<?php

class SCE_Logger {

    public static function log($message) {

        if (function_exists('wc_get_logger')) {
            $logger = wc_get_logger();
            $context = ['source' => 'smart-checkout-enhancer'];

            $logger->info($message, $context);
        }
    }
}