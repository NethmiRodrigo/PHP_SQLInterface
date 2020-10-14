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
    $id = $_POST["id"];
    $updated_value = $_POST["updated_value"];
    $type = $_POST["type"];
    $sql = '';
    if($type == 'residential_account'){
        global $sql;
        $update_field = $_POST["update_field_residential"];
        $sql = "UPDATE residential_account SET $update_field = '$updated_value' WHERE acc_no = '$id'";
    }
    else if($type == 'foreign_account'){
        global $sql;
        $update_field = $_POST["update_field_foreign"];
        $sql = "UPDATE foreign_account SET $update_field = '$updated_value' WHERE acc_no = '$id'";
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
            <h5 class="text-center">Update Account</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateAccount.php" method="POST">
                        <div class="form-group">
                        <label for="id">Accoount Number</label>
                            <input type="text" name="id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Accoount Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);" required>
                                <option selected>Choose Type</option>
                                <option value="residential_account">Residential</option>
                                <option value="foreign_account">Foreign</option>
                            </select>
                        </div>
                        <div id="residential">
                            <div class="form-group">
                                <label for="update_field_residential">Update Field</label>
                                <select id="update_field_residential" name="update_field_residential" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="details">Account Details</option>
                                    <option value="residential_type">Residential Type</option>
                                    <option value="balance">Balance</option>
                                </select>
                            </div>
                        </div>
                        <div id="foreign">
                            <div class="form-group">
                                <label for="update_field_foreign">Update Field</label>
                                <select id="update_field_foreign" name="update_field_foreign" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="details">Account Details</option>
                                    <option value="unit">Unit</option>
                                    <option value="balance">Balance</option>
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
    </div>
    <div class="row" style="padding-top: 50px">
        <div class="col-sm">
            <h5 class="text-center">Residential Accounts</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="table_id" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Account No </th>
                        <th>Balance</th>
                        <th>Details</th>
                        <th>Residential Type</th>
                        <th>Customer Id</th>
                        <th>Branch ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($res_acc as $residential_account) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($residential_account["acc_no"]);?></td>
                            <td><?php echo htmlspecialchars($residential_account["balance"]);?></td>
                            <td><?php echo htmlspecialchars($residential_account["details"]);?></td>
                            <td><?php echo htmlspecialchars($residential_account["residential_type"]);?></td>
                            <td><?php echo htmlspecialchars($residential_account["customer_id"]);?></td>
                            <td><?php if($residential_account["regional_id"] != NULL ) echo htmlspecialchars($residential_account["regional_id"]); else echo htmlspecialchars($residential_account["supergrade_id"]);?> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm" style="padding-top: 30px">
            <h5 class="text-center">Foreign Accounts</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="foreign_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Account No </th>
                        <th>Balance</th>
                        <th>Details</th>
                        <th>Unit</th>
                        <th>Customer Id</th>
                        <th>Branch ID</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach  ($fori_acc as $foreign_account) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($foreign_account["acc_no"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["balance"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["details"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["unit"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["customer_id"]);?></td>
                            <td><?php echo htmlspecialchars($foreign_account["unit"]);?></td>
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
 $(document).ready(function() {
    $('#foreign_table').DataTable();
} );
</script>

<?php
echo "<script>
        function changeType(sel) {
             var p = document.getElementById('residential');
             var b = document.getElementById('foreign');

             var choice = sel.value;

             if(choice == 'residential_account')
             {
                p.style.display = 'block';
                b.style.display = 'none';


             }
             else if(choice == 'foreign_account')
             {
                 p.style.display = 'none';
                 b.style.display = 'block';

             }
}</script>";
?>

</body>

</html>
