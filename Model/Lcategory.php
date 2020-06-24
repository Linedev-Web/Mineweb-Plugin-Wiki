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