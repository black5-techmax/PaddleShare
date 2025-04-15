<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider - Transportation & Carpooling System</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="location.js"></script>
    <link rel="icon" type="image/x-icon" href="logo.ico">
</head>
<body>

    <!-- <header>
        <div class="logo">
            <img src="logo.png" alt="Pool Buddy">
        </div>
        <h1 class="header-title">Paddle Share</h1>
        <nav>
            <ul>
            <b><p id="status" style="font-size:20px; color:white; padding-right:15px;"></p></b>
                <li><a href="seeker.php">Seeker</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="myrides.php">My_Rides</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </nav>
    </header> -->

    <header>
      <div class="logo">
        <img src="logo.png" alt="Logo" />
      </div>
      <button class="hamburger" id="hamburgerIcon">
        <div></div>
        <div></div>
        <div></div>
      </button>
      <nav>
      <ul>
            <b><p id="status" style="font-size:20px; color:white; padding-right:15px;"></p></b>
                <li><a href="seeker.php">Seeker</a></li>
                <li><a href="account.php">My Account</a></li>
                <li><a href="myrides.php">My_Rides</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
      </nav>
    </header>

    <main>
        <div class="auth-container">
            <h1>Rider Page</h1><br>
            <?php 
                session_start();
                error_reporting(0);
                $xyz = $_SESSION['email']; 
                if($xyz == true)
                {
                }  
                else 
                {
                    header('location:login.php');
                }
                    $xyz = $_SESSION['email'];
                    $query = "SELECT * FROM acc_registration WHERE Email = '$xyz'";
                    $data = mysqli_query($conn, $query);
                    $total = mysqli_fetch_assoc($data); 
        echo "
            <form id='riderForm' action='rider.php' method='POST' enctype='multipart/form-data' onsubmit='return formValidation()' name='myForm'>
                <label for='source'>Source:</label>
                <input type='text' id='status' name='source' required>

                <label for='destination'>Destination:</label>
                <input type='text' id='destination' name='destination' required>

                <label for='date'>Date:</label>
                <input type='date' id='date' name='date' required>
                <label for='time'>Time:</label>
                <input type='time' id='time' name='time' required>

                <label for='vehicleName'>Vehicle Name:</label>
                <input type='text' id='vehicleName' name='vehicleName' required>

                <label for='driverName'>Driver Name:</label>
                <input type='text' id='driverName' name='driverName' value = '$total[First_Name]'>

                <label for='carNumber'>Car Number:</label>
                <input type='text' id='carNumber' name='carNumber' required>

                <label>Max Seating Capacity:</label>
                <input type='text' id='seat' name='seat' required>

                <label for='price'>Price:</label>
                <input type='text' id='price' name='price' required>

                <button type='submit' name='submit' style='padding: 12px 25px; margin: 10px; border: none; background: #e74c3c; color: #fff; cursor: pointer; border-radius: 5px; font-size: 18px; transition: background-color 0.3s, transform 0.2s; width: 80%;'>Submit Vehicle</button>
            </form>
            
            <script type='text/javascript'>
        function disableField() {
            document.getElementById('myField').disabled = true;
        }
    </script>
            ";
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Transportation & Carpooling System</p>
    </footer>
</body>

<script>
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date').setAttribute('min', today);

</script>


<script>
function formValidation()
{
    let a = document.forms["myForm"]["source"].value;
    let b = document.forms["myForm"]["destination"].value;
    let c = document.forms["myForm"]["date"].value;
    let d = document.forms["myForm"]["time"].value;
    let e = document.forms["myForm"]["vehicleName"].value;
    let f = document.forms["myForm"]["driverName"].value;
    let g = document.forms["myForm"]["carNumber"].value;
    let h = document.forms["myForm"]["seat"].value;
    let i = document.forms["myForm"]["price"].value;

    if(a == b)
    {
        alert('Source and Destination Cannot be same..!!!');
        return false;
    }

    if(a == "")
    {
        alert('Source is Empty..!!!');
        return  false;
    }

    if(b == "")
    {
        alert('Destination is Empty..!!!');
        return false;
    }

    if(c == "")
    {
        alert('Date is Empty..!!!');
        return false;
    }
    if(d == "")
    {
        alert('Time is Empty..!!!');
        return false;
    }
    if(e == "")
    {
        alert('Vehicle_Name is Empty..!!!');
        return false;
    }
    if(f == "")
    {
        alert('Driver_Name is Empty..!!!');
        return false;
    }
    if(g == "")
    {
        alert('Car_Number is Empty..!!!');
        return false;
    }
    if(h == "")
    {
        alert('Seat is Empty..!!!');
        return false;
    }
    if(i == "")
    {
        alert('Price is Empty..!!!');
        return false;
    }
}
</script>
</html>

<?php
session_start();
include('connection.php');
error_reporting(0);

$xyz = $_SESSION['email']; 
// echo "<script>alert('$xyz');</script>";
if($xyz == true)
{
}  
else 
{
    header('location:login.php');
}

if(isset($_POST['submit']))
{
    $source = $_POST['source'];
    $dest = $_POST['destination'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $vehicle_name = $_POST['vehicleName'];
    $driver_name = $_POST['driverName'];
    $car_num = $_POST['carNumber'];
    $seat_cap = $_POST['seat'];
    $price = $_POST['price'];
    // $dri_img = $_POST['dri_image'];
    // $filename = $_FILES['dri_image']['name'];
    // $temp_name = $_FILES['dri_image']['tmp_name'];
    // $folder = 'images/'.$filename;
    // move_uploaded_file($temp_name, $folder);

    // $_SESSION['email'] = $email;
    // $qq = "SELECT * FROM acc_registration WHERE Email = '$xyz'";
    // $dd = mysqli_query($conn, $qq);
    // $tt = mysqli_num_rows($dd);
    // $vv = mysqli_fetch_assoc($dd);
    // if($tt != 0)
    // {
        // echo "<script>alert($tt);</script>";
        $_SESSION['dri_image'] = $drii;
    // }
    // // echo $folder;

    if($source!="" && $dest!="" && $date!="" && $time!="" && $vehicle_name!="" && $car_num!="" && $seat_cap!="" && $price!="")
    {
        $query = "INSERT INTO rider (`Username`, `Source`, `Destination`, `Date`, `Time`, `Vehicle_Name`, `Driver_Name`, `Car_Num`, `Seat_Status`, `Price`) VALUES ('$xyz', '$source', '$dest', '$date', '$time', '$vehicle_name', '$driver_name', '$car_num', '$seat_cap', '$price')";
        $data = mysqli_multi_query($conn, $query);

        if($data)
        {
            echo "<script>alert('Your Ride has been Created..!!!');</script>";
        }
        else
        {
            echo "<script>alert('Unable to create Ride..!!!');</script>";
        }
    }

}
?>

<script>
  // Get the hamburger icon and menu
  const hamburgerIcon = document.getElementById("hamburgerIcon");
  const navMenu = document.querySelector("nav ul");

  // Add click event to toggle menu visibility
  hamburgerIcon.addEventListener("click", () => {
    navMenu.classList.toggle("active");
    hamburgerIcon.classList.toggle("active");
  });
</script>