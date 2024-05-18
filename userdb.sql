-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS UserDB;

-- Use the created database
USE UserDB;

-- Create a table to store user information
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    message VARCHAR(100) NOT NULL UNIQUE,
    
);

-- create a table to store user information, including username, firstname, lastname, password  
CREATE TABLE IF NOT EXISTS userdata (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

