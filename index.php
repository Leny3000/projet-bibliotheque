<?php 
// Inclure les classes nécessaires
require_once 'Livre.php';
require_once 'Roman.php';
require_once 'BandeDessinee.php';
require_once 'Bibliotheque.php';

// Créer une instance de la bibliothèque
$biblio = new Bibliotheque('database.php');

// Charger les livres depuis la base de données
$biblio->chargerLivres();

// Créer quelques livres
$roman1 = new Roman(101, 'Les Misérables', 'Victor Hugo', 1862, true, 'Historique', 1200);
$roman2 = new Roman(102, '1984', 'George Orwell', 1949, true, 'Science-fiction', 328);

$bd1 = new BandeDessinee(201, 'Astérix le Gaulois', 'René Goscinny', 1961, true, 'Albert Uderzo', 'Astérix', 1);
$bd2 = new BandeDessinee(202, 'La Serpe d’Or', 'René Goscinny', 1962, true, 'Albert Uderzo', 'Astérix', 2);
$bd3 = new BandeDessinee(203, 'Tintin au Congo', 'Hergé', 1931, true, 'Hergé', 'Tintin', 2);

// Ajouter les livres à la bibliothèque
$biblio->ajouterLivre($roman1);
$biblio->ajouterLivre($roman2);
$biblio->ajouterLivre($bd1);
$biblio->ajouterLivre($bd2);
$biblio->ajouterLivre($bd3);

// Afficher les informations des livres
echo "<h3>Informations des livres :</h3>";
foreach ([$roman1, $roman2, $bd1, $bd2, $bd3] as $livre) {
    echo $livre->getInfos() . "<br>";
}

// Vérifier si deux BD sont de la même série
echo "<h3>Comparaison de séries :</h3>";
if ($bd1->estDansLaMemeSerieQue($bd2)) {
    echo "{$bd1->getTitre()} et {$bd2->getTitre()} sont dans la même série.<br>";
} else {
    echo "Ils ne sont pas dans la même série.<br>";
}

// Emprunter et retourner des livres
echo "<h3>Emprunt et retour :</h3>";
if ($bd1->emprunter()) {
    echo "{$bd1->getTitre()} a été emprunté.<br>";
}
$bd1->retourner();
echo "{$bd1->getTitre()} a été retourné.<br>";

// Utilisation de foreach pour lister les livres disponibles
echo "<h3>Livres disponibles :</h3>";
$livresDisponibles = $biblio->getLivresDisponibles();
foreach ($livresDisponibles as $livre) {
    echo $livre->getInfos() . "<br>";
}