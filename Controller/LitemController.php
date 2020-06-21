<?php

class LitemController extends LwikiAppController
{

    public function admin_edit($id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';

            if ($id != false) {
                $this->loadModel('Lwiki.Lcategory');
                $this->loadModel('Lwiki.Litem');
                $categories = $this->Lcategory->get();
                $search = $this->Litem->getFindId($id);
                if (!empty($search)) {
                    $item = $search["Litem"];
                    $ltypeId = $search['Lcategory'];
                    $this->set(compact('item', 'categories', 'ltypeId'));
                } else {
                    throw new NotFoundException();
                }
            } else {
                $this->redirect('/');
            }
        }

    }

    public function admin_edit_ajax()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {

                $id = $this->request->data['id'];
                $lcategorie_id = $this->request->data['lcategorie_id'];
                $name = $this->request->data['name'];
                $text = $this->request->data['text'];

                if (!empty($lcategorie_id) && !empty($name) && !empty($text)) {
                    $this->loadModel('Lwiki.Litem');
                    $this->Litem->edit($id, $lcategorie_id, $name, $text);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('SHOP__CATEGORY_EDIT_SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS'))));
                }
            } else {
                $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('ERROR__BAD_REQUEST'))));
            }
        } else {
            throw new ForbiddenException();
        }
    }

    public function admin_add($lcategorie_id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';

            if ($lcategorie_id != false) {
                $this->set(compact('lcategorie_id'));
            } else {
                $this->redirect('/');
            }
        }

    }

    public function admin_add_ajax()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->loadModel('Lwiki.Litem');

            //Si la requete est de type ajax
            if ($this->request->is('ajax')) {
                $this->autoRender = null;
                //Je récupère le champs name="pseudo"

                $categories_id = $this->request->data['lcategorie_id'];
                $name = $this->request->data['name'];
                $text = $this->request->data['text'];

                $this->Litem->add($categories_id, $name, $text);
                $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));
            } else {
                //Je déclare le thème du panel admin
                $this->layout = 'admin';
                $types = $this->Ltypes->get();
                $this->set(compact('types'));
            }
        } else {
            $this->redirect('/');
        }
    }

}