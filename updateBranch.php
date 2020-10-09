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

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $updated_value = $_POST["updated_value"];
    $type = $_POST["branch_type"];
    $sql = '';
    if($type == 'regional'){
        global $sql;
        $update_field = $_POST["update_field_regional"];
        $sql = "UPDATE regional_branch SET $update_field = '$updated_value' WHERE branch_id = '$id'";
    }
    else if($type == 'supergrade'){
        global $sql;
        $update_field = $_POST["update_field_supergrade"];
        $sql = "UPDATE supergrade_branch SET $update_field = '$updated_value' WHERE branch_id = '$id'";
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
        <div class="col-sm">
            <h5 class="text-center">Update Branch</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateBranch.php" method="POST">
                        <div class="form-group">
                            <label for="id">Branch Id</label>
                            <input type="text" name="id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="branch_type">Branch Type</label>
                            <select id="branch_type" name="branch_type" class="form-control" onchange="changeType(this);" required>
                                <option selected>Choose Type</option>
                                <option value="regional">Regional</option>
                                <option value="supergrade">Supergrade</option>
                            </select>
                        </div>
                        <div id="regional">
                            <div class="form-group">
                                <label for="update_field_regional">Update Field</label>
                                <select id="update_field_regional" name="update_field_regional" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="branch_name">Branch Name</option>
                                    <option value="location">Location</option>
                                    <option value="building_area">Building Area</option>
                                    <option value="temp_debt">Temporary debt</option>
                                    <option value="regional_code">Regional Code</option>
                                </select>
                            </div>
                        </div>
                        <div id="supergrade">
                            <div class="form-group">
                                <label for="update_field_supergrade">Update Field</label>
                                <select id="update_field_supergrade" name="update_field_supergrade" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="branch_name">Branch Name</option>
                                    <option value="location">Location</option>
                                    <option value="building_area">Building Area</option>
                                    <option value="main_city">Main City</option>
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
