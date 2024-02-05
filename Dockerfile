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

# # Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $UID -d /home/$USER $USER
# RUN mkdir -p /home/$USER/.composer && \
#     chown -R $USER:$USER /home/$USER
    
# Add a non-root user to prevent files being created with root permissions on host machine.
ENV USER=laravel
ENV UID 1000
ENV GID 1000

RUN addgroup --gid "$GID" "$USER" \
    && adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "$USER" \
    --no-create-home \
    --uid "$UID" \
    "$USER"    

# Set working directory
COPY --chown=docker:docker . /home/www/vehicles
WORKDIR /home/www/vehicles
USER $USER
