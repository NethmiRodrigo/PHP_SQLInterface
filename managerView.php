<?php
include_once ("config/db_connect.php");

$conn = connect();

$sql = "SELECT * FROM expired_assignment";
$result = mysqli_query($conn, $sql);
$views = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>

<div class="container" style="padding: 30px">
    <h5 class="text-center">Assignments whose funding period has ended</h5>
    <div class="row" style="margin-top: 50px">
        <div class="col-md-6 offset-md-3">
            <div class="card" style="width: 100%; padding: 10px">
                <table id="view" class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Budget</th>
                        <th>Duration</th>
                        <th>Funding Period</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($views as $view) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($view["project_id"]);?></td>
                            <td><?php echo htmlspecialchars($view["NAME"]);?></td>
                            <td> <?php echo htmlspecialchars($view["budget"]);?></td>
                            <td><?php echo htmlspecialchars($view["duration"]);?></td>
                            <td><?php echo htmlspecialchars($view["funding_period"]);?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
