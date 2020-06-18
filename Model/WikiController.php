<?php
class WikiController extends WikiAppController{

    public function index(){
        $this->loadModel('Wiki.Info');

        //Appel de la fonction présent dans notre modèle.
        $datas = $this->Info->get();

        $this->set(compact('datas'));
    }
}