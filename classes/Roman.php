<?php

class Roman extends Livre {
    private $genre;
    private $nombrePages;

    // Constructeur (utile si tu veux instancier directement un Roman)
    public function __construct($id, $titre, $auteur, $anneePublication, $disponible, $genre, $nombrePages) {
        parent::__construct($id, $titre, $auteur, $anneePublication, $disponible);
        $this->genre = $genre;
        $this->nombrePages = $nombrePages;
    }

    // Getters
    public function getGenre() {
        return $this->genre;
    }

    public function getNombrePages() {
        return $this->nombrePages;
    }

    // Setters
    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function setNombrePages($nombrePages) {
        $this->nombrePages = $nombrePages;
    }

    // Méthodes
    public function getInfos() {
        echo parent::getInfos() . ", Genre : $this->genre, Pages : $this->nombrePages";
    }

    public function tempsLecture() {
        // Estimation du temps de lecture (2 pages par minute)
        if ($this->nombrePages > 0) {
            $minutes = ceil($this->nombrePages / 2);
            echo "Temps de lecture estimé : $minutes minutes";
        } else {
            echo "Nombre de pages invalide.";
        }
    }
}