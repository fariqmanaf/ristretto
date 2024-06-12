CREATE TABLE `user` (
  `user_id` integer PRIMARY KEY,
  `email` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `role_id` integer
);

CREATE TABLE `user_tokens` (
  `tokens_id` integer PRIMARY KEY,
  `user_id` integer,
  `token` varchar(255),
  `expired_at` datetime,
  `created_at` datetime
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
  `photo` varchar(255),
  `is_best_seller` integer
);

CREATE TABLE `transaction` (
  `transaction_id` integer PRIMARY KEY,
  `transaction_date` date,
  `payment_id` integer,
  `is_done` integer
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

-- Tabel user
ALTER TABLE `user`
MODIFY `user_id` INT AUTO_INCREMENT;

-- Tabel user_tokens
ALTER TABLE `user_tokens`
MODIFY `tokens_id` INT AUTO_INCREMENT;

-- Tabel rating
ALTER TABLE `rating`
MODIFY `rating_id` INT AUTO_INCREMENT;

-- Tabel roles
ALTER TABLE `roles`
MODIFY `role_id` INT AUTO_INCREMENT;

-- Tabel category
ALTER TABLE `category`
MODIFY `category_id` INT AUTO_INCREMENT;

-- Tabel product
ALTER TABLE `product`
MODIFY `product_id` INT AUTO_INCREMENT;

-- Tabel transaction
ALTER TABLE `transaction`
MODIFY `transaction_id` INT AUTO_INCREMENT;

-- Tabel payment
ALTER TABLE `payment`
MODIFY `payment_id` INT AUTO_INCREMENT;

-- Tabel payment_type
ALTER TABLE `payment_type`
MODIFY `payment_type_id` INT AUTO_INCREMENT;

-- Tabel transaction_detail
ALTER TABLE `transaction_detail`
MODIFY `transaction_detail_id` INT AUTO_INCREMENT;

ALTER TABLE `transaction_detail` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

ALTER TABLE `product` ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

ALTER TABLE `user` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

ALTER TABLE `rating` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `user_tokens` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `rating` ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

ALTER TABLE `transaction_detail` ADD FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`);

ALTER TABLE `transaction` ADD FOREIGN KEY (`payment_id`) REFERENCES `payment` (`payment_id`);

ALTER TABLE `payment` ADD FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`);