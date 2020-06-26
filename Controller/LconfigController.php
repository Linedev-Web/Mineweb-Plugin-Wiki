<?php

class LconfigController extends LwikiAppController
{

    public function admin_index()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';
            $this->loadModel('Lwiki.Lconfig');
            $this->loadModel('Lwiki.Lcolor');
            $config = $this->Lconfig->get();
            $color = $this->Lcolor->get();
            if ($config[0] && $color[0]) {
                $config = $config[0]['Lconfig'];
                $color = json_decode($color[0]['Lcolor']['color'], true);
                $this->set(compact('config', 'color'));

            }
        } else {
            $this->redirect('/');
        }
    }

    public function admin_edit_info()
    {
        $this->autoRender = null;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {
                $this->loadModel('Lwiki.Lconfig');

                $this->Lconfig->set($this->request->data);
                if ($this->Lconfig->validates()) {

                    $title = $this->request->data('title');
                    $content = $this->request->data('content');
                    $this->Lconfig->edit($title, $content);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('SHOP__CATEGORY_EDIT_SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Lconfig->validationErrors))));
                }
            } else {
                $this->redirect('/');
            }
        }
    }

    public function admin_edit_color()
    {
        $this->autoRender = null;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {
                $this->loadModel('Lwiki.Lconfig');
                $this->loadModel('Lwiki.Lcolor');
                $this->Lcolor->set($this->request->data);
                if ($this->Lcolor->validates()) {

                    $this->Lconfig->editColor(1);
                    $this->Lcolor->edit(1, json_encode($this->request->data));
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('SHOP__CATEGORY_EDIT_SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Lconfig->validationErrors))));
                }
            } else {
                $this->redirect('/');
            }
        }
    }
}