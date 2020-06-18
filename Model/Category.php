<?php

class Category extends LwikiAppModel
{


    public function add($types_id, $name, $icon)
    {
        $this->create();
        $this->set(['types_id' => $types_id, 'name' => $name, 'icon' => $icon]);
        return $this->save();
    }
}