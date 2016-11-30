<?php

// Definicion de end points y funciones callback
$app->get('/tienda_producto', 'getTienda_productos');
$app->get('/tienda_producto/:id', 'getTienda_producto');
$app->post('/tienda_producto', 'addTienda_producto');
$app->put('/tienda_producto/:id', 'updateTienda_producto');
$app->delete('/tienda_producto/:id','deleteTienda_producto');


function getTienda_productos() {
    $sql = "SELECT t.nombre AS nombreTienda, p.nombre AS nombreProducto
        FROM exf_tienda_producto AS tp INNER JOIN exf_tienda AS t INNER JOIN exf_producto AS p
        WHERE t.id_tienda = tp.id_tienda AND t.id_producto = tp.id_producto ";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$tienda_productos = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"tienda_productos": ' . json_encode($tienda_productos) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getTienda_producto($id) {
    $sql = "SELECT t.nombre AS nombreTienda, p.nombre AS nombreProducto
        FROM exf_tienda_producto AS tp INNER JOIN exf_tienda AS t INNER JOIN exf_producto AS p
        WHERE t.id_tienda = tp.id_tienda AND p.id_producto = tp.id_producto AND tp.id_tienda_producto = :id ";
	try {
		$db = getConnection()
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$tienda_producto = $stmt->fetchObject();
		$db = null;
		echo json_encode($tienda_producto);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addTienda_producto() {
	error_log('addTienda_producto\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$tienda_producto = json_decode($request->getBody());
	$sql = "INSERT INTO exf_tienda_producto (id_tienda, id_producto) VALUES (:id_tienda, :id_producto)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id_tienda", $tienda_producto->id_tienda);
		$stmt->bindParam("id_producto", $tienda_producto->id_producto);
		$stmt->execute();
		$tienda_producto->id = $db->lastInsertId();
		$db = null;
		echo json_encode($tienda_producto);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateTienda_producto($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$tienda_producto = json_decode($body);
	$sql = "UPDATE exf_tienda_producto SET id_tienda=:id_tienda, id_producto=:id_producto WHERE id_tienda_producto=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("id_tienda", $tienda_producto->id_tienda);
		$stmt->bindParam("id_producto", $tienda_producto->id_producto);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($tienda_producto);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteTienda_producto($id) {
	$sql = "DELETE FROM exf_tienda_producto WHERE id_tienda_producto=:id";
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
