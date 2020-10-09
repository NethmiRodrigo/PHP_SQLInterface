<!DOCTYPE html>
<html>

<?php
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();

    $sql3 = "SELECT * from department";
    $result3 = mysqli_query($conn, $sql3);
    $departments= mysqli_fetch_all($result3, MYSQLI_ASSOC);

    if(isset($_POST["submit"])){
        
        $budget = $_POST["budget"];
		$duration = $_POST["duration"];
		$name = $_POST["name"];
		$type = $_POST["type"];
		$dept_code = $_POST["dept_code"];
		$sql = "";
        if($type == 'government'){
            global $sql;
            $task_breakdown = $_POST["task_breakdown"];
            $sql = "INSERT INTO assignment VALUES ('', '$budget', '$duration', '$name', NULL, '$task_breakdown', NULL, 0, 1, 0, $dept_code)";
        }
        else if($type == 'internal'){
            global $sql;
            $staff = $_POST["staff"];
            $sql = "INSERT INTO assignment VALUES ('', '$budget', '$duration', '$name', '$staff', NULL, NULL, 1, 0, 0, $dept_code)";
        }
        else if($type == 'thirdparty'){
            global $sql;
            $funding_period = $_POST["funding_period"];
            $sql = "INSERT INTO assignment VALUES ('', '$budget', '$duration', '$name', NULL, NULL, '$funding_period', 0, 0, 1, $dept_code)";
        }
        if(mysqli_query($conn, $sql)){
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
        }else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
        mysqli_close($conn);
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-sm">
            <h5 class="text-center">Add Assignment</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addAssignment.php" method="POST">
                        
						<div class="form-group">
                            <label for="password">Assignment Name</label>
                            <input type="text" name="name" required class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="password">Assignment Budget</label>
                            <input type="text" name="budget" required class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="password">Assignment Duration</label>
                            <input type="text" name="duration" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Assignment Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="internal">Internal</option>
                                <option value="government">Government</option>
                                <option value="thirdparty">Third Party</option>
                            </select>
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
                        </div>
                        <div id="thirdparty">
                            <div class="form-group">
                                <label for="funding_period">Funding Period</label>
                                <input type="text" name="funding_period" class="form-control"/>
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
    $('#departments_table').DataTable();
} );
 function changeType(sel) {
             var p = document.getElementById('internal');
             var b = document.getElementById('government');
             var t = document.getElementById('thirdparty');

             var choice = sel.value;

             if(choice == 'internal')
             {
                p.style.display = 'block';
                b.style.display = 'none';
                t.style.display = 'none';
             }
             else if(choice == 'government')
             {
                 b.style.display = 'block';
                 p.style.display = 'none';
                 t.style.display = 'none';
             }
              else if(choice == 'thirdparty')
             {
                 t.style.display = 'block';
                 p.style.display = 'none';
                 b.style.display = 'none';
             }
}
</script>

</body>

</html>
