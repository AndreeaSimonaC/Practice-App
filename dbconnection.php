<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "practice-mysql";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>


<!-- 
mysql:
//create users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);


//insert admin in users table
INSERT INTO users (username, password, role) VALUES ('admin', '123', 'admin');


//insert products in products table
INSERT INTO products (product_title, product_description, product_price) VALUES 
("title1", "description1", 1), 
("title2", "description2", 2), 
("title3", "description3", 3);

-->