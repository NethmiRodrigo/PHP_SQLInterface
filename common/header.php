<?php
session_start();
include_once('config/db_connect.php');
$conn = connect();
if(!$conn) {
    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>Session timed out!</div>";
    header('Location: index.php');
}
mysqli_close($conn);
?>

<head>
    <title>Bank of Asia</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script type="text/javascript" charset="utf8" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"
    ></script>
    <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"
    ></script>

    <style>
        body {
            background-color: #0F2027;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: 'Poppins', sans-serif;
            color: white;
        }
         button:hover{
            background-color: #36667c !important;
        }
        button{
            width: 100%;
            background-color: #2193b0 !important;
            color: white !important;
        }
        li{
            margin-right: 10px;
            margin-left: 10px;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <a class="navbar-brand" href="#">
        <a href="home.php"><img src="assets/icon.png" width="10%" height="10%" alt="" loading="lazy" style="border: solid 1px white;border-radius: 50%; margin-right: 5px"/>
        <span class="navbar-text">Bank of Asia</span></a>
    </a>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Branch
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addBranch.php">Add Branch</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteBranch.php">Delete Branch</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateBranch.php">Update Branch</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Employee
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addEmployee.php">Add Employee</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteEmployee.php">Delete Employee</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateEmployee.php">Update Employee</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Department
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addDepartment.php">Add Department</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteDepartment.php">Delete Department</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateDepartment.php">Update Department</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addAccount.php">Add Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteAccount.php">Delete Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateAccount.php">Update Account</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Assignment
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addAssignment.php">Add Assignment</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteAssignment.php">Delete Assignment</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateAssignment.php">Update Assignment</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customer
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="addCustomer.php">Add Customer</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="deleteCustomer.php">Delete Customer</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="updateCustomer.php">Update Customer</a>
                </div>
            </li>
        </ul>
        <span class="navbar-text" style="padding: 10px">
            <i class="fas fa-user" style="padding: 5px"></i>User: <?php echo strtoupper($_SESSION['username']); ?>
        </span>
        <span class="navbar-text">
            <a href="config/logout.php" class="nav-link">Logout</a>
        </span>

    </div>
</nav>


