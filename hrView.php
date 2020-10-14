<?php
include_once ("config/db_connect.php");

$conn = connect();

$sql = "SELECT * FROM employees_per_dept";
$result = mysqli_query($conn, $sql);
$views = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<div class="container" style="padding: 30px">
    <h5 class="text-center">Number of employees per department</h5>
    <div class="row" style="margin-top: 50px">
        <div class="col-md-8 offset-md-2">
            <div class="card" style="width: 100%; padding: 10px">
                <table id="view" class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Department ID</th>
                        <th>Department Name</th>
                        <th>Type</th>
                        <th>Department Head</th>
                        <th>Number of Employees</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($views as $view) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($view["dept_code"]);?></td>
                            <td><?php echo htmlspecialchars($view["dept_name"]);?></td>
                            <td> <?php echo htmlspecialchars($view["TYPE"]);?></td>
                            <td><?php echo htmlspecialchars($view["head"]);?></td>
                            <td><?php echo htmlspecialchars($view["number_of_employees"]);?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
