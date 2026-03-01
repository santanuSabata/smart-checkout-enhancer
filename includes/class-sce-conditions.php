<?php

class SCE_Conditions {

    public static function should_apply_fee($cart) {

        $has_subscription = true;

        /*foreach ($cart->get_cart() as $cart_item) {
            if (class_exists('WC_Subscriptions_Product') &&
                WC_Subscriptions_Product::is_subscription($cart_item['data'])) {
                $has_subscription = true;
            }
        }*/  

        $has_eligible_product = false;
        foreach ($cart->get_cart() as $cart_item) {
            $product = $cart_item['data'];
            if ($product->is_type('subscription') || $product->is_type('simple')) {
                $has_eligible_product = true;  
            }
        }

        $country = WC()->customer->get_shipping_country();
        $cart_total = $cart->get_subtotal();
        $fee_country = get_option('sce_fee_country', 'IN');
        $min_total  = get_option('sce_cart_min_total', 500);

       //print $cart_total;exit;
        if (
            $has_subscription &&
            $country === $fee_country &&
            $cart_total < $min_total
        ) {   
            return true;
        }

        return false;
    }
}