#!/usr/bin/env bash
set -euo pipefail

error_exit() {
    echo "$1" 1>&2
    exit 1
}

link_folders() {
  find $1/ -maxdepth 1 -mindepth 1 -type d -printf '%f\n' | xargs -L1 -I{} ln -s "$1/{}" "$2/{}" || error_exit "Failed to link source code";
}

echo -e "Removing inactive plugins"

wp --allow-root plugin delete --quiet $(wp --allow-root plugin list --status=inactive --field=name) || error_exit "Could not remove Wordpress Extensions"

echo -e "Installing WooCommerce"

wp --allow-root plugin install --quiet wordpress-importer --activate || error_exit "Could not install wordpress-importer"
wp --allow-root plugin install --quiet woocommerce-admin || error_exit "Could not install Woocommerce-admin"
wp --allow-root plugin install --quiet woocommerce || error_exit "Could not install Woocommerce"
wp --allow-root plugin activate woocommerce || error_exit "Could not activate Woocommerce"
wp --allow-root plugin activate woocommerce-admin || error_exit "Could not activate Woocommerce-admin"

SRC_PATH="/source_code/src"

echo "Linking Source to Extension folder"

ln -s "$SRC_PATH" "/opt/bitnami/wordpress/wp-content/plugins/paymentgatewaycloud"

echo "Activate Extension"

wp --allow-root plugin activate paymentgatewaycloud || error_exit "Could not activate PGC Extension"

