<?php
Router::connect('/wiki', ['controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki']);
Router::connect('/admin/lwiki', array('controller' => 'lwiki', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
Router::connect('/admin/lwiki/lcategorie', array('controller' => 'lcategory', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
Router::connect('/admin/lwiki/lcategorie/edit/:id', array('controller' => 'lcategory', 'action' => 'index', 'plugin' => 'lwiki', 'admin' => true));
