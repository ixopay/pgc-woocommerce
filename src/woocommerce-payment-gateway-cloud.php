<?php
/**
 * Plugin Name: WooCommerce Payment Gateway Cloud Extension
 * Description: Payment Gateway Cloud for WooCommerce
 * Version: X.Y.Z
 * Author: Payment Gateway Cloud
 * WC requires at least: 3.6.0
 * WC tested up to: 3.7.0
 */
if (!defined('ABSPATH')) {
    exit;
}

define('PAYMENT_GATEWAY_CLOUD_EXTENSION_URL', 'https://gateway.paymentgateway.cloud/');
define('PAYMENT_GATEWAY_CLOUD_EXTENSION_NAME', 'Payment Gateway Cloud');
define('PAYMENT_GATEWAY_CLOUD_EXTENSION_VERSION', 'X.Y.Z');
define('PAYMENT_GATEWAY_CLOUD_EXTENSION_UID_PREFIX', 'payment_gateway_cloud_');
define('PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR', plugin_dir_path(__FILE__));

add_action('plugins_loaded', function () {
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-provider.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-amex.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-diners.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-discover.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-jcb.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-maestro.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-mastercard.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-unionpay.php';
    require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/includes/payment-gateway-cloud-creditcard-visa.php';

    add_filter('woocommerce_payment_gateways', function ($methods) {
        foreach (WC_PaymentGatewayCloud_Provider::paymentMethods() as $paymentMethod) {
            $methods[] = $paymentMethod;
        }
        return $methods;
    }, 0);

    add_filter('woocommerce_checkout_before_customer_details', function(){
        if(!empty($_GET['gateway_return_result']) && $_GET['gateway_return_result'] == 'error') {
            wc_print_notice(__('Payment failed or was declined', 'woocommerce'), 'error');
        }
    }, 0, 0);
});
