<?php
class Category extends WikiAppModel{

    public function get(){
        return $this->find('all');
    }

    public function _delete($id){
        return $this->delete($id);
    }
}