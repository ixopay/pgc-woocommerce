FROM bitnami/wordpress:5

EXPOSE 8080
EXPOSE 8443

VOLUME /bitnami
VOLUME /source
VOLUME /dist

ENV PRECONFIGURE="" \
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
    SHOP_PGC_CC_UNIONPAY="True" \
    SHOP_PGC_CC_VISA="True" \
    SHOP_PGC_CC_TYPE="debit" \
    SHOP_PGC_CC_TYPE_AMEX="debit" \
    SHOP_PGC_CC_TYPE_DINERS="debit" \
    SHOP_PGC_CC_TYPE_DISCOVER="debit" \
    SHOP_PGC_CC_TYPE_JCB="debit" \
    SHOP_PGC_CC_TYPE_MAESTRO="debit" \
    SHOP_PGC_CC_TYPE_MASTERCARD="debit" \
    SHOP_PGC_CC_TYPE_UNIONPAY="debit" \
    SHOP_PGC_CC_TYPE_VISA="debit" \
    DEMO_CUSTOMER_USER="customer" \
    DEMO_CUSTOMER_PASSWORD="customer" \
    URL="localhost" \
    REPOSITORY="https://github.com/user/repo" \
    BRANCH="master" \
    WHITELABEL="" \
    BUILD_ARTIFACT="undefined"

USER root

RUN sed -i "s/Listen 80/Listen 8085/g" /opt/bitnami/apache/conf/httpd.conf
RUN sed -i "s/Listen 443/Listen 8086/g" /opt/bitnami/apache/conf/httpd.conf

RUN apt-get update && apt-get install --no-install-recommends -y \
  git \
  zip \
  unzip \
  vim-tiny \
  && apt-get autoclean

USER 1001

COPY start.sh /start.sh
COPY whitelabel_vars.php /whitelabel.php

ENTRYPOINT ["/start.sh"]
