# Utilizza l'immagine PHP 8.2 con Apache
FROM php:8.2-apache

# Abilita il modulo di riscrittura di Apache e l'estensione mysqli di PHP
RUN a2enmod rewrite && docker-php-ext-install mysqli

# Copia i file del sito web nella directory del server web
COPY ./app /var/www/html/
