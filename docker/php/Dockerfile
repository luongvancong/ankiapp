FROM php:7.2.5-apache
RUN apt-get update
RUN apt-get install -y libmcrypt-dev
RUN apt-get install zip unzip
RUN apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
	&& docker-php-ext-install -j$(nproc) iconv \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install exif
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install ctype
#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get install -y git
RUN apt-get install -y libapache2-mod-wsgi
RUN apt-get update
RUN apt-get install -y python-pip
RUN a2enmod rewrite
RUN a2enmod headers
RUN service apache2 restart
