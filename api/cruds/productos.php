<?php

$app = new Slim();
// Definicion de end points y funciones callback
$app->get('/productos', 'getProductos');
$app->get('/productos/:id', 'getProducto');
$app->post('/producto', 'addProducto');
$app->put('/producto/:id', 'updateProducto');
$app->delete('/producto/:id','deleteProducto');

$app->run();

function getProductos() {
    $sql = "select * FROM exf_producto";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$productos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"productos": ' . json_encode($productos) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getProducto($id) {
	$sql = "select * from exf_producto where id_producto=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$producto = $stmt->fetchObject();
		$db = null;
		echo json_encode($producto);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addProducto() {
	error_log('addProducto\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$producto = json_decode($request->getBody());
	$sql = "INSERT INTO exf_producto (nombre, apPaterno, apMaterno, foto, telefono, membresia, user, password) VALUES (:nombre, :apPaterno, :apMaterno, :foto, :telefono, :membresia, :user, :password)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $producto->nombre);
		$stmt->bindParam("apPaterno", $producto->apPaterno);
		$stmt->bindParam("apMaterno", $producto->apMaterno);
		$stmt->bindParam("foto", $producto->foto);
		$stmt->bindParam("telefono", $producto->telefono);
		$stmt->bindParam("membresia", $producto->membresia);
		$stmt->bindParam("user", $producto->user);
		$stmt->bindParam("password", $producto->password);
		$stmt->execute();
		$producto->id = $db->lastInsertId();
		$db = null;
		echo json_encode($producto);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateProducto($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$producto = json_decode($body);
	$sql = "UPDATE exf_producto SET nombre=:nombre, apPaterno=:apPaterno, apMaterno=:apMaterno, foto=:foto, telefono=:telefono, membresia=:membresia WHERE id_producto=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $producto->nombre);
		$stmt->bindParam("apPaterno", $producto->apPaterno);
		$stmt->bindParam("apMaterno", $producto->apMaterno);
		$stmt->bindParam("foto", $producto->foto);
		$stmt->bindParam("telefono", $producto->telefono);
		$stmt->bindParam("membresia", $producto->membresia);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($producto);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteProducto($id) {
	$sql = "DELETE FROM exf_producto WHERE id_producto=:id";
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
