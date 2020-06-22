<?php

class Litem extends LwikiAppModel
{
    public $belongsTo = array(
        'Lcategory' => array(
            'className' => 'Lwiki.Lcategory',
            'foreignKey' => 'lcategorie_id'
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
    public function edit($id, $lcategorie_id, $name, $text)
    {
        $this->read(null, $id);
        $this->set(['lcategorie_id' => $lcategorie_id, 'name' => $name, 'text' => $text]);
        return $this->save();
    }

    public function add($lcategorie_id, $name, $text)
    {
        $this->create();
        $this->set(['lcategorie_id' => $lcategorie_id, 'name' => $name, 'text' => $text]);
        return $this->save();
    }
}