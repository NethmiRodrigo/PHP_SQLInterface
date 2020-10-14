<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();

$sql1 = "SELECT * from employee";
$result = mysqli_query($conn, $sql1);
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql2 = "SELECT * FROM intern";
$result2 = mysqli_query($conn, $sql2);
$interns = mysqli_fetch_all($result2, MYSQLI_ASSOC);
mysqli_free_result($result2);

$sql3 = "SELECT * FROM permanent_employee";
$result3 = mysqli_query($conn, $sql3);
$permanents = mysqli_fetch_all($result3, MYSQLI_ASSOC);
mysqli_free_result($result3);

if(isset($_POST['submit'])){
	$emp_id = $_POST["emp_id"];
	$type = $_POST["type"];
	$updated_value = $_POST["updated_value"];
	$sql = '';
	$update_field = '';
    if($type == 'intern'){
            global $sql;
            global $update_field;
            $update_field = $_POST["update_field_intern"];
            if($update_field == 'period' or $update_field == 'salary_scale') {
                $sql = "UPDATE intern SET $update_field = '$updated_value' WHERE emp_id = '$emp_id'";
            }
            else {
                $sql = "UPDATE employee SET $update_field = '$updated_value' WHERE emp_id = '$emp_id'";
            }
    }
    else if($type == 'permanent'){
            global $sql;
            $update_field = $_POST["update_field_permanent"];
            if($update_field == 'basic_salary' or $update_field == 'grade'){
                $sql = "UPDATE permanent SET $update_field = '$updated_value' WHERE emp_id = '$emp_id'";
            }
            else {
                $sql = "UPDATE employee SET $update_field = '$updated_value' WHERE emp_id = '$emp_id'";
            }
    }

    if($conn->query($sql) == TRUE){
        echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY UPDATED!</div>";
    }else{
        echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
    }
    mysqli_close($conn);
}
?>
<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="text-center">Update Employee</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateEmployee.php" method="POST">
                        <div class="form-group">
                            <label for="emp_id">Employee Id</label>
                            <input type="number" name="emp_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Employee Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);" required>
                                <option selected>Choose Type</option>
                                <option value="intern">Intern</option>
                                <option value="permanent">Permanent</option>
                            </select>
                        </div>
                        <div id="intern">
                            <div class="form-group">
                                <label for="update_field_intern">Update Field</label>
                                <select id="update_field_intern" name="update_field_intern" class="form-control" required>
                                    <option selected>Choose field</option>
									<option value="emp_name">Name</option>
									<option value="nic">NIC</option>
									<option value="emp_address">Address</option>
                                    <option value="qualification">Qualification</option>
									<option value="period">Period</option>
									<option value="salary_scale">Salary Scale</option>
                                </select>
                            </div>
                        </div>
                        <div id="permanent">
                            <div class="form-group">
                                <label for="update_field_permanent">Update Field</label>
                                <select id="update_field_permanent" name="update_field_permanent" class="form-control" required>
                                    <option selected>Choose field</option>
									<option value="emp_name">Name</option>
									<option value="nic">NIC</option>
									<option value="emp_address">Address</option>
                                    <option value="qualification">Qualification</option>
									<option value="basic_salary">Basic Salary</option>
									<option value="grade">Grade</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updated_value">Enter new value</label>
                            <input type="text" name="updated_value" required class="form-control"/>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm" style="padding-top: 50px">
            <h5 class="text-center">All Employees</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>NIC</th>
                        <th>Date of birth</th>
                        <th>Address</th>
                        <th>Qualification</th>
                        <th>Type</th>
                        <th>Department Code</th>
                        <th>Branch</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee["emp_id"]);?></td>
                            <td><?php echo htmlspecialchars($employee["emp_name"]);?></td>
                            <td> <?php echo htmlspecialchars($employee["nic"]);?></td>
                            <td><?php echo htmlspecialchars($employee["dob"]);?></td>
                            <td><?php echo htmlspecialchars($employee["emp_address"]);?></td>
                            <td><?php echo htmlspecialchars($employee["qualification"]);?></td>
                            <td><?php echo htmlspecialchars($employee["type"]);?></td>
                            <td><?php echo htmlspecialchars($employee["dept_code"]);?></td>
                            <td> <?php if($employee["regional_id"] != NULL ) echo htmlspecialchars($employee["regional_id"]); else echo htmlspecialchars($employee["supergrade_id"]);?> </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm" style="padding-top: 50px">
            <h5 class="text-center">Interns</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="intern_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Employee ID</th>
                        <th>Temporary Id</th>
                        <th>Period</th>
                        <th>Start date</th>
                        <th>Salary Scale</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($interns as $intern) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($intern["emp_id"]);?></td>
                            <td> <?php echo htmlspecialchars($intern["temp_id"]);?></td>
                            <td><?php echo htmlspecialchars($intern["period"]);?></td>
                            <td><?php echo htmlspecialchars($intern["start_date"]);?></td>
                            <td><?php echo htmlspecialchars($intern["salary_scale"]);?></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm" style="padding-top: 50px">
            <h5 class="text-center">Permanent Employees</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="permanent_table" class="table table-striped" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Employee ID</th>
                            <th>Basic Salary</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($permanents as $permanent) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($permanent["emp_id"]);?></td>
                            <td> <?php echo htmlspecialchars($permanent["basic_salary"]);?></td>
                            <td><?php echo htmlspecialchars($permanent["grade"]);?></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
	</div>  
</div>


<script type="text/javascript">
    $(document).ready(function() {
    $('#table_id').DataTable();
} );
    $(document).ready(function() {
    $('#intern_table').DataTable();
} );
    $(document).ready(function() {
    $('#permanent_table').DataTable();
} );
    function changeType(sel) {
         var p = document.getElementById('intern');
         var b = document.getElementById('permanent');

         var choice = sel.value;

         if(choice == 'intern')
         {
            p.style.display = 'block';
            b.style.display = 'none';
         }
         else if(choice == 'permanent')
         {
             p.style.display = 'none';
             b.style.display = 'block';

         }
    }
</script>

</body>

</html>
	
	
	
	
	
	
	
	
	
}