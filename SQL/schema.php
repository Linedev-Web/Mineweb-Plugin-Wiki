<?php

class LwikiAppSchema extends CakeSchema
{

    public $file = 'schema.php';

    public function before($event = [])
    {
        return true;
    }

    public function after($event = [])
    {
    }

    public $lwiki__ltypes = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'unsigned' => true, 'key' => 'primary'],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];
    public $lwiki__lcategories = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'unsigned' => true, 'key' => 'primary'],
        'types_id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'unsigned' => false],
        'icon' => ['type' => 'text', 'null' => false, 'default' => null, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];
    public $lwiki__litems = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'unsigned' => true, 'key' => 'primary'],
        'categories_id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'text' => ['type' => 'text', 'null' => false, 'default' => null, 'unsigned' => false],
        'icon' => ['type' => 'text', 'null' => false, 'default' => null, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB']
    ];
}