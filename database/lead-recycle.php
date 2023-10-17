<?php
require("./conn.php");
require("./../functions/Log.php");

$log = new Log;
$log->logRequest($_POST, "Log del leads-recycle");

$campanaId = $_POST["arr"]['id'];

$array = array();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "SELECT leadId, campaignId FROM leads WHERE campaignId = $campanaId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $idLead = $row["leadId"];
            
            $sqlD = "DELETE FROM leads WHERE leadId = $idLead";
            
            if ($conn->query($sqlD) === TRUE) {
                $r = "Lead id eliminado " . $row["leadId"];
                array_push($array, $r);
            } else {
                echo json_encode(array('success' => "Error deleting record $idLead : " . $conn->error));
            }
        }
        echo json_encode(array('success' => $array));
    } else {
        echo json_encode(array('success' => "0 resultados."));
        // echo "0 results";
    }
    $conn->close();
}
