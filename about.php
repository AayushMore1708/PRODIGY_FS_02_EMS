<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
// Include the database connection file
require_once("dbConnection.php");

$result = mysqli_query($mysqli, "SELECT * FROM companies WHERE id = 1"); // assuming company ID is 1
$company_data = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Company - <?php echo $company_data['name']; ?></title>
	<link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/3090/3090108.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style> 
  body {
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            min-height: 100vh;
        }

        /* Style the navigation menu */
.form-control.me-2 {
  width: 300px; /* adjust the width to your liking */
  height: 40px; /* adjust the height to your liking */
  font-size: 18px; /* adjust the font size to your liking */
  padding: 5px; /* adjust the padding to your liking */
}
.d-none.d-sm-inline.mx-1 {
  color: #337ab7; /* blue color */
  font-weight: bold; /* make the text bold */
  font-size: 16px; /* increase the font size */
  padding: 5px; /* add some padding around the text */
  border-radius: 5px; /* add a slight rounded corner effect */
  background-color: #f7f7f7; /* light gray background color */
}
        /* Style the navigation items */
.nav-item {
  margin-left: 20px; /* add some space between items */
  margin-top: 10px; /* add some space between items */
  padding: 10px; /* add some padding around the button */
  border: none; /* remove the default border */
  border-radius: 5px; /* add a slight rounded corner effect */
  background-color: #00b090; /* blue background color */
  color: #fff; /* white text color */
  font-weight: bold; /* make the text bold */
  font-size: 16px; /* increase the font size */
  cursor: pointer; /* change the cursor to a pointer on hover */
}

.nav-item:hover {
  background-color: #23527c; /* darker blue background color on hover */
  color: #fff; /* keep the text color white on hover */
}

.nav-item.active {
  background-color: #23527c; /* darker blue background color for active item */
  color: #fff; /* keep the text color white for active item */
}

/* Style the icons */
.bi-house, .bi-people {
  font-size: 24px; /* increase icon size */
  margin-right: 10px; /* add some space between icon and text */
  color: #fff; /* white icon color */
}

        .navbar {
            background: linear-gradient(120deg, #f6d365, #fda085);

        }

        .navbar-brand, .nav-link {
            color: black !important;
            font-weight: bold;
            font-size: 20px;
        }

        #sidebar {
            background: linear-gradient(120deg, #a18cd1, #fbc2eb);

  width: 250px; /* adjust the width to your liking */
  min-width: 250px; /
        }

        .dropdown {
            font-size: 28px;
            padding: 10px 20px; /* Adjust padding for size */
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

        /* Responsive design */
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
    </style>
</head>

<body>
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Employee Management System</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav me-auto">
					<a class="nav-link active" aria-current="page" href="index.php">Home</a>
					<a class="nav-link" href="logout.php">Logout</a>
				</div>
				<div class="dropdown">
					<a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
						<img src="https://github.com/mdo.png" alt="Profile" width="30" height="30" class="rounded-circle">
						<span class="d-none d-sm-inline mx-1">
							<?php echo $_SESSION['username']; ?></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="dropdownUser1">

						<li><a class="dropdown-item" href="about.php">Profile</a></li>
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
			<div class="col-auto col-md-3 col-xl-2 px-0 " id="sidebar">
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
								<i class="fs-4 bi-people"></i> <span type="button" class="ms-1 d-none d-sm-inline">About</button> </a>
						</li>
					</ul>
					<hr>
				</div>
			</div>
			
 <div class="col py-3">
                <div class="company-info">
                    <h1><?php echo $company_data['name']; ?></h1>
                    <p><?php echo $company_data['description']; ?></p>
                    <p>Address: <?php echo $company_data['address']; ?></p>
                    <p>Phone: <?php echo $company_data['phone']; ?></p>
                    <p>Email: <?php echo $company_data['email']; ?></p>
                </div>
            </div>
</body>

</html>