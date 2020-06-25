<?php

class Litem extends LwikiAppModel
{
    public $belongsTo = array(
        'Lcategory' => array(
            'className' => 'Lwiki.Lcategory',
            'foreignKey' => 'lcategory_id',
            'counterCache' => true
        )
    );


    public $validate = array(
        'id' => array(
            'rule' => 'naturalNumber',
            'message' => 'Une erreur d\'identification de l\'id, actualiser la page pour corriger le problème.'
        ),
        'lcategory_id' => array(
            'rule' => 'naturalNumber',
            'message' => 'Identification de l\'id Catégorie, actualiser la page pour corriger le problème.'
        ),
        'name' => array(
            'between' => array(
                'rule' => array('between', 1, 30),
                'message' => 'Le nom de l\'article doit avoir une longueur comprise entre 1 et 30 caractères.',
                'allowEmpty' => false
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Cette article a déjà êtes crée.',
                'allowEmpty' => false)
        ),
    );

    public function get()
    {
        return $this->find('all', array(
            'recursive' => 1
        ));
    }

    public function _delete($id)
    {
        return $this->delete($id);
    }

    public function edit($id, $name, $text)
    {
        $this->read(null, $id);
        $this->set(['name' => $name, 'text' => $text]);
        return $this->save();
    }

    public function add($lcategory_id, $name, $text)
    {
        $this->create();
        $this->set(['lcategory_id' => $lcategory_id, 'name' => $name, 'text' => $text]);
        return $this->save();
    }

    public function edit_display_ajax($id)
    {
        $idItem = $this->findById($id);
        if ($idItem['Litem']['display'] == false) {
            $display = true;
        } else {
            $display = false;
        }
        $this->read(null, $id);
        $this->set(['display' => $display]);
        return $this->save();
    }

    public function editCategoryAndOrderFindId($id, $order, $item_id, $CategoryName)
    {
        $this->read(null, $id);
        $this->set(array(
            'order' => $order,
        ));
        if ($id === $item_id) {
            $this->set(array(
                'lcategory_id' => $CategoryName,
            ));
        }
        $this->save();
    }
}