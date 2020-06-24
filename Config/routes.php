<?php
Router::connect('/wiki', ['controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki']);
Router::connect('/wiki/:element&:name&:id', ['controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki'], array(),
    array('id' => '[0-9]+', 'element' => '[a-z]', 'name' => '[a-z]'));
Router::connect('/admin/lwiki', array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
