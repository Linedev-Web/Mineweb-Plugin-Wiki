<?php

class LitemController extends LwikiAppController
{

    public function getWiki()
    {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('post')) {
            $this->loadModel('Lwiki.Litem');
            $id = $this->request->data['id'];
            $item = $this->Litem->findById($id);
            $this->response->body(json_encode(array('statut' => true, 'content' => htmlspecialchars_decode($item['Litem']['text']))));
        }

    }

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
                $name = $this->request->data['name'];
                $text = $this->request->data['text'];

//                var_dump($text);
//                die();

                if (!empty($name) && !empty($text)) {
                    $this->loadModel('Lwiki.Litem');
                    $this->Litem->edit($id, $name, $text);
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

    public function admin_add($lcategory_id)
    {
        if ($this->isConnected and $this->User->isAdmin()) {
            $this->layout = 'admin';

            if ($lcategory_id != false) {
                $this->set(compact('lcategory_id'));
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

                $categories_id = $this->request->data['lcategory_id'];
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

    public function admin_edit_display_ajax()
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->User->isAdmin()) {

            if ($this->request->is('post')) {
                $this->loadModel('Lwiki.Litem');

                $id = $this->request->data['id'];
                $this->Litem->edit_display_ajax($id);
                $display = $this->Litem->findById($id);
                return $this->sendJSON(['statut' => true, 'display' => $display['Litem']['display'], 'msg' => $this->Lang->get('SHOP__SAVE_SUCCESS')]);
            }
        }
    }

    public function admin_save_ajax()
    {
        $this->autoRender = false;
        if ($this->isConnected and $this->User->isAdmin()) {

            if ($this->request->is('post')) {
                if (!empty($this->request->data)) {

                    //I explode the contents of the wiki_category_name to retrieve the name of each item.
                    $data = $this->request->data['wiki_item_order'];
                    $data = explode('&', $data);

                    //I explode the contents of the wiki_category_name to retrieve the name of the selected category.
                    $category = $this->request->data['wiki_category_name'];
                    $category = explode('-', $category);

                    //I explode the contents of the wiki_item_name_selected to retrieve the name of the selected category.
                    $itemIdSelected = $this->request->data['wiki_item_name_selected'];
                    $itemIdSelected = explode('-', $itemIdSelected);

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

                    //we change the modules
                    $this->loadModel('Lwiki.Litem');
                    $this->loadModel('Lwiki.Lcategory');

                    //We retrieve the information of the element passed in variable ex: id, name, etc...
                    $categoryName = $this->Lcategory->findByName($category[0]);
                    $itemName = $this->Litem->findByName($itemIdSelected[0]);

                    foreach ($data as $key => $value) {
                        $find = $this->Litem->findByName($key);
                        if (!empty($find)) {
                            $id = $find['Litem']['id'];
                            $this->Litem->editCategoryAndOrderFindId(
                                $id,
                                $value,
                                $itemName['Litem']['id'],
                                $categoryName['Lcategory']['id']);
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