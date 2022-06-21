CREATE DATABASE IF NOT EXISTS testDB;
CREATE USER 'egor'@'localhost' IDENTIFIED BY 'Rasmus1love';
GRANT ALL PRIVILEGES ON testDB.* TO 'egor'@'localhost';
FLUSH PRIVILEGES;
DROP TABLE IF EXISTS Users;
CREATE TABLE Users(id int PRIMARY KEY, login varchar(50) NOT NULL, name varchar(50) NOT NULL);
INSERT INTO Users VALUES (1,'congrats','db installed succesfully'), (2,'madeby','elisntdead'), (3,'sample','user'), (4,'sample','user2'), (5,'sample','user3');