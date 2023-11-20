<?php
require("./../functions/Log.php");
require("./conn.php");

$log = new Log;
$log->logRequest($_POST, "Log del campaigns");

$id = $_POST["arr"]['id'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "SELECT c.stats FROM campaigns c WHERE id = $id";
    $log->logRequest($sql, "Log SQL");

    if ($conn->query($sql) === TRUE) {
       echo json_encode(array('success' => "Actualización a la tabla campaigns realizada."));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}