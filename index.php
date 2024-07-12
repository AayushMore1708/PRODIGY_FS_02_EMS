<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

require_once("dbConnection.php");

$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

$result = mysqli_query($mysqli, "SELECT * FROM users WHERE name LIKE '%$search_query%' OR age LIKE '%$search_query%' OR email LIKE '%$search_query%' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3090/3090108.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            min-height: 100vh;
        }

       .form-control.me-2 {
            width: 300px;
            height: 40px;
            font-size: 18px;
            padding: 5px;
        }

       .d-none.d-sm-inline.mx-1 {
            color: #337ab7;
            font-weight: bold;
            font-size: 16px;
            padding: 5px;
            border-radius: 5px;
            background-color: #f7f7f7;
        }

       .nav-item {
            margin-left: 20px;
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #00b090;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

       .nav-item:hover {
            background-color: #23527c;
            color: #fff;
        }

       .nav-item.active {
            background-color: #23527c;
            color: #fff;
        }

       .bi-house,.bi-people {
            font-size: 24px;
            margin-right: 10px;
            color: #fff;
        }

       .navbar {
            background: linear-gradient(120deg, #f6d365, #fda085);
        }

       .navbar-brand,.nav-link {
            color: black!important;
            font-weight: bold;
            font-size: 20px;
        }

        #sidebar {
            background: linear-gradient(120deg, #a18cd1, #fbc2eb);
            width: 250px;
            min-width: 250px;
        }

       .dropdown {
            font-size: 28px;
            padding: 10px 20px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        #dropdown {
            background: linear-gradient(120deg, #f6d365, #fda085);
        }

       .container-fluid {
            margin-top: 0px;
        }

       .ButtonsCRUD {
            margin-bottom: 20px;
        }

       .table {
            background-color: #ffffff;
        }

        /* Responsive designs */
        @media (max-width: 768px) {
            #sidebar {
                display: none;
            }
        }

        @media (max-width: 576px) {
           .ButtonsCRUD {
                margin-bottom: 10px;
            }
        }

        @media (max-width: 393px) {
           .container-fluid {
                padding:0 10px;
            }
          .ButtonsCRUD {
                margin-bottom: 10px;
            }
          .table {
                font-size: 12px;
            }
          .nav-item {
                margin-left: 10px;
            }
        }

        @media (max-width: 480px) {
          .container-fluid {
                padding: 0 15px;
            }
          .ButtonsCRUD {
                margin-bottom: 15px;
            }
          .table {
                font-size: 14px;
            }
          .nav-item {
                margin-left: 15px;
            }
        }

        @media (max-width: 430px) {
          .container-fluid {
                padding: 0 12px;
            }
          .ButtonsCRUD {
                margin-bottom: 12px;
            }
          .table {
                font-size: 13px;
            }
          .nav-item {
                margin-left: 12px;
            }
        }

        @media (max-width:360px) {
          .container-fluid {
                padding: 0 8px;
            }
          .ButtonsCRUD {
                margin-bottom: 8px;
            }
          .table {
                font-size: 11px;
            }
          .nav-item {
                margin-left: 8px;
            }
        }

        @media (max-width: 768px) {
           #sidebar {
                display: none;
            }
          .dropdown {
                display: inline-block;
                margin-right: 1200px;
            }
          .navbar-nav {
                flex-direction: row;
            }
          .nav-link {
                display: inline-block;
            }
        }

       .navbar-brand {
            display: inline-block;
            margin-right: 10px;
        }

       .navbar-nav {
            flex-direction: row;
        }

       .dropdown {
            display: inline-block;
            margin-right: 50px;
        }
    </style>
</head>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Employee Management System</a>
        <ul class="navbar-nav">
            <li class="nav-itemnav">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
			&nbsp;
			&nbsp;
            <li class="nav-itemnav">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="Profile" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">
                        <?php echo $_SESSION['username'];?>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="about.php">About</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-0" id="sidebar">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-5 pt-1 text-black min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-end" id="menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">About</span>
                       </a>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
        <div class="col py-3">
            <div class="ButtonsCRUD">
                <form action="" method="post" class="d-flex mb-3">
                    <input type="search" name="search" placeholder="Search employees" class="form-control me-2">
                </form>
                <?php
                if (empty($search_query)) {
                    $result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
                } else {
                    $result = mysqli_query($mysqli, "SELECT * FROM users WHERE name LIKE '%$search_query%' OR age LIKE '%$search_query%' OR email LIKE '%$search_query%' ORDER BY id DESC");
                }
               ?>
                <p>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#create" class="btn btn-primary">Add New Employee</button>
                </p>
                <p id="totalEmployees">Total Employees</p>
            </div>
            <table class="table table-striped table-hover table-bordered  table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    while ($res = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>". $res['name']. "</td>";
                        echo "<td>". $res['age']. "</td>";
                        echo "<td>". $res['email']. "</td>";
                        echo "<td>
                            <button type=\"button\" class=\"btn btn-info\" onclick=\"location.href='viewEmployee.php?id=". $res['id']. "'\">View Details</button>
                            <button type=\"button\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#edit\" onclick=\"setEditId(". $res['id']. ")\">Edit</button>
                            <a href=\"delete.php?id=". $res['id']. "\" class=\"btn btn-danger\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                            </td>";
                        echo "</tr>";
                    }
                   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add New Employee Modal -->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="add" method="post" action="addAction.php">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="text" class="form-control" id="age" name="age" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" name="department" required>
                            </div>
                            <div class="form-group">
                                <label for="job_title">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" required>
                            </div>
                            <div class="form-group">
                                <label for="hire_date">Hire Date</label>
                                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                            </div>
                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary"required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-3">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Employee Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="edit" method="post" action="editAction.php">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="form-group">
                                <label for="names">Name</label>
                                <input type="text" name="name" id="names" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ages">Age</label>
                                <input type="text" name="age" id="ages" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="emails">Email</label>
                                <input type="email" name="email" id="emails" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phones">Phone</label>
                                <input type="text" name="phone" id="phones" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="addresses">Address</label>
                                <textarea name="address" id="addresses" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="departments">Department</label>
                                <input type="text" name="department" id="departments" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="job_titles">Job Title</label>
                                <input type="text" name="job_title" id="job_titles" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="hire_dates">Hire Date</label>
                                <input type="date" name="hire_date" id="hire_dates" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="salaries">Salary</label>
                                <input type="number" name="salary" id="salaries" class="form-control" required>
                            </div>
                            <input type="hidden" name="id" id="ids">
                            <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let editId = null;

    function setEditId(id) {
        editId = id;
        jQuery.ajax({
            type: "POST",
            url: "fetchEmployee.php",
            data: {id: editId},
            success: function(data) {
                const employeeData = JSON.parse(data);
                $('#names').val(employeeData.name);
                $('#ages').val(employeeData.age);
                $('#emails').val(employeeData.email);
              $('#phones').val(employeeData.phone);
                $('#addresses').val(employeeData.address);
                $('#departments').val(employeeData.department);
                $('#job_titles').val(employeeData.job_title);
                $('#hire_dates').val(employeeData.hire_date);
                $('#salaries').val(employeeData.salary);
                $('#ids').val(employeeData.id);
                $('#edit').modal('show');
            }
        });
    }

    const searchInput = document.querySelector('input[name="search"]');
    searchInput.addEventListener('input', showSearchResults);

    function showSearchResults() {
        const searchQuery = document.querySelector('input[name="search"]').value;
        jQuery.ajax({
            type: "POST",
            url: "search.php",
            data: {search: searchQuery},
            success: function(data) {
                const tableBody = document.querySelector('tbody');
                tableBody.innerHTML = '';
                const searchData = JSON.parse(data);
                searchData.forEach((employee) => {
                    const tableRow = document.createElement('tr');
                    tableRow.innerHTML = `
                        <td>${employee.name}</td>
                        <td>${employee.age}</td>
                        <td>${employee.email}</td>
                        <td>
                            <button type="button" class="btn btn-info" onclick="location.href='viewEmployee.php?id=${employee.id}'">View Details</button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit" onclick="setEditId(${employee.id})">Edit</button>
                            <a href="delete.php?id=${employee.id}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                        </td>
                    `;
                    tableBody.appendChild(tableRow);
                });
            }
        });
    }
</script>
</body>
</html>