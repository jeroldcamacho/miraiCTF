#!/bin/bash
/usr/bin/mysqld_safe --skip-grant-tables &
sleep 5
mysql -u root -e "CREATE DATABASE sqli"
mysql -u root sqli < /tmp/backup.sql
