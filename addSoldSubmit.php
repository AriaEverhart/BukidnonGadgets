<?php
    $IMEI =           $_POST['IMEI'];
    $Buyer_Name =     $_POST['buyer_name'];
    $Buyer_No =       $_POST['buyer_no'];
    $Date_Sold =      $_POST['date_sold'];
    $Sale_Price =     $_POST['price'];

    $Date_Sold = date('y-m-d',strtotime($Date_Sold));

    $connection = mysqli_connect('localhost', 'root', '');
        if ($connection->connect_errno) {
            echo ("SQL can't connect to PHP". $connection->connect_error);
            exit();
        }	

    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));

    $query = "INSERT INTO buyer VALUES ('', '$Buyer_Name', '$Buyer_No')";
    $result = mysqli_query($connection, $query) or die ('query error1');

    $Buyer_ID = mysqli_insert_id($connection);
    
    $query = "INSERT INTO sold VALUES ('$IMEI', '$Buyer_ID', '$Date_Sold', '$Sale_Price')";
    $result = mysqli_query($connection, $query) or die ("query error2 $IMEI");

    $query = "DELETE FROM onHand WHERE IMEI = '$IMEI'";
    $result = mysqli_query($connection, $query) or die ('query error3');

    mysqli_close($connection);

    if($result)
        echo "<script type='text/javascript'>window.location.href = 'listSold.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listonHand.php'</script>";  
?>

