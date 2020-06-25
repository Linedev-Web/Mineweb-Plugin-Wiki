<?php

class Ltypes extends LwikiAppModel
{

    public $hasMany = array(
        'Lwiki.Lcategory' => array(
            'order' => 'Lcategory.order ASC',
            'dependent' => true
        ));

    public $validate = array(
        'id' => array(
            'rule' => 'naturalNumber',
            'message' => 'Une erreur d\'identification de l\'id, actualiser la page pour corriger le problème.'
        ),
        'name' => array(
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Cette catégorie a déjà êtes crée.',
            ),
            'bettwen' => array(
                'rule' => array('between', 1, 30),
                'message' => 'Le nom de catégorie doit avoir une longueur comprise entre 1 et 30 caractères.',
                'allowEmpty' => false
            ),
        ),
    );

    public function get()
    {
        return $this->find('all', array(
            'order' => 'Ltypes.order ASC',
            'recursive' => 2
        ));
    }

    public function _delete($id)
    {
        return $this->delete($id);
    }

    public function edit($id, $name)
    {
        $this->read(null, $id);
        $this->set(array('name' => $name,));
        return $this->save();
    }

    public function add($name)
    {
        $this->create();
        $this->set(['name' => $name]);
        $this->save();
    }

    public function edit_collapse_ajax($id)
    {
        $idTypes = $this->findById($id);
        if ($idTypes['Ltypes']['collapse'] == '0') {
            $collapse = 1;
        } else {
            $collapse = 0;
        }
        $this->read(null, $id);
        $this->set(['collapse' => $collapse]);
        return $this->save();
    }
}