<?php
require_once 'modele/modeleBillet.php';
require_once 'modele/modeleCommentaire.php';

abstract class Controleur
{  
    protected function genererVue($vue, $donnees) {
        $fichierVue = 'vue/' .$vue. '.php';
        if (file_exists($fichierVue)) {
            extract($donnees);
            require $fichierVue;
        }
        else
            throw new Exception("Fichier $fichierVue non trouvé");
    }
    
    protected function afficherErreur($msgErreur) {
        require 'vue/erreur.php';
    }
}