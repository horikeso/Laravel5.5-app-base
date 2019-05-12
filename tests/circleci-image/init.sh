#!/usr/bin/env bash

set -ex

yum -y upgrade
yum -y groupinstall 'Base' 'Development Libraries' 'Development Tools' 'Editors'
yum -y install sudo wget git zip unzip

# add locale

localedef -f UTF-8 -i ja_JP ja_JP.utf8

# set locale

sed -i -e 's/.*/LANG=ja_JP.utf8/' /etc/locale.conf

# timezone

mv /etc/localtime /etc/localtime.origin
cp -f /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# PHP

rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
yum -y install --enablerepo=remi,remi-php72 php php-devel php-mbstring php-pdo php-gd php-mcrypt php-fpm php-mysqlnd php-opcache php-apcu php-xml php-tokenizer php-openssl php-pear php-zip
PHPINI_PATH=/etc/php.ini
cp ${PHPINI_PATH} ${PHPINI_PATH}.origin
sed -i -e 's/expose_php = On/expose_php = Off/g' -e 's/memory_limit = 128M/memory_limit = 512M/g' -e 's|;date.timezone =|date.timezone = "Asia/Tokyo"|g' ${PHPINI_PATH}

# memcached

yum -y install memcached

wget https://launchpad.net/libmemcached/1.0/1.0.18/+download/libmemcached-1.0.18.tar.gz
tar xvf libmemcached-1.0.18.tar.gz
cd libmemcached-1.0.18
./configure
make
make install
cd ../

wget http://pecl.php.net/get/memcached-3.0.3.tgz
tar xvf memcached-3.0.3.tgz
yum -y install autoconf
yum -y install zlib-devel
cd memcached-3.0.3
phpize
./configure --with-libmemcached-dir=/usr/local/ --disable-memcached-sasl
make
make install
cd ../

sed -i -e 's/MAXCONN="1024"/MAXCONN="65535"/' -e 's/CACHESIZE="64"/CACHESIZE="512"/' /etc/sysconfig/memcached

# composer

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

systemctl enable memcached
