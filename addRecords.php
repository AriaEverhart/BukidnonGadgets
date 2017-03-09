<?php
    $IMEI =           $_POST['IMEI'];
    $type =           $_POST['type'];
    $color =          $_POST['color'];
    $size =           $_POST['size'];
    $IOS_Version =    $_POST['IOS_Version'];
    $unlock =         $_POST['Unlock'];
    $Network =        $_POST['Network'];
	$arrival =        $_POST['Arrival_Date'];
    $supplier_Price = $_POST['Supplier_Price'];
    $shipping_fee =   $_POST['Shipping_fee'];
    $Other_Expenses = $_POST['Other_Expenses'];
    $clean =          $_POST['clean'];

	$arrival = date('y-m-d',strtotime($arrival));

    $connection = mysqli_connect('localhost', 'root', '');


    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));
    
	$query = "INSERT INTO iPhone VALUES('$IMEI', '$type', '$color', '$size', '$unlock', '$Network', '$arrival', '$supplier_Price', '$shipping_fee', '$Other_Expenses', '$IOS_Version','$clean')";
	echo'<br>';
	$result = mysqli_query($connection, $query)
	or die ("Adding query error: '$query'");

    $query = "INSERT INTO onHand VALUES('', '$IMEI')";

	echo'<br>';
	$result = mysqli_query($connection, $query)
	or die ('query error');

    if($result)
        echo "<script type='text/javascript'>alert('Success!'); window.location.href = 'listPhones.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listPhones.php'</script>";

    mysqli_close($connection);

?>