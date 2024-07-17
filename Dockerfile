FROM amazonlinux:2

# ARG
ARG PHP_VERSION
ARG REPO

#USER PARAMS
#USER root

# INSTALL NGINX
RUN yum -y update
COPY ./conf/nginx/nginx.repo /etc/yum.repos.d/
RUN yum -y update && yum -y install nginx && yum -y install initscripts

# INSTALL AND CONFIGURE PHP
RUN yum install gcc-c++ zlib-devel amazon-linux-extras -y
RUN amazon-linux-extras enable $PHP_VERSION && amazon-linux-extras install $PHP_VERSION -y
RUN yum -y install php php-bcmath php-cli php-mbstring php-xml php-opcache php-fpm php-intl php-gd php-pear php-devel gd gd-devel wget unzip memcached tar


# INSTALL AND CONFIGURE GIT
RUN yum -y install git  

# INSTALL AND CONFIGURE COMPOSER
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');" && \
    ln -s /usr/local/bin/composer /usr/local/bin/composer.phar && \
    composer self-update && \
    composer --version -y

# INSTALL LARAVEL
RUN composer global require laravel/installer

# LOAD CONFIG FOR NGINX
COPY ./conf/nginx/default.conf /etc/nginx/conf.d/default.conf

# LOAD PHP.INI CUSTOM
COPY ./conf/php/php.ini /etc/php.ini

RUN export COMPOSER_PROCESS_TIMEOUT=6000

WORKDIR /var/tmp

# Clone the repository where the code is located
RUN git clone $REPO
RUN mv /var/tmp/API-LARAVEL/backend /usr/share/nginx/html

WORKDIR /usr/share/nginx/html/backend

RUN composer install

# Change group for PHP-FPM
RUN sed -i 's/^user = apache/user = nginx/' /etc/php-fpm.d/www.conf
RUN sed -i 's/^group = apache/group = nginx/' /etc/php-fpm.d/www.conf

# Set permissions
RUN chown -R nginx:nginx /usr/share/nginx/html/backend/storage /usr/share/nginx/html/backend/bootstrap/cache
RUN chmod -R 775 /usr/share/nginx/html/backend/storage /usr/share/nginx/html/backend/bootstrap/cache

# Copy .env.laravel to .env
COPY /conf/laravel/.env.laravel /usr/share/nginx/html/backend/.env

# Generate application key
RUN php artisan key:generate

# RESTART NGIX AND PHP-FPM
RUN systemctl enable nginx.service && systemctl enable php-fpm.service

CMD ["/usr/sbin/init"] 