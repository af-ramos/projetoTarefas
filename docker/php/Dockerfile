FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl libpq-dev libzip-dev zip unzip libxml2-dev libonig-dev \
    libpng-dev libjpeg-dev libfreetype6-dev libmcrypt-dev libssl-dev \
    libcurl4-openssl-dev pkg-config libmagickwand-dev libicu-dev \
    gnupg libxslt-dev libgmp-dev supervisor
RUN pecl install redis mongodb > /dev/null 2>&1
RUN docker-php-ext-install pdo pdo_pgsql pgsql zip mbstring exif pcntl bcmath gd intl xsl gmp > /dev/null 2>&1 \
    && docker-php-ext-enable redis mongodb > /dev/null 2>&1

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG UID=1000
ARG GID=1000

RUN groupadd -g $GID senior && \
    useradd -u $UID -g senior -m -s /bin/bash senior

WORKDIR /var/www/senior-hcosta
USER senior

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/supervisord.conf"]
