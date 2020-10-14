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
	$p_id = $_POST["p_id"];
    $sql = "DELETE FROM company_assignment where project_id = '$p_id';";
    $sql .= "DELETE FROM ministry_assignment where project_id = '$p_id';";
	$sql .= "DELETE FROM assignment WHERE project_id = '$p_id';";
    if($conn->multi_query($sql)){
        echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY DELETED!</div>";
    }else{
        echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
    }
    mysqli_close($conn);
}
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-sm">
            <h5 class="text-center">Delete Assignment</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteAssignment.php" method="POST">
                        <div class="form-group">
                            <label for="username">Project ID</label>
                            <input type="text" name="p_id" required class="form-control"/>
                        </div>
                      
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <h5 class="text-center">Assignment</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Budget</th>
                        <th>Duration</th>
                        <th>Department Code</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($assignments as $assignment) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($assignment["project_id"]);?></td>
                            <td><?php echo htmlspecialchars($assignment["name"]);?></td>
                            <td> <?php echo htmlspecialchars($assignment["budget"]);?></td>
                            <td><?php echo htmlspecialchars($assignment["duration"]);?></td>
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

</script>

</body>

</html>
