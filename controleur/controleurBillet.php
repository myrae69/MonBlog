<?php
require_once 'Modele/ModeleBillet.php';
require_once 'Modele/ModeleCommentaire.php';
require_once 'controleur/controleur.php';


class ControleurBillet extends Controleur {

    private $modeleBillet;
    private $modeleCommentaire;

    public function __construct() {
        $this->modeleBillet = new ModeleBillet();
        $this->modeleCommentaire = new ModeleCommentaire();
    }

    public function listerBillets() {
        $resultats = $this->modeleBillet->lireTout();
        $billets = $resultats->fetchAll();
        foreach ($billets as &$billet) {
            $resultatsCom = $this->modeleCommentaire->compter($billet['BIL_ID']);
            $billet['NB_COM'] = $resultatsCom['NB_COM'];
        }
        $lienBillet = "index.php?action=afficherBillet&id=";
        $this->genererVue('listeBillets', 
                array('billets' => $billets, 'lienBillet' => $lienBillet));
    }

    public function afficherBillet($id)
    {
        $billet = $this->modeleBillet->lireUnSeul($id);
        $commentaires = $this->modeleCommentaire->lire($id);
        $this->genererVue('detailsBillet', 
                array('billet' => $billet, 'commentaires' => $commentaires));
    }

    public function ajouterCommentaire($auteur, $commentaire, $idBillet) {
        $this->modeleCommentaire->ajouter($auteur, $commentaire, $idBillet);
        $this->afficherBillet($idBillet);
    }

}