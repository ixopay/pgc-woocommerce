**Warning!** This docker image is dedicated for demo usage, we don't recommended to use it in production.

---

# USAGE

To quickly spawn a Woocommerce test shop with a plugin tagged at our github.com repository:

```
 REPOSITORY="https://github.com/ixopay/pgc-woocommerce" \
 BRANCH="master" \
 URL="http://localhost" \
 WORDPRESS_USERNAME=dev \
 WORDPRESS_PASSWORD=dev \
  docker-compose -f docker-compose.github.yml up --build --force-recreate --renew-anon-volumes
```

To develop and test plugin changes, you can run the following docker-compose command from the plugin root directory, to start a Woocommerce shop &
initialize a database with a bind mounted version of the plugin. The shop will be accessible via: `http://localhost/wp-admin`.

```
 BITNAMI_IMAGE_VERSION=latest \
 URL="http://localhost" \
 WORDPRESS_USERNAME=dev \
 WORDPRESS_PASSWORD=dev \
  docker-compose up --build --force-recreate --renew-anon-volumes
```

By running the command we always run a complete `--build` for the shop container, `--force-recreate` to delete previous containers  and always delete
the previous instance's storage volumes via `--renew-anon-volumes`. We currently use Bitnami Docker images as base for the environment and add our plugin.
Further environment variables can be set, please take a look at `docker/Dockerfile` for a complete list.

## Platform credentials

To successfully test a payment flow you will need merchant credentials for the payment platform and set them via the following environment variables:

```
 SHOP_PGC_URL="https://sandbox.paymentgateway.cloud"
 SHOP_PGC_USER="test-user"
 SHOP_PGC_PASSWORD="test-pass"
 SHOP_PGC_API_KEY="key"
 SHOP_PGC_SECRET="secret"
 SHOP_PGC_INTEGRATION_KEY="int-key"
 SHOP_PGC_CC_AMEX="True"
 SHOP_PGC_CC_DINERS="True"
 SHOP_PGC_CC_DISCOVER="True"
 SHOP_PGC_CC_JCB="True"
 SHOP_PGC_CC_MAESTRO="True"
 SHOP_PGC_CC_MASTERCARD="True"
 SHOP_PGC_CC_UNIOPNPAY="True"
 SHOP_PGC_CC_VISA="True"
 SHOP_PGC_CC_TYPE="debit"
 SHOP_PGC_CC_TYPE_AMEX="debit"
 SHOP_PGC_CC_TYPE_DINERS="debit"
 SHOP_PGC_CC_TYPE_DISCOVER="debit"
 SHOP_PGC_CC_TYPE_JCB="debit"
 SHOP_PGC_CC_TYPE_MAESTRO="debit"
 SHOP_PGC_CC_TYPE_MASTERCARD="debit"
 SHOP_PGC_CC_TYPE_UNIOPNPAY="debit"
 SHOP_PGC_CC_TYPE_VISA="debit"
```