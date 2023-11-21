<?php
// echo "Hola";
$hostname = "rinconviajero.t24service.com";
$database = "adialer";
$username = "t24dialer";
$password = "T24Service@2023";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn) {
  // echo json_encode(array('success' => "Conexión a la base de datos realizada."));
} else {
  die("Connection failed: " . $conn->connect_error);
  echo json_encode(array('success' => "Error de conexión: " . $conn->connect_error));
}
