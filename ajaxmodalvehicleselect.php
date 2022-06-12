<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die(header('location: login'));
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
        <?php
        //CHECK IF VEHICLE IN USE
        $querycheckavailable = mysqli_query($conn, "SELECT COUNT(plateno) FROM booking WHERE plateno='$plateno'");
        $bookcount = mysqli_fetch_array($querycheckavailable)[0];
        $datetimenow = date('Y-m-d H:i:s');
        if ($bookcount == 0) {
            echo '<span class="badge rounded-pill bg-success">Available</span>';
        } else {
            $querygetlastrecord = mysqli_query($conn, "SELECT MAX(idbook) FROM booking WHERE plateno='$plateno'");
            $lastbookidforvehicle = mysqli_fetch_array($querygetlastrecord)[0];

            $querylastbookdata = mysqli_query($conn, "SELECT * FROM booking WHERE idbook = '$lastbookidforvehicle'");
            $getlastbookdata = mysqli_fetch_array($querylastbookdata);
            $bookstarttime = $getlastbookdata['booktime']; //START DATE TIME
            $hour = $getlastbookdata['hour'];
            $bookenddate = date('Y-m-d H:i:s', strtotime($bookstarttime . " + $hour hours"));  //END DATE TIME

            if (($datetimenow > $bookstarttime) && ($datetimenow < $bookenddate)) {
        ?>
                <button class="btn btn-primary" disabled>Not available</button>
            <?php
            } else {
            ?>
                <a href="booking.php?plateno=<?php echo $plateno ?>&type=<?php echo $type ?>" class="btn btn-primary" role="button">Book Now</a>
        <?php
            }
        }
        ?>
    </div>
<?php
}
