CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(128) UNIQUE,
    full_name VARCHAR(128),
    phone VARCHAR(32),
    other_info JSON,
    css TEXT
);

CREATE TABLE relations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user1 INT NOT NULL,
    user2 INT NOT NULL
);
