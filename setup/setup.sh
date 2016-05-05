#!/bin/bash

sudo apt-get update

# install lamp server
sudo apt-get install apache2
sudo apt-get install php5 libapache2-mod-php5
sudo apt-get install mysql-server

sudo cp expensemanager.com.conf /etc/apache2/sites-available/

sudo mv /etc/hosts /etc/hosts.backup
sudo cp hosts /etc/hosts

sudo /etc/init.d/apache2 restart

# Check if website is opening
echo "Opening expensemanager.com on google chrome"
google-chrome expensemanager.com
