<?php
include('conn.php');
session_start();
if (!isset($_SESSION['admin'])) {
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
?>

<div class="modal-body">
    <form id="editvehicleform" action="vehicleaddprocess.php" enctype="multipart/form-data" method="POST">
        <div class="mb-3">
            <label for="vehiclepicture" class="form-label">Vehicle picture</label>
            <input class="form-control" type="file" id="vehiclepicture" name="vehiclepicture" required>
        </div>
        <div class="mb-3">
            <label for="vehiclemodel" class="form-label">Vehicle Model/Name</label>
            <input type="text" name="vehiclemodel" value="<?php echo $model ?>" class="form-control" id="vehiclemodel" required>
        </div>
        <div class="mb-3">
            <label for="vehiclemodel" class="form-label">Vehicle Type</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">Choose Type</option>
                <option value="Car" <?php if($type=='Car'){echo 'selected';} ?>>Car</option>
                <option value="Motocycle" <?php if($type=='Motocycle'){echo 'selected';} ?>>Motocycle</option>
                <option value="Bicycle" <?php if($type=='Bicycle'){echo 'selected';} ?>>Bicycle</option>
                <option value="Scooter" <?php if($type=='Scooter'){echo 'selected';} ?>>Scooter</option>
                <option value="Other" <?php if($type=='Other'){echo 'selected';} ?>>Others</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="plateno" class="form-label">Plate number</label>
            <input type="text" name="plateno" value="<?php echo $plateno ?>" class="form-control" id="plateno" required>
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" value="<?php echo $color ?>" class="form-control" id="color" required>
        </div>
        <div class="mb-3">
            <label for="priceperhour" class="form-label">Price Per Hour</label>
            <input type="number" name="priceperhour" value="<?php echo $priceperhour ?>" class="form-control" id="priceperhour" required>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="submit" name="submitvehicle" form="editvehicleform" class="btn btn-primary">Update</button>
</div>

<?php } ?>