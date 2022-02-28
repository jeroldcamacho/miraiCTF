FROM debian:9.3

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
    apache2 \
    php \
    nano \
    && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY index.php /var/www/html/index.php
COPY auth.php /var/www/html/login.php
COPY auth.php /var/www/html/auth.php
COPY auth.php /var/www/html/conn.php

RUN chown www-data:www-data -R /var/www/html && \
    rm /var/www/html/index.html

EXPOSE 2222

COPY main.sh /
ENTRYPOINT ["/main.sh"]