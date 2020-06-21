<?php

class LwikiController extends LwikiAppController
{

    public function index()
    {
        $this->loadModel('Lwiki.Ltypes');
        $this->loadModel('Lwiki.Lcategory');
        $types = $this->Ltypes->find('all');
        $categorys = $this->Lcategory->find('all');
        $this->set(compact('types', 'categorys'));
        $this->set('title_for_layout', 'Wiki');
    }

    public function admin_index()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->loadModel('Lwiki.Ltypes');
            $this->loadModel('Lwiki.Lcategory');

            //Si la requete est de type ajax
            if ($this->request->is('ajax')) {
                $this->autoRender = null;
                //Je récupère le champs name="pseudo"
                $name = $this->request->data['name'];

                if ($this->Ltypes->validates()) {
                    $this->Ltypes->add($name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS'))));
                }
//                if ($name) {
            } else {
                //Je déclare le thème du panel admin
                $this->layout = 'admin';
                $types = $this->Ltypes->get();
                $categorys = $this->Lcategory->get();
                $this->set(compact('types', 'categorys'));
            }
        } else {
            $this->redirect('/');
        }
    }

    public function admin_edit_types()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['name'])) {
                    $this->loadModel('Lwiki.Ltypes');
                    $id = $this->request->data['id'];
                    $name = $this->request->data['name'];
                    $this->Ltypes->edit($id, $name);
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

    public function admin_delete($id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->autoRender = null;

            $this->loadModel('Lwiki.Ltypes');

            //J'utilise _delete() car delete() existe déjà avec cakephp
            $this->Ltypes->_delete($id);

            //Redirection vers notre page
            $this->redirect('/admin/lwiki');
        } else {
            $this->redirect('/toto');
        }
    }

    public function admin_add_category()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->loadModel('Lwiki.Lcategory');

            //Si la requete est de type ajax
            if ($this->request->is('ajax')) {
                $this->autoRender = null;
                //Je récupère le champs name="pseudo"
                $types_id = $this->request->data['type'];
                $name = $this->request->data['name'];
                $this->Lcategory->add($types_id, $name);
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

    public function admin_edit_category()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['name'])) {
                    $this->loadModel('Lwiki.Lcategory');

                    $id = $this->request->data['id'];
                    $ltype_id = $this->request->data['type'];
                    $name = $this->request->data['name'];

                    $this->Lcategory->edit($id, $ltype_id, $name);

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
}