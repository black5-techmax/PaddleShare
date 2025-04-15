<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot_Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylelogin.css">
    <link rel="icon" type="image/x-icon" href="logo.ico">
</head>

<body>

<?php
error_reporting(0);
// $host = "localhost";
// $user = "1223600";
// $password = "231fa04a52";
// $dbname = "1223600";

$host = "localhost";
$user = "root";
$password = "";
$dbname = "field_project_batch_17";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn)
{
    echo "Error_Occured".mysqli_error_count();
}
?>
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
                <li><a href="login.php">Login</a></li>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                
        </ul>
    </nav>
</header>
    <main>
    <div class="auth-container">
            <h2>Forgot-Password</h2><br>
            <form id="login-form" action="forgot_pass.php" method="POST">
                <label for="login-email">Email:</label>
                <input type="text" id="login-email" name="email" placeholder="Enter your Email">
                <h4>
                    <span class="fa fa-star checked"></span> Enter Email to Change Password..!!! <span class="fa fa-star checked"></span></h4>
                <div class="button-container">
                <button type="submit" name="submit" onclick="return valid()">Check</button>
                </div>
                <div id="error-message" style="color: red; display: none;"></div>
            </form>
            <br><br>
            <h2>Your Account</h2>
            <?php
            session_start();
                if(isset($_POST['submit']))
                {
                    $email = $_POST['email'];
                    
                    $query = "SELECT * FROM acc_registration WHERE Email = '$email'";
                    $data = mysqli_query($conn, $query);
                    $total = mysqli_num_rows($data);
                    $cc = mysqli_fetch_assoc($data);
                    if($total != 0)
                    {
                        $_SESSION['email'] = $email;
                        echo "
                            <h3>First_Name: $cc[First_Name]</h3><br>
                            <form action='forgot_pass.php' method='POST'>
                            <input type='text' placeholder='Old Password' name='op' id='op'><br><br>
                            <input type='text' placeholder='New Password' name='np' id='np'><br><br>
                            <input type='text' placeholder='Confirm Password' name='cp' id='cp'><br><br>
                            <td style='text-align: center;  padding-top:15px;'><input type='submit' name='chgpass' onclick=' return validate()' value='Change Password' style='color:white; border-radius:15px; cursor:pointer; background-color:red;'></td></form>
                        ";
                    }
                    else
                    {
                        echo "<marquee><b>No such Account with $email has been Found..!!!<b></marquee>";
                    }
                }

                if(isset($_POST['chgpass']))
                {
                    session_start();
                    $opp = $_POST['op'];
                    $npp = $_POST['np'];
                    $xyz = $_SESSION['email'];
                    $qq = "SELECT * FROM acc_registration WHERE Email = '$xyz'";
                    $dd = mysqli_query($conn, $qq);
                    $tt = mysqli_num_rows($dd);
                    $ccc = mysqli_fetch_assoc($dd);
                    if($ccc['Password'] == $opp)
                    {
                        $gh = "UPDATE acc_registration SET Password = '$npp' WHERE Email = '$xyz'";
                        $fff = mysqli_query($conn, $gh);
                        if($fff)
                        {
                            echo "<script>alert('Password Updated..!!!');</script>";

                        }
                        else
                        {
                            echo "<script>alert('Some thing went wrong..!!!');</script>";
                        }
                    }
                    else
                    {
                        echo "<script>alert('Old password is wrong..!!!');</script>";
                    }
                }
            ?>
    </main>
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

<script>
    function valid()
    {
        var emm = document.getElementById('login-email').value;

        if(emm = "")
        {
            alert('Email is Empty..!!!');
            return false;
        }
    }
</script>

<script>
function validate()
{
    var q = document.getElementById('op').value;
    var z = document.getElementById('np').value;
    var qx = document.getElementById('cp').value;

    if(q == "")
    {
        alert('Old Password cannot be Empty..!!!');
        return false;
    }

    if(z == "")
    {
        alert('New Password cannot be Empty..!!!');
        return false;
    }

    if(qx == "")
    {
        alert('Confirm Password connot be empty..!!!');
        return false;
    }

    if(z != qx)
    {
        alert('Both Passwords should be same..!!!');
        return false;
    }

    //Password section...
    if(z.length < 8)
    {
        alert("Password should be atleast of 8 characters.");
        return false;
    }
    if(z.length > 8)
    {
        alert("Password should not exceed 8 characters.");
        return false;
    }
    if(z.search(/[0-9]/)==-1)
    {
        alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' NUMERIC CHARECTER")
        return false;
    }
    
    if(z.search(/[a-z]/)==-1)
    {
        alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' LOWER CASE CHARECTER")
        return false;
    }
    
    if(z.search(/[A-Z]/)==-1)
    {
        alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' UPPER CASE CHARECTER")
        return false;
    }
    
    if(z.search(/[+\&\%\@]/)==-1)
    {
        alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' SPECIAL CHARECTER")
        return false;
    }
}
</script>