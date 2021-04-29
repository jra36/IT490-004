if [ "$(id -u)" != "0" ]; then  
echo "This script must be run as root" 1>&2  
exit 1  
fi  
function generatePassword()
 {
    echo "$(openssl rand -base64 12)"
 }

#Update refs
sudo apt update -y
#Upgrade packages
sudo apt upgrade -y

sudo swapoff -a
#You may adjust this as necessary, 1G is fine, I upped it to 2G
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
sudo sysctl vm.swappiness=10

#enable config file
sudo a2enconf servername.conf

#install composer
sudo apt install -y composer 

#install php and required libs
sudo apt install -y php7.4 libapache2-mod-php7.4 php7.4-mysql php-common php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline

#install php fpm
sudo apt install php7.4-fpm

#enable modules
sudo a2enmod proxy_fcgi setenvif

#enable user directory
sudo a2enmod userdir
db_root_password=$(generatePassword)

#install mysql
export DEBIAN_FRONTEND="noninteractive"  
debconf-set-selections <<< "mysql-server mysql-server/root_password password $db_root_password"  
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $db_root_password"
sudo apt-get install -y mysql-server

#function modified from https://stackoverflow.com/a/44343801
function createMysqlDbUser()
{
   SQL1="CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
   SQL2="CREATE USER '${DB_USER}'@'%' IDENTIFIED BY '${DB_PASS}';"
   SQL3="GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'%';"
   SQL4="FLUSH PRIVILEGES;"

   if [ -f /root/.my.cnf ]; then
       $BIN_MYSQL -e "${SQL1}${SQL2}${SQL3}${SQL4}"
   else
       # If /root/.my.cnf doesn't exist then it'll ask for root password
       #_arrow "Please enter root user MySQL password!"
       #read rootPassword
       $BIN_MYSQL -h $DB_HOST -u root -p$db_root_password -e "${SQL1}${SQL2}${SQL3}${SQL4}"
   fi
}
 
# Find or Get user to assign to www-data group 
echo "Fetching non-root user"
user=$(w -shf)
IFS=' '
read -a details <<< "$user"
sshuser=${details[0]}
echo "Found user: $sshuser"
read -p "Is this user correct? [Y / desired username]: " answer
if [[ "$answer" =~ ^([yY][eE][sS]|[yY])$ ]]
then
   echo "Using fetched user"
else
   sshuser=$answer
   echo "Using given user $sshuser"
fi
 
#setup mysql vars
BIN_MYSQL=$(which mysql)

DB_HOST='localhost'
DB_NAME=$sshuser
DB_USER=$testUser
DB_PASS=$(generatePassword)
 

createMysqlDbUser
 
CON_STRING="mysql://$DB_USER:$DB_PASS@$DB_HOST:3306/$DB_NAME";
echo "#DO NOT COMMIT TO REPOSITORY, DO NOT MAKE THIS PUBLIC" > /home/$sshuser/config.ini
echo "MYSQL_CONNECTION=$CON_STRING" >> /home/$sshuser/config.ini
sudo chmod 644 /home/$sshuser/config.ini
 
sudo mkdir /home/$sshuser/.emergency
sudo chmod 600 /home/$sshuser/.emergency
echo "DBR: $db_root_password" > /home/$sshuser/.emergency/.privatecreds
echo "DBUU: $DB_USER" >> /home/$sshuser/.emergency/.privatecreds
echo "DBUP: $DB_PASS" >> /home/$sshuser/.emergency/.privatecreds
sudo chmod 600 /home/$sshuser/.emergency/.privatecreds
 
#setup local dir
sudo mkdir /home/$sshuser/public_html
sudo chmod -R 755 /home/$sshuser/public_html
sudo chown -R $sshuser:www-data /home/$sshuser/public_html
 
 
sudo apt install wget -y

#tuning mysql for low mem environment
wget https://raw.githubusercontent.com/MattToegel/IT202/VMSetup/my.cnf
sudo mv /etc/mysql/my.cnf /etc/mysql/my.cnf.backup
sudo cat my.cnf > /etc/mysql/my.cnf

sudo systemctl restart mysql

debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $DB_PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $DB_PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $DB_PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt install -y phpmyadmin

sudo apt install -y git nano
