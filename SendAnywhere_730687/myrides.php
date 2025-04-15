<?php
include('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <title>My_Rides</title>
</head>
<body>

<header>
        <div class="logo">
            <img src="logo.png" alt="Pool Buddy">
        </div>
        <nav>
            <ul>
                <li><a href="rider.php">Rider</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </nav>
    </header>
<div class="row">
  <div class="col-75">
    <div class="container">

        <div class="row">
          <div class="col-50">
            <!-- <h3>Billing Address</h3>
             -->
    </div>
  </div>
</div>



        <div class="auth-container">
            <h1>My Rides</h1>
            <div id="availableRides" class="ride-container">
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
            $xyz = $_SESSION['email'];

            $query = "SELECT * FROM rider WHERE Username = '$xyz' && Status = 'Dri_AP'";
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
                    <th width="10%" style="text-align: center; color:#00e600;">Seeker_Name</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Price</th>
                <?php
                $a = 1;
                while($cc = mysqli_fetch_assoc($data))
                {
                    $seeker_mail = $cc['S_Username'];
                    $ss = $cc['Seat_Status'];
                    $rr = $cc['R_Id'];
                    $Dri_name = $cc['Driver_Name'];
                    $date = $cc['Date'];
                    $source = $cc['Source'];
                    $dest = $cc['Destination'];
                    $ppp = $cc['Price'];
                    $carn = $cc['Car_Num'];
                    $veh_name = $cc['Vehicle_Name'];
                    $dri_email = $cc['Username'];
                    echo " <tr>
                    <form method='POST'>
                    <td style='text-align: center; padding-top:15px;'><input type='checkbox' required name='riderID' style='width:18 px; height:18px;' value='$cc[R_Id]'></td>
                    <td style='text-align: center;'>$a</td>
                    <td style='text-align: center;'>$cc[Source]</td>
                    <td style='text-align: center;'>$cc[Destination]</td>
                    <td style='text-align: center; width: 50px;'>$cc[Date]</td>
                    <td style='text-align: center;'>$cc[Time]</td>
                    <td style='text-align: center;'>$cc[S_Username]</td>
                    <td style='text-align: center;'>$cc[Price]</td>
                    <td style='text-align: center;  padding-top:15px;'><td><button name='accept' >Accept</td>
                            </tr>
                    ";
                    $a += 1;
                }
            }
            else
            {
                echo "<center><h2 style='color:red;'>No Rides Available...!!!</h2></center>";
            }

            $qqeeuu = "SELECT * FROM rider WHERE Status = 'Live' && Username = '$xyz'";
            $dfg = mysqli_query($conn, $qqeeuu);
            $ghbn = mysqli_num_rows($dfg);
            if($ghbn > 0)
            {
                echo "<script>alert('First complete the on going or live ride..!!!');</script>";
            }
            else
            {
                if(isset($_POST['accept']))
                {
                    $query = "UPDATE rider SET Status = 'Live' WHERE Username = '$xyz' && Status = 'Dri_AP'";
                    $data = mysqli_query($conn, $query);
                    // echo "<script>window.location.href = 'seeker.php';</script>";
                    // echo "<script>window.location.href = 'myrides.php';</script>";

                    $mail = new PHPMailer(true);

        try
        {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();            
            
            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '231fa04a52konala@gmail.com';                     //SMTP username
            $mail->Password   = 'hfggxhhocrpepkef'; 
            
            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //ENCRYPTION_SMTPS           //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //UserEmail Sending...
            //Recipients
            $mail->setFrom('231fa04a52konala@gmail.com', 'PaddleShare - @noreply');

            
            $mail->addAddress($seeker_mail);     //Add a recipient
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your Ride has been Confirmed, from '.$source.' to '.$dest.' ';
                // $mail->AddEmbeddedImage(dirname(__FILE__).'/logo.png', 'Pool_Buddy_Logo');
                $mail->Body = '<center><img src="https://media-hosting.imagekit.io//ed4a73bcfa744d57/logo-modified.png?Expires=1837177976&Key-Pair-Id=K2ZIVPTIP2VGHC&Signature=ptKUUWvT7U7kwJ9E~SPdDigM2Iv7-gec3Wqdmu-Gt-M~jYk51AfxIkrOx94U~gcdyLMC5ARS83U5C02zKc1LNp~VOWUxoGRfp~S0E9C7~yJ0Gd5IaQrCW~sxL3EIayE9xBY3wfMFhtrv92dGzqDkfDOudgcba-ONrhr9ep4qSkxZsJsP080T9ErQlB-moJseKHdx7z5BY20R51aQQpW06OTeJzma2chWi1Z0LeX2D7VLqrTFY-f3J3VbLXdiujdLM7DsJsfpx8NIJwDtcv~tWaawvKlA31Z4lLvX1f52Wd2WX~xBum~Ibl62oKutBpjTCJu8j-WfnCenh7ZrtTbvUg__" style="border-radius:30px;" alt="Pool Buddy" height="200px"><br><h3>Your Ride Details are: 
                            </h3><h4>Ride_ID: '. $rr .' </h4>
                            <h4>Driver Name:  '.$Dri_name.'</h4>
                            <h4>Source:  '.$source.'</h4>
                            <h4>Destination:  '.$dest.'</h4>
                            <h4>Price:  '.$ppp.'/-</h4>
                            <h4>Date:  '.$date.'</h4>
                            <h4>Car Number:  '.$carn.'</h4>
                            <h4>Vehicle Name:  '.$veh_name.'</h4>
                            <h2 style="font-family: Brush Script MT, cursive;">Happy Journey 🚕</h2>
                            <h6>If ride not booked by you or have any quaries, please <a href="https://paddleshare.freevar.com/contact.html">contact us..!!!</a></h6>';
                $mail->send();
            // echo 'Message has been sent';



                //Driver Email Sending...
                // $mail->addAddress($dri_email);
                // $mail->Subject = 'Your Ride has been Booked from '.$source.' to '.$dest.' ';
                // $mail->Body = '<h3>Your Ride Details are: 
                //               </h3><h4>Ride_ID: '. $rr .' </h4>
                //               <h4>Seeker Name:  '.$xyz.'</h4>
                //               <h4>Source:  '.$source.'</h4>
                //               <h4>Destination:  '.$dest.'</h4>
                //               <h4>Price:  '.$ppp.'</h4>
                //               <h4>Date:  '.$date.'</h4>';
                // $mail->send();

        }
        catch (Exception $e)
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
                }
            } 
