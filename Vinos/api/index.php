<?php

require 'Slim/Slim.php';

$app = new Slim();
// Definicion de end points y funciones callback
$app->get('/vinos', 'getVinos');
$app->get('/vinos/:id',	'getVino');
$app->get('/vinos/search/:query', 'findByName');
$app->post('/vinos', 'addVino');
$app->put('/vinos/:id', 'updateVino');
$app->delete('/vinos/:id',	'deleteVino');

$app->run();

function getVinos() {
	$sql = "select * FROM Vino ORDER BY nombre";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$vinos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"vino": ' . json_encode($vinos) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getVino($id) {
	$sql = "SELECT * FROM Vino WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$vino = $stmt->fetchObject();  
		$db = null;
		echo json_encode($vino); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addVino() {
	error_log('addVino\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$vino = json_decode($request->getBody());
	$sql = "INSERT INTO Vino (nombre, uvas, pais, region, anio, descripcion) VALUES (:nombre, :uvas, :pais, :region, :anio, :descripcion)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nombre", $vino->nombre);
		$stmt->bindParam("uvas", $vino->uvas);
		$stmt->bindParam("pais", $vino->pais);
		$stmt->bindParam("region", $vino->region);
		$stmt->bindParam("anio", $vino->anio);
		$stmt->bindParam("descripcion", $vino->descripcion);
		$stmt->execute();
		$vino->id = $db->lastInsertId();
		$db = null;
		echo json_encode($vino); 
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateVino($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$vino = json_decode($body);
	$sql = "UPDATE Vino SET nombre=:nombre, uvas=:uvas, pais=:pais, region=:region, anio=:anio, descripcion=:descripcion WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nombre", $vino->nombre);
		$stmt->bindParam("uvas", $vino->uvas);
		$stmt->bindParam("pais", $vino->pais);
		$stmt->bindParam("region", $vino->region);
		$stmt->bindParam("anio", $vino->anio);
		$stmt->bindParam("descripcion", $vino->descripcion);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($vino); 
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
