FROM debian:9.3

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
    mysql-common \
    mysql-server \
    sudo \
    wget \
    git \
    apache2 \
    php \
    nano \
    vim \
    && \
    apt-get clean

COPY index.php /var/www/html/index.php
COPY files/backup.sql /tmp/backup.sql
COPY xss /var/www/html/xss
COPY files/md5 /var/www/html/md5
COPY files/back_me_up/ /var/www/html/back_me_up
COPY files/lfi/ /var/www/html/lfi
COPY files/command_injection/ /var/www/html/command_injection
COPY files/sqli/ /var/www/html/sqli
COPY files/logic1/ /var/www/html/logic1
COPY files/logic2/ /var/www/html/logic2

RUN /etc/init.d/mysql start
ADD init_db.sh /tmp/init_db.sh
RUN sudo bash /tmp/init_db.sh

RUN chown www-data:www-data -R /var/www/html && \
    rm /var/www/html/index.html

COPY run.sh /
RUN chmod +x /run.sh
ENTRYPOINT ["/run.sh"]
