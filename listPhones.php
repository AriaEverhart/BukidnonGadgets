<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>[Osiris] List Records</title>

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
                        <h1>iPhones</h1>
                 
						<?php
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	

                                $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                    if(!$SelectDB)
                                        die("Database Selection Failed: ".mysqli_error($connection));

                                $query = 'SELECT IMEI, 
                                                 concat("iPhone ", type, " ", Color,  " ", size, "gb"), 
                                                 IOS_Version, 
                                                 Unlock_type, 
                                                 Network, 
                                                 clean, 
                                                 DATE_FORMAT(Supplier_Date, "%b %d %Y"), 
                                                 FORMAT(Supplier_Price,2), 
                                                 FORMAT(Shipping_Price,2), 
                                                 FORMAT(Other_Expenses,2) 
                                                 FROM iPhone ';
                                $result = mysqli_query($connection, $query)
                                or die ('query error');

                                 if(!$query)
                                     ('Error in query: ' . mysqli_error($query));

                                if(mysqli_num_rows ($result)>0){
                                        echo'<div class="table-responsive">';
                                        echo'<table class="table">';
                                        echo"<thead>
                                                <tr>
                                                    <th>IMEI</th>
                                                    <th>Device</th>
													<th>IOS Version</th>
													<th>Unlock Type</th>
													<th>Network</th>
                                                    <th>Clean</th>
													<th>Arrival Date</th>
													<th>Supplier Price</th>
													<th>Shipping Fee</th>
													<th>Other Expenses</th>
                                                </tr>
                                            </thead>";

                                    while($row = mysqli_fetch_row($result)){
                                        echo"<tbody>
                                                <tr>
                                                    <td>$row[0]</td>
                                                    <td>$row[1]</td> 
                                                    <td>$row[2]</td> 
                                                    <td>$row[3]</td>
													<td>$row[4]</td>
													<td>$row[5]</td>
													<td>$row[6]</td>
													<td>$row[7]</td>
													<td>$row[8]</td>
                                                    <td>$row[9]</td>";
                                        
                                        echo' 
                                           <td id = "delete" width = 20>
                                                <form name = "delete" action = "deleteRecord.php" method = "post">
                                                     <button name = "IMEI" type="submit" value="' . $row[0] . '" class="btn btn-danger btn-xs"  onClick="return confirm(\'Delete This account?\')"> 
                                                            <span class="glyphicon glyphicon-minus"></span>
                                                     </button>
                                                </form>
                                                
                                                <form name = "edit" action = "editRecords.php" method = "post">
                                                    <button name = "IMEI" type="submit" value="'. $row[0] .'" class="btn btn-primary     btn-xs">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                    </button>
                                                </form>
                                            </td>
                                            ';	
                                        
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
