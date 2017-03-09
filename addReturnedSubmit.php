<?php
    $IMEI           = $_POST['IMEI'];
    $Buyer_ID       = $_POST['Buyer_ID'];
    $Date_Returned  = $_POST['date_returned'];
    $Status         = $_POST['Status'];
    $Issues         = $_POST['issues'];

    $Date_Returned = date('y-m-d',strtotime($Date_Returned));

    $connection = mysqli_connect('localhost', 'root', '');
        if ($connection->connect_errno) {
            echo ("SQL can't connect to PHP". $connection->connect_error);
            exit();
        }	

    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));
    
    $query = "INSERT INTO returned VALUES ('$IMEI', '$Buyer_ID', '$Date_Returned', '$Status', '$Issues')";
    $result = mysqli_query($connection, $query) or die ("query error1'$query'");

    mysqli_close($connection);

    if($result)
        echo "<script type='text/javascript'>window.location.href = 'listReturned.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listSold.php'</script>";  
?>

