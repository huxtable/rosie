#!/usr/bin/env bash

# Update apt sources
sudo apt-get update -y

# Data directories
sudo mkdir /var/opt/rosie
sudo chown -R vagrant /var/opt/rosie
sudo chgrp -R vagrant /var/opt/rosie

# Link generator to path as 'rosie'
sudo ln -s /vagrant/bin/rosie /usr/local/bin/rosie

# Install dependencies
sudo apt-get install php5-cli -y
sudo apt-get install php5-curl -y
sudo apt-get install php5-imagick -y
