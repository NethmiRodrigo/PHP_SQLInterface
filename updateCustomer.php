<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
include_once("config/db_connect.php");
$conn = connect();
$sql5 = "SELECT * from person";
$result5 = mysqli_query($conn, $sql5);
$persons = mysqli_fetch_all($result5, MYSQLI_ASSOC);
mysqli_free_result($result5);

$sql6 = "SELECT * from business";
$result6 = mysqli_query($conn, $sql6);
$businesses = mysqli_fetch_all($result6, MYSQLI_ASSOC);
mysqli_free_result($result6);

if(isset($_POST["submit"])){
    $cus_id = $_POST["cus_id"];
    $updated_value = $_POST["updated_value"];
    $type = $_POST["type"];
    $sql = '';
    if($type == 'person'){
        global $sql;
        $update_field = $_POST["update_field_person"];
        $sql = "UPDATE person SET $update_field = '$updated_value' WHERE customer_id = '$cus_id'";
    }
    else if($type == 'business'){
        global $sql;
        $update_field = $_POST["update_field_business"];
        $sql = "UPDATE business SET $update_field = '$updated_value' WHERE customer_id = '$cus_id'";
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
            <h5 class="text-center">Update Customer</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="updateCustomer.php" method="POST">
                        <div class="form-group">
                            <label for="cus_id">Customer Id</label>
                            <input type="number" name="cus_id" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Customer Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);" required>
                                <option selected>Choose Type</option>
                                <option value="person">Person</option>
                                <option value="business">Business</option>
                            </select>
                        </div>
                        <div id="person">
                            <div class="form-group">
                                <label for="update_field_person">Update Field</label>
                                <select id="update_field_person" name="update_field_person" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="nic">Nic</option>
                                    <option value="person_name">Name</option>
                                    <option value="address_lines">Address Lines</option>
                                    <option value="city">City</option>
                                    <option value="province">Province</option>
									<option value="zip_code">Zip Code</option>
                                </select>
                            </div>
                        </div>
                        <div id="business">
                            <div class="form-group">
                                <label for="update_field_business">Update Field</label>
                                <select id="update_field_business" name="update_field_business" class="form-control" required>
                                    <option selected>Choose field</option>
                                    <option value="type">Business Type</option>
                                    <option value="net_worth">Net Worth</option>
                                    <option value="business_name">Business Name</option>
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
            <h5 class="text-center">Customers</h5>
            <div class="card" style="width: 100%; padding: 10px">
                <table id="customers_table" class="table table-striped" >
                    <thead class="thead-dark">
                    <tr>
                        <th>Customer ID </th>
                        <th>Customer Type</th>
                        <th>Name</th>
                        <th>Net Worth</th>
                        <th>NIC</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($persons as $person) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($person["customer_id"]);?></td>
                            <td>Person</td>
                            <td><?php echo htmlspecialchars($person["person_name"]);?></td>
                            <td>N/A</td>
                            <td><?php echo htmlspecialchars($person["nic"]);?></td>
                        </tr>
                    <?php } ?>
                    <?php foreach ($businesses as $business) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($business["customer_id"]);?></td>
                            <td>Business</td>
                            <td><?php echo htmlspecialchars($business["business_name"]);?></td>
                            <td><?php echo htmlspecialchars($business["net_worth"]);?></td>
                            <td>N/A</td>
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
