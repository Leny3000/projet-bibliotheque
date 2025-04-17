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
    'type' ENUM ('livre, roman, BandeDessinee') NOT NULL -- "Roman", "BandeDessinee", etc.
    'genre' VARCHAR(100) NULL,
    'nombre_pages' INT NULL,
    'serie' VARCHAR(255) NULL,
    'tome' INT NULL,
);