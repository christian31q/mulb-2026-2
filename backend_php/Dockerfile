FROM php:8.2-cli

RUN docker-php-ext-install mysqli pdo_pgsql pgsql

WORKDIR /app
COPY . .

EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t api"]



