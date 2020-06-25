<?php

class LconfigController extends LwikiAppController
{

    public function admin_index()
    {

        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';
            $this->loadModel('Lwiki.Lconfig');
            $config = $this->Lconfig->get();
            $this->set(compact('config'));
        } else {
            $this->redirect('/');
        }
    }
}