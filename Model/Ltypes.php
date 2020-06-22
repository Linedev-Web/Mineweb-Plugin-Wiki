<?php

class Ltypes extends LwikiAppModel
{

    public $hasMany = array(
        'Lwiki.Lcategory' => array(
            'order' => 'Lcategory.order ASC',
            'dependent' => true
        ));

    public $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'message' => 'Ce nom name déjà utilisée.',
            'allowEmpty' => false
        )
    );

    public function get()
    {
        return $this->find('all', array(
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
        return $this->save();
    }
}