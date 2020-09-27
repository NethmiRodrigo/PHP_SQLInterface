<?php
session_start();
include_once ("config/db_connect.php");
$conn = connect();
$sql = "SELECT * from branch";
$result = mysqli_query($conn, $sql);
$branches = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<?php include_once("common/header.php");?>
<h6 class="center">Branches</h6>
<div class="container">
    <div class="row">
        <?php foreach($branches as $branch){ ?>
            <div class="col s6 md3 ">
                <div class="card ">
                    <div class="card-content center">
                        <div><b>Branch ID: <?php echo htmlspecialchars($branch["branchId"]);?></b></div>
                        <div><b>Branch Name:</b> <?php echo htmlspecialchars($branch["name"]);?> </div>
                        <div><b>Location:</b> <?php echo htmlspecialchars($branch["location"]);?></div>
                        <div><b>Building Area:</b> <?php echo htmlspecialchars($branch["building_area"]);?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</html>
