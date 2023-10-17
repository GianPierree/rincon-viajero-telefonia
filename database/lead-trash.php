<?php
require("./conn.php");
require("./../functions/Log.php");

$log = new Log;
$log->logRequest($_POST, "Log del leads-trash");

$campanaId = $_POST["arr"]['id'];

// echo json_encode($_POST);

$array = array();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "SELECT leadId, campaignId FROM leads WHERE campaignId = $campanaId";
    $result = $conn->query($sql);

    if ($result->num_rows >= 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $idLead = $row["leadId"];

            $sqlD = "DELETE FROM leads WHERE leadId = $idLead";

            if ($conn->query($sqlD) === TRUE) {
                $r = "Lead id eliminado " . $row["leadId"];
                array_push($array, $r);
            } else {
                $r = "Error deleting record $idLead : " . $conn->error;
                array_push($array, $r);
            }
        }

        $sqlC = "DELETE FROM campaigns WHERE id = $campanaId";

        if ($conn->query($sqlC) === TRUE) {
            $r = "campaigns id eliminado " . $campanaId;
            array_push($array, $r);
        } else {
            $r = "Error deleting record $campanaId : " . $conn->error;
            array_push($array, $r);
        }
        echo json_encode(array('success' => $array));
    }
     
    $conn->close();
}
