# Настройка PostgreSQL

## Установка

---

Установить PostgreSQL с доп. утилитами с помощью этой команды

```bash
sudo apt install postgresql postgresql-contrib -y
```

## Использование ролей в PostgreSQL

---

Переключение на учетну запись **postgres**

```bash
sudo -i -u postgres
```

Использование **postgres** без переключения учетной записи

```bash
sudo -u postgres psql
```

## Создание новой роли

---

Выполнить вход в учетную записиь **postgres** и создать нового пользователя

```psql
createuser --interactive
```

Тоже самое без переключения на **postgres**

```bash
sudo -u postgres createuser --interactive
```
