<!DOCTYPE html>
<html>

<?php
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();
    
    $sql1 = "SELECT emp_id,emp_name,nic,dept_code from employee";
	$result = mysqli_query($conn, $sql1);
	$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);

    if(isset($_POST["submit"])){
        $last_id = '';
        $name = $_POST["name"];
        $type = $_POST["type"];
        $head = $_POST["head"];

	    $sql = "INSERT INTO department(dept_code, type, dept_name, head) VALUES('', '$type', '$name', '$head')";

        if(mysqli_query($conn, $sql)){
            $last_id = $conn->insert_id;
            $contact1 = $_POST["contact1"];
            $contacts = explode(",", $contact1);
            $error = false;
            for($x = 0; $x < count($contacts); $x++){
                $sql = "INSERT INTO department_contact(dept_code, contact_no) VALUES('$last_id', '$contacts[$x]')";
                if(!mysqli_query($conn, $sql)){
                    global $error;
                    $error = true;
                    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
                    break;
                }
            }
            if(!$error){
                echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
            }
        }else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
            mysqli_close($conn);
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-sm">
            <h5 class="text-center">Add Department</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addDepartment.php" method="POST">
                        <div class="form-group">
                            <label for="username">Department Name</label>
                            <input type="text" name="name" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Contact No(Enter contact numbers seperated by commas Eg: 011456231,011235644)</label>
                            <input type="text" name="contact1" required class="form-control" id="contact1"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Department Type</label>
                            <input type="text" name="type" required class="form-control"/>
                        </div>
			            <div class="form-group">
                            <label for="head">Department Head</label>
                            <input type="number" name="head" class="form-control"/>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <h5 class="text-center">Employees</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>NIC</th>
                        <th>Department Code</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee["emp_id"]);?></td>
                            <td><?php echo htmlspecialchars($employee["emp_name"]);?></td>
                            <td> <?php echo htmlspecialchars($employee["nic"]);?></td>
                            <td><?php echo htmlspecialchars($employee["dept_code"]);?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
    $('#table_id').DataTable();
} );
</script>

</body>

</html>
