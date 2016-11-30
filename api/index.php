<?php

require 'Slim/Slim.php';

$app = new Slim();

require 'cruds/clientes.php';
require 'cruds/productos.php';
require 'cruds/tiendas.php';
require 'cruds/promociones.php';
require 'cruds/reportes.php';

function getConnection() {
	$dbhost="localhost";
	$dbuser="1015019_user";
	$dbpass="1015019";
	$dbname="daw_1015019";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

$app->run();

?>
