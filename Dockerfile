FROM php:5.6-apache


# Install some packages
RUN apt-get update && apt-get install -y \
        curl \
        apt-transport-https \
        lsb-release \
        vim \
        libicu-dev \
		zlib1g-dev \
		git \
        software-properties-common

# Add mongoDb client
RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 7F0CEB10
RUN echo "deb http://repo.mongodb.org/apt/ubuntu trusty/mongodb-org/3.0 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.0.list
RUN apt-get update && apt-get install -y mongodb-clients php5-mongo

# Add apache module required by the app
RUN a2enmod rewrite

# Add support for mysql
RUN docker-php-ext-install intl mbstring opcache pdo zip

# Set dev php.ini file
COPY scripts/php.ini /usr/local/etc/php/php.ini

# Script
RUN mkdir /docker
COPY scripts /docker

# Include the app code in apache directory
COPY . /var/www/html/
#VOLUME ["/var/www/html/"]

# Add apache conflicts
ADD scripts/000-default.conf /etc/apache2/sites-available/
RUN a2ensite 000-default

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Set read/write
RUN rm -rf app/cache/*
RUN rm -rf app/logs/*

RUN usermod -u 1000 www-data

CMD ["python", "/docker/start.py"]
