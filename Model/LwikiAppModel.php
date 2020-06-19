<?php
class LwikiAppModel extends AppModel{
    public $tablePrefix = 'lwiki__';

    public function get(){
        return $this->find('all');
    }

    public function _delete($id){
        return $this->delete($id);
    }
}