<?php
Router::connect('/wiki', ['controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki']);
Router::connect('/admin/wiki', array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
Router::connect('/admin/wiki/categorie', array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
