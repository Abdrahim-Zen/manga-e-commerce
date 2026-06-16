use manga;
INSERT INTO gruppo (id, nome) VALUES (1, 'admin'), (2, 'cliente');
INSERT INTO services (username) VALUES ('dashboard'), ('catalogo'), ('checkout'), ('gestione_utenti');

INSERT INTO services_has_groups (services_username, groups_id) VALUES 
('dashboard', 1), ('gestione_utenti', 1), ('catalogo', 1), ('checkout', 1),
('catalogo', 2), ('checkout', 2);


INSERT INTO users (id, nome, cognome, email, password) VALUES
(1, 'Abdrahim', 'Zeno', 'abra@gmail.com', '0000'),
(2, 'Admin', 'Sito', 'admin@gmail.com', '0000');

INSERT INTO users_has_groups (users_id, groups_id) VALUES (1, 2), (2, 1);


INSERT INTO categorie (id, nome_categoria) VALUES (1, 'Manga'), (2, 'Figure'), (3, 'Carte');


INSERT INTO prodotti (id, codice, descrizione, prezzo) VALUES
(1, 'FIG001', 'Figure Naruto Uzumaki - Edizione Limitata', 89.99),
(2, 'FIG002', 'Figure Sasuke Uchiha - Versione Battle', 79.99),
(3, 'CARD001', 'Carta Pokémon Charizard - First Edition', 149.99),
(4, 'CARD002', 'Carta Yu-Gi-Oh! Blue Eyes White Dragon', 129.99),
(5, 'MANG001', 'Boruto Volume 46', 9.99),
(6, 'MANG002', 'One Piece Volume 1', 9.99),
(7, 'FIG003', 'Figure Goku Super Saiyan', 99.99),
(8, 'CARD003', 'Carta Pokémon Pikachu Illustrator', 199.99),
(9, 'MANG003', 'Attack on Titan Volume 1', 12.99),
(10, 'MANG004', 'Gachiakuta 1', 12.99),
(11, 'MANG005', 'Jujutsu Kaisen 11', 11.99),
(12, 'MANG006', 'Dandadan 11', 14.99),
(13, 'FIG004', 'Figure Luffy Gear Fourth', 89.99);

-- ==========================================
-- 2. ASSOCIAZIONE CATEGORIE (Tabella di Relazione)
-- ==========================================
-- Ipotizziamo: 1=Manga, 2=Figure, 3=Carte (come da insert precedenti)
INSERT INTO prodotti_has_categorie (prodotto_id, categoria_id) VALUES 
(1, 2), (2, 2), (7, 2), (13, 2), -- Tutte le Figure
(3, 3), (4, 3), (8, 3),          -- Tutte le Carte
(5, 1), (6, 1), (9, 1), (10, 1), (11, 1), (12, 1); -- Tutti i Manga





INSERT INTO manga (id_manga, nome, volume, prezzo, categoria,stato) VALUES
(5, 'Boruto', 46, 9.99, 'Shonen','novita'),
(6, 'One Piece', 1, 9.99, 'Shonen',default),
(9, 'Attack on Titan', 1, 12.99, 'Seinen',default),
(10,'Gachiakuta ',1,12.99,'Shonen','novita'),
(11,'Jujutsu Kaisen',11,11.99,'Shonen','novita'),
(12,'Dandadan',11,14.99,'Seinen','novita');


INSERT INTO immagine_prodotti (prodotto_id, image) VALUES
(10, '/img/manga/gachiakuta1.JPG'),
(11, '/img/manga/jjk11.JPG'),
(12, '/img/manga/Dandadan1.JPG'),
(5, '/img/manga/boruto46.JPG');



INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES
(1, 10, '2024-01-15'), (2, 8, '2024-01-10'), (3, 3, '2024-01-05'),
(4, 5, '2024-01-08'), (5, 25, '2024-01-20'), (6, 30, '2024-01-18'),
(7, 12, '2024-01-12'), (8, 2, '2024-01-03'), (9, 18, '2024-01-22'),
(10, 7, '2024-01-14'), (11, 2, '2024-01-03'), (12, 18, '2024-01-22'),
(13, 7, '2024-01-14');

INSERT INTO metodi_pagamento (nome_metodo) VALUES ('PayPal'), ('Carta di Credito');
INSERT INTO indirizzo (utente_id, via, civico, citta, telefono) VALUES (1, 'Via Leopardi', 22, 'Firenze', '3451234567');

