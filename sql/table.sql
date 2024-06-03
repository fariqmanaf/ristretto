CREATE TABLE `user` (
  `user_id` integer PRIMARY KEY,
  `username` varchar(255),
  `password` varchar(255),
  `role_id` integer
);

CREATE TABLE `rating` (
  `rating_id` integer PRIMARY KEY,
  `comment` varchar(255),
  `star` integer,
  `product_id` integer,
  `user_id` integer
);

CREATE TABLE `roles` (
  `role_id` integer PRIMARY KEY,
  `role` varchar(255)
);

CREATE TABLE `category` (
  `category_id` integer PRIMARY KEY,
  `category_name` varchar(255)
);

CREATE TABLE `product` (
  `product_id` integer PRIMARY KEY,
  `product_name` varchar(255),
  `category_id` integer,
  `price` integer,
  `stock` integer
);

CREATE TABLE `transaction` (
  `transaction_id` integer PRIMARY KEY,
  `transaction_date` date,
  `payment_id` integer
);

CREATE TABLE `payment` (
  `payment_id` integer PRIMARY KEY,
  `payment_type_id` integer,
  `amount` integer
);

CREATE TABLE `payment_type` (
  `payment_type_id` integer PRIMARY KEY,
  `payment_type` varchar(255)
);

CREATE TABLE `transaction_detail` (
  `transaction_detail_id` integer PRIMARY KEY,
  `transaction_id` integer,
  `product_id` integer,
  `quantity` integer,
  `subtotal` integer
);

ALTER TABLE `transaction_detail` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

ALTER TABLE `product` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

ALTER TABLE `user` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

ALTER TABLE `rating` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `rating` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

ALTER TABLE `transaction_detail` ADD FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);

ALTER TABLE `transaction` ADD FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`);

ALTER TABLE `payment` ADD FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`);


-- Data untuk tabel roles
INSERT INTO roles (role_id, role) VALUES
(1, 'Admin'),
(2, 'Pelanggan');

-- Data untuk tabel category
INSERT INTO category (category_id, category_name) VALUES
(1, 'Minuman'),
(2, 'Makanan'),
(3, 'Dessert');

-- Data untuk tabel user
INSERT INTO user (user_id, username, password, role_id) VALUES
(1, 'admin', 'admin123', 1),
(2, 'user1', 'user123', 2),
(3, 'user2', 'user456', 2);

-- Data untuk tabel product
INSERT INTO product (product_id, product_name, category_id, price, stock) VALUES
(1, 'Kopi Latte', 1, 25000, 50),
(2, 'Teh Hijau', 1, 15000, 30),
(3, 'Nasi Goreng Spesial', 2, 35000, 20),
(4, 'Sandwich Tuna', 2, 30000, 25),
(5, 'Cheesecake Blueberry', 3, 28000, 15);

-- Data untuk tabel payment_type
INSERT INTO payment_type (payment_type_id, payment_type) VALUES
(1, 'Cash'),
(2, 'Debit Card'),
(3, 'Credit Card');

-- Data untuk tabel payment
INSERT INTO payment (payment_id, payment_type_id, amount) VALUES
(1, 1, 60000),
(2, 2, 80000);

-- Data untuk tabel transaction
INSERT INTO transaction (transaction_id, transaction_date, payment_id) VALUES
(1, '2023-05-25', 1),
(2, '2023-05-26', 2);

-- Data untuk tabel transaction_detail
INSERT INTO transaction_detail (transaction_detail_id, transaction_id, product_id, quantity, subtotal) VALUES
(1, 1, 1, 2, 50000),
(2, 1, 3, 1, 35000),
(3, 2, 2, 2, 30000),
(4, 2, 4, 1, 30000),
(5, 2, 5, 1, 28000);

-- Data untuk tabel rating
INSERT INTO rating (rating_id, comment, star, product_id, user_id) VALUES
(1, 'Kopi yang enak dan aroma yang harum', 5, 1, 2),
(2, 'Nasi gorengnya kurang pedas', 3, 3, 3),
(3, 'Cheesecake yang lezat', 4, 5, 2);