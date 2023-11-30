<?php
require("./../functions/Log.php");
require("./conn.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "SELECT c.id, c.campaignName, c.stats  FROM campaigns c";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $rows = $result->fetch_assoc();
        echo $rows;
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}