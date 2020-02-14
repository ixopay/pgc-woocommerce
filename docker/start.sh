#!/bin/bash
# set -x
#set -euo pipefail

echo -e "Starting Wordpress"

/app-entrypoint.sh nami start --foreground apache &

if [ ! -f "/setup_complete" ]; then

    echo -e "Waiting for Wordpress to Initialize"

    while [ ! -f "/bitnami/wordpress/.initialized" ]; do sleep 2s; done

    while (! $(curl --silent http://localhost:80 | grep "ust another WordPress site" > /dev/null)); do sleep 2s; done

    echo -e "Removing inactive plugins"

    wp --allow-root plugin delete --quiet $(wp --allow-root plugin list --status=inactive --field=name)

    echo -e "Installing WooCommerce"

    wp --allow-root plugin install --quiet woocommerce woocommerce-admin wordpress-importer --activate

    echo -e "Installing PGC Extension"

    DB_FIELD_NAME="payment_gateway_cloud"
    if [ "${BUILD_ARTIFACT}" != "undefined" ]; then
        if [ -f /dist/paymentgatewaycloud.zip ]; then
            echo -e "Using Supplied zip ${BUILD_ARTIFACT}"
            cp /dist/paymentgatewaycloud.zip /paymentgatewaycloud.zip
        else
            echo "Faled to build!, there is no such file: ${BUILD_ARTIFACT}"
            exit 1
        fi
    else
        if [ ! -d "/source/.git" ] && [ ! -f  "/source/.git" ]; then
            echo -e "Checking out branch ${BRANCH} from ${REPOSITORY}"
            git clone $REPOSITORY /tmp/paymentgatewaycloud
            cd /tmp/paymentgatewaycloud
            git checkout $BRANCH
        else
            echo -e "Using Development Source!"
            cp -rf /source /tmp/paymentgatewaycloud
        fi
        cd /tmp/paymentgatewaycloud
        if [ ! -z "${WHITELABEL}" ]; then
            echo -e "Running Whitelabel Script for ${WHITELABEL}"
            DEST_FILE="$(echo "y" | php build.php "gateway.mypaymentprovider.com" "${WHITELABEL}" | tail -n 1 | sed 's/.*Created file "\(.*\)".*/\1/g')"
            DB_FIELD_NAME="word$(php /whitelabel.php snakeCase "${WHITELABEL}")"
            cp "${DEST_FILE}" /paymentgatewaycloud.zip
        else
           mv src paymentgatewaycloud
           zip -q -r /paymentgatewaycloud.zip paymentgatewaycloud
        fi
    fi
    wp --allow-root plugin install /paymentgatewaycloud.zip --activate

    echo -e "Configuring Extensions"

    # Setup Woocommerce
    wp --allow-root option set siteurl "${URL}"
    wp --allow-root option set home "${URL}"
    wp --allow-root option set show_on_front page
    wp --allow-root option set page_on_front 5 # TODO: Get Correct ID Dynamically
    wp --allow-root option set woocommerce_store_address "${SHOP_ADDRESS}"
    wp --allow-root option set woocommerce_store_city "${SHOP_CITY}"
    wp --allow-root option set woocommerce_store_postcode "${SHOP_ZIP}"
    wp --allow-root option set woocommerce_store_postalcode "${SHOP_ZIP}"
    wp --allow-root option set woocommerce_default_country "${SHOP_COUNTRY}"
    wp --allow-root option set woocommerce_currency "${SHOP_CURRENCY}"
    wp --allow-root option set woocommerce_product_type "physical"
    wp --allow-root option set woocommerce_setup_jetpack_opted_in "0"
    wp --allow-root option set woocommerce_demo_store "${SHOP_DEMO}"
    wp --allow-root option set wc_admin_install_timestamp "1576074636"
    wp --allow-root option set --format=json woocommerce_admin_notices '{"install":"1"}'
    wp --allow-root option set --format=json woocommerce_stripe_settings '{"enabled":"no","create_account":false,"email":false}'
    wp --allow-root option set --format=json woocommerce_ppec_paypal_settings '{"reroute_requests":false,"email":false}'
    wp --allow-root option set --format=json woocommerce_cheque_settings '{"enabled":"no"}'
    wp --allow-root option set --format=json woocommerce_klarna_payments_settings '{"enabled":"no"}'
    wp --allow-root option set --format=json woocommerce_bacs_settings '{"enabled":"no"}'
    wp --allow-root option set --format=json woocommerce_cod_settings '{"enabled":"no"}'
    wp --allow-root wc --user=user@example.com tool run install_pages

    # Enable Payment Providers
    if [ $SHOP_PGC_URL ]; then
        wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE'"}'
        if [ $SHOP_PGC_CC_AMEX ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_amex_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_AMEX'"}'
        fi
        if [ $SHOP_PGC_CC_DINERS ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_diners_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_DINERS'"}'
        fi
        if [ $SHOP_PGC_CC_DISCOVER ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_discover_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_DISCOVER'"}'
        fi
        if [ $SHOP_PGC_CC_JCB ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_jcb_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_JCB'"}'
        fi
        if [ $SHOP_PGC_CC_MAESTRO ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_maestro_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_MAESTRO'"}'
        fi
        if [ $SHOP_PGC_CC_MASTERCARD ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_mastercard_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_MASTERCARD'"}'
        fi
        if [ $SHOP_PGC_CC_UNIONPAY ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_unionpay_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_UNIONPAY'"}'
        fi
        if [ $SHOP_PGC_CC_VISA ]; then
            wp --allow-root option set --format=json woocommerce_${DB_FIELD_NAME}_creditcard_visa_settings '{"enabled":"yes","apiHost":"'$SHOP_PGC_URL'","apiUser":"'$SHOP_PGC_USER'","apiPassword":"'$SHOP_PGC_PASSWORD'","apiKey":"'$SHOP_PGC_API_KEY'","sharedSecret":"'$SHOP_PGC_SECRET'","integrationKey":"'$SHOP_PGC_INTEGRATION_KEY'","transactionRequest":"'$SHOP_PGC_CC_TYPE_VISA'"}'
        fi
    fi

    echo -e "Import Products"

    curl -o /sample_products.xml https://raw.githubusercontent.com/woocommerce/woocommerce/master/sample-data/sample_products.xml
    wp --allow-root import /sample_products.xml --quiet --authors=create --skip=image_resize

    echo -e "Setup Complete! You can access the instance at: ${URL}"

    touch /setup_complete

    if [ $PRECONFIGURE ]; then
        echo -e "Prepare for Pre-Configured build"
        unlink /opt/bitnami/wordpress/wp-config.php
        unlink /opt/bitnami/wordpress/wp-content
        mkdir /opt/bitnami/wordpress/wp-content
        cp -rfLH /bitnami/wordpress/wp-content/* /opt/bitnami/wordpress/wp-content/
        cp -rfLH /bitnami/wordpress/* /opt/bitnami/wordpress/
        touch /opt/bitnami/wordpress/.initialized

        kill 1
    else
        # Keep script Running
        trap : TERM INT; (while true; do sleep 1m; done) & wait
    fi

else
    rm -rf /bitnami/wordpress
    ln -s /opt/bitnami/wordpress /bitnami/wordpress
    chown -R bitnami:daemon /opt/bitnami/wordpress
    chown -R bitnami:daemon /bitnami/wordpress
    wp --allow-root cache flush

    # Keep script Running
    trap : TERM INT; (while true; do sleep 1m; done) & wait
fi
