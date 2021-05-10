if [ "$(id -u)" != "0" ]; then  
echo "This script must be run as root" 1>&2  
exit 1  
fi  

#Update refs
sudo apt update -y

#Upgrade packages
sudo apt upgrade -y

#install composer
sudo apt install -y composer

#install bc-math
sudo apt install -y php-bcmath

#install php and required libs
sudo apt install -y php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline

#install php fpm
sudo apt install php7.4-fpm

#install mysql
sudo apt-get install -y mysql-server
