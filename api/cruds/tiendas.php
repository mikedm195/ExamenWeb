<?php

// Definicion de end points y funciones callback
$app->get('/tienda', 'getTiendas');
$app->get('/tienda/:id', 'getTienda');
$app->post('/tienda', 'addTienda');
$app->put('/tienda/:id', 'updateTienda');
$app->delete('/tienda/:id','deleteTienda');


function getTiendas() {
    $sql = "SELECT * FROM exf_tienda";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$tiendas = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"tiendas": ' . json_encode($tiendas) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getTienda($id) {
	$sql = "select * from exf_tienda where id_tienda=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$tienda = $stmt->fetchObject();
		$db = null;
		echo json_encode($tienda);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addTienda() {
	error_log('addTienda\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$tienda = json_decode($request->getBody());
	$sql = "INSERT INTO exf_tienda (nombre, ubicacion, foto, propietario, telefono) VALUES (:nombre, :ubicacion, :foto, :propietario, :telefono)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $tienda->nombre);
		$stmt->bindParam("ubicacion", $tienda->ubicacion);
		$stmt->bindParam("foto", $tienda->foto);
		$stmt->bindParam("propietario", $tienda->propietario);
		$stmt->bindParam("telefono", $tienda->telefono);
		$stmt->execute();
		$tienda->id = $db->lastInsertId();
		$db = null;
		echo json_encode($tienda);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateTienda($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$tienda = json_decode($body);
	$sql = "UPDATE exf_tienda SET nombre=:nombre, ubicacion=:ubicacion, foto=:foto, propietario=:propietario, telefono=:telefono WHERE id_tienda=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("nombre", $tienda->nombre);
		$stmt->bindParam("ubicacion", $tienda->ubicacion);
		$stmt->bindParam("foto", $tienda->foto);
		$stmt->bindParam("propietario", $tienda->propietario);
		$stmt->bindParam("telefono", $tienda->telefono);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($tienda);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteTienda($id) {
	$sql = "DELETE FROM exf_tienda WHERE id_tienda=:id";
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

?>
