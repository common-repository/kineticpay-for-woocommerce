<?php
function is_hpos_enabled(){
    if ( class_exists( \Automattic\WooCommerce\Utilities\OrderUtil::class ) ) {
        if ( \Automattic\WooCommerce\Utilities\OrderUtil::custom_orders_table_usage_is_enabled() ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function get_post_meta_wc($order_id, $meta_key, $single = true) {
    if ( is_hpos_enabled() ) {
        $order = wc_get_order( $order_id );
        $value = $order->get_meta( $meta_key, $single );
        return $value;
    } else {
        return get_post_meta($order_id, $meta_key, $single);
    }
}
function update_post_meta_wc($order_id, $meta_key, $meta_value) {
    if ( is_hpos_enabled() ) {
        $order = wc_get_order( $order_id );
        $order->update_meta_data( $meta_key, $meta_value );
        $order->save();
    } else {
        update_post_meta($order_id, $meta_key, $meta_value);
    }
}