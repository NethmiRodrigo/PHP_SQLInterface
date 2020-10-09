<!DOCTYPE html>
<html>

<?php
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();
    if(isset($_POST["submit"])){
        $id = $_POST["branchId"];
        $name = $_POST["name"];
        $location = $_POST["location"];
        $building = $_POST["building"];
        $type = $_POST["type"];
        $sql = "";
        if($type == 'regional_branch'){
            $temp_debt = $_POST["temp_debt"];
            $regional_code = $_POST["regional_code"];
            global $sql;
            $sql = "INSERT INTO regional_branch VALUES('$id', '$building', '$name', '$location', '$temp_debt', '$regional_code')";
        }
        else if($type == 'supergrade_branch'){
            global $sql;
            $main_city = $_POST["main_city"];
            $sql = "INSERT INTO supergrade_branch VALUES('$id', '$building', '$name', '$location', '$main_city')";
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
            <h5 class="text-center">Add Branch</h5>
            <div class="card" style="color: black">
                <div class="card-body">
                    <form action="addBranch.php" method="POST">
                        <div class="form-group">
                            <label for="username">Branch Id</label>
                            <input type="text" name="branchId" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="username">Branch Name</label>
                            <input type="text" name="name" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Branch Location</label>
                            <input type="text" name="location" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Building Area</label>
                            <input type="text" name="building" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="type">Branch Type</label>
                            <select id="type" name="type" class="form-control" onchange="changeType(this);">
                                <option selected>Choose type...</option>
                                <option value="regional_branch">Regional</option>
                                <option value="supergrade_branch">Supergrade</option>
                            </select>
                        </div>
                        <div id="regional">
                            <div class="form-group">
                                <label for="temp_debt">Temporary debt</label>
                                <input type="number" name="temp_debt" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="regional_code">Regional code</label>
                                <input type="text" name="regional_code" class="form-control" />
                            </div>
                        </div>
                        <div id="supergrade">
                            <div class="form-group">
                                <label for="main_city">Main city</label>
                                <input type="text" name="main_city" class="form-control" />
                            </div>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" style="background-color: #2193b0 !important;color: white !important; width: 100%">Submit </button>
                        </div>
                    </form>
                </div>
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

         if(choice == 'regional_branch')
         {
            p.style.display = 'block';
            b.style.display = 'none';
         }
         else if(choice == 'supergrade_branch')
         {
             p.style.display = 'none';
             b.style.display = 'block';

         }
    };
</script>

</body>

</html>
