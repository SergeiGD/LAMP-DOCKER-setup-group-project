# flask-app

Здесь находится простейшее web-приложение.  

Технологии, которые использовались

- Python 3.8
- Flask 2.1.1
- PostgreSQL
- Apache

## Как запустить.

Шаг 1. Настройка **virtualenv**.

```bash
$ python3 -m virtualenv env
```

В итоге получим:

![env](./images/env.png)

Шаг 2. Активация **env** и установка необходимых библиотек.

```bash
$ source env/bin/activate
$ pip install -r requirements.txt
```

Шаг 3. Создать файл `.env` и добавить туда переменные.

```bash
$ touch .env
```

Вот ты должно выглядель содержимое `.env`

```bash
FLASK_ENV='development'
DB_HOST='localhost'
DB_NAME='database name'
DB_USER='user'
PGSQL_DB_PASSWORD='user password'
SECRET_KEY='v3ry_s3cr37_k3y'
```

Шаг 4. Создать таблицу в вашей бд.

```SQL
CREATE TABLE users (
    id serial PRIMARY KEY,
    login varchar(50) NOT NULL,
    password varchar(100) NOT NULL,
    date_added date DEFAULT CURRENT_DATE
);
```

Шаг 5. Запустить приложение.

```bash
$ python app.py
```

## Настройка под Apache.

Шаг 1. Поместить файл `flask-app.conf` в директорию `/etc/apache2/sites-enabled/`.

```bash
$ sudo mv flask-app.conf /etc/apache2/sites-enabled/
```

> Примечание: Разкоментируйте в `flask-app.conf` строку `ServerName`  
> и вместо **Your IP** напишите ваш домен/IP адресс, чтобы подлючаться  
> не только через **localhost/127.0.0.1**

Шаг 2. Копировать файлы приложения в `/var/www/flask-app/`.

```bash
$ sudo cp -rp . /var/www/flask-app/
```

Шаг 3. Создать директорию `logs`.

```bash
$ mkdir logs
```

Шаг 4. Перезагрузить Apache.

```bash
$ sudo service apache2 restart
```