-- Truncate tabel rating
TRUNCATE TABLE rating;
ALTER TABLE rating AUTO_INCREMENT = 1;

-- Truncate tabel transaction_detail
TRUNCATE TABLE transaction_detail;
ALTER TABLE transaction_detail AUTO_INCREMENT = 1;

-- Truncate tabel transaction
TRUNCATE TABLE transaction;
ALTER TABLE transaction AUTO_INCREMENT = 1;

-- Truncate tabel payment
TRUNCATE TABLE payment;
ALTER TABLE payment AUTO_INCREMENT = 1;

-- Truncate tabel product
TRUNCATE TABLE product;
ALTER TABLE product AUTO_INCREMENT = 1;

-- Truncate tabel user
TRUNCATE TABLE user;
ALTER TABLE user AUTO_INCREMENT = 1;

-- Truncate tabel user
TRUNCATE TABLE user_tokens;
ALTER TABLE user_tokens AUTO_INCREMENT = 1;

-- Truncate tabel roles
TRUNCATE TABLE roles;
ALTER TABLE roles AUTO_INCREMENT = 1;

-- Truncate tabel category
TRUNCATE TABLE category;
ALTER TABLE category AUTO_INCREMENT = 1;

-- Truncate tabel payment_type
TRUNCATE TABLE payment_type;
ALTER TABLE payment_type AUTO_INCREMENT = 1;