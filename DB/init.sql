use manga;
INSERT INTO gruppo (id, nome) VALUES (1, 'admin'), (2, 'cliente');
INSERT INTO services (username) VALUES ('dashboard'), ('catalogo'), ('checkout'), ('gestione_utenti');

INSERT INTO services_has_groups (services_username, groups_id) VALUES 
('dashboard', 1), ('gestione_utenti', 1), ('catalogo', 1), ('checkout', 1),
('catalogo', 2), ('checkout', 2);


INSERT INTO users (id, nome, cognome, email, password) VALUES
(1, 'Admin', 'Sito', 'admin@gmail.com', '$2y$10$5Jh7EEl9C87nlb95abdmI.GUFVxkOgghcVX4DTxfGiN9Snx0pDVxS');

INSERT INTO users_has_groups (users_id, groups_id) VALUES (1, 1);


INSERT INTO categorie (id, nome_categoria) VALUES (1, 'Manga'), (2, 'Figure'), (3, 'Carte');


INSERT INTO prodotti (id, codice, descrizione, prezzo) VALUES

(1, 'MANG001', 'Boruto Volume 46', 9.99),
(2, 'MANG004', 'Gachiakuta 1', 12.99),
(3, 'MANG005', 'Jujutsu Kaisen 11', 11.99),
(4, 'MANG006', 'Dandadan 11', 14.99);


INSERT INTO prodotti_has_categorie (prodotto_id, categoria_id) VALUES 
(1, 1), (2, 1), (3, 1), (4, 1); 



INSERT INTO manga (id_manga, nome, volume, prezzo, categoria,stato) VALUES
(1, 'Boruto', 46, 9.99, 'Shonen','novita'),
(2,'Gachiakuta ',1,12.99,'Shonen','novita'),
(3,'Jujutsu Kaisen',11,11.99,'Shonen','novita'),
(4,'Dandadan',11,14.99,'Seinen','novita');


INSERT INTO immagine_prodotti (prodotto_id, image) VALUES
(2, 'img/manga/gachiakuta1.JPG'),
(3, 'img/manga/jjk11.JPG'),
(4, 'img/manga/Dandadan1.JPG'),
(1, 'img/manga/boruto46.JPG');



INSERT INTO inventario (prodotto_id, quantita, ultimo_restock) VALUES
(1, 10, '2024-01-15'), (2, 8, '2024-01-10'), (3, 3, '2024-01-05'),
(4, 5, '2024-01-08');

INSERT INTO metodi_pagamento (nome_metodo) VALUES ('PayPal'), ('Carta di Credito');
INSERT INTO indirizzo (utente_id, via, civico, citta, telefono) VALUES (1, 'Via Leopardi', 22, 'Firenze', '3451234567');

