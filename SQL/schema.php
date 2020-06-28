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

    public $lwiki__lcategories = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'ltype_id' => ['type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'unsigned' => false],
        'text' => ['type' => 'text', 'null' => true, 'default' => null, 'unsigned' => false],
        'litem_count' => ['type' => 'integer', 'null' => false, 'default' => 0, 'length' => 20, 'unsigned' => false],
        'display' => ['type' => 'tinyinteger', 'null' => false, 'default' => 0, 'length' => 1, 'unsigned' => false],
        'collapse' => ['type' => 'tinyinteger', 'null' => false, 'default' => 0, 'length' => 1, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci ', 'encoding ' => 'utf8mb4', 'engine' => 'InnoDB']
    ];

    public $lwiki__lcolors = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'],
        'color' => ['type' => 'text', 'null' => true, 'default' => null, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci ', 'encoding ' => 'utf8mb4', 'engine' => 'InnoDB']
    ];

    public $lwiki__lconfigs = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'],
        'title' => ['type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'unsigned' => false],
        'content' => ['type' => 'text', 'null' => true, 'default' => null, 'unsigned' => false],
        'lcolor_id' => ['type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false],
        'position' => ['type' => 'text', 'null' => true, 'default' => null, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci ', 'encoding ' => 'utf8mb4', 'engine' => 'InnoDB']
    ];

    public $lwiki__litems = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'unsigned' => false, 'key' => 'primary'],
        'lcategory_id' => ['type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'text' => ['type' => 'text', 'null' => true, 'default' => null, 'unsigned' => false],
        'display' => ['type' => 'tinyinteger', 'null' => false, 'default' => 0, 'length' => 1, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci ', 'encoding ' => 'utf8mb4', 'engine' => 'InnoDB']
    ];

    public $lwiki__ltypes = [
        'id' => ['type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'unsigned' => false, 'key' => 'primary'],
        'order' => ['type' => 'integer', 'null' => true, 'default' => null, 'length' => 20, 'unsigned' => false],
        'name' => ['type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'unsigned' => false],
        'lcategory_count' => ['type' => 'integer', 'null' => true, 'default' => 0, 'length' => 20, 'unsigned' => false],
        'collapse' => ['type' => 'tinyinteger', 'null' => false, 'default' => 0, 'length' => 1, 'unsigned' => false],
        'indexes' => [
            'PRIMARY' => ['column' => 'id', 'unique' => 1]
        ],
        'tableParameters' => ['charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci ', 'encoding ' => 'utf8mb4', 'engine' => 'InnoDB']
    ];


}