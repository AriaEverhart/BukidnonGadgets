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
                <li class="sidebar-brand" align="center">
                    <a href="index.html">
                        Home
                    </a>
                <li align="center">
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
                <li align="center">
                    Options
                </li>
                <li>
                    <a href="addRecords.html">Add Records</a>
                </li>
                <li>
                    <a href="addNewReservation.html">New Reservation</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="row" id="headerTitle"><h1>Unit Reserved</h1></div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                 
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
                             <table cellspacing="10" name="form">
								<tr>
                                    <td align="right">IMEI: </td>
                                    <td align="left">';echo($IMEI);echo'</td>
                                    <input type = "text" name = "IMEI" value="'.$IMEI.'" hidden>
                                </tr>
                                <tr>
                                    <td align="right">Device: </td>
                                    <td align="left">';echo($device);echo'</td>
                                </tr>
                                <tr><td></td></tr><tr><td></td></tr>
                                <tr>
                                    <td align="right">Buyer Name: </td>
                                    <td align="left"><input type = "text" name = "buyerName"></td>
                                </tr>
                                <tr>
                                    <td align="right">Buyer Contact No.:</td>
                                    <td align="left"><input type = "text" name = "buyerNo"></td>
                                </tr>
                                <tr><td></td></tr><tr><td></td></tr>
                                <tr>
                                    <td align="right">Payment Status:</td>
                                    <td align="left"><select name="Status">
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partially Paid">Partially Paid</option>
                                        <option value="Fully Paid">Fully Paid</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td align="right">Amount Paid:</td>
                                    <td align="left"><input type = "text" name = "amountPaid"></td>
                                </tr>
                                <tr>
                                    <td align="left" colspan="2"><textarea name ="remarks" rows="10", cols="39"placeholder="Remarks"></textarea></td>
                                </tr>
                                <tr>
                                    <td align="right"><input type = "submit" value = "Submit"></td>
                                    <td align="left"><button type="reset" value="Reset">Reset</button></td>
                                </tr>
                        </table></form>';
                        
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
