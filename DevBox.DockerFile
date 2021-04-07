FROM ubuntu:18.04
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update -y
RUN apt-get upgrade -y
RUN apt-get install -y composer
RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update -y
RUN apt-get install -y php7.4
RUN apt-get install -y php7.4-bcmath \
php7.4-bz2 php7.4-intl php7.4-gd \
php7.4-mbstring php7.4-mysql \
php7.4-zip php7.4-common php7.4-dev \
php7.4-mysql php7.4-curl php7.4-json
RUN apt-get install -y apache2 
RUN apt-get install -y libapache2-mod-php
#RUN curl -s "https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh" | /bin/bash
#RUN apt-get install -y software-properties-common
#RUN apt-get install -y php 7.2-phalcon
#COPY ./php.ini /etc/php/7.2/apache2/php.ini
#COPY ./restapicalculator.conf /etc/apache2/sites-available/restapicalculator.conf
#COPY ./apache2.conf /etc/apache2/apache2.conf
#RUN rm -rfv /etc/apache2/sites-enabled/*.conf
#RUN ln -s /etc/apache2/sites-available/restapicalculator.conf /etc/apache2/sites-enabled/restapicalculator.conf
#RUN echo "127.0.0.1 local.restapicalculator.com" >> /etc/hosts
CMD ["apachectl","-D","FOREGROUND"]
RUN a2enmod rewrite
EXPOSE 80
EXPOSE 443