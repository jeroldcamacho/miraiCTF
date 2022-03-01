FROM debian:9.3

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
    apache2 \
    php \
    nano \
    vim \
    && \
    apt-get clean

COPY index.php /var/www/html/index.php

RUN chown www-data:www-data -R /var/www/html && \
    rm /var/www/html/index.html

EXPOSE 1111

COPY main.sh /
ENTRYPOINT ["/main.sh"]