<?php

require_once("database.php");

$DP_OPT = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => true
];

$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $DB_OPT);
$stmt = $pdo->prepare(<<<EOD
CREATE DATABASE IF NOT EXISTS camagru;
USE camagru;
CREATE TABLE IF NOT EXISTS users(
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`login` VARCHAR(32) NOT NULL,
	`passwd` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `hash` VARCHAR(64) DEFAULT NULL,
    `verify` BOOLEAN DEFAULT false,
    `notifs` BOOLEAN DEFAULT true
);
CREATE TABLE IF NOT EXISTS images(
    `img_id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `login` CHAR(255) NOT NULL,
    `image_name` CHAR(255) NOT NULL,
    `creation_date` DATETIME NOT NULL,
    `likes` INT UNSIGNED DEFAULT 0
);
CREATE TABLE IF NOT EXISTS comments(
    `image_name` CHAR(255) NOT NULL,
    `login` CHAR(255) NOT NULL,
    `content` CHAR(255) NOT NULL,
    `creation_date` DATETIME NOT NULL
);
CREATE TABLE IF NOT EXISTS likes(
    `image_name` CHAR(255) NOT NULL,
    `login` CHAR(255) NOT NULL
);
EOD
)->execute();
$pdo = NULL;
$stmt = NULL;


?>