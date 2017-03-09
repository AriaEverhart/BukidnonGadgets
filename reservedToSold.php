<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>[Osiris] Edit Record</title>

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
                        <h3>Unit Sold</h3>

                 
						<?php
                            $IMEI = $_POST['IMEI'];
                        
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	
                            
                            $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                if(!$SelectDB)
                                    die("Database Selection Failed: ".mysqli_error($connection));
                            
                            $getBuyer = "SELECT Buyer_ID FROM reservation WHERE IMEI='$IMEI'";
                            $getBuyerResult = mysqli_query($connection, $getBuyer)
                                or die ("Device Fetch Query Error: '$getBuyer'");
                            while($row = mysqli_fetch_row($getBuyerResult)){
                                $buyerID = $row[0];
                            }
                            
                            $getBuyer = "SELECT * FROM buyer WHERE ID='$buyerID'";
                            $getBuyerResult = mysqli_query($connection, $getBuyer)
                                or die ("Device Fetch Query Error: '$getBuyer'");
                            while($row = mysqli_fetch_row($getBuyerResult)){
                                $buyerName = $row[1];
                                $buyerNo   = $row[2];
                            }
                            
                            $getDevice = "SELECT concat('iPhone ', type, ' ', color, ' ', size) FROM iphone WHERE IMEI = '$IMEI'";
                            $getDeviceResult = mysqli_query($connection, $getDevice)
                                or die ("Device Fetch Query Error: '$getDevice'");
                        
                            while($row = mysqli_fetch_row($getDeviceResult)){
                                $device      = $row[0];
                            }
                            

                        echo'<form name = "input" action = "reservedToSoldSubmit.php" method="post">
								IMEI: '.$IMEI.'
                                <br>Device: '.$device.'
                                <br>Buyer: '.$buyerName.'
                                <input type = "text" name = "IMEI"    value="'.$IMEI.'" hidden>
                                <input type = "text" name = "buyerID" value="'.$buyerID.'" hidden>
                                <br><br>
                                Date Sold:<br>
                                <input type = "date" name = "dateSold"><br><br>
                                Sale Price:<br>
                                <input type = "text" name = "price"><br><br>
                                
                                <input type = "submit" value = "Submit">
                        </form>
                        <form method="get" action="listonHand.php">
                            <button type="submit">Cancel</button>
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
	
    
</body>
</html>
