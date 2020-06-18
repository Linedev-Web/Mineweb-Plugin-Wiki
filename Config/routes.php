<?php
Router::connect('/wiki', ['controller' => 'wiki', 'action' => 'index', 'plugin' => 'wiki']);
Router::connect('/admin/wiki', array('controller' => 'wiki', 'action' => 'index', 'plugin' => 'wiki', 'admin' => true));
Router::connect('/admin/wiki/categorie', array('controller' => 'wiki', 'action' => 'index', 'plugin' => 'wiki', 'admin' => true));
