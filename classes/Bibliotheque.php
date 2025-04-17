<?php

class Bibliotheque {
    private $pdo;
    private $livres = [];

    public function __construct($configFile) {
        // Charger la configuration de la base de données
        $config = require $configFile;

        // Connexion à la base de données
        try {
            echo "Connexion à la base de données réussie.<br>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function ajouterLivre($livre) {
        // Déterminer le type de livre
        $type = get_class($livre);

        // Préparer l'insertion dans la base de données
        $stmt = $this->pdo->prepare(
            "INSERT INTO livres (titre, auteur, disponible, type) VALUES (titre, auteur, disponible, type)");
        $stmt->execute([
            'titre' => $livre->titre,
            'auteur' => $livre->auteur,
            'disponible' => $livre->disponible ? 1 : 0,
            'type' => $type
        ]);

        echo "Livre ajouté : $livre->titre <br>";
    }

    public function emprunterLivre($id) {
        // Utiliser le foreach
        foreach ($this->livres as $livre) {
            if ($livre->id == $id && $livre->disponible) {
                $livre->disponible = false;

                // Mettre à jour la base de données
                $stmt = $this->pdo->prepare("UPDATE livres SET disponible = 0 WHERE id = :id");
                $stmt->execute(['id' => $id]);

                echo "Livre emprunté : $livre->titre <br>";
                return;
            }
        }

        echo "Livre non disponible ou introuvable.<br>";
    }

    public function retournerLivre($id) {
        // Mettre à jour la base de données
        foreach ($this->livres as $livre) {
            if ($livre->id == $id && !$livre->disponible) {
                $livre->disponible = true;

                $stmt = $this->pdo->prepare("UPDATE livres SET disponible = 1 WHERE id = :id");
                $stmt->execute(['id' => $id]);

                echo "Livre retourné : $livre->titre <br>";
                return;
            }
        }

        echo "Livre introuvable ou déjà disponible.<br>";
    }

    public function getLivresDisponibles() {
        $livresDisponibles = [];

        // Utiliser le foreach
        foreach ($this->livres as $livre) {
            if ($livre->disponible) {
                $livresDisponibles[] = $livre;
            }
        }

        return $livresDisponibles;
    }

    public function getLivresParAuteur($auteur) {
        $livresAuteur = [];

        // Utiliser le foreach
        foreach ($this->livres as $livre) {
            if (strcasecmp($livre->auteur, $auteur) === 0) {
                $livresAuteur[] = $livre;
            }
        }

        return $livresAuteur;
    }

    public function chargerLivres() {
        $sql = "SELECT * FROM livres";

        $stmt = $this->pdo->query($sql);
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Utiliser le foreach
        foreach ($resultats as $row) {
            // Créer l'objet correspondant selon le type
            switch ($row['type']) {
                case 'Roman':
                    $livre = new Roman($row['id'], $row['titre'], $row['auteur'], $row['disponible']);
                    break;
                case 'Magazine':
                    $livre = new Magazine($row['id'], $row['titre'], $row['auteur'], $row['disponible']);
                    break;
                default:
                    $livre = new Livre($row['id'], $row['titre'], $row['auteur'], $row['disponible']);
                    break;
            }

            $this->livres[] = $livre;
        }

        echo "Chargement de " . count($this->livres) . " livres terminé.<br>";
    }
}