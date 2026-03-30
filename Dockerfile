FROM dunglas/frankenphp

COPY . /app

RUN install-php-extensions pcntl \
    pdo_mysql \
    zip
RUN apt update
RUN apt install mariadb-client -y

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
