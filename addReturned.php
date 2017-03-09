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
                    Options
                </li>
                <li>
                    <a href="searchRecords.html">Search Records</a>
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
                        <h3>Unit Returned</h3>

                 
						<?php
                            $IMEI = $_POST['returned'];
                            
                        
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	

                            $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                if(!$SelectDB)
                                    die("Database Selection Failed: ".mysqli_error($connection));

                            $query = "SELECT IMEI, Buyer_ID, Name FROM sold, buyer WHERE(IMEI = '$IMEI') AND (Buyer_ID=ID)";
                            $result = mysqli_query($connection, $query)
                            or die ('query error');

                             if(!$query)
                                 ('Error in query: ' . mysqli_error($query));
                            
                            while($row = mysqli_fetch_row($result)){
                                $IMEI       = $row[0];
                                $Buyer_ID   = $row[1];
                                $Buyer_Name = $row[2];
                            }
                            
                            $query = "SELECT concat('iPhone ', type, ' ', color, ' ', size) FROM iphone WHERE IMEI = '$IMEI'";
                            $result = mysqli_query($connection, $query)
                            or die ('query error');
                        
                            while($row = mysqli_fetch_row($result)){
                                $device      = $row[0];
                            }
                        
                        echo'<form name = "input" action = "addReturnedSubmit.php" method="post">
								IMEI: ';
                                echo($IMEI);
                                echo'
                                <input type = "text" name = "IMEI" value="'.$IMEI.'" hidden>
                                <input type = "text" name = "Buyer_ID" value="'.$Buyer_ID.'" hidden>
                                <br>Device: ';
                                echo($device);
                                echo' <br>Buyer: ';
                                echo($Buyer_Name);
                                echo'<br>';
                                echo'<br><br>
                                Date Returned:<br>
                                <input type = "date" name = "date_returned"><br><br>
                                Issues:<br>
                                <textarea name ="issues" rows="10", cols="30"> </textarea><br><br>
                                <input type = "submit" value = "Submit">
                        </form>
                        <form method="get" action="listSold.php">
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
