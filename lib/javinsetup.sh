#!/bin/bash

#This is a migration script meant for the APP server

#Update refs
sudo apt update -y
#Upgrade packages
sudo apt upgrade -y

#install apache2
sudo apt install -y apache2 apache2-utils

#make sure apache2 is started
sudo systemctl start apache2

#enable apache2 on bt
sudo systemctl enable apache2

#enable config file
#sudo a2enconf servername.conf

#reload apache2
sudo systemctl reload apache2

#install composer
sudo apt install composer

#install php
sudo apt install php-mbstring -y

#install php-bcmath
sudo apt install php-bcmath -y

#install php and required libs
sudo apt install -y php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline

#install php fpm
sudo apt install php7.4-fpm

#make a new directory to replace the default apache servable directory
sudo mkdir /home/ubuntu/public_html

#change file permissions
sudo chmod -R ubuntu:www-data /home/ubuntu/public_html

#change ownership
sudo chown -R ubuntu:www-data /home/ubuntu/public_html

#enable user directory
sudo a2enmod userdir

#one file needs to be manually edited to allow userdir to be servable
sudo nano /etc/apache2/mods-enabled/php7.4.conf
#turn userdir engine On from Off
