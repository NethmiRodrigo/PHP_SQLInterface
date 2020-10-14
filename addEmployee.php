<!DOCTYPE html>
<html>

<?php
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();
    $sql1 = "SELECT * from regional_branch";
    $result = mysqli_query($conn, $sql1);
    $regional_branches = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    $sql2 = "SELECT * from supergrade_branch";
    $result2 = mysqli_query($conn, $sql2);
    $supergrade_branches = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    mysqli_free_result($result2);

    $sql3 = "SELECT * from department";
    $result3 = mysqli_query($conn, $sql3);
    $departments= mysqli_fetch_all($result3, MYSQLI_ASSOC);

    if(isset($_POST["submit"])){
        $emp_name = $_POST["name"];
        $nic = $_POST["nic"];
        $emp_address = $_POST["address"];
        $type = $_POST["type"];
		$branch_id = $_POST["branch_id"];
		$dept_code = $_POST["dept_code"];
		$dob = $_POST["dob"];
		$qualification = $_POST["qualification"];
		$branch_type = $_POST["branch_type"];
		$sql = '';
		if($branch_type == 'regional'){
		    global $sql;
            $sql = "INSERT INTO employee VALUES ('', '$dob', '$qualification', '$emp_name', '$nic', '$emp_address', '$type', '$branch_type', '$dept_code', '$branch_id', NULL)";
        }
        else if($branch_type == 'supergrade'){
            global $sql;
            $sql = "INSERT INTO employee VALUES ('', '$dob', '$qualification', '$emp_name', '$nic', '$emp_address', '$type', '$branch_type', '$dept_code', NULL,'$branch_id')";
        }
        if(mysqli_query($conn, $sql)){
            if($type == 'Intern' or $type == 'Permanent'){
                $last_id = $conn->insert_id;
                if($type == 'Intern'){
                    global $sql;
                    $temp_id = $_POST["temp_id"];
                    $period = $_POST["period"];
                    $start_date = $_POST["start_date"];
                    $salary_scale = $_POST["salary_scale"];
                    $sql = "INSERT INTO intern VALUES('$last_id', '$temp_id', '$period', '$start_date', '$salary_scale')";
                }
                else if($type == 'Permanent'){
                    global $sql;
                    $basic_salary = $_POST["basic_salary"];
                    $grade = $_POST["grade"];
                    $sql = "INSERT INTO permanent_employee VALUES('$last_id', '$basic_salary', '$grade')";
                }
                if(mysqli_query($conn, $sql)){
                    echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
                }
                else {
                    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
                }
            }
            else {
                echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
            }
        }
        else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
        mysqli_close($conn);
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="text-center">Add Employee</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addEmployee.php" method="POST">
                        <div class="form-group">
                            <label for="username">Employee Name</label>
                            <input type="text" name="name" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">NIC number</label>
                            <input type="text" name="nic" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" name="qualification" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Employee Type</label>
                            <select id="type" name="type" class="form-control" onChange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="Other">Other</option>
                                <option value="Intern">Intern</option>
                                <option value="Permanent">Permanent</option>
                            </select>
                        </div>
                        <div id="intern">
                            <div class="form-group">
                                <label for="temp_id">Temporary Id</label>
                                <input type="text" name="temp_id" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="period">Period (in months)</label>
                                <input type="text" name="period" class="form-control" placeholder="Eg: 12"/>
                            </div>
							<div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control"/>
                            </div>
							<div class="form-group">
                                <label for="salary_scale">Salary Scale</label>
                                <input type="number" name="salary_scale" class="form-control"/>
                            </div>
                        </div>
                        <div id="permanentemployee">
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" class="form-control"/>
                            </div>
							 <div class="form-group">
                                <label for="grade">Grade</label>
                                <input type="text" name="grade" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="branch_type">Branch Type</label>
                            <select id="branch_type" name="branch_type" class="form-control">
                                <option selected>Choose type...</option>
                                <option value="regional">Regional</option>
                                <option value="supergrade">Supergrade</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label for="branch_id">Branch ID</label>
                            <input type="text" name="branch_id" required class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="dept_code">Department Code</label>
                            <input type="text" name="dept_code" required class="form-control"/>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-top: 50px">
        <div class="col-sm">
            <h5 class="text-center">Branches</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Branch ID</th>
                        <th>Branch Name</th>
                        <th>Branch Location</th>
                        <th>Building Area</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($regional_branches as $regional_branch) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($regional_branch["branch_id"]);?></td>
                            <td><?php echo htmlspecialchars($regional_branch["branch_name"]);?></td>
                            <td> <?php echo htmlspecialchars($regional_branch["location"]);?></td>
                            <td><?php echo htmlspecialchars($regional_branch["building_area"]);?></td>
                            <td>Regional</td>
                        </tr>
                    <?php } ?>
                    <?php foreach  ($supergrade_branches as $supergrade_branch) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($supergrade_branch["branch_id"]);?></td>
                            <td><?php echo htmlspecialchars($supergrade_branch["branch_name"]);?></td>
                            <td> <?php echo htmlspecialchars($supergrade_branch["location"]);?></td>
                            <td><?php echo htmlspecialchars($supergrade_branch["building_area"]);?></td>
                            <td>Supergrade</td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm">
            <h5 class="text-center">Departments</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="departments_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Department Code</th>
                        <th>Department Name</th>
                        <th>Department Head</th>
                        <th>Department Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($departments as $department) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($department["dept_code"]);?></td>
                            <td><?php echo htmlspecialchars($department["dept_name"]);?></td>
                            <td> <?php echo htmlspecialchars($department["head"]);?></td>
                            <td><?php echo htmlspecialchars($department["type"]);?></td>
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
    $('#departments_table').DataTable();
} );
        function changeType(sel) {
             var p = document.getElementById('intern');
             var b = document.getElementById('permanentemployee');

             var choice = sel.value;

             if(choice == 'Intern')
             {
                p.style.display = 'block';
                b.style.display = 'none';
             }
             else if(choice == 'Permanent')
             {
                 p.style.display = 'none';
                 b.style.display = 'block';
             }
             else if(choice == 'Other')
             {
                 p.style.display = 'none';
                b.style.display = 'none';
             }
}

</script>

</body>

</html>
