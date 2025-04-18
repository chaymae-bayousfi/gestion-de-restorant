USE projet_resto;
CREATE TABLE tbl_admin (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  full_name varchar(100) NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO tbl_admin (id, full_name, username, password) VALUES
(1, 'chaymae bayousfi', 'cbayousfi', '12345678'),
(9, 'hasnae aqajjef', 'haqajjef', '1234567890'),
(10, 'soukaina gmih', 'sgmih', '09876543'),
(12, 'amin elkess', 'aelkess', '0987654321');

CREATE TABLE tbl_category (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  image_name varchar(255) NOT NULL,
  featured varchar(10) NOT NULL,
  active varchar(10) NOT NULL,
  PRIMARY KEY (id)
);



INSERT INTO tbl_category (id, title, image_name, featured, active) VALUES
(4, 'couscous', 'couscous_category_123.jpeg', 'Yes', 'Yes'),
(5, 'pastilla', 'pastilla_category_789.jpg', 'Yes', 'Yes'),
(6, 'tajine', 'tagine_Category_456.jpg', 'Yes', 'Yes');


CREATE TABLE tbl_food (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  description text NOT NULL,
  price decimal(10,2) NOT NULL,
  image_name varchar(255) NOT NULL,
  category_id int(10) UNSIGNED NOT NULL,
  featured varchar(10) NOT NULL,
  active varchar(10) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (category_id) REFERENCES tbl_category(id)
);


INSERT INTO tbl_food (id, title, description, price, image_name, category_id, featured, active) VALUES
(3, 'couscous', 'Traditional couscous with vegetables and meat', '15', 'couscous.jpg', 4, 'Yes', 'Yes'),
(4, 'mini_pastilla', 'Mini pastilla with a delicate blend of chicken', '25', 'mini_pastilla.jpg', 5, 'Yes', 'Yes'),
(5, 'pastilla', 'Delicious Moroccan pastilla filled with fresh seafood ', '30', 'pastilla.jpg', 5, 'No', 'Yes'),
(6, 'tagine_berqouq', 'Lamb tajine with prunes and almonds', '30', 'tagine_berqouq.jpg', 6, 'Yes', 'Yes'),
(7, 'tagine_poulet', 'Chicken tajine with olives and preserved lemon.', '30', 'tagine_poulet.jpg', 6, 'Yes', 'Yes'),
(8, 'tajine2', 'Vegetable tajine with green peas', '25', 'tajine2.jpg', 6, 'No', 'No');


CREATE TABLE tbl_order (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  price decimal(10,2) NOT NULL,
  total DECIMAL(10,2) NOT NULL,                                                                                  
  qty int(11) NOT NULL,
  order_date datetime NOT NULL,
  status varchar(50) NOT NULL,
  customer_name varchar(150) NOT NULL,
  customer_contact varchar(20) NOT NULL,
  customer_email varchar(150) NOT NULL,
  customer_city varchar(255) NOT NULL,
  customer_street varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO tbl_order (id, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_city, customer_street) 
VALUES
(1, 30, 3, 90, '2024-12-06 03:49:48', 'Cancelled', 'maryem', '0667893112', 'maryema@gmail.com', 'khouribga', 'nahda'),
(2, 30, 4, 120, '2020-12-09 03:52:43', 'Delivered', 'mohamed', '0612457892', 'mohamedb@gmail.com', 'khenifra', 'masira'),
(3, 15, 2, 30, '2020-12-12 04:07:17', 'Delivered', 'aicha', '0734561863', 'aichaqw@gmail.com', 'casa', 'soltan');

CREATE TABLE tbl_order_food(
  id int AUTO_INCREMENT PRIMARY KEY,
  order_id int(10) UNSIGNED NOT NULL,
  food_id int(10) UNSIGNED NOT NULL,
  FOREIGN KEY (order_id) REFERENCES tbl_order(id),
  FOREIGN KEY (food_id) REFERENCES tbl_food(id)
);

INSERT INTO tbl_order_food (order_id, food_id) 
VALUES
(1, 5),
(2, 6),
(3, 3);