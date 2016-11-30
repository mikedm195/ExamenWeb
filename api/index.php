<?php

require 'Slim/Slim.php';

$app = new Slim();
// Definicion de end points y funciones callback
$app->get('/cliente/:id', 'getCliente');
$app->post('/login', 'getLogIn');
$app->post('/cliente', 'addCliente');
$app->put('/cliente/:id', 'updateCliente');
$app->delete('/cliente/:id','deleteCliente');

$app->run();

function getLogIn() {
	$request = Slim::getInstance()->request();
	$cliente = json_decode($request->getBody());
	$sql = "select * FROM exf_cliente WHERE user = :user AND password = :password";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("user", $cliente->user);
		$stmt->bindParam("password", $cliente->password);
		$stmt->execute();
		$c = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"vino": ' . json_encode($c) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getCliente($id) {
	$sql = "select * from exf_cliente where id_cliente=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$cliente = $stmt->fetchObject();
		$db = null;
		echo json_encode($cliente);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addCliente() {
	error_log('addCliente\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$cliente = json_decode($request->getBody());
	$sql = "INSERT INTO exf_cliente (nombre, apPaterno, apMaterno, foto, telefono, membresia, user, password) VALUES (:nombre, :apPaterno, :apMaterno, :foto, :telefono, :membresia, :user, :password)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $cliente->nombre);
		$stmt->bindParam("apPaterno", $cliente->apPaterno);
		$stmt->bindParam("apMaterno", $cliente->apMaterno);
		$stmt->bindParam("foto", $cliente->foto);
		$stmt->bindParam("telefono", $cliente->telefono);
		$stmt->bindParam("membresia", $cliente->membresia);
		$stmt->bindParam("user", $cliente->user);
		$stmt->bindParam("password", $cliente->password);
		$stmt->execute();
		$cliente->id = $db->lastInsertId();
		$db = null;
		echo json_encode($cliente);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateCliente($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$cliente = json_decode($body);
	$sql = "UPDATE Vino SET nombre=:nombre, apPaterno=:apPaterno, apMaterno=:apMaterno, foto=:foto, telefono=:telefono, membresia=:membresia WHERE id_cliente=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $cliente->nombre);
		$stmt->bindParam("apPaterno", $cliente->apPaterno);
		$stmt->bindParam("apMaterno", $cliente->apMaterno);
		$stmt->bindParam("foto", $cliente->foto);
		$stmt->bindParam("telefono", $cliente->telefono);
		$stmt->bindParam("membresia", $cliente->membresia);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($cliente);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteVino($id) {
	$sql = "DELETE FROM Vino WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function findByName($query) {
	$sql = "SELECT * FROM Vino WHERE UPPER(nombre) LIKE :query ORDER BY nombre";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$vinos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"vino": ' . json_encode($vinos) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getConnection() {
	$dbhost="localhost";
	$dbuser="1015019_user";
	$dbpass="1015019";
	$dbname="daw_1015019";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>
