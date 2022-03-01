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
COPY 8d0c6dd264153f8fe15d584e050f2f00.sql /tmp/8d0c6dd264153f8fe15d584e050f2f00.sql
COPY 4f33eccad3ab1e772e7f32ff0514cfe0 /var/www/html/4f33eccad3ab1e772e7f32ff0514cfe0
COPY 08eef57312ecf3117e9f3896e166a72e /var/www/html/08eef57312ecf3117e9f3896e166a72e
COPY 97636d24b36f03e782210fcd7afa3de1 /var/www/html/97636d24b36f03e782210fcd7afa3de1
COPY af467cf24a2be4144a3c166a07004c58 /var/www/html/af467cf24a2be4144a3c166a07004c58
COPY dc633aa2cdf5eba7c495bee55c050953 /var/www/html/dc633aa2cdf5eba7c495bee55c050953
COPY b44807062df88c07f51eedf2538ff043 /var/www/html/b44807062df88c07f51eedf2538ff043

RUN /etc/init.d/mysql start
ADD init_db.sh /tmp/init_db.sh
RUN sudo bash /tmp/init_db.sh

RUN chown www-data:www-data -R /var/www/html && \
    rm /var/www/html/index.html

COPY run.sh /
RUN chmod +x /run.sh
ENTRYPOINT ["/run.sh"]
