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

if(isset($_POST["submit"])){
    $emp_id = $_POST["id"];
    $type = $_POST["type"];
    $sql = '';
    if($type == 'intern' or $type == 'permanent_employee'){
        if($type == 'intern'){
            global $sql;
            $sql = "DELETE FROM intern WHERE emp_id = '$emp_id'";
        }
        else if($type == 'permanent_employee'){
            global $sql;
            $sql = "DELETE FROM permanent_employee WHERE emp_id = '$emp_id'";
        }
        if(!mysqli_query($conn, $sql)) echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
    }

    $sql = "DELETE FROM employee WHERE emp_id = '$emp_id'";
    if(mysqli_query($conn, $sql)){
        echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY DELETED!</div>";
    }
    else {
        echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
    }


    mysqli_close($conn);
}
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-sm">
            <h5 class="text-center">Delete Employee</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteEmployee.php" method="POST">
                        <div class="form-group">
                            <label for="username">Employee Id</label>
                            <input type="text" name="id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Employee Type</label>
                            <select id="type" name="type" class="form-control">
                                <option selected value="intern">Intern</option>
                                <option value="permanent_employee">Permanent</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm">
            <h5 class="text-center">Employee</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>NIC</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employees as $employee) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee["emp_id"]);?></td>
                            <td><?php echo htmlspecialchars($employee["emp_name"]);?></td>
                            <td> <?php echo htmlspecialchars($employee["emp_address"]);?></td>
                            <td><?php echo htmlspecialchars($employee["nic"]);?></td>
							<td><?php echo htmlspecialchars($employee["type"]);?></td>
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
