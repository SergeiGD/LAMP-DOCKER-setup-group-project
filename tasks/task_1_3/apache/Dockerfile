FROM ubuntu/apache2:latest

RUN apt update

RUN apt -y upgrade

RUN apt install -y python3-pip

RUN apt-get install libapache2-mod-wsgi-py3

RUN mkdir /var/www/Task_1

COPY ./ports.conf /etc/apache2/ports.conf

COPY ./Task_1_3_main.conf /etc/apache2/sites-enabled/

COPY ./Task_1_3_delete.conf /etc/apache2/sites-enabled/