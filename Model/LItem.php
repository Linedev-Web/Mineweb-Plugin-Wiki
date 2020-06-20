<?php

class LItem extends LwikiAppModel
{

    public function get()
    {
        return $this->find('all');
    }

    public function _delete($id)
    {
        return $this->delete($id);
    }

    public function add($categories_id, $order, $name, $text)
    {
        $this->create();
        $this->set(['categories_id' => $categories_id, 'order' => $order, 'name' => $name, 'text' => $text]);
        return $this->save();
    }
}