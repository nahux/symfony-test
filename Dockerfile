FROM php:8.1-apache-buster

COPY symfony-test-app/ /var/www/html/
WORKDIR /var/www/html/symfony-test-app

EXPOSE 80
