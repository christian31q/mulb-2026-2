FROM php:8.2-cli

RUN apt-get update \
  && apt-get install -y --no-install-recommends libpq-dev \
  && docker-php-ext-install mysqli pdo_pgsql \
  && apt-get purge -y --auto-remove libpq-dev \
  && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . .

ENV PORT=10000
EXPOSE 10000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t /app/api"]
