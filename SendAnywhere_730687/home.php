<?php
    session_start();
?>


<?php 
    $xyz = $_SESSION['email']; 
    if($xyz == true)
    {
    }  
    else 
    {
        header('location:login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transportation & Carpooling System</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <link rel="stylesheet" href="styles1.css" />
    <link rel="stylesheet" href="cb.css" />
    <script src="location.js"></script>
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <!-- <link rel="shortcut icon" href="back.jpeg" type="image/x-icon"> -->
</head>
<body>
<!-- <header>
        <div class="logo">
            <img src="logo.png">
        </div>
        <h1 class="header-title">Paddle Share</h1>
        <nav>
            <ul>
            <b><p id="status" style="font-size:20px; color:white; padding-right:15px;"></p></b>
                <li><a href="account.php">My Account</a></li>
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
          <li><a href="account.php">Account</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </nav>
    </header>

    <div class="chat-icon1" id="chat-icon" onclick="toggleChat()">
      <span>💬</span>
    </div>
    <div class="chat-container1" id="chat-container">
      <div class="chat-box1" id="chat-box"></div>
      <center>
        <input
          type="text"
          id="user-input"
          placeholder="Chat Here..."
          onkeydown="if(event.key === 'Enter'){sendMessage()}"
          style="width: 80%"
        />

        <button onclick="sendMessage()" style="width: 40%" class="button1">
          Send
        </button>
      </center>
    </div>

    <main>
        <div class="auth-container">
            <h1><?php echo "Welcome ".$_SESSION['name']."!!!"; ?></h1>
            <img src="" alt="">
            <div class="circle-container">
                <a href="rider.php" class="circle" id="rider-circle">
                    <h2 style="color:white;">Rider</h2>
                </a>
                <a href="seeker.php" class="circle" id="seeker-circle">
                    <h2 style="color:white;">Seeker</h2>
                </a>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Transportation & Carpooling System</p>
    </footer>
</body>
</html>

<script src="cbb.js"></script>

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