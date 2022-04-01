FROM nginx:latest

WORKDIR /var/www/symfony_docker/public

ADD ./public .

ADD ./Docker/nginx/default.conf /etc/nginx/conf.d/default.conf
