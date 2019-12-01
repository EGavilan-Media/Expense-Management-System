CREATE DATABASE egm_expense;

USE egm_expense;

CREATE TABLE `tbl_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY(id)
);

INSERT INTO `tbl_expense` (`id`, `description`, `amount`, `date`) VALUES
(1, 'pasta pasta', '80.22', '2019-11-28'),
(2, 'seafood', '3.29', '2019-08-02'),
(3, 'noodles', '1.44', '2018-12-31'),
(4, 'seafood', '1.82', '2020-03-03'),
(5, 'soups', '0.69', '2020-08-19'),
(6, 'desserts', '2.22', '2019-09-02'),
(7, 'salads', '1.26', '2019-07-07'),
(8, 'desserts', '0.60', '2019-02-12'),
(9, 'soups', '0.43', '2020-04-03'),
(13, 'salads', '3.75', '2020-09-04'),
(14, 'sandwiches', '4.33', '2020-01-27'),
(15, 'noodles', '0.57', '2019-08-13'),
(16, 'cereals', '1.61', '2020-07-28'),
(17, 'soups', '0.94', '2019-07-08'),
(18, 'cereals', '3.51', '2020-01-05'),
(19, 'noodles', '0.72', '2019-03-21'),
(20, 'stews', '1.70', '2020-09-14'),
(21, 'salads', '0.00', '2020-07-14'),
(22, 'desserts', '2.07', '2020-05-02'),
(23, 'pies', '2.61', '2020-10-28'),
(24, 'salads', '0.28', '2019-02-28'),
(25, 'cereals', '0.03', '2019-10-12'),
(26, 'soups', '3.06', '2020-11-02'),
(27, 'cereals', '0.41', '2019-11-30'),
(28, 'stews', '4.64', '2020-04-02'),
(29, 'pasta', '2.81', '2020-02-03'),
(30, 'salads', '3.62', '2019-03-23'),
(31, 'salads', '0.42', '2020-05-14'),
(32, 'pasta', '2.22', '2019-07-14'),
(33, 'salads', '3.31', '2019-08-18'),
(34, 'seafood', '3.35', '2020-02-13'),
(35, 'cereals', '2.05', '2019-04-26'),
(36, 'desserts', '0.64', '2019-12-29'),
(37, 'pasta', '1.75', '2020-10-11'),
(38, 'cereals', '0.08', '2020-05-04'),
(39, 'stews', '4.50', '2020-03-02'),
(40, 'stews', '0.01', '2019-01-09'),
(41, 'salads', '3.39', '2020-01-04'),
(42, 'stews', '2.56', '2019-03-30'),
(43, 'cereals', '3.11', '2020-02-20'),
(44, 'salads', '0.31', '2020-02-19'),
(45, 'noodles', '0.29', '2020-11-03'),
(46, 'desserts', '0.91', '2019-05-29'),
(47, 'desserts', '0.33', '2019-05-07'),
(48, 'pies', '1.39', '2019-05-03'),
(49, 'desserts', '2.82', '2019-05-02'),
(50, 'seafood', '0.24', '2020-08-18'),
(51, 'soups', '2.60', '2020-10-28'),
(52, 'sandwiches', '4.65', '2020-06-25'),
(53, 'noodles', '0.93', '2020-10-29'),
(54, 'salads', '4.08', '2020-04-13'),
(55, 'pies', '4.09', '2018-12-07'),
(56, 'stews', '1.85', '2020-07-28'),
(57, 'pasta', '1.88', '2020-01-06'),
(58, 'soups', '0.60', '2020-06-05'),
(59, 'sandwiches', '4.81', '2019-03-27'),
(60, 'cereals', '4.02', '2020-07-21'),
(61, 'seafood', '3.08', '2019-04-13'),
(62, 'desserts', '1.21', '2020-06-16'),
(63, 'sandwiches', '1.23', '2020-10-17'),
(64, 'desserts', '3.97', '2020-01-20'),
(65, 'noodles', '2.04', '2019-10-15'),
(66, 'pies', '2.65', '2019-09-29'),
(67, 'seafood', '1.91', '2020-09-07'),
(68, 'cereals', '1.26', '2019-07-31'),
(69, 'pasta', '3.45', '2019-04-13'),
(70, 'stews', '1.82', '2020-01-29'),
(71, 'pies', '1.36', '2020-06-06'),
(72, 'salads', '2.45', '2019-08-30'),
(73, 'salads', '3.51', '2019-02-06'),
(74, 'salads', '1.55', '2018-12-15'),
(75, 'soups', '4.55', '2019-07-28'),
(76, 'noodles', '2.92', '2020-05-10'),
(77, 'seafood', '3.28', '2019-11-12'),
(78, 'pasta', '1.68', '2020-02-27'),
(79, 'desserts', '2.98', '2020-09-08'),
(80, 'desserts', '0.58', '2019-03-25'),
(81, 'sandwiches', '1.94', '2019-03-26'),
(82, 'pies', '1.64', '2019-08-07'),
(83, 'seafood', '3.18', '2020-05-18'),
(84, 'salads', '2.89', '2020-11-11'),
(85, 'pasta', '2.61', '2020-10-25'),
(86, 'salads', '2.03', '2019-02-27'),
(87, 'sandwiches', '3.69', '2019-04-01'),
(88, 'soups', '2.77', '2019-12-09'),
(89, 'desserts', '3.40', '2019-01-18'),
(90, 'sandwiches', '4.24', '2020-07-08'),
(91, 'soups', '0.10', '2019-06-28'),
(92, 'cereals', '1.88', '2019-11-18'),
(93, 'cereals', '3.12', '2019-04-03'),
(94, 'soups', '4.30', '2019-11-22'),
(95, 'salads', '4.65', '2019-05-13'),
(96, 'noodles', '0.12', '2019-09-15'),
(97, 'soups', '1.86', '2020-03-15'),
(98, 'soups', '2.21', '2020-09-24'),
(99, 'seafood', '1.16', '2019-08-14'),
(100, 'soups', '2.53', '2020-02-24');