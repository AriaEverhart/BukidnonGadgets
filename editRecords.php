<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>[Osiris] Add Records</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.html">
                        Home
                    </a>
                <li>
                    Show Records
                </li>
                <li>
                    <a href="listPhones.php">All</a>
                </li>
                <li>
                    <a href="listOnHand.php">On Hand</a>
                </li>
                <li>
                    <a href="listSold.php">Sold</a>
                </li>
                <li>
                    <a href="listReturned.php">Returned</a>
                </li>
                <li>
                    <a href="listReservations.php">Reservations</a>
                </li>
                <li>
                    Options
                </li>
                <li>
                    <a href="addRecords.html">Add Records</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Edit Records</h1>

							<?php
                                $IMEI = $_POST['IMEI'];
                                $origIMEI = $IMEI;
                        
                                $connection = mysqli_connect('localhost', 'root', '');


                                $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                    if(!$SelectDB)
                                        die("Database Selection Failed: ".mysqli_error($connection));
                        
                                $query = "SELECT * FROM iPhone WHERE IMEI='$IMEI'";
                                $result = mysqli_query($connection, $query)
                                or die ('query error');

                                if(!$query)
                                    ('Error in query: ' . mysqli_error($query));

                                while($row = mysqli_fetch_row($result)){
                                    $type          = $row[1];
                                    $color         = $row[2];
                                    $size          = $row[3];
                                    $unlockType    = $row[4];
                                    $network       = $row[5];
                                    $arrivalDate   = $row[6];
                                    $supplierPrice = $row[7];
                                    $shippingFee   = $row[8];
                                    $otherFees     = $row[9];
                                    $IOSVersion    = $row[10];
                                    $clean         = $row[11];
                                }
                        
                                echo'
                                <form name = "input" action = "editRecordsSubmit.php" method="post">
                                    IMEI:<br>
                                    <input type = "text" name = "IMEI" value     ="'.$IMEI.'"><br><br>
                                    <input type = "text" name = "origIMEI" value="'.$origIMEI.'" hidden>
                                
                                    Type:<br>
                                    <select name="type">';
                                        echo'<option value="5"';  if($type=='5')       {echo'selected';} echo'>iPhone 5</option>';
                                        echo'<option value="5s"'; if($type=='5s')      {echo'selected';} echo'>iPhone 5s</option>';
                                        echo'<option value="6"';  if($type=='6')       {echo'selected';} echo'>iPhone 6</option>';
                                        echo'<option value="6s"'; if($type=='6s')      {echo'selected';} echo'>iPhone 6s</option>';
                                        echo'<option value="6s"'; if($type=='6s plus') {echo'selected';} echo'>iPhone 6s plus</option>
                                    </select><br><br>	

                                    Color:<br>
                                    <select name="color">';
                                        echo'<option value="Silver"';     if($color=='Silver')     {echo'selected';} echo'>Silver</option>';
                                        echo'<option value="Gold"';       if($color=='Gold')       {echo'selected';} echo'>Gold</option>';
                                        echo'<option value="Space Grey"'; if($color=='Space Grey') {echo'selected';} echo'>Space Grey</option>';
                                        echo'<option value="Rose Gold"';  if($color=='Rose Gold')  {echo'selected';} echo'>Rose Gold</option>
                                    </select><br><br>

                                    
                                    Size:<br>
                                    <select name="size">';
                                        echo'<option value="16"';  if($size=='16')       {echo'selected';} echo'>16gb</option>';
                                        echo'<option value="32"';  if($size=='32')       {echo'selected';} echo'>32gb</option>';
                                        echo'<option value="64"';  if($size=='64')       {echo'selected';} echo'>64gb</option>';
                                        echo'<option value="128"'; if($size=='128')      {echo'selected';} echo'>128gb</option>
                                    </select><br><br>

                                    IOS Version:<br>
                                    <input type = "text" name = "IOS_Version" value="'.$IOSVersion.'"><br><br>

                                    Unlock Type:<br>
                                    <select name="Unlock">';
                                        echo'<option value="GPP 3G"';        if($unlockType=='GPP 3G')         {echo'selected';} echo'>GPP 3G</option>';
                                        echo'<option value="GPP LTE"';       if($unlockType=='GPP LTE')        {echo'selected';} echo'>GPP LTE</option>';
                                        echo'<option value="Factory Unlock"'; if($unlockType=='Factory Unlock') {echo'selected';} echo'>Factory Unlock</option>
                                    </select><br><br>

                                    Network Lock:<br>
                                    <input type = "text" name = "Network" value="'.$network.'"><br><br>
                                    
                                    Status:<br>
                                    <select name="clean">';
                                        echo'<option value="C"';  if($clean=='C')       {echo'selected';} echo'>C</option>';
                                        echo'<option value="UC"'; if($clean=='UC')      {echo'selected';} echo'>UC</option>
                                    </select><br><br>
                                    Arrival Date:<br>
                                    <input type = "date" name = "Arrival_Date" value="'.$arrivalDate.'"><br><br>

                                    Supplier Price:<br>
                                    <input type = "text" name = "Supplier_Price" value="'.$supplierPrice.'"><br><br>

                                    Shipping Fee:<br>
                                    <input type = "text" name = "Shipping_fee" value="'.$shippingFee.'"><br><br>
                                    Other Expenses:<br>
                                    <input type = "text" name = "Other_Expenses" value="'.$otherFees.'"><br><br>
                                    <br>';
                                    
                                    $soldChecker = "SELECT * FROM sold WHERE IMEI='$IMEI'";
                                    $isSold = mysqli_query($connection, $soldChecker)
                                    or die ('query error');
                                    
                                    if(mysqli_num_rows($isSold)>0){
                                        while($row = mysqli_fetch_row($isSold)){
                                            $buyerID   = $row[1];
                                            $dateSold  = $row[2];
                                            $salePrice = $row[3];
                                        }
                                        
                                        $Checker = "sold";
                                        $buyerInfoQuery = "SELECT * FROM buyer WHERE ID='$buyerID'";
                                        $buyerInfo = mysqli_query($connection, $buyerInfoQuery)
                                        or die ('query error');
                                        
                                        while($row = mysqli_fetch_row($buyerInfo)){
                                            $buyerName      = $row[1];
                                            $buyerContactNo = $row[2];
                                        }
                                        
                                        echo'   
                                            <h1>Sold Edit</h1>
                                            <input type = "text" name = "Checker" value = "'.$Checker.'" hidden>
                                            <input type = "text" name = "buyerID" value="'.$buyerID.'" hidden>

                                            Date Sold:
                                            <input type = "date" name = "dateSold" value="'.$dateSold.'"><br><br>

                                            Sale Price:
                                            <input type = "text" name = "salePrice" value="'.$salePrice.'"><br><br>
                                        ';
                                    }
                        
                        
                                    $returnedChecker = "SELECT * FROM returned WHERE IMEI='$origIMEI'";
                                    $isReturned = mysqli_query($connection, $returnedChecker)
                                    or die ('query error');

                                     if(mysqli_num_rows($isReturned)>0){
                                        while($row = mysqli_fetch_row($isReturned)){
                                            $buyerID    = $row[1];
                                            $returnDate = $row[2];
                                            $Status     = $row[3];
                                            $issues     = $row[4];
                                        }

                                        $buyerInfoQuery = "SELECT * FROM buyer WHERE ID='$buyerID'";
                                        $buyerInfo = mysqli_query($connection, $buyerInfoQuery)
                                        or die ('query error');

                                        while($row = mysqli_fetch_row($buyerInfo)){
                                            $buyerName      = $row[1];
                                            $buyerContactNo = $row[2];
                                        }

                                        $Checker = "returned";
                                        echo'
                                            <h1>Returned Edit</h1>
                                            <input type = "text" name = "Checker" value = "'.$Checker.'" hidden>
                                            <input type = "text" name = "buyerID" value = "'.$buyerID.'" hidden>

                                            Date Returned:<br>
                                            <input type = "date" name = "returnDate" value = "'.$returnDate.'"><br><br>

                                            Issues:<br>
                                            <textarea name ="issues" rows="10", cols="30">'.$issues.'</textarea><br><br>

                                            Status:<br>
                                            <select name="Status">';
                                                echo'<option value="Received from buyer"';   if($Status=='Received from buyer')   {echo'selected';} echo'>Received from buyer</option>';
                                                echo'<option value="Shipped to supplier"';   if($Status=='Shipped to supplier')  {echo'selected';} echo'>Shipped to supplier</option>';
                                                echo'<option value="Received from Supplier"'; if($Status=='Received from supplier') {echo'selected';} echo'>Received from supplier</option>';
                                                echo'<option value="Returned to buyer"';     if($Status=='Returned to buyer')     {echo'selected';} echo'>Returned to buyer</option>';        
                                                echo'<option value="Replaced"';              if($Status=='Replaced')              {echo'selected';} echo'>Replaced</option>     
                                            </select><br><br>
                                        ';
                                    }
                        
                                    $reservedChecker = "SELECT * FROM reservation WHERE IMEI='$origIMEI'";
                                    $isReserved = mysqli_query($connection, $reservedChecker)
                                        or die ('query error');

                                    if(mysqli_num_rows($isReserved)>0){
                                        while($row = mysqli_fetch_row($isReserved)){
                                            $buyerID    = $row[1];
                                            $status     = $row[2];
                                            $amountPaid = $row[3];

                                        $buyerInfoQuery = "SELECT * FROM buyer WHERE ID='$buyerID'";
                                        $buyerInfo = mysqli_query($connection, $buyerInfoQuery)
                                        or die ('query error');

                                        while($row = mysqli_fetch_row($buyerInfo)){
                                            $buyerName      = $row[1];
                                            $buyerContactNo = $row[2];
                                        }   

                                        $Checker = "reserved";
                                        echo'
                                            <h1>Reserved Edit</h1>

                                            <input type = "text" name = "Checker" value = "'.$Checker.'" hidden>
                                            <input type = "text" name = "buyerID" value = "'.$buyerID.'" hidden>

                                            Payment Status:<br>
                                            <select name="status">';
                                                echo'<option value="Unpaid"';         if($status=='Unpaid')         {echo'selected';} echo'>Unpaid</option>';
                                                echo'<option value="Partially Paid"'; if($status=='Partially Paid') {echo'selected';} echo'>Partially Paid</option>';
                                                echo'<option value="Fully Paid"';     if($status=='Fully Paid')     {echo'selected';} echo'>Fully Paid</option>
                                            </select><br><br>

                                            Amount Paid:<br>
                                            <input type = "text" name = "amountPaid" value = "'.$amountPaid.'">';
;    
                                        }  
                                    }    
                if(mysqli_num_rows($isSold)>0 || (mysqli_num_rows($isReturned)>0) || (mysqli_num_rows($isReserved)>0)){
                                        echo'
                                            <h1>Buyer Edit</h1>
                                            Buyer Name:<br>
                                            <input type = "text" name = "buyerName" value="'.$buyerName.'"><br><br>

                                            Buyer Contact Number:<br>
                                            <input type = "text" name = "buyerNo" value="'.$buyerContactNo.'"><br><br>
                                            ';
                                    }
                                        
                                    if((mysqli_num_rows($isSold)==0)&&(mysqli_num_rows($isReturned)==0)&&(mysqli_num_rows($isReserved)==0)){
                                        echo'<input type = "text" name = "Checker" value = "onHand" hidden>';
                                    }

                                    echo'<input type = "submit" value = "Submit">
                                    <input type = "reset">
                                    </form>';
                            mysqli_close($connection);

                            ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
	<!-- MySQL Show Records -->
	<script src="listRecords.php"></script>
</body>
</html>