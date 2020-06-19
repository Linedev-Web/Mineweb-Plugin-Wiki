<?php
Router::connect('/wiki', ['controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki']);
Router::connect('/admin/wiki', array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
Router::connect('/admin/wiki/lcategorie', array('controller' => 'lcategory', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
Router::connect('/admin/wiki/lcategorie/edit/:id', array('controller' => 'lcategory', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
