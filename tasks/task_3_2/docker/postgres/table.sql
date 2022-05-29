DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id serial PRIMARY KEY,
    login varchar(50) NOT NULL,
    password varchar(100) NOT NULL,
    date_added timestamp DEFAULT CURRENT_TIMESTAMP(0)
);

INSERT INTO users (login, password)
VALUES
('user1', 'a'), ('user2', 'b'),
('user3', 'c'), ('user4', 'd'),
('user5', 'e'), ('user6', 'f'),
('user7', 'g'), ('user8', 'h');
