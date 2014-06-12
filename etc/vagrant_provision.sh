#!/bin/bash
apt-get update -q
export DEBIAN_FRONTEND=noninteractive

## Aquarion's piece of mind setup

apt-get install -q -y vim curl

## Apache Setup
apt-get install -q -y apache2 libapache2-mod-php5 php5-json php5-xdebug php5-mysqlnd
a2enmod rewrite
ln -fs /vagrant /var/www/mimir
ln -s /vagrant/etc/apache_dev.conf /etc/apache2/sites-available/mimir
a2ensite mimir
a2dissite default
service apache2 restart

## Mysql Setup 
#debconf-set-selections <<< 'mysql-server mysql-server/root_password password $PASSWORD'
#debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password $PASSWORD'

export PASSWORD=asl33p
apt-get install -q -y mysql-server-5.5 mysql-client-5.5
mysqladmin -u root password $PASSWORD
echo "create database mimir;" | mysql -uroot -p$PASSWORD
echo "grant all on mimir.* to webapp@localhost identified by 'webapp'" | mysql -uroot -p$PASSWORD

cat /vagrant/doc/schema.sql | mysql -uwebapp -pwebapp mimir