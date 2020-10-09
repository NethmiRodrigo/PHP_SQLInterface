<?php
include_once ("config/db_connect.php");
$conn = connect();

$sql1 = "SELECT * from regional_branch";
$result = mysqli_query($conn, $sql1);
$regional_branches = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql2 = "SELECT * from supergrade_branch";
$result2 = mysqli_query($conn, $sql2);
$supergrade_branches = mysqli_fetch_all($result2, MYSQLI_ASSOC);
mysqli_free_result($result2);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<?php include_once("common/header.php");?>
<div class="container" style="padding: 30px">
    <h5 class="text-center">Branches</h5>
    <div class="row" style="margin-top: 50px">
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

<script type="text/javascript">
    $(document).ready(function() {
    $('#table_id').DataTable();
} );
</script>

</body>

</html>
