<?php
require("./database/conn.php");
require("./functions/Log.php");

$log = new Log;

// print_r($_REQUEST);

$arrId = $_REQUEST["document_id"][2];
$id = explode("_", $arrId);
writeToLog($id, 'incoming');
$idLead = $id[1];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {
    $sqlD = "DELETE FROM leads WHERE leadId = $idLead";
    $log->logRequest($sqlD, "Log SQL");

    if ($conn->query($sqlD) === TRUE) {
        $r = "Lead id eliminado " . $idLead;
        echo json_encode(array('success' => "Eliminación de lead."));
    } else {
        $r = "Error deleting record $idLead : " . $conn->error;
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }
    
    $conn->close();
}

/**
 * Write data to log file.
 *
 * @param mixed $data
 * @param string $title
 *
 * @return bool
 */
function writeToLog($data, $title = '')
{
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents(getcwd() . '/hook.log', $log, FILE_APPEND);
    return true;
}
