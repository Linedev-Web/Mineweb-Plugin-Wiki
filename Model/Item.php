<?php

class Item extends LwikiAppModel
{


    public function add($categories_id, $order, $name, $text, $icon)
    {
        $this->create();
        $this->set(['categories_id' => $categories_id, 'order' => $order, 'name' => $name, 'text' => $text, 'icon' => $icon]);
        return $this->save();
    }
}