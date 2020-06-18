<?php
class WikiController extends WikiAppController{

    public function index(){

        // Chargement du Model Tutorial
        $this->loadModel('Wiki.Info');

        //On enregistre dans $datas le contenu de toute la table Wiki
        $datas = $this->Info->find('all');

        //On passe la variable à la vue afin de pouvoir la réutiliser dans index.ctp
        $this->set(compact('datas'));

        //Pour passer plusieurs variable à la vue :
        //$this->set(compact('datas', 'variable', 'infos'));

        //Pour donner un titre à votre page : Dans le html <title> Titre <title>
        $this->set('title_for_layout', 'Titre');
    }

    public function admin_index(){
        if($this->isConnected AND $this->User->isAdmin()){
            $this->loadModel('Wiki.Info');

            //Si la requete est de type ajax
            if($this->request->is('ajax')){
                $this->autoRender = null;

                //Je récupère le champs name="pseudo"
                $pseudo = $this->request->data['pseudo'];
                $date = date('Y-m-d H:i:s');

                $this->Info->add($pseudo, $date);

                //Envoi réponse en ajax
                $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));
            }else{
                //Je déclare le thème du panel admin
                $this->layout = 'admin';

                //Je récupère les données de ma base.
                $datas = $this->Info->get();

                $this->set(compact('datas'));
            }
        }else {
            $this->redirect('/');
        }
    }

    public function admin_delete($id){
        if($this->isConnected AND $this->User->isAdmin()){
            $this->autoRender = null;

            $this->loadModel('Wiki.Info');

            //J'utilise _delete() car delete() existe déjà avec cakephp
            $this->Info->_delete($id);

            //Redirection vers notre page
            $this->redirect('/admin/wiki');
        }else {
            $this->redirect('/');
        }
    }

    public function tips(){
        $this->autoRender = null;
        $this->layout = null;

        var_dump('Est connecté : ', $this->isConnected);
        echo "<br />";

        var_dump('Argument courant : ', $this->request->{'here'});
        echo "<br />";

        $this->loadModel('User');
        var_dump('Email de l\'utilisateur en cours : ', $this->User->getFromUser('email', $_SESSION['user']));
        echo "<br />";

        var_dump('Money de l\'utilisateur en cours : ', $this->User->getFromUser('money', $_SESSION['user']));
        echo "<br />";

        var_dump('Thème actuel : ', $this->theme);
        echo "<br />";

        echo 'Requête en get ? ';
        echo ($this->request->is('get')) ? 'Oui' : 'Non';
        echo "<br />";

        echo 'Requête en post ? ';
        echo ($this->request->is('post')) ? 'Oui' : 'Non';
        echo "<br />";

        echo 'Requête en ajax ? ';
        echo ($this->request->is('ajax')) ? 'Oui' : 'Non';
        // Juste pour avoir 100 lignes :P
    }
}