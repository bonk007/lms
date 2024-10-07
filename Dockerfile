FROM ultimatesmoker/php8.3-laravel:dev

WORKDIR /app

COPY . /app
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 8008

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
