FROM nginx:latest

WORKDIR /var/www/symfony_docker/public

ADD ./public .
RUN ls

ADD ./Docker/nginx/default.conf /etc/nginx/conf.d/default.conf
