# Задача #6
С помощью связки Nginx, Python, PostgreSQL разработать приложение, которое будет выводить список пользователей по адресу 127.0.0.1/users.py, а по адресу 127.0.0.1/users/compare.py?id1=XXX&?id2=XXX будет возможность сравнения двух пользователей с подсветкой различающихся полей. Использовать docker.

```$ docker-compose up -d --build```

```$ docker-compose exec web python manage.py create_db```

```$docker-compose exec web python manage.py seed_db```
