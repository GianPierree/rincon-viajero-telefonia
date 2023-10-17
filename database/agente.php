<?php
require("./../functions/Log.php");
require("./conn.php");

$log = new Log;
$log->logRequest($_POST, "Log del agentes");

$id = $_POST['arrayFormAgente'][1]['value'];
$agente = $_POST['arrayFormAgente'][0]['value'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    // echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "UPDATE campaigns SET agents = $agente WHERE id = $id";
    $log->logRequest($sql, "Log SQL");

    if ($conn->query($sql) === TRUE) {
       echo json_encode(array('success' => "Actualización del agente de campaigns realizada."));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}