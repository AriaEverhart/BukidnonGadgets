<?php
    $IMEI = $_POST['IMEI'];

    $connection = mysqli_connect('localhost', 'root', '');


    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));
    
	$deleteRecord = "DELETE FROM iPhone WHERE IMEI='$IMEI'";
	echo'<br>';
	$deleteRecordResult = mysqli_query($connection, $deleteRecord)
	or die ("Deletion query error: '$deleteRecord'");
    
    if($deleteRecordResult)
        echo "<script type='text/javascript'>alert('Success!'); window.location.href = 'listPhones.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listPhones.php'</script>";

    mysqli_close($connection);
?>