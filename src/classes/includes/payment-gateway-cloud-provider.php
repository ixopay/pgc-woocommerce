<?php

final class WC_PaymentGatewayCloud_Provider
{
    public static function paymentMethods()
    {
        return [
            'WC_PaymentGatewayCloud_CreditCard',
            'WC_PaymentGatewayCloud_CreditCard_Amex',
            'WC_PaymentGatewayCloud_CreditCard_Diners',
            'WC_PaymentGatewayCloud_CreditCard_Discover',
            'WC_PaymentGatewayCloud_CreditCard_Jcb',
            'WC_PaymentGatewayCloud_CreditCard_Maestro',
            'WC_PaymentGatewayCloud_CreditCard_Mastercard',
            'WC_PaymentGatewayCloud_CreditCard_UnionPay',
            'WC_PaymentGatewayCloud_CreditCard_Visa',
        ];
    }

    public static function autoloadClient()
    {
        require_once PAYMENT_GATEWAY_CLOUD_EXTENSION_BASEDIR . 'classes/vendor/autoload.php';
    }

    public static function setupClient()
    {
        \PaymentGatewayCloud\Client\Client::setApiUrl(PAYMENT_GATEWAY_CLOUD_EXTENSION_URL);
    }
}
