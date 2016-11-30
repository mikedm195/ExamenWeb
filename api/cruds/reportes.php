<?php

// Definicion de end points y funciones callback
$app->get('/reporte', 'getReportes');
$app->get('/reporte/:id', 'getReporte');
$app->post('/reporte', 'addReporte');
$app->put('/reporte/:id', 'updateReporte');
$app->delete('/reporte/:id','deleteReporte');


function getReportes() {
    $sql = "SELECT c.cliente AS nombreCliente, t.nombre AS nombreTienda, p.nombre AS nombreProducto
        FROM exf_reporte";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);
		$reportes = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"reportes": ' . json_encode($reportes) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getReporte($id) {
	$sql = "select * from exf_reporte where id_reporte=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$reporte = $stmt->fetchObject();
		$db = null;
		echo json_encode($reporte);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function addReporte() {
	error_log('addReporte\n', 3, '/var/tmp/php.log');
        // El objeto request facilita el acceso a los datos de la peticion
        // En este caso la representacion JSON de un objeto Vino.
	$request = Slim::getInstance()->request();
	$reporte = json_decode($request->getBody());
	$sql = "INSERT INTO exf_reporte (nombre, fechaInicio, fechaFin, reporteMiembro, reporteNoMiembro) VALUES (:nombre, :fechaInicio, :fechaFin, :reporteMiembro, :reporteNoMiembro)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("nombre", $reporte->nombre);
		$stmt->bindParam("fechaInicio", $reporte->fechaInicio);
		$stmt->bindParam("fechaFin", $reporte->fechaFin);
		$stmt->bindParam("reporteMiembro", $reporte->reporteMiembro);
		$stmt->bindParam("reporteNoMiembro", $reporte->reporteNoMiembro);
		$stmt->execute();
		$reporte->id = $db->lastInsertId();
		$db = null;
		echo json_encode($reporte);
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function updateReporte($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$reporte = json_decode($body);
	$sql = "UPDATE exf_reporte SET nombre=:nombre, fechaInicio=:fechaInicio, fechaFin=:fechaFin, reporteMiembro=:reporteMiembro, reporteNoMiembro=:reporteNoMiembro WHERE id_reporte=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("nombre", $reporte->nombre);
		$stmt->bindParam("fechaInicio", $reporte->fechaInicio);
		$stmt->bindParam("fechaFin", $reporte->fechaFin);
		$stmt->bindParam("reporteMiembro", $reporte->reporteMiembro);
		$stmt->bindParam("reporteNoMiembro", $reporte->reporteNoMiembro);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($reporte);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteReporte($id) {
	$sql = "DELETE FROM exf_reporte WHERE id_reporte=:id";
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
