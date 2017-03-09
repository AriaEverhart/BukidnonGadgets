<?php
    $origIMEI       = $_POST['origIMEI'];
    $IMEI           = $_POST['IMEI'];
    $type           = $_POST['type'];
    $color          = $_POST['color'];
    $size           = $_POST['size'];
    $unlockType     = $_POST['Unlock'];
    $network        = $_POST['Network'];
    $arrivalDate    = $_POST['Arrival_Date'];
    $supplierPrice  = $_POST['Supplier_Price'];
    $shippingFee    = $_POST['Shipping_fee'];
    $otherFees      = $_POST['Other_Expenses'];
    $IOSVersion     = $_POST['IOS_Version'];
    $clean          = $_POST['clean'];
    $Checker        = $_POST['Checker'];

    $arrivalDate = date('y-m-d',strtotime($arrivalDate));


    $connection = mysqli_connect('localhost', 'root', '');


    $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
        if(!$SelectDB)
            die("Database Selection Failed: ".mysqli_error($connection));
    
    $onHandChecker = "SELECT * FROM onHand WHERE IMEI='$origIMEI'";
    $isOnHand = mysqli_query($connection, $onHandChecker)
    or die ('query error');

	$query = "UPDATE iPhone SET IMEI           ='$IMEI', 
                                Type           ='$type', 
                                color          ='$color', 
                                size           ='$size', 
                                unlock_type    ='$unlockType', 
                                network        ='$network', 
                                supplier_date  ='$arrivalDate',
                                supplier_price ='$supplierPrice', 
                                shipping_price ='$shippingFee', 
                                other_expenses ='$otherFees', 
                                IOS_Version    ='$IOSVersion', 
                                clean          ='$clean' 
              WHERE IMEI                       ='$origIMEI'";

	$result = mysqli_query($connection, $query)
	or die ("iPhone query error '$query'");
    
    if(($Checker =='sold') || ($Checker=='returned') || ($Checker=='reserved')){
        $buyerID        = $_POST['buyerID'];
        $buyerName      = $_POST['buyerName'];
        $buyerContactNo = $_POST['buyerNo'];

        $buyerUpdate = "UPDATE buyer SET Name       ='$buyerName', 
                                         Contact_no ='$buyerContactNo'
                        WHERE ID='$buyerID'";
        $buyerResult = mysqli_query($connection, $buyerUpdate)
        or die ("Buyer query error");
    }

    if($Checker == 'sold'){   
        $dateSold       = $_POST['dateSold'];
        $salePrice      = $_POST['salePrice'];

        $soldUpdate = "UPDATE sold SET Date_Bought='$dateSold', 
                                        sale_Price='$salePrice'
                       WHERE IMEI='$origIMEI'";
        $soldResult = mysqli_query($connection, $soldUpdate)
        or die ("Sold 2 query error '$soldUpdate'");
    }
    else if($Checker == 'returned'){
        $returnDate     = $_POST['returnDate'];
        $issues         = $_POST['issues'];
        $returnStatus   = $_POST['Status'];
        $returnDate = date('y-m-d',strtotime($returnDate));

        $returnedUpdate = "UPDATE returned SET Return_Date   ='$returnDate',
                                               issues        ='$issues',
                                               Return_Status ='$returnStatus'
                           WHERE IMEI                        ='$origIMEI'";
          
        $returnedResult = mysqli_query($connection, $returnedUpdate)
        or die ("Returned query error  '$returnedUpdate' END");

    }
    else if($Checker == 'reserved'){
        $status     = $_POST['status'];
        $amountPaid = $_POST['amountPaid'];
        
        $reservedUpdate = "UPDATE reservation SET status ='$status',
                                              amountpaid ='$amountPaid'
                           WHERE IMEI                    ='$origIMEI'";
        
        $reservedUpdateResult = mysqli_query($connection, $reservedUpdate)
        or die ("Returned query error: '$reservedUpdate' END");
    
    }

    if($result)
        echo "<script type='text/javascript'>alert('Success!'); window.location.href = 'listPhones.php'</script>";
    else
        echo "<script type='text/javascript'>alert('Failed!'); window.location.href = 'listPhones.php'</script>";

    mysqli_close($connection);
?>

