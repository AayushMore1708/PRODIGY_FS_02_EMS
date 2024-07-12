<?php
// Include the database connection file
require_once("dbConnection.php");

if (isset($_POST['update'])) {
    // Escape special characters in a string for use in an SQL statement
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $age = mysqli_real_escape_string($mysqli, $_POST['age']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
    $address = mysqli_real_escape_string($mysqli, $_POST['address']);
    $department = mysqli_real_escape_string($mysqli, $_POST['department']);
    $job_title = mysqli_real_escape_string($mysqli, $_POST['job_title']);
    $hire_date = mysqli_real_escape_string($mysqli, $_POST['hire_date']);
    $salary = mysqli_real_escape_string($mysqli, $_POST['salary']);

    // Check for empty fields
    if (empty($name) || empty($age) || empty($email) || empty($phone) || empty($address) || empty($department) || empty($job_title) || empty($hire_date) || empty($salary)) {
        if (empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        if (empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }
        if (empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        if (empty($phone)) {
            echo "<font color='red'>Phone field is empty.</font><br/>";
        }
        if (empty($address)) {
            echo "<font color='red'>Address field is empty.</font><br/>";
        }
        if (empty($department)) {
            echo "<font color='red'>Department field is empty.</font><br/>";
        }
        if (empty($job_title)) {
            echo "<font color='red'>Job Title field is empty.</font><br/>";
        }
        if (empty($hire_date)) {
            echo "<font color='red'>Hire Date field is empty.</font><br/>";
        }
        if (empty($salary)) {
            echo "<font color='red'>Salary field is empty.</font><br/>";
        }
    } else {
        // Update the database table
        $result = mysqli_query($mysqli, "UPDATE users SET `name` = '$name', `age` = '$age', `email` = '$email', `phone` = '$phone', `address` = '$address', `department` = '$department', `job_title` = '$job_title', `hire_date` = '$hire_date', `salary` = '$salary' WHERE `id` = $id");

        // Display success message
        echo "<p><font color='green'>Data updated successfully!</p>";
        echo "<a href='index.php'>View Result</a>";
        header("Location: index.php");
    }
}
?>