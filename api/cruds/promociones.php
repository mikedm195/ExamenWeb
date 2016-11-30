<?php

// Definicion de end points y funciones callback
$app->get('/promocion', 'getPromocions');
$app->get('/promocion/:id', 'getPromocion');
$app->post('/promocion', 'addPromocion');
$app->put('/promocion/:id', 'updatePromocion');
$app->delete('/promocion/:id','deletePromocion');


function getPromocions() {
    $sql = "SELECT * FROM exf_promocion";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$promocions = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"promocions": ' . json_encode($promocions) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getPromocion($id) {
	$sql = "select * from exf_promocion where id_promocion=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$promocion = $stmt->fetchObject();
		$db = null;
		echo json_encode($promocion);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addPromocion() {
	error_log('addPromocion\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$promocion = json_decode($request->getBody());
	$sql = "INSERT INTO exf_promocion (nombre, fechaInicio, fechaFin, promocionMiembro, promocionNoMiembro) VALUES (:nombre, :fechaInicio, :fechaFin, :promocionMiembro, :promocionNoMiembro)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $promocion->nombre);
		$stmt->bindParam("fechaInicio", $promocion->fechaInicio);
		$stmt->bindParam("fechaFin", $promocion->fechaFin);
		$stmt->bindParam("promocionMiembro", $promocion->promocionMiembro);
		$stmt->bindParam("promocionNoMiembro", $promocion->promocionNoMiembro);
		$stmt->execute();
		$promocion->id = $db->lastInsertId();
		$db = null;
		echo json_encode($promocion);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updatePromocion($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$promocion = json_decode($body);
	$sql = "UPDATE exf_promocion SET nombre=:nombre, fechaInicio=:fechaInicio, fechaFin=:fechaFin, promocionMiembro=:promocionMiembro, promocionNoMiembro=:promocionNoMiembro WHERE id_promocion=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("nombre", $promocion->nombre);
		$stmt->bindParam("fechaInicio", $promocion->fechaInicio);
		$stmt->bindParam("fechaFin", $promocion->fechaFin);
		$stmt->bindParam("promocionMiembro", $promocion->promocionMiembro);
		$stmt->bindParam("promocionNoMiembro", $promocion->promocionNoMiembro);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($promocion);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deletePromocion($id) {
	$sql = "DELETE FROM exf_promocion WHERE id_promocion=:id";
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
