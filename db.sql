-- Création de la base de données
CREATE DATABASE IF NOT EXISTS votemymusic;

-- Sélection de la base de données
USE votemymusic;

-- Création de la table utilisateur
CREATE TABLE utilisateur (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
    UNIQUE KEY unique_utilisateur (nom, prenom, email)
);

CREATE TABLE Musiques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    artiste VARCHAR(255) NOT NULL,
    lien VARCHAR(255) NOT NULL
);
-- Ajouter les colonnes likes et dislikes à la table Musiques
ALTER TABLE Musiques
ADD COLUMN likes INT DEFAULT 0,
ADD COLUMN dislikes INT DEFAULT 0;

ALTER TABLE Musiques
DROP COLUMN lien,
ADD COLUMN fichier BLOB;

ALTER TABLE Musiques MODIFY fichier MEDIUMBLOB;


CREATE TABLE contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    message VARCHAR(500) NOT NULL
);


CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_place ENUM('basique', 'handicape', 'vip') NOT NULL,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    UNIQUE KEY unique_reservation (nom, prenom, email), -- Empêche une personne de réserver plusieurs places
    FOREIGN KEY (nom, prenom, email) REFERENCES utilisateur(nom, prenom, email) ON UPDATE CASCADE ON DELETE CASCADE -- Clé étrangère pour les informations de l'utilisateur
);

CREATE TABLE place_disponible (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_place ENUM('basique', 'handicape', 'vip') NOT NULL,
    nombre_places_disponibles INT NOT NULL
);

INSERT INTO place_disponible (type_place, nombre_places_disponibles) VALUES 
('basique', 100),
('handicape', 50),
('vip', 20);

