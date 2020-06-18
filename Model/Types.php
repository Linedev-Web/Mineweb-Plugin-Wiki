<?php

class Types extends LwikiAppModel
{

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