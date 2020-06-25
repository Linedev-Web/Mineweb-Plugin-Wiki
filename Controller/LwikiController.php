<?php

class LwikiController extends LwikiAppController
{

    public function index()
    {
        $this->loadModel('Lwiki.Ltypes');
        $types = $this->Ltypes->get();
        $this->set(compact('types'));
        $this->set('title_for_layout', 'Wiki');

        if ($this->request->is('get')) {
            $element = $this->request->param('element');
            $id = $this->request->param('id');

            if ($element === 'item') {
                $this->loadModel('Lwiki.Litem');
                $item = $this->Litem->findById($id);
                $text = htmlspecialchars_decode($item['Litem']['text']);
                $this->set(compact('text'));
            }
            if ($element === 'category') {
                $this->loadModel('Lwiki.Lcategory');
                $category = $this->Lcategory->findById($id);
                $text = htmlspecialchars_decode($category['Lcategory']['text']);
                $this->set(compact('text'));
            }
        }
    }

    public function admin_index()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->loadModel('Lwiki.Ltypes');
            $this->loadModel('Lwiki.Lcategory');

            if ($this->request->is('ajax')) {
                $this->autoRender = null;


                $this->Ltypes->set($this->request->data);
                if ($this->Ltypes->validates()) {
                    $name = $this->request->data['name'];
                    $this->Ltypes->add($name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));
                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Ltypes->validationErrors))));
                }
//                if ($name) {
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

    public function admin_edit_types()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {

                $this->loadModel('Lwiki.Ltypes');

                $this->Ltypes->set($this->request->data);
                if ($this->Ltypes->validates()) {

                    $id = $this->request->data['id'];
                    $name = $this->request->data['name'];
                    $this->Ltypes->edit($id, $name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('SHOP__CATEGORY_EDIT_SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Ltypes->validationErrors))));
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

            $this->Ltypes->_delete($id);

            $this->redirect('/admin/lwiki');
        } else {
            $this->redirect('/toto');
        }
    }

    public function admin_add_category()
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->loadModel('Lwiki.Lcategory');

            $this->autoRender = null;
            if ($this->request->is('ajax')) {

                $this->Lcategory->set($this->request->data);
                if ($this->Lcategory->validates()) {

                    $types_id = $this->request->data['type'];
                    $name = $this->request->data['name'];
                    $this->Lcategory->add($types_id, $name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Lcategory->validationErrors))));
                }
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
                $this->loadModel('Lwiki.Lcategory');

                $this->Lcategory->set($this->request->data);
                if ($this->Lcategory->validates()) {

                    $id = $this->request->data['id'];
                    $name = $this->request->data['name'];

                    $this->Lcategory->edit($id, $name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('SHOP__CATEGORY_EDIT_SUCCESS'))));

                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Lcategory->validationErrors))));
                }
            } else {
                $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('ERROR__BAD_REQUEST'))));
            }
        } else {
            throw new ForbiddenException();
        }
    }

    public function admin_edit_collapse_ajax()
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->User->isAdmin()) {

            if ($this->request->is('post')) {
                $this->loadModel('Lwiki.Ltypes');

                $id = $this->request->data['id'];
                $this->Ltypes->edit_collapse_ajax($id);
                return $this->sendJSON(['statut' => true, 'msg' => $this->Lang->get('SHOP__SAVE_SUCCESS')]);
            }
        }
    }


    public function admin_save_ajax()
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->User->isAdmin()) {

            if ($this->request->is('post')) {
                if (!empty($this->request->data)) {

                    //I explode the contents of the wiki_category_order to retrieve the name of each item.
                    $data = $this->request->data['wiki_type_order'];
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

                    $this->loadModel('Lwiki.Ltypes');

                    $this->Ltypes->set($this->request->data);
                    if ($this->Ltypes->validates()) {
                        foreach ($data as $key => $value) {
                            $find = $this->Ltypes->findByName($key);
                            if (!empty($find)) {
                                $id = $find['Ltypes']['id'];
                                $this->Ltypes->read(null, $id);
                                $this->Ltypes->set(array(
                                    'order' => $value,
                                ));
                                $this->Ltypes->save();
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
                        $this->response->body(json_encode(array('statut' => false, 'msg' => $this->alertMesasge($this->Ltypes->validationErrors))));
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