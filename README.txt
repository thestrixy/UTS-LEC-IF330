=== UTSPEMWEBLEC ===
Uts Web Programming Lecture Website Online Shop Restaurant

Link: https://saporous-retrievals.000webhostapp.com/

Kode Reff (admin): admin123

NAMA DATABASE : utswebproglec

=== TABEL ===

TABEL ms_user: 
CREATE TABLE ms_user (id INT NOT NULL AUTO_INCREMENT , namadepan VARCHAR(100) NOT NULL , namabelakang VARCHAR(100) NOT NULL , tanggalLahir DATE NOT NULL , gender VARCHAR(20) NOT NULL , username VARCHAR(100) NOT NULL , password VARCHAR(150) NOT NULL , is_admin BOOLEAN NOT NULL , PRIMARY KEY (id), UNIQUE (username)) ENGINE = InnoDB COMMENT = 'Tabel Username';

Tabel menu: 
CREATE TABLE menu (idmenu INT NOT NULL AUTO_INCREMENT , jenismenu VARCHAR(20) NOT NULL , namamenu VARCHAR(100) NOT NULL , deskripsi TEXT NOT NULL , harga INT NOT NULL , foto VARCHAR(100) NOT NULL , PRIMARY KEY (idmenu)) ENGINE = InnoDB COMMENT = 'Menu';

Tabel order: 
CREATE TABLE `order` (id INT NOT NULL , idmenu INT NOT NULL , jumlahpesanan INT NOT NULL , hargatotal INT NOT NULL, PRIMARY KEY (id,idmenu), FOREIGN KEY (id) REFERENCES ms_user(id), FOREIGN KEY (idmenu) REFERENCES menu(idmenu)) ENGINE = InnoDB COMMENT = 'Order';

=== Insert Data ===
INSERT INTO menu(jenismenu, namamenu, deskripsi, harga, foto) VALUES 
('Appetizer', 'Rujak Cingur', 'Rujak khas Surabaya', '18000', 'rujak cingur.png'),
('Appetizer', 'Sate Taichan', 'Sate ditusuk', '25000', 'sate taichan.png'),
('Appetizer', 'Siomay Bandung', 'Siomay khas Bandung', '15000', 'siomay bandung.png'),
('Appetizer', 'Bakwan Jagung', 'Bakwan make jagung', '10000', 'bakwan jagung.png'),
('Appetizer', 'Lumpia Semarang', 'Lumpia goreng khas semarang', '15000', 'lumpia.png'),
('Appetizer', 'Tahu Bakso', 'Tahu sama Bakso', '15000', 'tahu bakso.png'),
('Main course', 'Ayam Goreng', 'Ayam digoreng tepung', '17000', 'ayam goreng.png'),
('Main course', 'Ayam Kremes', 'Ayam pake kremesan', '20000', 'ayam kremes.png'),
('Main course', 'Rendang', 'Rendang padang', '20000', 'rendang.png'),
('Main course', 'Soto Ayam', 'Soto', '12000', 'soto ayam.png'),
('Main course', 'Nasi Goreng', 'Nasi digoreng', '20000', 'nasi goreng.png'),
('Main course', 'Mie Goreng', 'Mie digoreng', '18000', 'mie goreng.png'),
('Drink', 'Es jeruk', 'Es dicampur jeruk', '8000', 'es jeruk.png'),
('Drink', 'Es teh', 'Es sama teh', '5000', 'es teh.png'),
('Drink', 'Jus Alpukat', 'Alpukat di jus', '15000', 'jus alpukat.png'),
('Drink', 'Es campur', 'Es dicampur', '15000', 'es camput.png'),
('Drink', 'Kopi Orang Kaya', 'Kopi 80K', '80000', 'kopi tubruk.png'),
('Drink', 'Milk Shake', 'Susu kocok', '15000', 'milk shake.png'),
('Dessert', 'Dadar gulung', 'Dadar digulung', '12000', 'dadar gulung.png'),
('Dessert', 'Es durian', 'Es dicampur durian', '15000', 'es durian.png'),
('Dessert', 'Klepon', 'Klepon isi gula merah', '8000', 'klepon.png'),
('Snack', 'Kentang Goreng', 'Kentang digoreng', '12000', 'kentang goreng.png'),
('Snack', 'Mendoan', 'Tempe Mendoan', '6500', 'mendoan.png'),
('Snack', 'Perkedel', 'Kentang jadi perkedel', '7000', 'perkedel.png');
