FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    nodejs \
    npm \
    git \
    zip \
    unzip

RUN docker-php-ext-install \
    gd \
    zip \
    pdo \
    pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

EXPOSE 9000

CMD ["php-fpm"]
