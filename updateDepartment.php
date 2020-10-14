<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();
$sql1 = "SELECT * from department";
$result = mysqli_query($conn, $sql1);
$departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $updated_value = $_POST["updated_value"];
    $sql = '';
	global $sql;
        $update_field = $_POST["update_field_department"];
        $sql = "UPDATE department SET $update_field = '$updated_value' WHERE dept_code = '$id'";

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
        <div class="col-sm">
            <h5 class="text-center">Update Department</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateDepartment.php" method="POST">
                        <div class="form-group">
                            <label for="id">Department Code</label>
                            <input type="text" name="id" required class="form-control"/>
                        </div>
                        
                        <div id="department">
                            <div class="form-group">
                                <label for="update_field_department">Update Field</label>
                                <select id="update_field_department" name="update_field_department" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="dept_name">Department Name</option>
                                    <option value="head">Head</option>
                                    <option value="type">Type</option>
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
        <div class="col-sm">
            <h5 class="text-center">Department</h5>
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
    function changeType(sel) {
         var p = document.getElementById('regional');
         var b = document.getElementById('supergrade');

         var choice = sel.value;

         if(choice == 'regional')
         {
            p.style.display = 'block';
            b.style.display = 'none';
         }
         else if(choice == 'supergrade')
         {
             p.style.display = 'none';
             b.style.display = 'block';

         }
    }
</script>

</body>

</html>
