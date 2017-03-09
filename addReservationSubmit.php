<?php
    $IMEI       = $_POST['IMEI'];
    $buyerName  = $_POST['buyerName'];
    $buyerNo    = $_POST['buyerNo'];
    $Status     = $_POST['Status'];
    $amountPaid = $_POST['amountPaid'];

    $connection = mysqli_connect('localhost', 'root', '');
        if ($connection->connect_errno) {
            echo ("SQL can't connect to PHP". $connection->connect_error);
            exit();
        }	

    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));

    $newBuyer             = "INSERT INTO buyer VALUES ('', '$buyerName', '$buyerNo')";
    $newBuyerResult       = mysqli_query($connection, $newBuyer) or die ("Buyer Insertion Query Error: '$newBuyer'");

    $Buyer_ID             = mysqli_insert_id($connection);
    
    $newReservation       = "INSERT INTO reservation VALUES ('$IMEI', '$Buyer_ID', '$Status', '$amountPaid')";
    $newReservationResult = mysqli_query($connection, $newReservation) or die ("Reservation Insertion Query Error: '$newReservation'");

    $deleteOnHand         = "DELETE FROM onHand WHERE IMEI = '$IMEI'";
    $deleteOnHandResult   = mysqli_query($connection, $deleteOnHand) or die ("On Hand Deletion Query Error: '$deleteOnHand  '");

    mysqli_close($connection);

    if($deleteOnHandResult)
        echo "<script type='text/javascript'>window.location.href = 'listSold.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listonHand.php'</script>";  
?>

