<?php 
class Livre {
    protected $id;
    protected $titre;
    protected $auteur;
    protected $anneePublication;
    protected $disponible;

    public function __construct($id, $titre, $auteur, $anneePublication, $disponible = true) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
        $this->disponible = $disponible;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getAnneePublication() {
        return $this->anneePublication;
    }

    public function estDisponible() {
        return $this->disponible;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function setAnneePublication($annee) {
        $this->anneePublication = $annee;
    }

    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }

    // Méthodes
    public function getInfos() {
        return "Titre : {$this->titre}, Auteur : {$this->auteur}, Année : {$this->anneePublication}, " .
               "Disponible : " . ($this->disponible ? 'Oui' : 'Non');
    }

    public function emprunter() {
        if ($this->disponible) {
            $this->disponible = false;
            return true;
        }
        return false;
    }

    public function retourner() {
        $this->disponible = true;
    }
}