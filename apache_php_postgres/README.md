# PHP x APACHE x POSTGRES

PostgreSQL CRUD PHP

Мой гит https://github.com/elisntdead

Требования: Postgres, PHP, Apache. БД в postgres с названием users, полями id, login, name.

Для работы:
  1) Поместить файл apache2.conf из папки conf этого репозитория по следующему пути: /etc/apache2/
  2) Поместить файл ports.conf из папки conf этого репозитория по пути /etc/apache2/
  3) Поместить файл hellowrld.conf из папки conf этого репозитория по пути /etc/apache2/sites-enabled/
  4) Поместить файлы index.html, index.php в /var/www/hellowrld/public_data (при необходиомости создать директории)
  5) Перезапустите Apache с помощью команды ```sudo systemctl restart apache2```
Далее зайдите в браузер по адресу localhost, сразу же откроется страница с надписью Hello World. По адресу localhost/index.php откроется таблица, нашей БД.

![img1](https://github.com/SergeiGD/LAMP-setup-group-project/blob/main/apache_php_postgres/img/img1.png)

![img2](https://github.com/SergeiGD/LAMP-setup-group-project/blob/main/apache_php_postgres/img/img2.png)
