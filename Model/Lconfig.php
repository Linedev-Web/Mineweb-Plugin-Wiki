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

    public function add($text, $content, $color, $position)
    {
        $this->create();
        $this->set(['text' => $text, 'content' => $content, 'color' => $color, 'position' => $position]);
        return $this->save();
    }

    public function edit($text, $content, $color, $position)
    {
        $this->set(['text' => $text, 'content' => $content, 'color' => $color, 'position' => $position]);
        return $this->save();
    }
}