# APACHE x PYTHON x MYSQL
Здесь предоставлено простое web-приложение, позволяющие делать CRUD операции с базой данных mysql через HTML-формы, а также файлы настроек apache.

## Автор - https://github.com/dedneded

## Первоначальная настройка

1) Создаем виртуальную среду:
 
```
python3 -m venv env
```
 
2) Активируем среду:

```
source env/bin/activate
```
3) Устанавливаем все пакеты:

```
pip install -r requirements.txt
```
4) Деактивируем виртуальную среду:

```
deactivate 
```
5) Установите mod_wsgi - модуль Apache, который предоставляет WSGI-совместимый интерфейс для работы с web-приложениями, написанными на языке программирования Python:

```
apt-get install libapache2-mod-wsgi-py3
```

6) Создаем файл с расширением wsgi. В нем ипортируем системное управление,  подключаем наш проект в путь python, указываем путь поиска для модулей, импортируем переменную flask:

```
import sys
sys.path.insert(0, "/var/www/ваш/путь/до/папки/с/проектом")
sys.path.append("/var/www/до/ваших/установленных/модулей")

from index import app as application
```
7) Создаем новый файл в /etc/apache2/sites-available/имя_файла.conf и вводим в него следующий блок конфигурации:

```
<VirtualHost *:8080>


        WSGIDaemonProcess ваша папка с проектом user=www-data group=www-data threads=5
        WSGIScriptAlias / /var/www/путь/до/файла/с/расширением/wsgi

        <Directory /var/www/путь/до/папки/с/проектом>
                WSGIprocessGroup ПроизвольноеИмя
                WSGIApplicationGroup %{GLOBAL}
                Order deny,allow
                Allow from all
        </Directory>
</VirtualHost>
```
8) Активируем файл:

```
sudo a2ensite имя_файла.conf
```
9) Проверяем ошибки конфигурации:

```
sudo apache2ctl configtest
```
Должны получить следующий результат:

```
Syntax OK
```
10) Перезапускаем Apache для внесения изменений:

```
sudo systemctl restart apache2
```

11)Переходим в браузер и в адресной строке набираем http://ваш_ip:8080. Готово!
