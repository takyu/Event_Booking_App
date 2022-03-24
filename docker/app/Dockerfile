FROM php:8.1.2-fpm

#
# multi stage build
#

# composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# nodejs
COPY --from=node /usr/local/bin /usr/local/bin
COPY --from=node /usr/local/lib /usr/local/lib

RUN apt-get update \
	&& apt-get -y install \
	git \
	zip \
	unzip \
	vim \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-install pdo_mysql bcmath \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug

# Current directory (Command: docker-compose exec app bash)
WORKDIR /var/www/html
