<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die("NO SESSION");
    //die(header('location: login'));
}
if (isset($_REQUEST['vehicleid'])) {
    $vehicleid = $_REQUEST['vehicleid'];
    $querygetlistvehicle = mysqli_query($conn, "SELECT * FROM vehicles WHERE idvehicle='$vehicleid'");
    $getvehicledata = mysqli_fetch_array($querygetlistvehicle);

    $plateno = $getvehicledata['plateno'];
    $model = $getvehicledata['model'];
    $color = $getvehicledata['color'];
    $type = $getvehicledata['type'];
    $priceperhour = $getvehicledata['priceperhour'];
    $imagepath = $getvehicledata['imagepath'];
    $adminvehiclemanager = $getvehicledata['adminuser'];

?>
    <div class="modal-body">
        <img class="vehicleimgmodal" src="<?php echo $imagepath ?>" alt=""><br><br>
        <h4><?php echo $model ?></h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th colspan="2"> </th>
                </tr>
            </thead>
            <tbody class="table-primary">
                <tr>
                    <td>Plate Number:</td>
                    <td><?php echo $plateno ?></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><?php echo $color ?></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><?php echo $type ?></td>
                </tr>
                <tr>
                    <td>Price Per Hour:</td>
                    <td>RM <?php echo $priceperhour ?></td>
                </tr>
                <tr>
                    <td>Owner:</td>
                    <td><?php echo $adminvehiclemanager ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Chat Now</button>
        <a href="booking.php?plateno=<?php echo $plateno ?>&type=<?php echo $type ?>" class="btn btn-primary" role="button">Book Now</a>
    </div>
<?php
}
