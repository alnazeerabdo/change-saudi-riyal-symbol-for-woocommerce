<?php
/**
 * Plugin Name: Change Saudi Riyal Symbol for WooCommerce
 * Plugin URI: https://linktr.ee/alnazeer
 * Description: Automatically replaces the default WooCommerce Saudi Riyal symbol with a modern, built-in SVG icon. No settings needed.
 * Version: 1.0.0
 * Author: Alnazeer Abdo
 * Author URI: https://linktr.ee/alnazeer
 * License: GPL v2 or later
 * Text Domain: change-saudi-riyal-symbol-for-woocommerce
 * WC requires at least: 6.0
 * WC tested up to: 8.0.0
 *
 * @package Change_Saudi_Riyal_Symbol_For_WooCommerce
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Replace the default Saudi Riyal symbol with a custom SVG icon.
 *
 * @param string $currency_symbol The currency symbol.
 * @param string $currency The currency code.
 * @return string Modified currency symbol if SAR, original symbol otherwise.
 */
function change_sar_currency_symbol( $currency_symbol, $currency ) {
    if ( 'SAR' === $currency && ! is_admin() ) {
        $svg_url = plugins_url( 'assets/images/saudi-riyal-symbol.svg', __FILE__ );
        
        return '<img src="' . esc_url( $svg_url ) . '" alt="SAR" class="sar-svg-symbol" />';
    }
    return $currency_symbol;
}

add_filter( 'woocommerce_currency_symbol', 'change_sar_currency_symbol', 10, 2 );


/**
 * Enqueue the stylesheet for the Saudi Riyal SVG symbol.
 */
function sar_symbol_enqueue_styles() {
    if ( ! is_admin() ) {
        wp_enqueue_style(
            'sar-symbol-styles',
            plugins_url( 'assets/css/style.css', __FILE__ ),
            array(),
            '1.0.0'
        );
    }
}

add_action( 'wp_enqueue_scripts', 'sar_symbol_enqueue_styles' );
