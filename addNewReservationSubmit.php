<?php
    $buyerName  = $_POST['buyerName'];
    $buyerNo    = $_POST['buyerNo'];
    $Status     = $_POST['Status'];
    $amountPaid = $_POST['amountPaid'];
    $remarks    = $_POST['remarks'];
    $type       = $_POST['type'];
    $color      = $_POST['color'];
    $size       = $_POST['size'];

    $connection = mysqli_connect('localhost', 'root', '');
        if ($connection->connect_errno) {
            echo ("SQL can't connect to PHP". $connection->connect_error);
            exit();
        }	

    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));

    $newTempDevice            = "INSERT INTO tempDevices VALUES ('','$type','$color', '$size', '?')";    
    $newTempDeviceResult      = mysqli_query($connection, $newTempDevice) or die ("Temp Device Creation Query Error: '$newTempDevice'");

    $Temp_ID                  = mysqli_insert_id($connection);

    $newBuyer                 = "INSERT INTO buyer VALUES ('', '$buyerName', '$buyerNo')";
    $newBuyerResult           = mysqli_query($connection, $newBuyer) or die ("Buyer Creation Query Error: '$newBuyer'");

    $Buyer_ID                 = mysqli_insert_id($connection);
    
    $newTempReservation       = "INSERT INTO tempDevicesReservation VALUES ('$Buyer_ID', '$Temp_ID', '$Status', '$amountPaid', '$remarks')";
    $newTempReservationResult = mysqli_query($connection, $newTempReservation) or die ("Temp Reservation Insertion Query Error: '$newTempReservation'");

    mysqli_close($connection);

    if($newTempReservation)
        echo "<script type='text/javascript'>window.location.href = 'listSold.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listonHand.php'</script>";  
?>

