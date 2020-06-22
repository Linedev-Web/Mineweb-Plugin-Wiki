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

    public function admin_delete($id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->autoRender = null;

            $this->loadModel('Lwiki.Litem');

            //J'utilise _delete() car delete() existe déjà avec cakephp
            $this->Litem->_delete($id);

            //Redirection vers notre page
            $this->redirect('/admin/lwiki');
        } else {
            $this->redirect('/toto');
        }
    }

    public function admin_save_ajax()
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->Permissions->can('MANAGE_NAV')) {

            if ($this->request->is('post')) {
                if (!empty($this->request->data)) {
                    $data = $this->request->data['wiki_item_order'];
                    $data = explode('&', $data);
                    $i = 1;
                    foreach ($data as $key => $value) {
                        $data2[] = explode('=', $value);
                        $data3 = substr($data2[0][0], 0, -2);
                        $data1[$data3] = $i;
                        unset($data3);
                        unset($data2);
                        $i++;
                    }
                    $data = $data1;
                    $this->loadModel('Lwiki.Litem');
                    foreach ($data as $key => $value) {
                        $find = $this->Litem->find('first', array('conditions' => array('name' => $key)));
                        if (!empty($find)) {
                            $id = $find['Litem']['id'];
                            $this->Litem->read(null, $id);
                            $this->Litem->set(array(
                                'order' => $value,
                            ));
                            $this->Litem->save();
                        } else {
                            $error = 1;
                        }
                    }
                    if (empty($error)) {
                        return $this->sendJSON(['statut' => true, 'msg' => $this->Lang->get('SHOP__SAVE_SUCCESS')]);
                    } else {
                        return $this->sendJSON(['statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS')]);
                    }
                } else {
                    return $this->sendJSON(['statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS')]);
                }
            } else {
                return $this->sendJSON(['statut' => false, 'msg' => $this->Lang->get('ERROR__BAD_REQUEST')]);

            }
        } else {
            $this->redirect('/');
        }
    }
}