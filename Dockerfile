FROM amazonlinux:2

# ARG
ARG XDEBUG_VERSION
ARG DRUSH_VERSION
ARG PHP_VERSION
ARG LARAVEL_VERSION

#USER PARAMS
USER root

# INSTALL NGINX
RUN yum -y update
COPY ./conf/nginx/nginx.repo /etc/yum.repos.d/
RUN yum -y update && yum -y install nginx && yum -y install initscripts

# INSTALL AND CONFIGURE PHP
RUN yum install gcc-c++ zlib-devel amazon-linux-extras -y
RUN amazon-linux-extras enable $PHP_VERSION && amazon-linux-extras install $PHP_VERSION -y
RUN yum -y install php php-bcmath php-cli php-mbstring php-xml php-opcache php-fpm php-intl php-gd php-pear php-devel gd gd-devel wget unzip memcached tar


# INSTALL XDEBUG
RUN pecl install $XDEBUG_VERSION 

# INSTALL AND CONFIGURE GIT
RUN yum -y install git  

# INSTALL AND CONFIGURE COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"   \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer  \
    && php -r "unlink('composer-setup.php');"                                   \
    && ln -s /usr/local/bin/composer /usr/local/bin/composer.phar               \
    && composer self-update                                               \
    && composer --version -y

# INSTALL LARAVEL
RUN composer global require laravel/installer

# LOAD CONFIG FOR NGINX
COPY ./conf/nginx/default.conf /etc/nginx/conf.d/default.conf

# LOAD PHP.INI CUSTOM
COPY ./conf/php/php.ini /etc/php.ini

RUN export COMPOSER_PROCESS_TIMEOUT=6000

WORKDIR /usr/share/nginx/html

# RESTART NGIX AND PHP-FPM
RUN systemctl enable nginx.service && systemctl enable php-fpm.service

#RUN php artisan serve --host=0.0.0.0 --port=80

CMD ["/usr/sbin/init"] 