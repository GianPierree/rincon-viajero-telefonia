<?php
require("./conn.php");
require("./../functions/Log.php");

$log = new Log;
$log->logRequest($_POST, "Log del leads");

$campanaId = $_POST["arrLeads"]['idCampana'];
$leadId = $_POST["arrLeads"]['id'];
$leadTelefono = $_POST["arrLeads"]['telefono'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "INSERT INTO leads (leadId, dst, campaignId) VALUES ($leadId, $leadTelefono, $campanaId) ON DUPLICATE KEY UPDATE lastStatus=0, hints=0";
    $log->logRequest($sql, "Log SQL");

    if ($conn->query($sql) === TRUE) {
       echo json_encode(array('sql' => $sql));
       echo json_encode(array('success' => "Conexión a la tabla leads realizada. Num: " . $leadTelefono));
    } else {
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
