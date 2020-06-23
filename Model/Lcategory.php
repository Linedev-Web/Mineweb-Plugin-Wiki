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