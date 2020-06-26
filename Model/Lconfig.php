<?php

class Lconfig extends LwikiAppModel
{
    public function get()
    {
        return $this->find('all');
    }

    public $validate = array(
        'title' => array(
            'between' => array(
                'rule' => array('between', 1, 64),
                'message' => 'Le nom de l\'article doit avoir une longueur comprise entre 1 et 30 caractères.',
                'allowEmpty' => false
            ),
        ),
    );

    public function edit($title, $content)
    {
        $this->read(null, 1);
        $this->set(['title' => $title, 'content' => $content]);
        return $this->save();
    }

    public function editColor($color)
    {
        $this->read(null, 1);
        $this->set(['lcolor_id' => $color]);
        return $this->save();
    }

    public function addPosition($position)
    {
        $this->set(['position' => $position]);
        return $this->save();
    }

    public function editPosition($position)
    {
        $this->set(['position' => $position]);
        return $this->save();
    }

}
