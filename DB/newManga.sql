DROP DATABASE IF EXISTS manga;
CREATE DATABASE IF NOT EXISTS manga;
USE manga;

-- ==========================================
-- 1. GESTIONE UTENTI (Modello Obbligatorio)
-- ==========================================

CREATE TABLE users (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255),
    cognome VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    creato TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE gruppo (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL -- es. 'admin', 'cliente'
);

CREATE TABLE users_has_groups (
    users_id INT UNSIGNED NOT NULL,
    groups_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (users_id, groups_id),
    FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (groups_id) REFERENCES gruppo(id) ON DELETE CASCADE
);

CREATE TABLE services (
    username VARCHAR(50) PRIMARY KEY -- Nome dello script/azione (es. 'aggiungi_prodotto')
);

CREATE TABLE services_has_groups (
    services_username VARCHAR(50) NOT NULL,
    groups_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (services_username, groups_id),
    FOREIGN KEY (services_username) REFERENCES services(username) ON DELETE CASCADE,
    FOREIGN KEY (groups_id) REFERENCES gruppo(id) ON DELETE CASCADE
);

-- ==========================================
-- 2. CATALOGO PRODOTTI
-- ==========================================

CREATE TABLE prodotti (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    codice VARCHAR(255) NOT NULL,
    descrizione TEXT,
    prezzo DECIMAL(10, 2) NOT NULL,
    creato TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE figure (
    id_figure INT UNSIGNED PRIMARY KEY,
    nome_personaggio VARCHAR(50),
    nome_serie VARCHAR(50),
    larghezza DECIMAL(10, 2),
    altezza DECIMAL(10, 2),
    FOREIGN KEY (id_figure) REFERENCES prodotti (ID) ON DELETE CASCADE
);

CREATE TABLE carta (
    id_carta INT UNSIGNED PRIMARY KEY,
    brand_carta VARCHAR(50),
    FOREIGN KEY (id_carta) REFERENCES prodotti (ID) ON DELETE CASCADE
);

CREATE TABLE manga (
    id_manga INT UNSIGNED PRIMARY KEY,
    nome VARCHAR(255),
    volume INT UNSIGNED,
    prezzo DECIMAL(10, 2), -- Nota: potresti ometterlo se usi il prezzo della tabella 'prodotti'
    categoria VARCHAR(255),
    stato ENUM('normale', 'novita', 'in_sconto', 'esaurito', 'in_arrivo') DEFAULT 'normale',
    FOREIGN KEY (id_manga) REFERENCES prodotti (ID) ON DELETE CASCADE
);

CREATE TABLE inventario (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    prodotto_id INT UNSIGNED NOT NULL,
    quantita INT NOT NULL DEFAULT 0,
    ultimo_restock DATE,
    FOREIGN KEY (prodotto_id) REFERENCES prodotti (ID) ON DELETE CASCADE
);

CREATE TABLE immagine_prodotti (
    prodotto_id INT UNSIGNED NOT NULL PRIMARY KEY,
    image VARCHAR(550) NOT NULL,
    FOREIGN KEY (prodotto_id) REFERENCES prodotti (ID) ON DELETE CASCADE
);

-- ==========================================
-- 3. INTEGRAZIONI E-COMMERCE (Per arrivare a 18 tabelle)
-- ==========================================

CREATE TABLE categorie (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome_categoria VARCHAR(100) NOT NULL,
    descrizione TEXT
);

CREATE TABLE prodotti_has_categorie (
    prodotto_id INT UNSIGNED NOT NULL,
    categoria_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (prodotto_id, categoria_id),
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(ID) ON DELETE CASCADE,
    FOREIGN KEY (categoria_id) REFERENCES categorie(ID) ON DELETE CASCADE
);

CREATE TABLE recensioni (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    utente_id INT UNSIGNED NOT NULL,
    prodotto_id INT UNSIGNED NOT NULL,
    voto INT CHECK (voto BETWEEN 1 AND 5),
    commento TEXT,
    data_recensione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utente_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(ID) ON DELETE CASCADE
);

CREATE TABLE metodi_pagamento (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nome_metodo VARCHAR(50) NOT NULL -- es. 'PayPal', 'Carta di Credito', 'Bonifico'
);

-- ==========================================
-- 4. ORDINI E UTENTI
-- ==========================================

CREATE TABLE indirizzo (
    indirizzo_id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
    utente_id INT UNSIGNED NOT NULL, -- Modificato per legarlo correttamente
    via VARCHAR(255) NOT NULL,
    civico INT NOT NULL,
    citta VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL, -- Cambiato a VARCHAR per gestire i prefissi
    FOREIGN KEY (utente_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE ordini (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    utente_id INT UNSIGNED NOT NULL,
    metodo_pagamento_id INT UNSIGNED NOT NULL, -- Aggiunto per collegare il pagamento
    data_ordine TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    indirizzo_consegna INT UNSIGNED NOT NULL,
    FOREIGN KEY (utente_id) REFERENCES users(id),
    FOREIGN KEY (metodo_pagamento_id) REFERENCES metodi_pagamento(ID),
    FOREIGN KEY (indirizzo_consegna) REFERENCES indirizzo(indirizzo_id)
);

CREATE TABLE dettagli_ordine (
    ordine_id INT UNSIGNED NOT NULL,
    prodotto_id INT UNSIGNED NOT NULL,
    quantita INT NOT NULL,
    prezzo_unitario_venduto DECIMAL(10,2) NOT NULL, 
    PRIMARY KEY (ordine_id, prodotto_id),
    FOREIGN KEY (ordine_id) REFERENCES ordini(ID) ON DELETE CASCADE,
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(ID)
);

CREATE TABLE IF NOT EXISTS carrello (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    utente_id INT UNSIGNED NOT NULL,
    prodotto_id INT UNSIGNED NOT NULL,
    quantita INT NOT NULL DEFAULT 1,
    aggiunto_il TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utente_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(ID) ON DELETE CASCADE
);