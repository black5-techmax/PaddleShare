<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/x-icon" href="logo.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="styles.css">
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
  /* background-color: #f2f2f2; */
  background: rgba(255, 255, 255, 0.8);
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

<script>
function showPaymentFields()
{
  var paymentMethod = document.querySelector('input[name="Pay_Mode"]:checked').value;
  document.getElementById('bhim_upi_fields').style.display = 'none';
  document.getElementById('net_banking_fields').style.display = 'none';
  document.getElementById('credit_card_fields').style.display = 'none';
  document.getElementById('debit_card_fields').style.display = 'none';

  if(paymentMethod == 'BHIM_UPI')
  {
    document.getElementById('bhim_upi_fields').style.display = 'block';
  }
  else if(paymentMethod == 'Net_Banking')
  {
    document.getElementById('net_banking_fields').style.display = 'block';
  }
  else if(paymentMethod == 'Credit_Card')
  {
    document.getElementById('credit_card_fields').style.display = 'block';
  }
  else if(paymentMethod == 'Debit_Card')
  {
    document.getElementById('debit_card_fields').style.display = 'block';
  }
}
</script>
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
              <label style='padding-left:25px;'>
                <input type='radio' value='BHIM_UPI' name='Pay_Mode' style='width:15px; height:15px;' required onclick='showPaymentFields()'>BHIM UPI
              </label><br>
              <label style='padding-left:25px;'>
                <input type='radio' value='Net_Banking' name='Pay_Mode' style='width:15px; height:15px;' required onclick='showPaymentFields()'>Net Banking 
              </label><br>
              <label style='padding-left:25px;'>
                <input type='radio' value='Credit_Card' name='Pay_Mode' style='width:15px; height:15px;' required onclick='showPaymentFields()'>Credit Card 
              </label><br>
              <label style='padding-left:25px;'>
                <input type='radio' value='Debit_Card' name='Pay_Mode' style='width:15px; height:15px;' required onclick='showPaymentFields()'>Debit Card 
              </label><br>
              
              <!-- Hidden Payment Fields -->
              <div id='bhim_upi_fields' style='display:none; padding-left:25px;'>
                <label>Enter BHIM UPI ID:</label>
                <input type='text' name='bhim_upi_id' required>
              </div>
              <div id='net_banking_fields' style='display:none; padding-left:25px;'>
                <label>Bank Name:</label>
                <input type='text' name='bank_name' required>
                <label>Account Number:</label>
                <input type='text' name='account_number' required>
              </div>
              <div id='credit_card_fields' style='display:none; padding-left:25px;'>
                <label>Card Number:</label>
                <input type='text' name='card_number' required>
                <label>Expiry Date:</label>
                <input type='text' name='expiry_date' required>
                <label>CVV:</label>
                <input type='text' name='cvv' required>
              </div>
              <div id='debit_card_fields' style='display:none; padding-left:25px;'>
                <label>Card Number:</label>
                <input type='text' name='debit_card_number' required>
                <label>Expiry Date:</label>
                <input type='text' name='debit_expiry_date' required>
                <label>CVV:</label>
                <input type='text' name='debit_cvv' required>
              </div>
              
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
      }
?>