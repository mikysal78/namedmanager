# BindManager

## Project Homepage
Questo è un fork di [NamedManager](https://github.com/jethrocarr/namedmanager).

For more information including source code, issue tracker and documentation
visit the original [wiki](https://github.com/jethrocarr/namedmanager/wiki)


# Installing 

Install playbook ansible-general-services (webserver) or Apache2, php5, MariaDB


## 1. Getting code from Git 

~~~
cd /opt/
git clone git@github.com:mikysal78/namedmanager.git
cd namedmanager/
~~~


## 2. Install the MySQL database

~~~
$ mysql ­-u root ­< sql/install.sql
~~~


## 3. Write the web interface configuration file

~~~
mkdir /etc/namedmanager/
cp htdocs/include/sample-config.php /etc/namedmanager/config.php
ln -s /etc/namedmanager/config.php $PWD/htdocs/include/config-settings.php
~~~

## 4. Enable SSL and interfaces

~~~
cp resources/namedmanager-httpdconfig.conf /etc/apache2/conf-available/
ln -s /etc/apache2/conf-available/namedmanager-httpdconfig.conf /etc/apache2/conf-enabled/namedmanager-httpdconfig.conf
a2ensite default-ssl
service apache2 restart
~~~


## 5. Install Web Interface Cronjob

Some background cronjobs are used for performing tasks such as replicating to cloud providers. This requires the cron.d configuration file be installed
~~~
cp resources/namedmanager-www.cron /etc/cron.d/namedmanager-www
~~~
You may need to edit this file and adjust the assumed paths.

You also need to create a directory for the logs:
~~~
mkdir /var/log/namedmanager
chown www-data:www-data /var/log/namedmanager
~~~

## 6. Install Bind9 and configuring with namedmanager

~~~
apt-get -y install bind9
cp -R bind/* /etc/bind/
cp bind/include/sample-config.php /etc/namedmanager/config-bind.php
ln -s /etc/namedmanager/config-bind.php $PWD/bind/include/config-settings.php
ln -s /etc/namedmanager/config-bind.php /etc/bind/include/config-settings.php
~~~

## 6.1 Install Contab

~~~
cp resources/namedmanager-bind.cron /etc/cron.d/namedmanager-bind
~~~

## 6.2 Install bootscript

~~~
cp resources/namedmanager_logpush.rcsysinit /etc/init.d/namedmanager_logpush
chmod +x /etc/init.d/namedmanager_logpush
cp resources/namedmanager-logpush.service /lib/systemd/system/namedmanager-logpush.service
ln -s /lib/systemd/system/namedmanager-logpush.service /etc/systemd/system/namedmanager-logpush.service
systemctl enable namedmanager-logpush
~~~


## 7. Login and setup the name servers.

Before you can configure any domain names and records, it's necessary to login to the web interface and configure your name servers.

NamedManager requires all the name servers to have an entry in NamedManager - this information is used to generate NS records for all the domains, as well as being where the API keys are set to allow the name servers to connect to NamedManager for pulling configuration.

The default login is username "admin", password "ninux". If the default Apache configuration is installed, the application should be available at https://localhost/namedmanager.


## 8. (optional) Configure Route53 Integration

If planning to use the Amazon AWS Route53 integration, read [Installation-Integration-Route53] (https://github.com/jethrocarr/namedmanager/wiki/Installation-Integration-Route53) for instructions on configuration.


## 9. Begin Adding Zones

You can now begin adding DNS zones - by importing existing Bind zonefiles, generating reverse zones or manual entry of records into the web interface.

Use the application configuration panel to set defaults such as SOA contact and expiry times for your domains.
