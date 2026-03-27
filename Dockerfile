FROM dunglas/frankenphp

COPY . /app

RUN install-php-extensions pcntl \
    pdo_mysql

ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
