<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seeker - Transportation & Carpooling System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <script src="location.js"></script>
</head>


<body>
    <!-- <header>
        <div class="logo">
            <img src="logo.png" alt="Pool Buddy">
        </div>
        <nav>
            <ul>
                <b><p id="status" style="font-size:20px; color:white; padding-right:15px;"></p></b>
                <li><a href="rider.php">Rider</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </nav>
    </header> -->

    <header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
    <button class="hamburger" id="hamburgerIcon">
        <div></div>
        <div></div>
        <div></div>
    </button>

    <nav>
        <ul>
        <b><p id="status" style="font-size:20px; color:white; padding-right:15px;"></p></b>
                <li><a href="rider.php">Rider</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="logout.php">LogOut</a></li>
        </ul>
    </nav>
</header>

    <main>
        <div class="auth-container">
            <h1>Find a Ride</h1>
            <form id="searchForm" method="POST" action="seeker.php">
                <label for="source">Source:</label>
                <input type="text" id="source" name="source" required>

                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date">

                <br><br>
                <div class="button-container">
                <button type="submit" name="submit" >Search Ride</button>
                </div>
            </form>
        </div>
        <div class="auth-container">
            <h1>All Available Rides</h1> 
            <div id="allRides" class="ride-container">
                <?php
                session_start();
                $xyz = $_SESSION['email']; 
                if($xyz == true)
                {
                }  
                else 
                {
                    header('location:login.php');
                }
                include("connection.php");
                if(isset($_POST['submit']))
                {
                    $source = $_POST['source'];
                    $dest = $_POST['destination'];
                    $date = $_POST['date'];
                        $query = "SELECT * FROM rider WHERE Source = '$source' && Destination = '$dest' && Date = '$date' && Seat_Status >= 1 && Status = 'Not_Booked'";
                        $data = mysqli_query($conn, $query);

                        $total = mysqli_num_rows($data);
                        if($total != 0)
                        {
                            ?>
                            <center>
                            <table border="0px solid-green" cellspacing="10" width="100%">
                                <th width="10%" style="text-align: center;"></th>
                                <th width="10%" style="text-align: center; color:#00e600;">S.No</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Source</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Destination</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Date</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Time</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Vehicle_Name</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Driver_Name</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Car_Num</th>
                                <th width="10%" style="text-align: center; color:#00e600;">Price</th>
                            <?php
                            $a = 1;
                            while($cc = mysqli_fetch_assoc($data))
                            {
                                echo " <tr>
                                <form method='POST'>
                                <td style='text-align: center; padding-top:15px;'><input type='checkbox' required name='riderID' style='width:18 px; height:18px;' value='$cc[R_Id]'></td>
        
                                <td style='text-align: center;'>$a</td>
                                <td style='text-align: center;'>$cc[Source]</td>
                                <td style='text-align: center;'>$cc[Destination]</td>
                                <td style='text-align: center; width: 50px;'>$cc[Date]</td>
                                <td style='text-align: center;'>$cc[Time]</td>
                                <td style='text-align: center;'>$cc[Vehicle_Name]</td>
                                <td style='text-align: center;'>$cc[Driver_Name]</td>
                                <td style='text-align: center;'>$cc[Car_Num]</td>
                                <td style='text-align: center;'>$cc[Price]</td>
                                <td style='text-align: center;  padding-top:15px;'><input type='submit' name='book' value='Book' style='color:green; border-radius:15px; cursor:pointer;'></form></td>
                                        </tr>
                                ";
                                $a += 1;
                                $_SESSION['riderID'] = $cc['R_Id'];

                            }
                        }
                        else
                        {
                            echo "<h2 style='color:red;'>No Rides Available...!!!</h2>";
                        }
                }
                else
                {
                    echo "<h2 style='color:hotpink;'>Search for the Rides.....</h2>";
                }

                if(isset($_POST['book']))
                {    
                    $xyz = $_SESSION['email']; 
                    $rrii = $_POST['riderID'];
                    $query = "UPDATE rider SET S_Username = '$xyz', Status = 'P_Pending' WHERE R_Id = '$rrii'";
                    $data = mysqli_query($conn, $query);
                    if($data)
                    {
                        echo "<script>alert('Yahoooooo!!!!_Ride_Booked');</script>";
                        header('location:payment.php');
                    }
                    else
                    {
                        echo "<script>alert('Ohhh..._Ride_Not_Booked');</script>";
                    }
                }
                ?>
            </center>
            </table>
            </div>
        </div>
        <div class="auth-container">
            <h1>My Rides</h1>
            <div id="availableRides" class="ride-container">
            <?php
                $xyz = $_SESSION['email']; 
                
                $query = "SELECT * FROM rider WHERE S_Username = '$xyz' && Status = 'Ride_Completed'";
                $data = mysqli_query($conn, $query);
                $total = mysqli_num_rows($data);
                // $tt = mysqli_num_rows($d);
                if($total != 0)
                {
                    ?>
                    <center>
                        <table border="0px" style="border-color:green" cellspacing="10" width="100%">
                            <th width="10%" style="text-align: center;"></th>
                            <th width="10%" style="text-align: center;  color:hotpink;  border:0px solid black;" width:5px;>S_No</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Source</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Destination</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Date</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Time</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Vehicle_Name</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Driver_Name</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Car-Num</th>
                            <th width="10%" style="text-align: center; color:hotpink; border:0px solid black;" width:5px;>Price</th>
                <?php
                    $abb = 1;
                    while($xx = mysqli_fetch_assoc($data))
                    {
                            echo " <tr>
                                    <form method='POST' action = 'seeker.php'>
                                    <td style='text-align: center;  padding-top:15px;'><input type='checkbox' required name='riderID' value='$xx[R_Id]' style='height:18px; width:18px;'></td>
                                    <td style='text-align: center; border:0px solid black;'>$abb</td>
                                    <td style='text-align: center; border: 0px solid black;' width:5px;>$xx[Source]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Destination]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Date]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Time]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Vehicle_Name]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Driver_Name]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Car_Num]</td>
                                    <td style='text-align: center; border:0px solid black;' width:5px;>$xx[Price]</td>
                                    <td style='text-align: center;  padding-top:15px;'><input type='submit' name='cancel' value='Cancel' style='color:red; border-radius:15px; cursor:pointer;'></form></td>
                                            </tr>
                                    ";
                            $abb += 1;
                        }
                }
                else
                {
                    echo "<h2 style='color:hotpink;'>No Booking Yet...!!!</h2>";
                }

                if(isset($_POST['cancel']))
                {
                    $rri = $_POST['riderID'];

                    $q = "SELECT * FROM rider WHERE S_Username = '$xyz' && R_Id = '$rri'";
                    $kl = mysqli_query($conn, $q);
                    $kk = mysqli_num_rows($kl);
                    $gh = mysqli_fetch_assoc($kl);
                    $zzz = $gh['Seat_Status'];
                    // echo "<script>alert($zzz + 1);</script>";
                    $query = "UPDATE rider SET S_Username = NULL, Status = 'Not_Booked' , Pay_Status = NULL, Pay_Mode = NULL, Seat_Status = $zzz+1 WHERE R_Id = '$rri'";
                    $data = mysqli_query($conn, $query);
                    if($data)
                    {
                        echo "<script>alert('Ride_Cancelled...!!!');</script>";
                        echo "<script>window.location.href = 'seeker.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Ride_Cannot_Be_Cancelled...!!!');</script>";
                    }
                }
            ?>
        </center>
        </table>
            </div>
        </div>
        
        <div id="map" style="height: 400px; display: none;"></div>
    </main>

    <footer>
        <p>&copy; 2025 Transportation & Carpooling System</p>
    </footer>
</body>
</html>

<script>
    // Get the hamburger icon and menu
    const hamburgerIcon = document.getElementById('hamburgerIcon');
    const navMenu = document.querySelector('nav ul');

    // Add click event to toggle menu visibility
    hamburgerIcon.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburgerIcon.classList.toggle('active');
    });
</script>