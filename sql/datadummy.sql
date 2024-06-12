-- Data untuk tabel roles
INSERT INTO roles (role_id, role) VALUES
(1, 'Admin'),
(2, 'Karyawan'),
(3, 'Pelanggan');

-- Data untuk tabel category
INSERT INTO category (category_id, category_name) VALUES
(1, 'Beverage'),
(2, 'Food'),
(3, 'Coffee'),
(4, 'Dessert');

-- Data untuk tabel user
INSERT INTO user (user_id, email, username, password, role_id) VALUES
(1, 'admin@example.com' ,'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1),
(2, 'karyawan@example.com' ,'karyawan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2),
(3, 'pelanggan@example.com' ,'pelanggan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3);

INSERT INTO `user_tokens` (`tokens_id`, `user_id`, `token`, `expired_at`, `created_at`) VALUES
(1, 1, 'ac6d23f8aec2330f8c6734e618fd9ec885cf376f74f4d710179fb9b57f6c0d2f', '2024-05-22 01:55:59', '2024-05-21 15:06:25'),
(2, 2, '4d5308bcb9f4dc45287687b1f07f69737af7dc9fa51b10aefb67a49d3c911be8', '2024-05-22 01:55:33', '2024-05-21 16:05:27'),
(3, 3, '14c46ec267c39b8dfba14054a82356db0375a105db45885f92b343ad41fbeaf3', '2024-05-21 21:33:25', '2024-05-21 18:28:44');
-- Data untuk tabel product
INSERT INTO product (product_id, product_name, category_id, price, photo, is_best_seller) VALUES
(1, 'Ice Tea', 1, 25000, 'beverage/ice-tea.webp', 0),
(2, 'Jazuci Tea', 1, 15000, 'beverage/jazuci-tea.webp', 1),
(3, 'Velvet Rough', 1, 35000, 'beverage/velvet-rough.webp', 0),
(4, 'By The Fireplace', 1, 30000, 'beverage/by-the-fireplace.webp', 1),
(5, 'Bloody Hearts', 1, 28000, 'beverage/bloody-heart.webp', 0),
(6, 'Slice Ur Life', 2, 28000, 'food/slice-ur-life.webp', 0),
(7, 'Burgeritto', 2, 28000,'food/burgeritto.webp', 1),
(8, 'Steak Haligon', 2, 28000, 'food/steak-haligon.webp', 0);

-- Data untuk tabel payment_type
INSERT INTO payment_type (payment_type_id, payment_type) VALUES
(1, 'Cash'),
(2, 'Debit Card'),
(3, 'Credit Card');

-- Data untuk tabel rating
INSERT INTO rating (rating_id, comment, star, product_id, user_id) VALUES
(1, 'Kopi yang enak dan aroma yang harum', 5, 1, 2),
(2, 'Nasi gorengnya kurang pedas', 3, 3, 3),
(3, 'Cheesecake yang lezat', 4, 5, 2);