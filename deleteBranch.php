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
    $name = $_POST["branch_id"];
    $type = $_POST["type"];
    $sql = "";
    if($type == 'regional_branch'){
        global $sql;
        $sql = "DELETE FROM regional_branch WHERE branch_id = '$name'";
    }
    else if($type == 'supergrade_branch'){
        global $sql;
        $sql = "DELETE FROM supergrade_branch WHERE branch_id = '$name'";
    }

    if($conn->query($sql) == TRUE){
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
            <h5 class="text-center">Delete Branch</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteBranch.php" method="POST">
                        <div class="form-group">
                            <label for="branch_id">Branch Id</label>
                            <input type="text" name="branch_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Branch Type</label>
                            <select id="type" name="type" class="form-control" required>
                                <option selected value="regional_branch">Regional</option>
                                <option value="supergrade_branch">Supergrade</option>
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
</script>

</body>

</html>
