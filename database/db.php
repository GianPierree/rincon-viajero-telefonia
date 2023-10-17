<?php
require("../functions/Log.php");
require("conn.php");

$log = new Log;
$log->logRequest($_POST, "Log de las campañas.");

$nombre = $_POST["arrCampana"]['nombre'];
$colaId = $_POST["arrCampana"]['idCola'];
$campanaId = $_POST["arrCampana"]['id'];
$tipo = $_POST["arrCampana"]['tipo'];
$intentos = $_POST["arrCampana"]['intentos'];
$intervalo = $_POST["arrCampana"]['intervalo'];
$agentes = $_POST["arrCampana"]['agentes'];
$num = $_POST["arrCampana"]['numero'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "INSERT INTO campaigns (id, campaignName, callerId, type, maxHints, waitTime, agents, cpa, stats, customerId, queueId) VALUES ($campanaId, '" . $nombre . "', $num, $tipo, $intentos, $intervalo, $agentes, 7, 0, 1, $colaId) ON DUPLICATE KEY UPDATE id=$campanaId, stats=0";
    $log->logRequest($sql, "Log SQL");

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => "Conexión a la tabla campaigns realizada."));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
