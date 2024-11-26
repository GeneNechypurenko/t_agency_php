<?php
include_once("Functions.php");

$mysqli = connect();

$ct1 = "CREATE TABLE countries (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(64) UNIQUE
) DEFAULT CHARSET='utf8'";

$ct2 = "CREATE TABLE cities (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(64),
    countryid INT,
    FOREIGN KEY (countryid) REFERENCES countries(id) ON DELETE CASCADE,
    UNIQUE INDEX ucity (city, countryid)
) DEFAULT CHARSET='utf8'";

$ct3 = "CREATE TABLE hotels (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotel VARCHAR(64),
    cityid INT,
    FOREIGN KEY (cityid) REFERENCES cities(id) ON DELETE CASCADE,
    countryid INT,
    FOREIGN KEY (countryid) REFERENCES countries(id) ON DELETE CASCADE,
    stars INT,
    cost INT,
    info VARCHAR(2048)
) DEFAULT CHARSET='utf8'";

$ct4 = "CREATE TABLE images (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    imagepath VARCHAR(255),
    hotelid INT,
    FOREIGN KEY (hotelid) REFERENCES hotels(id) ON DELETE CASCADE
) DEFAULT CHARSET='utf8'";

$ct5 = "CREATE TABLE roles (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(32)
) DEFAULT CHARSET='utf8'";

$ct6 = "CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(32) UNIQUE,
    pass VARCHAR(128),
    email VARCHAR(128),
    roleid INT,
    FOREIGN KEY (roleid) REFERENCES roles(id) ON DELETE CASCADE,
    avatar MEDIUMBLOB
) DEFAULT CHARSET='utf8'";

$ct7 = "CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    comment TEXT NOT NULL,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
) DEFAULT CHARSET='utf8'";

if (!$mysqli->query($ct1)) {
    printf("Errorcode 1: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct2)) {
    printf("Errorcode 2: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct3)) {
    printf("Errorcode 3: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct4)) {
    printf("Errorcode 4: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct5)) {
    printf("Errorcode 5: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct6)) {
    printf("Errorcode 6: %d\n", $mysqli->errno);
    exit();
}

if (!$mysqli->query($ct7)) {
    printf("Errorcode 7: %d\n", $mysqli->errno);
    exit();
}

printf("All tables created successfully!");
?>
