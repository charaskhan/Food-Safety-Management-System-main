-- =============================================================================================================
--                                          DROP QUERIES
-- =============================================================================================================
DROP USER IF EXISTS 'your_username'@'localhost';
DROP DATABASE IF EXISTS fsms;

-- =============================================================================================================
--                                          CREATE QUERIES
-- =============================================================================================================
CREATE USER 'your_username'@'localhost' IDENTIFIED WITH 'mysql_native_password' BY 'your_password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE ON fsms.* TO 'your_username'@'localhost';

CREATE DATABASE fsms;
USE fsms;

CREATE TABLE meal_chef (
    meal_id varchar(10) NOT NULL,
    chef_username varchar(10) NOT NULL,
    action_date date NOT NULL,
    action_type varchar(50) NOT NULL,
    PRIMARY KEY (meal_id, chef_username, action_date)
);

CREATE TABLE meal_ingredient (
    meal_id varchar(10) NOT NULL,
    ingredient_id varchar(10) NOT NULL,
    PRIMARY KEY (meal_id, ingredient_id)
);

CREATE TABLE ingredient (
    ingredient_id varchar(10) NOT NULL,
    ingredient_name varchar(50),
    ingredient_cost float,
    purchase_date date,
    expire_date date NOT NULL,
    allergy_type int(5),
    supplier int(5) NOT NULL,
    PRIMARY KEY (ingredient_id)
);

CREATE TABLE allergy (
    allergy_num int(5) NOT NULL AUTO_INCREMENT,
    allergy_type varchar(50) NOT NULL,
    allergy_severity int(2) NOT NULL,
    PRIMARY KEY (allergy_num)
);

CREATE TABLE supplier (
    supp_num int(5) NOT NULL AUTO_INCREMENT,
    supp_name varchar(50),
    supp_phone int(10),
    supp_country varchar(50),
    PRIMARY KEY (supp_num)
);

CREATE TABLE chef (
    chef_username varchar(10) NOT NULL,
    chef_fname varchar(50),
    chef_lname varchar(50),
    chef_age int(3),
    chef_gender varchar(10),
    chef_password varchar(255) NOT NULL,
    PRIMARY KEY (chef_username)
);

CREATE TABLE meal (
    meal_id varchar(10) NOT NULL,
    meal_name varchar(50),
    meal_price int(11),
    meal_category varchar(50) NOT NULL,
    PRIMARY KEY (meal_id)
);

-- =============================================================================================================
--                                          INDEX/CONSTRAINT QUERIES
-- =============================================================================================================
ALTER TABLE meal_chef
    ADD INDEX FKmeal_chef260234 (chef_username),
    ADD CONSTRAINT FKmeal_chef260234 FOREIGN KEY (chef_username) REFERENCES chef (chef_username);

ALTER TABLE meal_chef
    ADD INDEX FKmeal_chef954388 (meal_id),
    ADD CONSTRAINT FKmeal_chef954388 FOREIGN KEY (meal_id) REFERENCES meal (meal_id);

ALTER TABLE ingredient
    ADD INDEX FKingredient51913 (allergy_type),
    ADD CONSTRAINT FKingredient51913 FOREIGN KEY (allergy_type) REFERENCES allergy (allergy_num) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE meal_ingredient
    ADD INDEX FKmeal_ingre337039 (ingredient_id),
    ADD CONSTRAINT FKmeal_ingre337039 FOREIGN KEY (ingredient_id) REFERENCES ingredient (ingredient_id);

ALTER TABLE meal_ingredient
    ADD INDEX FKmeal_ingre215209 (meal_id),
    ADD CONSTRAINT FKmeal_ingre215209 FOREIGN KEY (meal_id) REFERENCES meal (meal_id);

ALTER TABLE ingredient
    ADD INDEX FKingredient740659 (supplier),
    ADD CONSTRAINT FKingredient740659 FOREIGN KEY (supplier) REFERENCES supplier (supp_num) ON UPDATE CASCADE;

COMMIT;
