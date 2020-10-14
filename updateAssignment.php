<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();

$sql1 = "SELECT * from assignment";
$result = mysqli_query($conn, $sql1);
$assignments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);


if(isset($_POST["submit"])){
        $project_id = $_POST["project_id"];
        $budget = $_POST["budget"];
		$duration = $_POST["duration"];
		$name = $_POST["name"];
		$type = $_POST["type"];
		$dept_code = $_POST["dept_code"];
		$updated_value = $_POST["updated_value"];
		$sql = '';
   
    if($type == 'government'){
            global $sql;
            $task_breakdown = $_POST["task_breakdown"];
			$government_flag = $_POST["government_flag"];
			$update_field = $_POST["update_field_government"];
            $sql = "UPDATE assignment SET $update_field = '$updated_value' WHERE project_id = '$project_id'";
        }
    else if($type == 'internal'){
            global $sql;
            $staff = $_POST["staff"];
			$internal_flag = $_POST["internal_flag"];
            $update_field = $_POST["update_field_internal"];
            $sql = "UPDATE assignment SET $update_field = '$updated_value' WHERE project_id = '$project_id'";
        }
    else if($type == 'thirdparty'){
            global $sql;
            $funding_period = $_POST["funding_period"];
			$thirdparty_flag = $_POST["thirdparty_flag"];
            $update_field = $_POST["update_field_thirdparty"];
            $sql = "UPDATE assignment SET $update_field = '$updated_value' WHERE project_id = '$project_id'";
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
            <h5 class="text-center">Update Assignment</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateAssignment.php" method="POST">
                        <div class="form-group">
                            <label for="project_id">Project Id</label>
                            <input type="number" name="project_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);" required>
                                <option selected>Choose Type</option>
                                <option value="government">Government</option>
                                <option value="internal">Internal</option>
								<option value="thirdparty">Third Party</option>
                            </select>
                        </div>
                        <div id="government">
                            <div class="form-group">
                                <label for="update_field_government">Update Field</label>
                                <select id="update_field_government" name="update_field_government" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="budget">Budget</option>
                                    <option value="duration">Duration</option>
                                    <option value="name">Name</option>
                                    <option value="task_breakdown">Task Breakdown</option>
                                </select>
                            </div>
                        </div>
                        <div id="internal">
                            <div class="form-group">
                                <label for="update_field_internal">Update Field</label>
                                <select id="update_field_internal" name="update_field_internal" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="budget">Budget</option>
                                    <option value="duration">Duration</option>
                                    <option value="name">Name</option>
                                    <option value="no_of_staff">No of Staff</option>
                                </select>
                            </div>
                        </div>
						<div id="thirdparty">
                            <div class="form-group">
                                <label for="update_field_thirdparty">Update Field</label>
                                <select id="update_field_thirdparty" name="update_field_thirdparty" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="budget">Budget</option>
                                    <option value="duration">Duration</option>
                                    <option value="name">Name</option>
                                    <option value="funding_period">Funding Period</option>
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
            <h5 class="text-center">All Assignments</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Project ID</th>
                        <th>Budget</th>
                        <th>Duration</th>
                        <th>Name</th>
                        <th>Assignment Type</th>
                        <th>No of staff</th>
						<th>Task breakdown</th>
						<th>Funding period</th>
						<th>Department code</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($assignment["project_id"]);?></td>
                            <td><?php echo htmlspecialchars($assignment["budget"]);?></td>
                            <td><?php echo htmlspecialchars($assignment["duration"]);?></td>
                            <td><?php echo htmlspecialchars($assignment["name"]);?></td>
                            <td><?php if($assignment["internal_flag"]) echo "Internal"; else if($assignment["government_flag"]) echo "Government"; else echo "Third Party"; ?></td>
							<td><?php echo htmlspecialchars($assignment["no_of_staff"]);?></td>
							<td><?php echo htmlspecialchars($assignment["task_breakdown"]);?></td>
							<td><?php echo htmlspecialchars($assignment["funding_period"]);?></td>
							<td><?php echo htmlspecialchars($assignment["dept_code"]);?></td>
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
