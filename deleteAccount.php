<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();
$sql1 = "SELECT * from residential_account";
$result = mysqli_query($conn, $sql1);
$res_acc = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

$sql2 = "SELECT * from foreign_account";
$result2 = mysqli_query($conn, $sql2);
$fori_acc = mysqli_fetch_all($result2, MYSQLI_ASSOC);
mysqli_free_result($result2);

if(isset($_POST["submit"])){
	$acc_no = $_POST["acc_no"];
	$atype = $_POST["atype"];
    $sql = "";
    if($atype == 'residential_account'){
        global $sql;
        $sql = "DELETE FROM residential_account WHERE acc_no = '$acc_no'";
    }
    else if($atype == 'foreign_account'){
        global $sql;
        $sql = "DELETE FROM foreign_account WHERE acc_no = '$acc_no'";
    }

    if(mysqli_query($conn, $sql)){
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
            <h5 class="text-center">Delete Account</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteAccount.php" method="POST">
                        <div class="form-group">
                            <label for="username">Account Number</label>
                            <input type="text" name="acc_no" required class="form-control"/>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type">Account Type</label>
                            <select id="type" name="atype" class="form-control" onChange="changeType(this);" required>
                                <option selected value="residential_account">Residential</option>
                                <option value="foreign_account">Foreign</option>
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
            <h5 class="text-center">Accounts</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Account No </th>
                        <th>Balance</th>
                        <th>Account Details</th>
                        <th>Customer Id</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($res_acc as $residential_account) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($residential_account["acc_no"]);?></td>
                            <td><?php echo htmlspecialchars($residential_account["balance"]);?></td>
                            <td>Residential</td>
                            <td><?php echo htmlspecialchars($residential_account["customer_id"]);?></td>
                        </tr>
                    <?php } ?>
                    <?php foreach  ($fori_acc as $foreign_account) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($foreign_account["acc_no"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["balance"]);?></td>
                            <td>Foreign</td>
                            <td><?php echo htmlspecialchars($foreign_account["customer_id"]);?></td>
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
