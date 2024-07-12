<?php
require_once("dbConnection.php");

$search_query = $_POST['search'];

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE name LIKE '%$search_query%' OR age LIKE '%$search_query%' OR email LIKE '%$search_query%' ORDER BY id DESC");

$employees = array();
while ($res = mysqli_fetch_assoc($result)) {
    $employees[] = $res;
}

echo json_encode($employees);
?>