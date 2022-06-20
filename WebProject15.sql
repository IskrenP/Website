CREATE DATABASE WebProject15
USE WebProject15

CREATE TABLE Users (
Id INT Primary key AUTO_INCREMENT,
UserName VARCHAR(50) NOT NULL,
Password VARCHAR(20) NOT NULL
)

INSERT INTO Users (UserName , Password ) VALUES 
('UserName1','pass123'),
('UserName2','pass321'),
('UserName3','pass123')