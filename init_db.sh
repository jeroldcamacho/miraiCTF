#!/bin/bash
/usr/bin/mysqld_safe --skip-grant-tables &
sleep 5
mysql -u root -e "CREATE DATABASE sqli"
mysql -u root sqli < /tmp/8d0c6dd264153f8fe15d584e050f2f00.sql