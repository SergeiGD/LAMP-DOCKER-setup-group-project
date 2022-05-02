# Настройка стака linux nginx python mysql

Здесь предоставлено простое web-приложение, позволяющие делать CRUD операции с базой данных mysql и файлы настроек nginx

Технологии:
    - python 3.8.10
    - flask
    - nginx
    - mysql

## Настройка для запуска:

1) Для начала создайте вирутальную среду

```bash
python3 -m venv env
```

2) Затем активируйте ее

```bash
source env/bin/activate
```

3) После этого установите все пакеты

```bash
pip install -r requirements.txt
```

4) После этого виртуальную среду можно деактивировать

```bash
deactivate 
```

5) Затем импортируйте структуры базы данных:

```bash
mysql -uUSER_NAME -pUSER_PASSWORD < /var/www/LAMP-setup-group-project/nginx_python_mysql/database_structure.sql 
```

6) После этого в файле .env укажите пользователя, у которого есть права на импортированную в предыдущем шаге базу данных, его пароль, имя БД оставьте users и порт (если не изменяли, оставьте стандартный 3444). В моем случае файл .env имеет следующие содержание:

```
DB_NAME=users
DB_USER=db_users
DB_PASSWD=my_pass123
DB_PORT=3444
```

7) Теперь в файле configuration_files/nginx_site в разделе uwsgi_pass укажите путь до папки проекта (если вы и так загружали проект по пути /var/www, то оставьте без изменений)

8) После этого в файле настроек демона configuration_files/nginx_site.service укажите пользователя, рабочую директорию (путь до проекта), окружение (PATH=путь до папки bin в виртуальной среде) и файл запуска (путь до файла uwsgi в виртуальной среде --ini nginx_site.ini)

9) Затем закиньте файл nginx_site (шаг 7) в папку /etc/nginx/sites-available/

```bash
sudo cp ./configuration_files/nginx_site /etc/nginx/sites-available/
```

10) И файл nginx_site.service (шаг 8) в папку /etc/systemd/system/

```bash
sudo cp ./configuration_files/nginx_site.service /etc/systemd/system/nginx_site.service
```

11) После этого активируйте демона и перезапустите nginx

```bash
sudo systemctl start nginx_site.service
sudo systemctl enable nginx_site.service
sudo systemctl restart nginx
```

12) Все готово. Теперь по адресу http://ваш_ip:80 вы можете зайти на сайт. Обратите внимание, что изначально таблица с пользователями будет пуста, т.к. импортировалась только стрктура базы данных без данных