<?php 

class BandeDessinee extends Livre {
    private $dessinateur;
    private $serie;
    private $tome;

    // Constructeur (optionnel mais utile)
    public function __construct($id, $titre, $auteur, $disponible, $dessinateur, $serie, $tome) {
        parent::__construct($id, $titre, $auteur, $disponible);
        $this->dessinateur = $dessinateur;
        $this->serie = $serie;
        $this->tome = $tome;
    }

    // Getters
    public function getDessinateur() {
        return $this->dessinateur;
    }

    public function getSerie() {
        return $this->serie;
    }

    public function getTome() {
        return $this->tome;
    }

    // Setters
    public function setDessinateur($dessinateur) {
        $this->dessinateur = $dessinateur;
    }

    public function setSerie($serie) {
        $this->serie = $serie;
    }

    public function setTome($tome) {
        $this->tome = $tome;
    }

    // Méthodes
    public function estDansLaMemeSerieQue($autreBD){
        // Vérifie que l'autre objet est bien une BandeDessinee
        if (!$autreBD instanceof BandeDessinee) {
            return false;
        }

        // Compare les noms de série (insensible à la casse)
        return strcasecmp($this->serie, $autreBD->getSerie()) === 0;
    }
}