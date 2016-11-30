<?php

// Definicion de end points y funciones callback
$app->get('/producto', 'getProductos');
$app->get('/producto/:id', 'getProducto');
$app->post('/producto', 'addProducto');
$app->put('/producto/:id', 'updateProducto');
$app->delete('/producto/:id','deleteProducto');


function getProductos() {
    $sql = "SELECT * FROM exf_producto";
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
	$sql = "INSERT INTO exf_producto (nombre, descripcion, foto, cantidad, precio, impuesto) VALUES (:nombre, :descripcion, :foto, :cantidad, :precio, :impuesto)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $producto->nombre);
		$stmt->bindParam("descripcion", $producto->descripcion);
		$stmt->bindParam("foto", $producto->foto);
		$stmt->bindParam("cantidad", $producto->cantidad);
		$stmt->bindParam("precio", $producto->precio);
		$stmt->bindParam("impuesto", $producto->impuesto);
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
	$sql = "UPDATE exf_producto SET nombre=:nombre, descripcion=:descripcion, foto=:foto, cantidad=:cantidad, precio=:precio, impuesto=:impuesto WHERE id_producto=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("nombre", $producto->nombre);
		$stmt->bindParam("descripcion", $producto->descripcion);
		$stmt->bindParam("foto", $producto->foto);
		$stmt->bindParam("cantidad", $producto->cantidad);
		$stmt->bindParam("precio", $producto->precio);
		$stmt->bindParam("impuesto", $producto->impuesto);
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

?>
