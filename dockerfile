FROM php:8.2-apache

# Habilita mod_rewrite por si usas rutas amigables
RUN a2enmod rewrite

# Extensiones comunes para exámenes (MySQL/PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia el código fuente al DocumentRoot de Apache
COPY src/ /var/www/html/

EXPOSE 80