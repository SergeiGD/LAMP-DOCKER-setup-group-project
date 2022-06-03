DROP TABLE IF EXISTS users;

CREATE TABLE users(
    user_id serial PRIMARY KEY,
    user_name varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    phone_num varchar(15) NOT NULL,
    photo varchar(50)
);

INSERT INTO users(user_name, email, phone_num, photo) VALUES
('michel', 'asdsf@gmail.com', '324523', NULL), ('anna', 'anna293122f@gmail.com', '435436', 'images/5.jpg'),
('alex', 'qwerty@gmail.com', '880055355', 'images/2.jpg'), ('user789', 'xan@gmail.com', '2123', NULL),
('boris', 'zbfddg@gmail.com', '423525654', NULL), ('jaba', 'usersname@gmail.com', '32465434', NULL);

GRANT ALL PRIVILEGES ON users TO sergei;