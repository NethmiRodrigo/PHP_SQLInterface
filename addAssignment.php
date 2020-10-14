<!DOCTYPE html>
<html>

<?php
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();

    $sql1 = "SELECT * from ministry";
    $result1 = mysqli_query($conn, $sql1);
    $ministries = mysqli_fetch_all($result1, MYSQLI_ASSOC);

    $sql2 = "SELECT * from company";
    $result2 = mysqli_query($conn, $sql2);
    $companies = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $sql3 = "SELECT * from department";
    $result3 = mysqli_query($conn, $sql3);
    $departments= mysqli_fetch_all($result3, MYSQLI_ASSOC);

    if(isset($_POST["submit"])){
        $budget = $_POST["budget"];
		$duration = $_POST["duration"];
		$name = $_POST["name"];
		$type = $_POST["type"];
		$dept_code = $_POST["dept_code"];
        $staff = $task_breakdown =  $funding_period =  $company_id = NULL;
        $internal_flag = $government_flag = $thirdparty_flag = 0;
		$sql = "";
		for($x = 0; $x < count($type); $x++) {
		    if($type[$x] == 'government'){
		        global $government_flag;
                $government_flag = 1;
            }
            if($type[$x] == 'internal'){
                global $internal_flag;
                $internal_flag = 1;
            }
            if($type[$x] == 'thirdparty'){
                global $thirdparty_flag;
                $thirdparty_flag = 1;
            }
        }
		if($government_flag == 1) {
            global $task_breakdown; $task_breakdown = $_POST["task_breakdown"];}
		if($internal_flag == 1) {
		    global $staff;
            $staff = $_POST["staff"];
        }
		if($thirdparty_flag == 1) {
		    global $funding_period, $company_id;
		    $funding_period = $_POST["funding_period"];
		    $company_id = $_POST["company-id"];
        }
		$sql = "INSERT INTO assignment VALUES ('', '$budget', '$duration', '$name', '$staff', '$task_breakdown', '$funding_period', '$internal_flag', '$government_flag', '$thirdparty_flag', '$dept_code')";
        if(mysqli_query($conn, $sql)){
            $last_id = $conn->insert_id;
            if($government_flag == 1 and !(empty($_POST["ministry_code"]))){
                $ministry_code = $_POST["ministry_code"];
                $sql = "INSERT INTO ministry_assignment VALUES ('$ministry_code', '$last_id')";
                if (!mysqli_query($conn, $sql)){
                    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
                }
            }
            if($thirdparty_flag == 1){
                $sql = "INSERT INTO company_assignment VALUES ('$company_id', '$last_id')";
                if (!mysqli_query($conn, $sql)){
                    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
                }
            }
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
        }else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
        mysqli_close($conn);
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="text-center">Add Assignment</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addAssignment.php" method="POST">
                        
						<div class="form-group">
                            <label for="name">Assignment Name</label>
                            <input type="text" name="name" required class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="budget">Assignment Budget</label>
                            <input type="text" name="budget" required class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="duration">Assignment Duration</label>
                            <input type="text" name="duration" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            Assignment Type<br/>
                            <input type="checkbox" value="government" name="type[]" onchange="changeType(this);"/>
                            <label for="government">Government</label><br/>
                            <input type="checkbox" value="internal" name="type[]" onchange="changeType(this);"/>
                            <label for="internal">Internal</label><br/>
                            <input type="checkbox" value="thirdparty" name="type[]" onchange="changeType(this);"/>
                            <label for="thirdparty">Third Party</label><br/>
                        </div>
                        <div id="internal">
                            <div class="form-group">
                                <label for="staff">No. of staff</label>
                                <input type="number" name="staff" class="form-control"/>
                            </div>
                        </div>
                        <div id="government">
                            <div class="form-group">
                                <label for="task_breakdown">Task breakdown</label>
                                <input type="text" name="task_breakdown" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="ministry_code">Ministry Code</label>
                                <input type="text" name="ministry_code" class="form-control"/>
                            </div>
                        </div>
                        <div id="thirdparty">
                            <div class="form-group">
                                <label for="funding_period">Funding Period</label>
                                <input type="text" name="funding_period" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="company-id">Company ID</label>
                                <input type="text" name="company-id" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept_code">Department Code</label>
                            <input type="number" name="dept_code" required class="form-control"/>
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
        <div class="col-sm">
            <h5 class="text-center">Ministries</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="ministry_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Ministry Code</th>
                        <th>Ministry Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ministries as $ministry) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ministry["ministry_code"]);?></td>
                            <td><?php echo htmlspecialchars($ministry["name"]);?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5">
            <h5 class="text-center">Companies</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="company_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Company ID</th>
                        <th>Company Head</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($companies as $company) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($company["company_id"]);?></td>
                            <td><?php echo htmlspecialchars($company["head"]);?></td>
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
    $('#departments_table').DataTable();
} );
    $(document).ready(function() {
    $('#ministry_table').DataTable();
} );
    $(document).ready(function() {
    $('#company_table').DataTable();
} );
 function changeType(sel) {
             var checkboxes = document.getElementsByName("type[]");
             for(var i = 0; i < checkboxes.length; i++){
                var doc = document.getElementById(checkboxes[i].value);
                if(checkboxes[i].checked){
                    doc.style.display = 'block';
                }
                else {
                    doc.style.display = 'none';
                }
             }
}
</script>

</body>

</html>
