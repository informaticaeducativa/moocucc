FROM php:7.2
RUN apt-get update -y && apt-get install -y openssl zip unzip git libmcrypt-dev zlib1g-dev libxml2-dev libpng-dev
RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install mbstring
#RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install zip
RUN docker-php-ext-install xml
RUN docker-php-ext-install gd
RUN docker-php-ext-install exif
RUN docker-php-ext-install bcmath

WORKDIR /app
COPY . /app
RUN composer dumpautoload
#RUN composer update
RUN composer install
RUN composer require tomgrohl/laravel4-php71-encrypter

CMD php artisan serve --host=0.0.0.0 --port=8181
EXPOSE 8181