?>

</center>
        </table>
            </div>
        </div>

        <div class="auth-container">
            <h1>Live Rides</h1>
            <div id="availableRides" class="ride-container">
<?php
            $xyz = $_SESSION['email']; 
            if($xyz == true)
            {
            }  
            else 
            {
                header('location:login.php');
            }
            include("connection.php");
            $xyz = $_SESSION['email'];

            $query = "SELECT * FROM rider WHERE Username = '$xyz' && Status = 'Live'";
            $data = mysqli_query($conn, $query);

            $total = mysqli_num_rows($data);
            if($total != 0)
            {
                ?>
                <center>
                <table border="0px solid-green" cellspacing="10" width="100%">
                    <th width="10%" style="text-align: center; color:#00e600;">S.No</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Source</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Destination</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Date</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Time</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Seeker_Name</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Price</th>
                <?php
                $a = 1;
                while($cc = mysqli_fetch_assoc($data))
                {
                    echo " <tr>
                    <form method='POST'>
                    <td style='text-align: center;'>$a</td>
                    <td style='text-align: center;'>$cc[Source]</td>
                    <td style='text-align: center;'>$cc[Destination]</td>
                    <td style='text-align: center; width: 50px;'>$cc[Date]</td>
                    <td style='text-align: center;'>$cc[Time]</td>
                    <td style='text-align: center;'>$cc[S_Username]</td>
                    <td style='text-align: center;'>$cc[Price]</td>
                    <td style='text-align: center;  padding-top:15px;'><td><button name='complete_ride' >Complete_Ride</td>
                            </tr>
                    ";
                    $a += 1;
                }
            }
            else
            {
                echo "<center><h2 style='color:red;'>No Live Rides Available...!!!</h2></center>";
            }

            if(isset($_POST['complete_ride']))
            {
                $mnm = "UPDATE rider SET Status = 'Ride_Completed' WHERE Username = '$xyz' && Status = 'Live'";
                $lkl = mysqli_query($conn, $mnm);
                echo "<script>window.location.href = 'myrides.php';</script>";
            }
            
?>

</center>
        </table>
            </div>
        </div>



        <div class="auth-container">
            <h1>Completed Rides</h1>
            <div id="availableRides" class="ride-container">
<?php
            $xyz = $_SESSION['email']; 
            if($xyz == true)
            {
            }  
            else 
            {
                header('location:login.php');
            }
            include("connection.php");
            $xyz = $_SESSION['email'];

            $query = "SELECT * FROM rider WHERE Username = '$xyz' && Status = 'Ride_Completed'";
            $data = mysqli_query($conn, $query);

            $total = mysqli_num_rows($data);
            if($total != 0)
            {
                ?>
                <center>
                <table border="0px solid-green" cellspacing="10" width="100%">
                    <th width="10%" style="text-align: center; color:#00e600;">S.No</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Source</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Destination</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Date</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Time</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Seeker_Name</th>
                    <th width="10%" style="text-align: center; color:#00e600;">Price</th>
                <?php
                $a = 1;
                while($cc = mysqli_fetch_assoc($data))
                {
                    echo " <tr>
                    <form method='POST'>
                    <td style='text-align: center;'>$a</td>
                    <td style='text-align: center;'>$cc[Source]</td>
                    <td style='text-align: center;'>$cc[Destination]</td>
                    <td style='text-align: center; width: 50px;'>$cc[Date]</td>
                    <td style='text-align: center;'>$cc[Time]</td>
                    <td style='text-align: center;'>$cc[S_Username]</td>
                    <td style='text-align: center;'>$cc[Price]</td>
                            </tr>
                    ";
                    $a += 1;
                }
            }
            else
            {
                echo "<center><h2 style='color:red;'>No Completed Rides...!!!</h2></center>";
            }
            
?>

</center>
        </table>
            </div>
        </div>


        </body>
</html>