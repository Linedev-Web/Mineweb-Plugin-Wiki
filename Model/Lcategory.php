<?php

class Lcategory extends LwikiAppModel
{
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

    public function edit($data)
    {
        $this->read(null, $data['id']);
        $this->set($data);
        return $this->save();
    }

    public function add($types_id, $name)
    {
        $this->create();
        $this->set(['ltype_id' => $types_id, 'name' => $name]);
        return $this->save();
    }
}