<?php
// Create a new PHP file, e.g., `viewEmployee.php`

// Include the database connection file
require_once("dbConnection.php");

// Check if the employee ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the employee data from the database
    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE id = '$id'");

    if (mysqli_num_rows($result) > 0) {
        $employeeData = mysqli_fetch_assoc($result);

        // Display the employee details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Employee Details</title>
            	<link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3090/3090108.png">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <style>
    body {
        background: linear-gradient(120deg, #96fbc4, #f586);
        min-height: 100vh;
      
    }
    table, th, td,tr {
      border: 1px solid;
       max-width: 800px;
          margin: 0 auto;
    }
    table {
      table-layout: fixed;
      width: 100%;
      
          margin: 0 auto;
                  
    }
 
    th, td {
      word-wrap: break-word;
      overflow-wrap: break-word;
    }
            </style>
        </head>
        <body>
            <div class="container-fluid">
                <div class="row flex-nowrap">
                    <div class="col py-3">
                        <h2 align="center">Employee Details : -</h2>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th scope="col">Name:</th>
                                <td><?php echo $employeeData['name']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Age:</th>
                                <td><?php echo $employeeData['age']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Email:</th>
                                <td><?php echo $employeeData['email']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Phone:</th>
                                <td><?php echo $employeeData['phone']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Address:</th>
                                <td><?php echo $employeeData['address']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Department:</th>
                                <td><?php echo $employeeData['department']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Job Title:</th>
                                <td><?php echo $employeeData['job_title']; ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Hire Date:</th>
                                <td><?php echo date("M d, Y", strtotime($employeeData['hire_date'])); ?></td>
                            </tr>
                            <tr>
                                <th scope="col">Salary:</th>
                                <td><?php echo number_format($employeeData['salary'], 2); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Employee not found.";
    }
} else {
    echo "Invalid request.";
}
?>