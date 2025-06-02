# ------------------------------------------------------------
# Etapa 1: Imagen base con PHP y extensiones necesarias
# ------------------------------------------------------------
FROM php:8.2-fpm

# Instalación de extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    libcurl4-openssl-dev libssl-dev libpq-dev vim \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# ------------------------------------------------------------
# Etapa 2: Instalación de Composer
# ------------------------------------------------------------
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# ------------------------------------------------------------
# Etapa 3: Crear carpeta del proyecto
# ------------------------------------------------------------
WORKDIR /var/www

# Copiar todos los archivos del proyecto
COPY . .

# Instalar dependencias PHP (Laravel)
RUN composer install --no-dev --optimize-autoloader

# ------------------------------------------------------------
# Etapa 4: Instalar Node.js y build de Vite
# ------------------------------------------------------------
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Instalar dependencias de Node
RUN npm install && npm run build

# ------------------------------------------------------------
# Etapa 5: Permisos y cache
# ------------------------------------------------------------
RUN chmod -R 775 storage bootstrap/cache
RUN php artisan config:cache && php artisan view:cache
# ------------------------------------------------------------
# Etapa 6: Variables necesarias para Laravel
# (Estas las puedes sobreescribir con Render en render.yaml)
# ------------------------------------------------------------
ENV APP_ENV=production

ENV APP_URL=https://autoclean360.onrender.com

# Puerto por el que se expondrá Laravel
EXPOSE 8000


# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=8000
