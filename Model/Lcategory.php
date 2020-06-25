<?php

class Lcategory extends LwikiAppModel
{

    public $hasMany = array(
        'Litem' => array(
            'className' => 'Lwiki.Litem',
            'foreignKey' => 'lcategory_id',
            'order' => 'Litem.order ASC',
            'dependent' => true
        ),
    );

    public $belongsTo = array(
        'Ltypes' => array(
            'className' => 'Lwiki.Ltypes',
            'foreignKey' => 'ltype_id',
            'counterCache' => true
        )
    );

    public $validate = array(
        'id' => array(
            'rule' => 'naturalNumber',
            'message' => 'l\'identification de l\'id, actualiser la page pour corriger le problème.'
        ),
        'order' => array(
            'rule' => 'naturalNumber',
            'message' => 'l\'ordre de la sous-catégorie est erroné'
        ),
        'ltype_id' => array(
            'rule' => 'naturalNumber',
            'message' => 'Identification de l\'id Type, actualiser la page pour corriger le problème.'
        ),
        'name' => array(
            'between' => array(
                'rule' => array('between', 1, 30),
                'message' => 'Le nom de sous-catégorie doit avoir une longueur comprise entre 1 et 30 caractères.',
                'allowEmpty' => false
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Cette sous-catégorie a déjà êtes crée.',
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


    public function editTypeAndOrderFindId($id, $order, $category_id, $typeName)
    {
        $this->read(null, $id);
        $this->set(array(
            'order' => $order,
        ));
        if ($id === $category_id) {
            $this->set(array(
                'ltype_id' => $typeName,
            ));
        }
        $this->save();
    }

    public function edit_display_ajax($id)
    {
        $idCategory = $this->findById($id);
        if ($idCategory['Lcategory']['display'] == '0') {
            $display = 1;
        } else {
            $display = 0;
        }
        $this->read(null, $id);
        $this->set(['display' => $display]);
        return $this->save();
    }

    public function edit_collapse_ajax($id)
    {
        $idCategory = $this->findById($id);
        if ($idCategory['Lcategory']['collapse'] == '0') {
            $collapse = 1;
        } else {
            $collapse = 0;
        }
        $this->read(null, $id);
        $this->set(['collapse' => $collapse]);
        return $this->save();
    }

    public function edit($id, $name, $text)
    {
        $this->read(null, $id);
        $this->set(['name' => $name, 'text' => $text]);
        return $this->save();
    }

    public function add($ltype_id, $name)
    {
        $this->create();
        $this->set(['ltype_id' => $ltype_id, 'name' => $name]);
        return $this->save();
    }
}