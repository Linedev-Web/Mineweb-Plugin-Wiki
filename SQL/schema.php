<?php

class WikiAppSchema extends CakeSchema
{

    public $file = 'schema.php';

    public function before($event = []) {
        return true;
    }

    public function after($event = []) {}

    public $wiki__infos = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 8, 'unsigned' => false, 'key' => 'primary'],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'text' => ['type' => 'text', 'null' => false, 'default' => null, 'unsigned' => false]
    ];
    public $wiki__categories = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'unsigned' => false]
    ];
    public $wiki__items = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'],
        'categories_id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'text' => ['type' => 'text', 'null' => false, 'default' => null, 'unsigned' => false]
    ];
}