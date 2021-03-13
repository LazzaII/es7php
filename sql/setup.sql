DROP DATABASE IF EXISTS es7php;
CREATE DATABASE es7php;
USE es7php;

CREATE TABLE fornitore (
    id INT NOT NULL,
    nome VARCHAR(45) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE prodotto (
    id INT NOT NULL,
    nome VARCHAR(45) NOT NULL,
    fornitore INT NOT NULL,
    prezzo FLOAT NOT NULL,
    disponibilita FLOAT NOT NULL,
    tipo VARCHAR(45) NOT NULL,
    urlImg VARCHAR(1000) NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fornitoreProdotto FOREIGN KEY(fornitore)
        REFERENCES fornitore(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE utente (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    cognome VARCHAR(45) NOT NULL,  
    email VARCHAR(45) NOT NULL,
    HASHpassword VARCHAR(512) NOT NULL,
    PRIMARY KEY (id)
);
