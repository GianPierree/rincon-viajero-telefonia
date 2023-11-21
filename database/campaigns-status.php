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
    $log->logRequest($query, "Log SQL");
    $query = $conn->query($sql);
    $id = '';

    while ($obj = $query->fetch_object()) {
        $id = $obj->id;
    }

    if ($query->num_rows >= 0) {
        echo json_encode(array('success' => "Estados de campanas.", 'data' => $id, 'obj' => $query->fetch_object()));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
