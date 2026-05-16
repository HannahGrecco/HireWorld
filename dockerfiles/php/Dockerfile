FROM php:8.3-cli-alpine

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

RUN npm install
RUN npm run build

RUN php artisan optimize:clear

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
