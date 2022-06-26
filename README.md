# LAMP-setup-group-project

## Данный репозиторий создан в учебных целях, а именно: научиться настроивать серверное программное обеспечение, а также совместно работать в общем репозитории.

В этом репозитории вы найдете:
- Реализацию LAMP среды и ее аналогов
- Настройки docker'а
- Простейшие веб-приложения для CRUD операций

Структура этого репозитория максимально проста. В нем есть:
- Языки программирования: php и python (flask)
- Базы данных: mysql и postgresql
- Веб сервер: apache и nginx
- Docker

Внутри папок находятся все необходимые файлы (включая веб-программы). Также есть доп. задания (task_N, task_N_1, task_N_2, где N - номер варианта), которые находятся в папке tasks. Описание каждой задачи содержится внутри соответствующий папоки, а также коротко приведено ниже (после авторов). </br>
### **_Задания с докером находятся в tasks/task_N_2, для остальных заданий докер не настроен_** </br>
Сами же веб-программы являются крайне элементарными и просто позволяют делать CRUD операции над соответствующей базой данных. </br>

Авторы:
* nginx python mysql + task_5 - https://github.com/SergeiGD
* apache python postgresql + task_3 - https://github.com/romankravchuk
* apache python mysql + task_6 - https://github.com/dedneded
* nginx php mysql - https://github.com/GrigoryTatarnikov
* apache php mysql - https://github.com/Nik1taZz
* apache php postgresql + task_1 - https://github.com/elisntdead

----------------------------

## Описание задач nginx python mysql + task_5:

1) В папке [**nginx_python_mysql**](./nginx_python_mysql) содержаться все необходимые файлы для запуска соотвествующей связки. Также там предоставлен файл для инициализации базы данных и readme с подробной инструкцией запуска.
2) В папке [**tasks/task_5**](./tasks/task_5) находится первое дополнительное задание, в котором с помощью связки Nginx, PHP, PostgreSQL необходимо разработать приложение, которое будет по одному адресу выводить всех пользователей, а по другому будет возможность их редактирования, в том числе настройка фотографии пользоватея. Более подробное описание есть в readme папки с этим заданием.
3) В папке [**tasks/task_5_1**](./tasks/task_5_1) находится тоже самое задание, что и в task_5 (Nginx, PHP, PostgreSQL + фотографии), но теперь уже используется база данных mysql и сервер apache.
4) В папке [**tasks/task_5_2**](./tasks/task_5_2) находится тоже самое задание, что и в task_5 (Nginx, PHP, PostgreSQL + фотографии), а также docker файлы для развертывания с помощью docker-compose.

## Описание задач apache python mysql + task_6:

1) В папке [**apache_python_mysql**](./apache_python_mysql) находятся файлы для запуска web-приложения с использованием связки apache+python+mysql.
2) В папке [**tasks/task_6**](./tasks/task_6) находятся файлы для запуска web-приложения с использованием связки nginx+pytnon+postgresql. Это приложение по одному адресу выводит список пользователей, а по другому адресу позволяет этих пользователей сравнивать.
3) В папке [**tasks/task_6_1**](./tasks/task_6_1) находятся файлы для запуска web-приложения с использованием связки apache+pytnon+mysql. Задача этого приложения аналогична с задачей приложения в task_6.
4) В папке [**tasks/task_6_2**](./tasks/task_6_2) находятся для запуска web-приложения с использованием связки nginx+pytnon+postgresql, а также docker файлы для развертывания с помощью docker-compose. Задача этого приложения аналогична с задачей приложения в task_6.
