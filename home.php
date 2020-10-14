<?php
include_once ("config/db_connect.php");
$conn = connect();
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>

<?php
include_once("common/header.php");
    if($username == 'manager') include_once("managerView.php");
    else if($username == 'employee') include_once("employeeView.php");
    else if($username == 'admin') include_once ("adminView.php");
    else if($username == 'hr') include_once ("hrView.php");
?>

<script type="text/javascript">
    $(document).ready(function() {
    $('#view').DataTable();
} );
</script>

</body>

</html>
