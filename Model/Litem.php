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
        'name' => array(
            'rule' => 'isUnique',
            'message' => 'Ce nom name déjà utilisée.',
            'allowEmpty' => false
        )
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

    public function getFindId($id)
    {
        return $this->find('first', array(
            'conditions' => array('litem.id' => $id),
            'recursive' => 0
        ));
    }

    public function edit($id, $lcategory_id, $name, $text)
    {
        $this->read(null, $id);
        $this->set(['lcategory_id' => $lcategory_id, 'name' => $name, 'text' => $text]);
        return $this->save();
    }

    public function add($lcategory_id, $name, $text)
    {
        $this->create();
        $this->set(['lcategory_id' => $lcategory_id, 'name' => $name, 'text' => $text]);
        return $this->save();
    }
}