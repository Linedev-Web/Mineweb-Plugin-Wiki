<?php

class Ltypes extends LwikiAppModel
{
    public function get()
    {
        return $this->find('all');
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