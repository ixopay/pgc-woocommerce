# Docker demo & development environment

We supply ready to use Docker environments for plugin development & testing.

- `docker-compose.yml` Setup Wordpress instance and configure Pgc Extension (Testing)
- `docker-compose.dev.yml` Setup Wordpress instance with Pgc Extension, but without Configuration (Development)

**Warning!** This docker image is dedicated for development & demo usage, we don't recommended to use it in production.

---

## Usage

Run Development Environment
```
docker-compose -f docker-compose.dev.yml up --force-recreate --renew-anon-volumes

# Reload Extension Source Code in Wordpress:
docker-compose -f docker-compose.dev.yml exec wordpress wp --allow-root plugin update paymentgatewaycloud
```

Run Test Environment
```
docker-compose up --force-recreate --renew-anon-volumes
```


## Configuration

Settings can be supplied as Environment Variables inside the docker-compose file.


| Value                    |           Default            |                       Description                       |
| ------------------------ |:----------------------------:|:-------------------------------------------------------:|
| HTTPS                    |            false             |                  Enable/Disable HTTPS                   |
| REPOSITORY               | https://github.com/user/repo | URL to the Repo where your branded Extension is located |
| BRANCH                   |            master            |        Which Branch to checkout from REPOSITORY         |
| WHITELABEL               |          AwesomePay          |                  Whitelabel Extension                   |
| URL                      |          localhost           |                     Default Hostname                    |
| WORDPRESS_EMAIL          |       user@example.com       |                   Default Admin Email                   |
| WORDPRESS_USERNAME       |             user             |                 Default Admin Username                  |
| WORDPRESS_PASSWORD       |           bitnami            |                 Default Admin Password                  |
| DEMO_CUSTOMER_USER       |           customer           |                  Default User Username                  |
| DEMO_CUSTOMER_PASSWORD   |           customer           |                  Default User Password                  |
| WORDPRESS_BLOG_NAME      |          Demo Shop           |                   Default Shop name                     |
| SHOP_ADDRESS             |      Shoppingstreet 123      |                  Default Shop Address                   |
| SHOP_DEMO                |             yes              |     Wheter this is a Demo shop (yes) or not (no)        |
| SHOP_CURRENCY            |             EUR              |                  Default Currency to use                |
| SHOP_COUNTRY             |            AT:*              |                    Default Country                      |
| SHOP_ZIP                 |            1000              |                   Default ZIP code                      |
| SHOP_CITY                |            Wien              |                   Default City name                     |
| SHOP_PGC_URL             |           sandbox            |                 URL to your Gateway API                 |
| SHOP_PGC_USER            |          test-user           |                    Your Gateway User                    |
| SHOP_PGC_PASSWORD        |          test-pass           |               Your Gateway User Password                |
| SHOP_PGC_API_KEY         |             key              |                  Your Gateway API-Key                   |
| SHOP_PGC_SECRET          |            secret            |                 Your Gateway API-Secret                 |
| SHOP_PGC_INTEGRATION_KEY |           int_key            |              Your Gateway Integration Key               |
| SHOP_PGC_SEAMLESS        |              1               |      Whether to Enable (1) or Disable (0) Seamless      |


### You can also Configure seperate CC Brands with


| Value                        | Default |                   Description                   |
| ---------------------------- |:-------:|:-----------------------------------------------:|
| SHOP_PGC_CC_<BRAND>          |    1    |    Enable (True) or Disable (False) CC Brand    |
| SHOP_PGC_CC_TYPE_<BRAND>     |  debit  |              debit / preauthorize               |


#### Available Brands are:

- VISA
- MAESTRO
- AMEX
- DINERS
- DISCOVER
- JCB
- MASTERCARD
- UNIONPAY

## Default Credentials:

### User / Customer

> **Login:** customer
>
> **Password:** customer

### Admin

> **Login:** user
>
> **Password:** bitnami
