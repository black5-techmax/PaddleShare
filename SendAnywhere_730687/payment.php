<?php

error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles1.css">
<link rel="icon" type="image/x-icon" href="logo.ico">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 30px;
  width:80%;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

.btn1 {
  background-color: #04AA6D;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn1:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>
<header>
        <div class="logo">
            <img src="logo.png" alt="Pool Buddy">
        </div>
        <h1 class="header-title">Paddle Share</h1>
        <nav>
            <ul>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

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
?>

<br>
<center>
<div class="row" style="padding-top:200px;">
  <div class="col-75">
    <div class="container">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <br><br>
            <?php
	            $query = "SELECT * FROM rider WHERE S_Username = '$xyz' && Status = 'P_Pending'";
              $data = mysqli_query($conn, $query);
              $total = mysqli_num_rows($data);
              if($total == 1)
              {
                $cc = mysqli_fetch_assoc($data);
                $ss = $cc['Seat_Status'];
                $Dri_name = $cc['Driver_Name'];
                $date = $cc['Date'];
                $source = $cc['Source'];
                $dest = $cc['Destination'];
                $ppp = $cc['Price'];
                $carn = $cc['Car_Num'];
                $veh_name = $cc['Vehicle_Name'];
                $dri_email = $cc['Username'];



                echo "
                <form method='POST'>
                    <label for='fname'><i class='fa fa-car' style='font-size:24px;'></i> Ride Id </label>
                    <input type='text' id='fname' name='rider_ID' value='$cc[R_Id]' disabled>
                    <label for='email'><i class='fa fa-drivers-license' style='font-size:24px;'></i> Driver Name</label>
                    <input type='text' id='email' name='dri_name' value='$cc[Driver_Name]' disabled>
            
                  <div class='row'>
                    <div class='col-50'>
                      <label for='state'><i class='fa fa-calendar' style='font-size:24px;'></i> Date</label>
                      <input type='text' id='state' name='state' value='$cc[Date]' disabled>
                      </div>
                    <div class='col-50'>
                      <label for='zip'><i class='fa fa-clock-o' style='font-size:24px;'></i> Time</label>
                      <input type='text' id='zip' name='zip' value='$cc[Time]' disabled>
                    </div>
                    <div class='col-50'>
                      <label for='state'><i class='fa fa-map-marker' style='font-size:24px; color:green'></i> Source</label>
                      <input type='text' id='state' name='state' value='$cc[Source]' disabled>
                    </div>
                    <div class='col-50'>
                      <label for='zip'><i class='fa fa-map-marker' style='font-size:24px; color:red'></i> Destination</label>
                      <input type='text' id='zip' name='zip' value='$cc[Destination]' disabled>
                    </div>

                    <div class='col-50'>
                      <label for='zip'><i class='fa fa-rupee' style='font-size:24px; color:black'></i> Price</label>
                      <input type='text' id='zip' name='zip' value='$cc[Price]' disabled>
                    </div>
              
              </div>
            </div>
            <div class='col-50'>
              <h3 style='padding-left:25px;'>Payment</h3>
              <br><br>
              <div class='icon-container' style='padding-left:25px;'>
                <i class='fa fa-cc-visa' style='color:navy;'></i>
                <i class='fa fa-cc-amex' style='color:blue;'></i>
                <i class='fa fa-cc-mastercard' style='color:red;'></i>
                <i class='fa fa-cc-discover' style='color:orange;'></i>
              </div>
              <label style='padding-left:25px;'><input type='radio' value='BHIM_UPI' name='Pay_Mode' style='width:15px; height:15px;' required>BHIM UPI</label><br>
              <label style='padding-left:25px;'><input type='radio' value='Net_Banking' name='Pay_Mode' style='width:15px; height:15px;' required>Net Banking </label><br>
              <label style='padding-left:25px;'><input type='radio' value='Credit_Card' name='Pay_Mode' style='width:15px; height:15px;' required>Credit Card </label><br>
              <label style='padding-left:25px;'><input type='radio' value='Debit_Card' name='Pay_Mode' style='width:15px; height:15px;' required>Debit Card </label><br>
              <div class='row' style='padding-left:25px; padding-right:25px;'>
                <input type='reset' value='Reset' class='btn1'>
              </div>
            </div>
            
          </div>
          <input type='submit' name = 'submit' value='Book Ride' class='btn'>
        </form>";


      }
      ?>
    </div>
  </div>

</body>
</center>
</html>

<?php
      if(isset($_POST['submit']))
      {
        $xyz = $_SESSION['email'];
        $rr = $_SESSION['riderID'];
        $nnnn = $_SESSION['name'];
        $pp = $_POST['Pay_Mode'];
        $qwerty = $ss-1;

        if($rr == true)
        {
            $query = "UPDATE rider SET Status = 'Dri_AP', Pay_Status = 'Done' WHERE R_Id = '$rr';
                      UPDATE rider SET Pay_Mode = '$pp', Seat_Status = '$qwerty' WHERE R_Id = '$rr'";
            $data = mysqli_multi_query($conn, $query);
            if($data)
            {
              echo "<script>alert('Ride Booked...!!!');</script>";
              echo "<script>window.location.href = 'seeker.php';</script>";
            }
            else
            {
              echo "<script>alert('Ride_Not_Booked...!!!');</script>";
            }
        }
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

        
        // $mail->addAddress($xyz);     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            // $mail->Subject = 'Your Ride has been Booked from '.$source.' to '.$dest.' ';
            // $mail->Body = '<h3>Your Ride Details are: 
            //               </h3><h4>Ride_ID: '. $rr .' </h4>
            //               <h4>Driver Name:  '.$Dri_name.'</h4>
            //               <h4>Source:  '.$source.'</h4>
            //               <h4>Destination:  '.$dest.'</h4>
            //               <h4>Price:  '.$ppp.'</h4>
            //               <h4>Date:  '.$date.'</h4>
            //               <h4>Car Number:  '.$carn.'</h4>
            //               <h4>Vehicle Name:  '.$veh_name.'</h4>';
            // $mail->send();
        // echo 'Message has been sent';



            //Driver Email Sending...
            $mail->addAddress($dri_email);
            $mail->Subject = 'Your Ride has been Booked from '.$source.' to '.$dest.' ';
            $mail->Body = '<center><img src="https://media-hosting.imagekit.io/78f96e008efd4dd1/booked.jpeg?Expires=1838385911&Key-Pair-Id=K2ZIVPTIP2VGHC&Signature=HCskXckIZVRxVyfO9vqqCuILNZCjJ-OgugXwVfpOA1kSQOfqI1lzrHS0DgK4Uo9DQFuKOWxC2mqZVNHSAfq4VxPr3Dap3SHpqRfVgqQCcryPnyRouP93uRCXSuBI8jQwfXCTVChEp8XTWymLw8CsLBZGRjkOBM~DS25SUQUnzxgd2BltQlGG00PWrRxEoLAg-8qijiQ-BmKVQkiqxanl0nYxxg~I5HwWBg2seXTB6tXwWmjAQBeESWP9m8375m2WvqC1cI~VM5MASA3RZmw1B1dADErpPWzpCn91n4d4oJbfI64sIII68AV0oFmLUlvlEwZujkJ~vcifiRfJxI4bUg__" style="border-radius:10px;" alt="Pool Buddy" height="250px" width="500px"><br><h3 style="font-family: Trebuchet MS, sans-serif;">Your Ride Details are: </h3 >
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Ride_ID: '. $rr .' </h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Seeker Name:  '.$nnnn.'</h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Seeker Email:  '.$xyz.'</h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Source:  '.$source.'</h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Destination:  '.$dest.'</h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Price:  '.$ppp.'</h4>
                          <h4 style="font-family: Trebuchet MS, sans-serif;">Date:  '.$date.'</h4>
                          <h2 style="font-family: Brush Script MT, cursive;">Happy Journey 🚕</h2>
                          <h6 style="font-family: Trebuchet MS, sans-serif;">If ride not booked by you or have any quaries, please <a href="https://paddleshare.freevar.com/contact.html">contact us..!!!</a></h6>';
            $mail->send();

    }
    catch (Exception $e)
    {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

else
{
    // header('location:index.php');
    exit();
}
?>