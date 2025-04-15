<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM acc_registration WHERE Email = '$email' && Password = '$password'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);
    $row = mysqli_fetch_assoc($data);
    if($total == 1)
    {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['First_Name'];
        header('location:home.php');
    }
    else
    {
        echo "<script>alert('Invalid Password (OR) No Account Found..!!!');</script>";
    }

}
?>
    <!-- <header>
        <div class="logo">
            <img src="logo.png" alt="Company Logo">
        </div>
        <h1 class="header-title" style="text-align:center;">Paddle-Share</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
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
        <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
</header>
    <main>
        <div class="auth-container">
            <h2>Login</h2>
            <form id="login-form" action="login.php" method="POST" onsubmit = "return formValidation()" name="myForm">
                <label for="login-email">Email:</label>
                <input type="text" id="login-email" name="email" placeholder="Enter your Email">

                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="password" placeholder="Enter your Password">
                <!-- <input type="password" id="login-password" name="password" placeholder="Enter your password"> -->
                <div class="checkbox-container">
                <label for="login-password">Show Password:</label>
                <span id="togglePassword" class="eye-icon">👁️</span>
                </div>

                <div class="button-container">
                <button type="submit" name="submit">Login</button>
                <!-- <button type="reset">Reset</button> -->
                </div>
                <div id="error-message" style="color: red; display: none;"></div>
            </form>


            <div class="register-link">
                <p class="register">Don't have an account? <a href="register.php">Register here</a></p><br>
                <p class="register">Forgot <a href="forgot_pass.php">Password?</a></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="copyright">
            <p><b>&copy; 2025 Carpool System. All rights reserved.</b></p>
        </div>
    </footer>
</body>
</html>


<script>
function formValidation()
{
  let x = document.forms["myForm"]["email"].value;
  let y = document.forms["myForm"]["password"].value;
  if (x == "")
  {
    alert("Email must be filled out..!!!");
    return false;
  }
  if(y == "")
  {
    alert("Password shouldn't be EMPTY..!!!");
    return false;
  }
}
</script>


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
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('login-password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.textContent = type === 'password' ? '👁️' : '🙈';
    });
</script>