-- Crée la base de données
CREATE DATABASE IF NOT EXISTS 'bibliotheque' CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE 'bibliotheque';

-- Table principale pour tous les livres
CREATE TABLE IF NOT EXISTS 'livres' (
    'id' INT AUTO_INCREMENT PRIMARY KEY,
    'titre' VARCHAR(255) NOT NULL,
    'auteur' VARCHAR(255) NOT NULL,
    'annee_publication' INT,
    'disponible' BOOLEAN DEFAULT TRUE,
    'type' VARCHAR(50) NOT NULL -- "Roman", "BandeDessinee", etc.
);

-- Table pour les romans
CREATE TABLE IF NOT EXISTS 'romans' (
    'livre_id' INT PRIMARY KEY,
    'genre' VARCHAR(100),
    'nombre_pages' INT,
    FOREIGN KEY ('livre_id') REFERENCES 'livres'(id) ON DELETE CASCADE
);

-- Table pour les bandes dessinées
CREATE TABLE IF NOT EXISTS 'bandes_dessinees' (
    'livre_id' INT PRIMARY KEY,
    'dessinateur' VARCHAR(255),
    'serie' VARCHAR(255),
    'tome' INT,
    FOREIGN KEY ('livre_id') REFERENCES 'livres'(id) ON DELETE CASCADE
);