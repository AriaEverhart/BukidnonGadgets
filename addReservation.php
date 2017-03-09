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
                        <h3>Unit Reserved</h3>

                 
						<?php
                            $id = $_POST['id'];
                            
                        
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	

                            $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                if(!$SelectDB)
                                    die("Database Selection Failed: ".mysqli_error($connection));

                            $query = "SELECT * FROM onHand WHERE ID = '$id'";
                            $result = mysqli_query($connection, $query)
                            or die ('query error');

                             if(!$query)
                                 ('Error in query: ' . mysqli_error($query));
                            
                            while($row = mysqli_fetch_row($result)){
                                $id     = $row[0];
                                $IMEI   = $row[1];
                            }
                        
                            $query = "SELECT concat('iPhone ', type, ' ', color, ' ', size) FROM iphone WHERE IMEI = '$IMEI'";
                            $result = mysqli_query($connection, $query)
                            or die ('query error');
                        
                            while($row = mysqli_fetch_row($result)){
                                $device      = $row[0];
                            }
                        
                        echo'<form name = "input" action = "addReservationSubmit.php" method="post">
								IMEI: ';
                                echo($IMEI);
                                echo'
                                <input type = "text" name = "IMEI" value="'.$IMEI.'" hidden><br>Device: ';
                                echo($device);
                                echo'<br><br>
                                Buyer Name:<br>
                                <input type = "text" name = "buyerName"><br><br>
                                Buyer Contact No.:<br>
                                <input type = "text" name = "buyerNo"><br><br>
                                Payment Status:<br>
                                <select name="Status">
                                    <option value="Unpaid">Unpaid</option>
                                    <option value="Partially Paid">Partially Paid</option>
                                    <option value="Fully Paid">Fully Paid</option>
                                </select><br><br>
                                Amount Paid:<br>
                                <input type = "text" name = "amountPaid"><br><br>
                                
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
