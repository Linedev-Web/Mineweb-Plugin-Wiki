<?php
class LwikiController extends LwikiAppController{

    public function index(){
        $this->loadModel('Lwiki.Types');

        //Appel de la fonction présent dans notre modèle.
        $datas = $this->Info->get();

        $this->set(compact('datas'));
    }
}