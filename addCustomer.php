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
        $type = $_POST["type"];
		$b_id = $_POST["b_id"];
        $branch_type = $_POST["branch_type"];
        $sql = '';
        if($branch_type == 'regional') {
            global $sql;
            $sql = "INSERT INTO customer VALUES('', '$type', 'Regional', '$b_id', NULL)";
        }
        else {
            global $sql;
            $sql = "INSERT INTO customer VALUES('', '$type', 'Supergrade',NULL , '$b_id')";
        }
        if(mysqli_query($conn, $sql)){
            $last_id = $conn->insert_id;
            if($type == 'person'){
                global $sql;
                global $last_id;
                $nic = $_POST["nic"];
                $name = $_POST["name"];
                $addressline = $_POST["addressline"];
                $city = $_POST["city"];
                $province = $_POST["province"];
                $zip_code = $_POST["zip_code"];
                $sql = "INSERT INTO person(nic, person_name, address_lines, city, province, zip_code, customer_id) VALUES('$nic', '$name', '$addressline', '$city', '$province', '$zip_code', '$last_id')";
            }
            else if($type == 'business'){
                global $sql;
                global $last_id;
                $b_no = $_POST["b_no"];
                $b_type = $_POST["b_type"];
                $net_worth = $_POST["net_worth"];
                $sql = "INSERT INTO business(br_no, type, net_worth, customer_id) VALUES('$b_no', '$b_type', '$net_worth', '$last_id')";
            }
            if(mysqli_query($conn, $sql)){
                echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
            }else{
                echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
            }
        }
        else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
    }
?>

<div class="container" style="padding: 100px 10px 100px 10px">
    <div class="row">
        <div class="col-sm">
            <h5 class="text-center">Add Customer</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addCustomer.php" method="POST">
						<div class="form-group">
                            <label for="type">Customer Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="person">Person</option>
                                <option value="business">Business</option>
                            </select>
                        </div>
						<div id = "person">
                            <div class="form-group">
                                <label for="nic">NIC</label>
                                <input type="text" name="nic" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control"/>
                            </div>
							<div class="form-group">
                                <label for="addressline">Address Lines</label>
                                <input type="text" name="addressline" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" class="form-control"/>
                            </div>
							<div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" name="province" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="zip_code">Zip code</label>
                                <input type="text" name="zip_code" class="form-control"/>
                            </div>
                        </div>
                        
                        <div id = "business">
                            <div class="form-group">
                                <label for="b_no">Business Number</label>
                                <input type="text" name="b_no" class="form-control"/>
                            </div>
							<div class="form-group">
                                <label for="b_type">Business Type</label>
                                <input type="text" name="b_type" class="form-control"/>
                            </div>
							<div class="form-group">
                                <label for="net_worth">Net Worth</label>
                                <input type="number" name="net_worth" class="form-control"/>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="b_id">Branch ID</label>
                            <input type="text" name="b_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="branch_type">Branch Type</label>
                            <select id="branch_type" name="branch_type" class="form-control">
                                <option selected>Choose type...</option>
                                <option value="regional">Regional</option>
                                <option value="supergrade">Supergrade</option>
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

<?php
echo "<script>
        function changeType(sel) {
             var p = document.getElementById('person');
             var b = document.getElementById('business');

             var choice = sel.value;

             if(choice == 'person')
             {
                p.style.display = 'block';
                b.style.display = 'none';


             }
             else if(choice == 'business')
             {
                 p.style.display = 'none';
                 b.style.display = 'block';

             }
}</script>";
?>

</body>

</html>
