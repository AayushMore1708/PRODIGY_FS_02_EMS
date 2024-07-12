<?php
require_once("dbConnection.php");

$id = $_POST['id'];

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id = $id");
$resultData = mysqli_fetch_assoc($result);

echo json_encode($resultData);
?>