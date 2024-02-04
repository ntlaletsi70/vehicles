FROM php:8.2.10RC1-fpm-bullseye
# Arguments defined in docker-compose.yml
# ARG USER
# ARG UID

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
# RUN mkdir -p /home/$USER/.composer && \
#     chown -R $USER:$USER /home/$USER

# Set working directory
COPY --chown=docker:docker . /var/www
WORKDIR /var/www
# USER $USER
