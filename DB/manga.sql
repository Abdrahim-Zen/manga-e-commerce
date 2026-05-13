drop database if exists manga;
create database if not exists manga;
use manga;


create table prodotti(
ID int unsigned primary key auto_increment,
codice varchar(255) not null,
descrizione text,
prezzo decimal(10,2) not null,
creato timestamp default current_timestamp
);

create table figure(
id_figure int unsigned primary key,
nome_personaggio varchar(50),
nome_serie varchar(50),
larghezza decimal(10,2),
altezza decimal(10,2),
foreign key (id_figure) references prodotti(ID)
);

create table carte(
id_carta int unsigned primary key,
brand_carta varchar(50),
foreign key (id_carta) references prodotti(ID)
);

create table manga(
id_manga INT UNSIGNED primary key,
nome varchar(255),
volume INT UNSIGNED,
prezzo DECIMAL(10,2),
categoria VARCHAR(50),
stato ENUM('normale', 'novita', 'in_sconto', 'esaurito','in_arrivo') DEFAULT 'normale',
foreign key (id_manga) references prodotti(ID)
);

create table inventario(
ID int unsigned primary key auto_increment,
prodotto_id int unsigned not null,
quantita int not null default 0,
ultimo_restock date,
foreign key (prodotto_id) references prodotti(ID)
);

create table immagine_prodotti(
prodotto_id int unsigned not null primary key,
image varchar(550) not null,
foreign key (prodotto_id) references prodotti(ID)
);

create table utente(
ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
nome varchar(255),
cognome varchar(255),
email varchar(255) unique not null,
creato timestamp default current_timestamp,
password varchar(255) not null
);

create table indirizzo(
 indirizzo_id int unsigned primary key, 
 via varchar(255) not null,
 civico int not null,
 citta varchar(255) not null,
 telefono int not null,
 foreign key (indirizzo_id) references utente(ID)
);

create table ordini(
ID int unsigned primary key auto_increment,
utente_id int unsigned not null,
data_ordine timestamp default current_timestamp,
indirizzo_consegna int unsigned not null,
stato enum('confermato','cancellato','spedito','consegnato'),
foreign key (utente_id) references utente(ID),
foreign key (indirizzo_consegna) references indirizzo(indirizzo_id)
);


CREATE TABLE IF NOT EXISTS carrello (
    ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    utente_id INT UNSIGNED NOT NULL,
    prodotto_id INT UNSIGNED NOT NULL,
    quantita INT NOT NULL DEFAULT 1,
    aggiunto_il TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utente_id) REFERENCES utente(ID),
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(ID)
);




create table Amministratore(
ID INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
nome varchar(255),
cognome varchar(255),
email varchar(255),
password varchar(255)
)

