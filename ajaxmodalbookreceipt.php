<?php
include('conn.php');
session_start();
if (!isset($_SESSION['customer'])) {
    die(header('location: login'));
}
if (isset($_REQUEST['book'])) {
    $idbook = $_REQUEST['book'];
    $querybook = mysqli_query($conn, "SELECT * FROM booking WHERE idbook = '$idbook'");
    $getbookdata = mysqli_fetch_array($querybook);
    $plateno = $getbookdata['plateno'];
    $startdate = $getbookdata['booktime'];
    $hours = $getbookdata['hour'];

    $formatnewdate = new DateTime($startdate);

    $querygetlistvehicle = mysqli_query($conn, "SELECT * FROM vehicles WHERE plateno='$plateno'");
    $getvehicledata = mysqli_fetch_array($querygetlistvehicle);

    $model = $getvehicledata['model'];
    $color = $getvehicledata['color'];
    $type = $getvehicledata['type'];
    $priceperhour = $getvehicledata['priceperhour'];
    $imagepath = $getvehicledata['imagepath'];
    $adminvehiclemanager = $getvehicledata['adminuser'];

    $price = $priceperhour * $hours;

    //GET ALL DATA CUSTOMER
    $icstudent = $_SESSION['customer'];
    $querycustomerdata = mysqli_query($conn, "SELECT * FROM student WHERE icstudent='$icstudent'");
    $getstudentdata = mysqli_fetch_array($querycustomerdata);
    $studentname = $getstudentdata['name'];
    $phoneno = $getstudentdata['phoneno'];
    $email = $getstudentdata['email'];
    $license = $getstudentdata['license'];

?>
    <div class="modal-body">
        <img class="vehicleimgmodal" src="<?php echo $imagepath ?>" alt=""><br><br>
        <h4>Book Details</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody class="table-warning">
                <tr>
                    <td>Total Price</td>
                    <td>RM <?php echo number_format((float)$price, 2, '.', ''); ?></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><?php echo $formatnewdate->format('d-m-Y') ?></td>
                </tr>
                <tr>
                    <td>Hours</td>
                    <td><?php echo $hours ?></td>
                </tr>
            </tbody>
        </table>
        <h4>Student Details</h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th colspan="2"> </th>
                </tr>
            </thead>
            <tbody class="table-success">
                <tr>
                    <td>Full Name</td>
                    <td><?php echo $studentname ?></td>
                </tr>
                <tr>
                    <td>IC Student</td>
                    <td><?php echo $icstudent ?></td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td><?php echo $phoneno ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td>License</td>
                    <td><?php echo $license ?></td>
                </tr>
            </tbody>
        </table>
        <h4><?php echo $model ?></h4>
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th colspan="2"> </th>
                </tr>
            </thead>
            <tbody class="table-primary">
                <tr>
                    <td>Plate Number</td>
                    <td><?php echo $plateno ?></td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td><?php echo $color ?></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td><?php echo $type ?></td>
                </tr>
                <tr>
                    <td>Price Per Hour</td>
                    <td>RM <?php echo $priceperhour ?></td>
                </tr>
                <tr>
                    <td>Owner</td>
                    <td><?php echo $adminvehiclemanager ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </div>
<?php
}
