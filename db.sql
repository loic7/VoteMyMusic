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
