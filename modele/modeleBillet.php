<?php
require_once 'modele/modele.php';

class ModeleBillet extends Modele
{
    public function lireTout()
    {
        return $this->executerLecture('select * from T_BILLET order by BIL_ID desc');
    }
    
    public function lireUnSeul($id)
    {
        return $this->executerLecture('select * from T_BILLEt where BIL_ID=' .$id, true);
    }
}

