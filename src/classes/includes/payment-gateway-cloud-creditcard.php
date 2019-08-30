<?php

class WC_PaymentGatewayCloud_CreditCard extends WC_Payment_Gateway
{
    public $id = 'creditcard';

    public $method_title = 'Credit Card';

    public function __construct()
    {
        $this->id = PAYMENT_GATEWAY_CLOUD_EXTENSION_UID_PREFIX . $this->id;
        $this->method_description = PAYMENT_GATEWAY_CLOUD_EXTENSION_NAME . ' ' . $this->method_title . ' payments.';

        $this->has_fields = false;

        $this->init_form_fields();
        $this->init_settings();

        $this->title = $this->get_option('title');
        $this->callbackUrl = str_replace('https:', 'http:', add_query_arg('wc-api', 'wc_' . $this->id, home_url('/')));

        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
        add_action('wp_enqueue_scripts', function () {
            wp_register_script('payment_js', PAYMENT_GATEWAY_CLOUD_EXTENSION_URL . 'js/integrated/payment.min.js', [], null, false);
        }, 999);
        add_action('woocommerce_api_wc_' . $this->id, [$this, 'process_callback']);
        add_filter('script_loader_tag', function ($tag, $handle) {
            if ($handle !== 'payment_js') {
                return $tag;
            }
            return str_replace(' src', ' data-main="payment-js" src', $tag);
        }, 10, 2);
    }

    public function process_payment($orderId)
    {
        global $woocommerce;
        $order = new WC_Order($orderId);
        $order->update_status('pending', __('Awaiting cheque payment', 'woocommerce'));

        WC_PaymentGatewayCloud_Provider::autoloadClient();
        WC_PaymentGatewayCloud_Provider::setupClient();

        $client = new PaymentGatewayCloud\Client\Client(
            $this->get_option('apiUser'),
            $this->get_option('password'),
            $this->get_option('apiKey'),
            $this->get_option('sharedSecret')
        );

        $customer = new \PaymentGatewayCloud\Client\Data\Customer();
        $customer
            ->setBillingAddress1($order->get_billing_address_1())
            ->setBillingAddress2($order->get_billing_address_2())
            ->setBillingCity($order->get_billing_city())
            ->setBillingCountry($order->get_billing_country())
            ->setBillingPhone($order->get_billing_phone())
            ->setBillingPostcode($order->get_billing_postcode())
            ->setBillingState($order->get_billing_state())
            ->setCompany($order->get_billing_company())
            ->setEmail($order->get_billing_email())
            ->setFirstName($order->get_billing_first_name())
            ->setIpAddress(WC_Geolocation::get_ip_address())
            ->setLastName($order->get_billing_last_name());
        /**
         * TODO: there is no shipping data for digital goods
         */
        // ->setShippingAddress1($order->get_shipping_address_1())
        // ->setShippingAddress2($order->get_shipping_address_2())
        // ->setShippingCity($order->get_shipping_city())
        // ->setShippingCompany($order->get_shipping_company())
        // ->setShippingCountry($order->get_shipping_country())
        // ->setShippingFirstName($order->get_shipping_first_name())
        // ->setShippingLastName($order->get_shipping_last_name())
        // ->setShippingPostcode($order->get_shipping_postcode())
        // ->setShippingState($order->get_shipping_state());

        $debit = new \PaymentGatewayCloud\Client\Transaction\Debit();
        $debit->setCustomer($customer)
            ->setCallbackUrl($this->callbackUrl)
            ->setTransactionId($orderId)
            ->setAmount(floatval($order->get_total()))
            ->setCurrency($order->get_currency())
            ->setCancelUrl($woocommerce->cart->get_checkout_url())
            ->setSuccessUrl($this->get_return_url($order))
            ->setErrorUrl($this->get_return_url($order));


        $redirect = $this->get_return_url($order);
        $result = $client->debit($debit);
        if ($result->isSuccess()) {
            $woocommerce->cart->empty_cart();

            if ($result->getReturnType() == \PaymentGatewayCloud\Client\Transaction\Result::RETURN_TYPE_REDIRECT) {
                $redirect = $result->getRedirectUrl();
            }
            return [
                'result' => 'success',
                'redirect' => $redirect,
            ];
        }

        /**
         * something went wrong
         */
        return [
            'result' => 'failure',
        ];
    }

    public function process_callback()
    {
        WC_PaymentGatewayCloud_Provider::autoloadClient();
        WC_PaymentGatewayCloud_Provider::setupClient();

        $client = new PaymentGatewayCloud\Client\Client(
            $this->get_option('apiUser'),
            $this->get_option('password'),
            $this->get_option('apiKey'),
            $this->get_option('sharedSecret')
        );

        $client->validateCallbackWithGlobals();
        $callbackResult = $client->readCallback(file_get_contents('php://input'));
        $orderId = $callbackResult->getTransactionId();
        $order = new WC_Order($orderId);
        if ($callbackResult->getResult() == \PaymentGatewayCloud\Client\Callback\Result::RESULT_OK) {
            $order->payment_complete();
        }

        die("OK");
    }

    public function init_form_fields()
    {
        $this->form_fields = [
            'title' => [
                'title' => 'Title',
                'type' => 'text',
                'label' => 'Title',
                'description' => 'Title',
                'default' => $this->method_title,
            ],
            'apiUser' => [
                'title' => 'API User',
                'type' => 'text',
                'label' => 'API User',
                'description' => 'API User',
                'default' => '',
            ],
            'password' => [
                'title' => 'API Password',
                'type' => 'text',
                'label' => 'API Password',
                'description' => 'API Password',
                'default' => '',
            ],
            'apiKey' => [
                'title' => 'API Key',
                'type' => 'text',
                'label' => 'API Key',
                'description' => 'API Key',
                'default' => '',
            ],
            'sharedSecret' => [
                'title' => 'Shared Secret',
                'type' => 'text',
                'label' => 'Shared Secret',
                'description' => 'Shared Secret',
                'default' => '',
            ],
        ];
    }

    public function payment_fields()
    {
        wp_enqueue_script('payment_js');
        echo '<div>
                    <label for="card_holder">Card holder</label>
                    <input type="text" id="card_holder" name="card_holder" />
                </div>
                <div>
                    <label for="number_div">Card number</label>
                    <div id="number_div" style="height: 35px; width: 200px;"></div>
                </div>
                <div>
                    <label for="cvv_div">CVV</label>
                    <div id="cvv_div" style="height: 35px; width: 200px;"></div>
                </div>
            
                <div>
                    <label for="exp_month">Month</label>
                    <input type="text" id="exp_month" name="exp_month" />
                </div>
                <div>
                    <label for="exp_year">Year</label>
                    <input type="text" id="exp_year" name="exp_year" />
                </div>';
    }
}