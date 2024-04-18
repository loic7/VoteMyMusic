-- Création de la base de données
CREATE DATABASE IF NOT EXISTS votemymusic;

-- Sélection de la base de données
USE votemymusic;

-- Création de la table utilisateur
CREATE TABLE IF NOT EXISTS utilisateur (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);
