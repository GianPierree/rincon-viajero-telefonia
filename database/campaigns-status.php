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

    $sql = "SELECT stats FROM campaigns WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(array('success' => "Estados de campanas.", 'stats' => $row['stats']));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
