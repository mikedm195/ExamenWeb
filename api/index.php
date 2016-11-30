<?php

require 'Slim/Slim.php';

$app = new Slim();

require 'cruds/clientes.php';
require 'cruds/productos.php';

$app->run();

?>
