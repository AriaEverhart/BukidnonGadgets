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
                        <h1>On Hand</h1>
                 
						<?php
                            $connection = mysqli_connect('localhost', 'root', '');
                                if ($connection->connect_errno) {
                                    echo ("SQL can't connect to PHP". $connection->connect_error);
                                    exit();
                                }	

                                $SelectDB = mysqli_select_db($connection, "BukidnonGadgets");
                                    if(!$SelectDB)
                                        die("Database Selection Failed: ".mysqli_error($connection));

                                $query = 'SELECT onHand.ID, onHand.IMEI, concat("iPhone ", type, " ", Color,  " ", size, "gb"), IOS_Version, iPhone.Unlock_Type, iPhone.clean from iPhone, onHand WHERE (onHand.IMEI = iPhone.IMEI) ORDER BY onhand.ID;';
                                $result = mysqli_query($connection, $query)
                                or die ('query error');

                                 if(!$query)
                                     ('Error in query: ' . mysqli_error($query));

                                if(mysqli_num_rows ($result)>0){
                                        echo'<div class="table-responsive">';
                                        echo'<table class="table">';
                                        echo"<thead>
                                                <tr>
                                                    <th>Stock No.</th>
													<th>IMEI</th>
                                                    <th>Device</th>
													<th>IOS Version</th>
													<th>Unlock Type</th>
                                                    <th>Clean</th>
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
                                                    <td>$row[5]</td>";
                                        
                                        echo' 
                                            
                                            
                                            <td id = "sold" width = 20>
                                                <form name = "sold" action = "addSold.php" method = "post">
                                                    <button name = "id" type="submit" value="'. $row[0] .'" class="btn btn-success btn-xs">
                                                            <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    </button>
                                                </form>
                                                
                                                <form name = "reserved" action = "addReservation.php" method = "post">
                                                    <button name = "id" type="submit" value="'. $row[0] .'" class="btn btn-warning btn-xs">
                                                            <span class="glyphicon glyphicon-tag"></span>
                                                    </button>
                                                </form>
                                                
                                            </td>
                                            
                                            <td id = "delete" width = 20>
                                                <form name = "delete" action = "deleteRecord.php" method = "post">
                                                     <button name = "IMEI" type="submit" value="' . $row[1] . '" class="btn btn-danger btn-xs" onClick="return confirm(\'Delete This account?\')"> 
                                                            <span class="glyphicon glyphicon-minus"></span>
                                                     </button>
                                                </form>
                                                
                                                <form name = "edit" action = "editRecords.php" method = "post">
                                                    <button name = "IMEI" type="submit" value="'. $row[1] .'" class="btn btn-primary     btn-xs">
                                                            <span class="glyphicon glyphicon-edit"></span>
                                                    </button>
                                                </form>
                                                
                                            </td>';	
                                        
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
