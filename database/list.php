<?php
require("./../functions/Log.php");
require("./conn.php");

$log = new Log;
$log->logRequest($_POST, "Log del agentes");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    // echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
    echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
} else {

    $sql = "SELECT id, campaignName FROM campaigns";
    $log->logRequest($sql, "Log SQL");

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><th scope='row'>" . $row["id"] . "</th><td>" . $row["campaignName"] . "</td><td><button class='btn btn-info' role='button' onclick='campanaPlay(" . $row["id"] . ", 1)'><img src='./images/play.svg' /></button>  <button class='btn btn-info' role='button' onclick='campanaStop(" . $row["id"] . ", 0)'><img src='./images/stop.svg' /></button> <button class='btn btn-info' role='button' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='" . $row["id"] . "'><img src='./images/edit.svg' /></button>  <button class='btn btn-info' role='button' onclick='campanaRecycle(" . $row["id"] . ", 0)'><img src='./images/recycle.svg' /></button> <button class='btn btn-info' role='button' onclick='campanaTrash(" . $row["id"] . ")'><img src='./images/trash.svg' /></button></td></tr>";
        }
        //echo json_encode(array('data' => $sql));
    } else {
        echo "0 results";
        echo json_encode(array('success' => "Error: " . $sql . "<br>" . $conn->error));
    }

    $conn->close();
}
