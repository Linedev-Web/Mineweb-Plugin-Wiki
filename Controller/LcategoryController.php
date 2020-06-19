<?php

class LcategoryController extends LwikiAppController
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

    public function admin_edit($id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';

            if ($id != false) {
                $this->loadModel('Lwiki.Ltypes');
                $this->loadModel('Lwiki.Lcategory');
                $types = $this->Ltypes->get();
                $search = $this->Lcategory->getFindId($id);
                if (!empty($search)) {
                    $category = $search["Lcategory"];
                    $category['filename'] = explode('/', $category['icon']);
                    $category['filename'] = end($category['filename']);
                    $this->set(compact('category', 'types'));
                } else {
                    throw new NotFoundException();
                }
            } else {
                throw new NotFoundException();
            }
        } else {
            $this->redirect('/');
        }

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

                if ($name) {
                    $this->Ltypes->add($name);
                    $this->response->body(json_encode(array('statut' => true, 'msg' => $this->Lang->get('GLOBAL__SUCCESS'))));
                } else {
                    $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('ERROR__FILL_ALL_FIELDS'))));
                }
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

    public function admin_delete($id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->autoRender = null;

            $this->loadModel('Lwiki.Lcategory');

            //J'utilise _delete() car delete() existe déjà avec cakephp
            $this->Lcategory->_delete($id);

            //Redirection vers notre page
            $this->redirect('/admin/wiki');
        } else {
            $this->redirect('/toto');
        }
    }

    public function admin_edit_ajax()
    {
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->isConnected and $this->User->isAdmin()) {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['name'])) {
                    $this->loadModel('Lwiki.Lcategory');

                    if (!isset($this->request->data['img_edit'])) {
                        $checkIfImageAlreadyUploaded = (isset($this->request->data['img-uploaded']));
                        if ($checkIfImageAlreadyUploaded) {
                            $url_img = Router::url('/') . 'img' . DS . 'uploads' . $this->request->data['img-uploaded'];
                        } else {
                            $isValidImg = $this->Util->isValidImage($this->request, array('png', 'jpg', 'jpeg'));

                            if (!$isValidImg['status']) {
                                $this->response->body(json_encode(array('statut' => false, 'msg' => $isValidImg['msg'])));
                                return;
                            } else {
                                $infos = $isValidImg['infos'];
                            }

                            $time = date('Y-m-d_His');

                            $url_img = WWW_ROOT . 'img' . DS . 'uploads' . DS . 'icons' . DS . $time . '.' . $infos['extension'];

                            if (!$this->Util->uploadImage($this->request, $url_img)) {
                                $this->response->body(json_encode(array('statut' => false, 'msg' => $this->Lang->get('FORM__ERROR_WHEN_UPLOAD'))));
                                return;
                            }

                            $url_img = Router::url('/') . 'img' . DS . 'uploads' . DS . 'icons' . DS . $time . '.' . $infos['extension'];

                        }

                        $data = array(
                            'id' => $this->request->data['id'],
                            'name' => $this->request->data['name'],
                            'ltype_id' => $this->request->data['type'],
                            'icon' => $url_img
                        );

                    } else {
                        $data = array(
                            'id' => $this->request->data['id'],
                            'name' => $this->request->data['name'],
                            'ltype_id' => $this->request->data['type'],
                        );
                    }
                        $this->Lcategory->edit($data);
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