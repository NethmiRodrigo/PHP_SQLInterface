<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();

$sql3 = "SELECT * from person";
$result3 = mysqli_query($conn, $sql3);
$persons = mysqli_fetch_all($result3, MYSQLI_ASSOC);
mysqli_free_result($result3);

$sql4 = "SELECT * from business";
$result4 = mysqli_query($conn, $sql4);
$businesses = mysqli_fetch_all($result4, MYSQLI_ASSOC);
mysqli_free_result($result4);

if(isset($_POST["submit"])){
	$type = $_POST["type"];
	$cus_id = $_POST["cus_id"];
    $sql = "DELETE FROM customer WHERE customer_id = '$cus_id'";
    if(mysqli_query($conn, $sql)){
        global $sql;
        if($type == 'person'){
            $sql = "DELETE FROM person WHERE customer_id = '$cus_id'";
        }
        else if($type == 'business'){
            $sql = "DELETE FROM business WHERE customer_id = '$cus_id'";
        }
        if(mysqli_query($conn, $sql)) {
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY DELETED!</div>";
        }
        else {
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->error</div>";
        }
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
            <h5 class="text-center">Delete Customer</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="deleteCustomer.php" method="POST">
                        <div class="form-group">
                            <label for="username">Customer ID</label>
                            <input type="text" name="cus_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Customer Type</label>
                            <select id="type" name="type" class="form-control" onChange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="person">Person</option>
                                <option value="business">Business</option>
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
            <h5 class="text-center">Customers</h5>
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

<script type="text/javascript">
    $(document).ready(function() {
    $('#customers_table').DataTable();
} );
</script>

</body>

</html>
