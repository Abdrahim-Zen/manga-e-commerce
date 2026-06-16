
use manga;
-- Popola la tabella prodotti
INSERT INTO prodotti (codice, descrizione, prezzo) VALUES
('FIG001', 'Figure Naruto Uzumaki - Edizione Limitata', 89.99),
('FIG002', 'Figure Sasuke Uchiha - Versione Battle', 79.99),
('CARD001', 'Carta Pokémon Charizard - First Edition', 149.99),
('CARD002', 'Carta Yu-Gi-Oh! Blue Eyes White Dragon', 129.99),
('MANG001', 'Boruto Volume 46', 9.99),
('MANG002', 'One Piece Volume 1', 9.99),
('FIG003', 'Figure Goku Super Saiyan', 99.99),
('CARD003', 'Carta Pokémon Pikachu Illustrator', 199.99),
('MANG003', 'Attack on Titan Volume 1', 12.99),
('MANG004', 'Gachiakuta 1', 12.99),
('MANG005', 'Jujutsu Kaisen 11', 11.99),
('MANG006', 'Dandadan 11', 14.99),
('FIG004', 'Figure Luffy Gear Fourth', 89.99);

-- Popola la tabella figure
INSERT INTO figure (id_figure, nome_personaggio, nome_serie, larghezza, altezza) VALUES
(1, 'Naruto Uzumaki', 'Naruto', 15.5, 25.0),
(2, 'Sasuke Uchiha', 'Naruto', 14.0, 24.5),
(7, 'Goku', 'Dragon Ball Z', 16.0, 28.0),
(10, 'Monkey D. Luffy', 'One Piece', 14.5, 26.0);

-- Popola la tabella carte
INSERT INTO carta (id_carta, brand_carta) VALUES
(3, 'Pokémon'),
(4, 'Yu-Gi-Oh!'),
(8, 'Pokémon');

-- Popola la tabella manga
INSERT INTO manga (id_manga, nome, volume, prezzo, categoria,stato) VALUES
(5, 'Boruto', 46, 9.99, 'Shonen','novita'),
(6, 'One Piece', 1, 9.99, 'Shonen',default),
(9, 'Attack on Titan', 1, 12.99, 'Seinen',default),
(10,'Gachiakuta ',1,12.99,'Shonen','novita'),
(11,'Jujutsu Kaisen',11,11.99,'Shonen','novita'),
(12,'Dandadan',11,14.99,'Seinen','novita');
-- immagine manga
INSERT INTO immagine_prodotti(prodotto_id,image) VALUES
('10', '/img/manga/gachiakuta1.JPG'),
('12', '/img/manga/Dandadan1.JPG'),
('11', '/img/manga/jjk11.JPG'),
('5', '/img/manga/boruto46.JPG');


-- Popola la tabella inventario
INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES
(1, 10, '2024-01-15'),
(2, 8, '2024-01-10'),
(3, 3, '2024-01-05'),
(4, 5, '2024-01-08'),
(5, 25, '2024-01-20'),
(6, 30, '2024-01-18'),
(7, 12, '2024-01-12'),
(8, 2, '2024-01-03'),
(9, 18, '2024-01-22'),
(10, 7, '2024-01-14');

-- Popola la tabella utente
INSERT INTO utente (nome, cognome, email, password) VALUES
('Mario', 'Rossi', 'mario.rossi@email.com', 'hashed_password_1'),
('Laura', 'Bianchi', 'laura.bianchi@email.com', 'hashed_password_2'),
('Luca', 'Verdi', 'luca.verdi@email.com', 'hashed_password_3'),
('Giulia', 'Neri', 'giulia.neri@email.com', 'hashed_password_4');

-- Popola la tabella indirizzo


-- Popola la tabella ordini


