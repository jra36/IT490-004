#!/bin/bash

# Check if running as root  
if [ "$(id -u)" != "0" ]; then  
echo "This script must be run as root" 1>&2  
exit 1  
fi  

#Update refs
sudo apt update -y
#Upgrade packages
sudo apt upgrade -y

#Install the necessary packages for API VM
sudo apt install -y php7.4 php7.4-cli php-mbstring php-bcmath composer
