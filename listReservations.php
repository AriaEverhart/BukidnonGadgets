<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reservation List</title>

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
        <div class="row" id="headerTitle"><h1>Reservations</h1></div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">                 
						<?php
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	

                                $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                    if(!$SelectDB)
                                        die("Database Selection Failed: ".mysqli_error($connection));

                                $listExisting = 'SELECT 0,
                                                         reservation.IMEI, 
                                                         CONCAT("iPhone ", iPhone.Type, " ", iPhone.Color, " ", iPhone.Size,"gb"), 
                                                         buyer.name, 
                                                         buyer.Contact_no, 
                                                         reservation.Status,
                                                         FORMAT(AmountPaid,2),
                                                         reservation.remarks
                                                 FROM iPhone, reservation, buyer
                                                 WHERE (reservation.IMEI=iPhone.IMEI) AND (reservation.buyer_ID=buyer.id)
                                                 UNION
                                                 SELECT tempDevices.ID,
                                                        NULL,
                                                        CONCAT("iPhone ", tempDevices.Type, " ", tempDevices.Color, " ", tempDevices.Size,"gb"),
                                                        buyer.name,
                                                        buyer.Contact_no,
                                                        tempDevicesReservation.Status,
                                                        FORMAT(AmountPaid,2),
                                                        tempDevicesReservation.remarks
                                                 FROM tempDevices, tempDevicesReservation, buyer
                                                 WHERE (tempDevicesReservation.Buyer_ID=buyer.ID) AND (tempDevicesReservation.TempDevice_ID=tempdevices.id)';

                                $listExistingResult = mysqli_query($connection, $listExisting)
                                or die ("Reservation Query error : '$listExisting'");

                                 if(!$listExisting)
                                     ('Error in query: ' . mysqli_error($listExisting));

                                if(mysqli_num_rows ($listExistingResult)>0){
                                        echo'<div class="table-responsive">';
                                        echo'<table class="table">';
                                        echo"<thead>
                                                <tr>
                                                    <th>IMEI</th>
													<th>Device</th>
                                                    <th>Buyer Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Status</th>
													<th>Amount Paid</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>";

                                    while($row = mysqli_fetch_row($listExistingResult)){
                                        echo"<tbody>
                                                <tr>
                                                    <td>$row[1]</td>
                                                    <td>$row[2]</td> 
                                                    <td>$row[3]</td> 
                                                    <td>$row[4]</td>
													<td>$row[5]</td>
													<td>$row[6]</td>
													<td>$row[7]</td>";
                                                    
                                        
                                        $checker = $row[0];
                                        
                                        
                                        if($checker==0){
                                            echo'<td id = "sold" width = 20>
                                                <form name = "sold" action = "reservedToSold.php" method = "post">
                                                    <button name = "Sold" type="submit" value="'. $row[1] .'" class="btn btn-success btn-xs">
                                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    </button>
                                                </form>
                                                <form name = "cancelled" action = "cancelledExist.php" method = "post">
                                                    <button name = "IMEI" type="submit" value="'. $row[1] .'" class="btn btn-warning btn-xs">
                                                            <span class="glyphicon glyphicon-ban-circle"></span>
                                                    </button>
                                                </form>';
                                        }
                                        else{
                                            echo'<td id = "sold" width = 20>
                                                <form name = "sold" action = "reservedToSold.php" method = "post">
                                                    <button name = "Sold" type="submit" value="'. $row[0] .'" class="btn btn-success btn-xs">
                                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    </button>
                                                </form>
                                                <form name = "cancelled" action = "cancelledTemp.php" method = "post">
                                                    <button name = "ID" type="submit" value="'. $row[0] .'" class="btn btn-warning btn-xs">
                                                            <span class="glyphicon glyphicon-ban-circle"></span>
                                                    </button>
                                                </form>';
                                        }
                                        echo'</td>
                                            <td id = "delete" width = 20>
                                            <form name = "delete" action = "deleteRecord.php" method = "post">
                                                 <button name = "IMEI" type="submit" value="' . $row[1] . '" class="btn btn-danger btn-xs" onClick="return confirm(\'Delete This entry?\')"> 
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                 </button>
                                            </form>

                                            <form name = "edit" action = "editRecords.php" method = "post">
                                                <button name = "IMEI" type="submit" value="'. $row[0] .'" class="btn btn-primary     btn-xs">
                                                        <span class="glyphicon glyphicon-edit"></span>
                                                </button>
                                            </form>

                                        </td>';	
                                            
                                            ;	
                                        
                                        echo"</tr>";	
                                    }

                                    echo"</tbody>
                                        </table>";
                                }

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
