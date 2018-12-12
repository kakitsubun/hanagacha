FROM php:7.1-fpm

RUN cp /etc/apt/sources.list /etc/apt/sources.list.bak \ 
	&& apt-get update \ 
	&& apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev

RUN docker-php-ext-install -j$(nproc) iconv mcrypt \
    	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    	&& docker-php-ext-install -j$(nproc) gd \
   	&& docker-php-ext-install pdo_mysql \
   	&& docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com