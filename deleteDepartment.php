<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();
$sql1 = "SELECT * from department";
$result = mysqli_query($conn, $sql1);
$departments= mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if(isset($_POST["submit"])){
    $name = $_POST["id"];
    $sql = "DELETE FROM department_contact WHERE dept_code = '$name'";
    if(mysqli_query($conn, $sql)){
        $sql = "DELETE FROM department WHERE dept_code = '$name'";
        if(mysqli_query($conn, $sql)){
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY DELETED!</div>";
        }
        else {
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
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
            <h5 class="text-center">Delete Department</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteDepartment.php" method="POST">
                        <div class="form-group">
                            <label for="username">Department Code</label>
                            <input type="text" name="id" required class="form-control"/>
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
                <table id="table_id" class="table table-striped" >
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
</script>

</body>

</html>
