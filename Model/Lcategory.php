<?php

class Lcategory extends LwikiAppModel
{

    public $hasAndBelongsToMany = array('Ltypes');
    public $belongsTo = array(
        'Ltypes' => array(
            'className' => 'Ltypes',
            'foreignKey' => 'ltype_id'
        )
    );

    public function get()
    {
        return $this->find('all', array(
            'recursive' => 1
        ));
    }

    public function getFindId($id)
    {
        return $this->find('first', array(
            'conditions' => array('Lcategory.id' => $id),
            'recursive' => 0,
        ));
    }

    public function _delete($id)
    {
        return $this->delete($id);
    }

    public function edit($id, $ltype_id, $name)
    {
        $this->read(null, $id);
        $this->set(['ltype_id' => $ltype_id, 'name' => $name]);
        return $this->save();
    }

    public function add($ltype_id, $name)
    {
        $this->create();
        $this->set(['ltype_id' => $ltype_id, 'name' => $name]);
        return $this->save();
    }
}