FROM php:8.4-apache

# Installer dépendances système nécessaires et extensions PHP
RUN apt-get update \
    && apt-get install -y --no-install-recommends zip unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Activer rewrite
RUN a2enmod rewrite

# Définir le document root sur le dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}/!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Permettre .htaccess (AllowOverride All) et définir ServerName
RUN { \
    echo "<Directory \"/var/www/html/public\">"; \
    echo "    AllowOverride All"; \
    echo "    Require all granted"; \
    echo "</Directory>"; \
    echo "ServerName localhost"; \
} > /etc/apache2/conf-available/ponymvc.conf \
    && a2enconf ponymvc

WORKDIR /var/www/html

# Copier le projet
COPY . /var/www/html

# Installer composer (copie depuis l'image officielle composer)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP si composer.json présent (ne bloque pas si échec en dev)
RUN if [ -f /var/www/html/composer.json ]; then composer install --no-interaction --prefer-dist; fi

EXPOSE 80
CMD ["apache2-foreground"]
