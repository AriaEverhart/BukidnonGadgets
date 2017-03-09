<?php
    $IMEI       = $_POST['IMEI'];
    $buyerID    = $_POST['buyerID'];
    $dateSold   = $_POST['dateSold'];
    $salePrice  = $_POST['price'];

    $dateSold = date('y-m-d',strtotime($dateSold));

    $connection = mysqli_connect('localhost', 'root', '');
        if ($connection->connect_errno) {
            echo ("SQL can't connect to PHP". $connection->connect_error);
            exit();
        }	

    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));

    $newSold       = "INSERT INTO sold VALUES ('$IMEI', '$buyerID', '$dateSold', '$salePrice')";
    $newSoldResult = mysqli_query($connection, $newSold) or die ("Buyer Insertion Query Error: '$newSold'");
    
    $deleteReservation       = "DELETE FROM reservation WHERE IMEI='$IMEI'";
    $deleteReservationResult = mysqli_query($connection, $deleteReservation) or die ("Buyer Insertion Query Error: '$deleteReservation'");
        
    mysqli_close($connection);

    if($newSoldResult)
        echo "<script type='text/javascript'>window.location.href = 'listSold.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listonHand.php'</script>";  
?>

