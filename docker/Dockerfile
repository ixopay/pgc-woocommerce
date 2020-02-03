FROM bitnami/wordpress:5

EXPOSE 80

VOLUME /bitnami
VOLUME /source
VOLUME /dist

ENV ALLOW_EMPTY_PASSWORD="yes" \
    BITNAMI_APP_NAME="wordpress" \
    BITNAMI_IMAGE_VERSION="5.3.0-debian-9-r17" \
    MARIADB_HOST="mariadb" \
    MARIADB_PORT_NUMBER="3306" \
    MARIADB_ROOT_PASSWORD="" \
    MARIADB_ROOT_USER="root" \
    MYSQL_CLIENT_CREATE_DATABASE_NAME="" \
    MYSQL_CLIENT_CREATE_DATABASE_PASSWORD="" \
    MYSQL_CLIENT_CREATE_DATABASE_PRIVILEGES="ALL" \
    MYSQL_CLIENT_CREATE_DATABASE_USER="" \
    PATH="/opt/bitnami/apache/bin:/opt/bitnami/php/bin:/opt/bitnami/php/sbin:/opt/bitnami/wp-cli/bin:/opt/bitnami/mysql/bin:$PATH" \
    SMTP_HOST="" \
    SMTP_PASSWORD="" \
    SMTP_PORT="" \
    SMTP_PROTOCOL="" \
    SMTP_USER="" \
    SMTP_USERNAME="" \
    WORDPRESS_BLOG_NAME="User's Blog!" \
    WORDPRESS_DATABASE_NAME="bitnami_wordpress" \
    WORDPRESS_DATABASE_PASSWORD="" \
    WORDPRESS_DATABASE_SSL_CA_FILE="" \
    WORDPRESS_DATABASE_USER="bn_wordpress" \
    WORDPRESS_EMAIL="user@example.com" \
    WORDPRESS_FIRST_NAME="FirstName" \
    WORDPRESS_HTACCESS_OVERRIDE_NONE="yes" \
    WORDPRESS_HTTPS_PORT="443" \
    WORDPRESS_HTTP_PORT="80" \
    WORDPRESS_LAST_NAME="LastName" \
    WORDPRESS_PASSWORD="bitnami" \
    WORDPRESS_SCHEME="http" \
    WORDPRESS_SKIP_INSTALL="no" \
    WORDPRESS_TABLE_PREFIX="wp_" \
    WORDPRESS_USERNAME="user" \
    PRECONFIGURE="" \
    SHOP_ADDRESS="Shoppingstreet 123" \
    SHOP_DEMO="yes" \
    SHOP_CURRENCY="EUR" \
    SHOP_COUNTRY="AT:*" \
    SHOP_ZIP="1000" \
    SHOP_CITY="Wien" \
    SHOP_PGC_URL="sandbox" \
    SHOP_PGC_USER="test-user" \
    SHOP_PGC_PASSWORD="test-pass" \
    SHOP_PGC_API_KEY="key" \
    SHOP_PGC_SECRET="secret" \
    SHOP_PGC_INTEGRATION_KEY="int_key" \
    SHOP_PGC_CC_AMEX="True" \
    SHOP_PGC_CC_DINERS="True" \
    SHOP_PGC_CC_DISCOVER="True" \
    SHOP_PGC_CC_JCB="True" \
    SHOP_PGC_CC_MAESTRO="True" \
    SHOP_PGC_CC_MASTERCARD="True" \
    SHOP_PGC_CC_UNIOPNPAY="True" \
    SHOP_PGC_CC_VISA="True" \
    SHOP_PGC_CC_TYPE="debit" \
    SHOP_PGC_CC_TYPE_AMEX="debit" \
    SHOP_PGC_CC_TYPE_DINERS="debit" \
    SHOP_PGC_CC_TYPE_DISCOVER="debit" \
    SHOP_PGC_CC_TYPE_JCB="debit" \
    SHOP_PGC_CC_TYPE_MAESTRO="debit" \
    SHOP_PGC_CC_TYPE_MASTERCARD="debit" \
    SHOP_PGC_CC_TYPE_UNIOPNPAY="debit" \
    SHOP_PGC_CC_TYPE_VISA="debit" \
    URL="http://localhost" \
    REPOSITORY="https://github.com/user/repo" \
    BRANCH="master" \
    BUILD_ARTIFACT="undefined"

RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip \
  vim \
  && apt-get autoclean

COPY wp_config.php /bitnami/wordpress/wp-config.php
COPY start.sh /start.sh

ENTRYPOINT ["/start.sh"]
