# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "ubuntu/precise32"

  config.vm.hostname = "klein-box"

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network "forwarded_port", guest: 80, host: 8080

  # Enable provisioning with custom hackish shell script
  config.vm.provision "shell", inline: <<-SHELL
    apt-get update
    locale-gen en_US.UTF-8
    update-locale LC_ALL=en_US.UTF-8 LANG=en_US.UTF-8 LC_MESSAGES=POSIX
    apt-get -y install curl screen git tree apache2
    echo ServerName $HOSTNAME >> /etc/apache2/apache2.conf
    a2enmod rewrite
    service apache2 restart
    apt-get -y install libapache2-mod-php5 php5-curl php5-mcrypt
    MYSQL_ROOT_PASSWORD="secret"
    debconf-set-selections <<< "mysql-server mysql-server/root_password password $MYSQL_ROOT_PASSWORD"
    debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $MYSQL_ROOT_PASSWORD"
    apt-get -y install mysql-server libapache2-mod-auth-mysql php5-mysql
    cat > /etc/apache2/sites-available/vagrant-default <<EOL
<VirtualHost *:80>
  ServerAdmin webmaster@localhost
  DocumentRoot /vagrant/htdocs
  <Directory />
    Options FollowSymLinks
    AllowOverride None
  </Directory>
  <Directory /vagrant/htdocs/>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Order allow,deny
    allow from all
  </Directory>
</VirtualHost>
EOL
    a2dissite default
    a2ensite vagrant-default
    service apache2 reload
    mysql -uroot -p"$MYSQL_ROOT_PASSWORD" -e 'CREATE DATABASE klein_php_example'
    mysql -uroot -p"$MYSQL_ROOT_PASSWORD" klein_php_example -e "CREATE TABLE textFiles (id VARCHAR(128) PRIMARY KEY, name VARCHAR(64) NOT NULL, content TEXT, type VARCHAR(8) DEFAULT 'txt', visibleOnlyWithLink TINYINT(1) UNSIGNED DEFAULT 0, createdAt DATETIME, validUntil DATETIME DEFAULT '9999-12-31 23:59:59')"
  SHELL
  config.vm.provision "shell", privileged: false, inline: <<-SHELL
    cd /vagrant
    bash download-libraries.sh
  SHELL
end
