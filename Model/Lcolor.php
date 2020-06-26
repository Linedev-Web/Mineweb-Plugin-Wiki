<?php

class Lcolor extends LwikiAppModel
{
    public function get()
    {
        return $this->find('all', array(
            'recursive' => 1
        ));
    }

    public function add($color)
    {
        $this->create();
        $this->set(['color' => $color]);
        return $this->save();
    }

    public function edit($id, $color)
    {
        $this->read(null, $id);
        $this->set(['color' => $color]);
        return $this->save();
    }
}