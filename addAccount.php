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
	
	$sql3 = "SELECT * from person";
	$result3 = mysqli_query($conn, $sql3);
	$persons = mysqli_fetch_all($result3, MYSQLI_ASSOC);
	mysqli_free_result($result3);

    $sql4 = "SELECT * from business";
    $result4 = mysqli_query($conn, $sql4);
    $businesses = mysqli_fetch_all($result4, MYSQLI_ASSOC);
    mysqli_free_result($result4);


    if(isset($_POST["submit"])){
        $acc_no = $_POST["acc_no"];
        $details = $_POST["details"];
		$atype = $_POST["atype"];
		$b_id = $_POST["b_id"];
		$cus_id = $_POST["cus_id"];
		$branch_type = $_POST["branch_type"];
        $balance = $_POST["balance"];
        $sql = "";
        if($atype == 'residential_account'){
            $res_type = $_POST["res_type"];
            global $sql;
            if ($branch_type == 'regional'){
                $sql = "INSERT INTO residential_account(acc_no,details,residential_type,balance,customer_id,branch_type,regional_id,supergrade_id) VALUES('$acc_no', '$details', '$res_type', '$balance','$cus_id','$branch_type','$b_id',NULL)";
            }else {
                $sql = "INSERT INTO residential_account(acc_no,details,residential_type,balance,customer_id,branch_type,regional_id,supergrade_id) VALUES('$acc_no', '$details', '$res_type', '$balance','$cus_id','$branch_type', NULL, '$b_id')";
            }
        }
        else if($atype == 'foreign_account'){
            global $sql;
            $unit = $_POST["unit"];
            if ($branch_type == 'regional'){
                $sql = "INSERT INTO foreign_account(acc_no,details,unit,balance,branch_type,customer_id,regional_id,supergrade_id) VALUES('$acc_no', '$details', '$unit', '$balance','$branch_type','$cus_id','$b_id',NULL)";
            }else {
                $sql = "INSERT INTO foreign_account(acc_no,details,unit,balance,branch_type,customer_id,regional_id,supergrade_id) VALUES('$acc_no', '$details', '$unit', '$balance','$branch_type','$cus_id', NULL, '$b_id')";
            }
        }

        if(mysqli_query($conn, $sql)){
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
        }else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
        mysqli_close($conn);
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h5 class="text-center">Add Account</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form class="needs-validation" novalidate action="addAccount.php" method="POST">
                        <div class="form-group">
                            <label for="username">Account Number</label>
                            <input type="text" name="acc_no" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Account Details</label>
                            <input type="text" name="details" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="atype">Account Type</label>
                            <select id="type" name="atype" class="form-control" onChange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="residential_account">Residential</option>
                                <option value="foreign_account">Foreign</option>
                            </select>
                        </div>
                        <div id="residential">
                            <div class="form-group">
                                <label for="res_type">Residential Account Type</label>
                                <input type="type" name="res_type" class="form-control"/>
                            </div>
                        </div>
                        <div id="foreign">
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" name="unit" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="number" name="balance" class="form-control"/>
                        </div>
						<div class="form-group">
                            <label for="username">Branch Id</label>
                            <input type="text" name="b_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="branch_type">Branch Type</label>
                            <select id="branch_type" name="branch_type" class="form-control">
                                <option selected>Choose Type...</option>
                                <option value="regional">Regional</option>
                                <option value="supergrade">Supergrade</option>
                            </select>
                        </div>
						<div class="form-group">
                            <label for="username">Customer Id</label>
                            <input type="number" name="cus_id" required class="form-control"/>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
        </div>
        </div>
        <div class="row" style="padding-top: 50px">
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
            <div class="col-sm">
                <h5 class="text-center">Customer</h5>
                <div class="card" style="width: 100%; padding: 10px">
                    <table id="customers_table" class="table table-striped" >
                        <thead class="thead-dark">
                        <tr>
                            <th>Customer ID </th>
                            <th>Customer Type</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($persons as $person) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($person["customer_id"]);?></td>
                                <td>Person</td>
                                <td><?php echo htmlspecialchars($person["person_name"]);?></td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($businesses as $business) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($business["customer_id"]);?></td>
                                <td>Business</td>
                                <td><?php echo htmlspecialchars($business["business_name"]);?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
    $('#table_id').DataTable();
} );
 $(document).ready(function() {
    $('#customers_table').DataTable();
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
