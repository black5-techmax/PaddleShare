<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Carpool System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.ico">
</head>
<body>
    <!-- <header>
        <div class="logo">
            <img src="logo.png" alt="Pool Buddy">
        </div>
        <nav>
            <ul>
                <li><a href="seeker.php">Seeker</a></li>
                <li><a href="rider.php">Rider</a></li>
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
          <li><a href="seeker.php">Seeker</a></li>
          <li><a href="rider.php">Rider</a></li>
        </ul>
      </nav>
    </header>


    <main>
        <div class="auth-container">
            <h2><b>My Account</b></h2>
            
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

            $query = "SELECT * FROM acc_registration WHERE Email = '$xyz'";
            $data = mysqli_query($conn, $query);
            $total = mysqli_num_rows($data);
            if($total != 0)
                    {
                        ?>
                        <center>
                        <table border="0px solid green" cellspacing="10" width="100%">
                            <th width="10%" style="text-align: center;">Profile Picture</th>
                            <th width="10%" style="text-align: center;" class="pp">First_Name</th>
                            <th width="10%" style="text-align: center;">Last_Name</th>
                            <th width="10%" style="text-align: center;">Email</th>
                            <th width="10%" style="text-align: center;">Phone_No</th>
                            <br>
                        <?php
                        while($cc = mysqli_fetch_assoc($data))
                        {
                            echo "
                            <tr>
                            <td style='text-align: center;'><img src = '$cc[img_src]' style='width:75px; height:75px; border-radius:15px;'></td>
                            <td style='text-align: center;' class='pp'>$cc[First_Name]</td>
                            <td style='text-align: center;'>$cc[Last_Name]</td>
                            <td style='text-align: center;'>$cc[Email]</td>
                            <td style='text-align: center;'>$cc[Phone_No]</td>
                            </tr><br>
                            ";
                        }
                    }
            ?>

            <table id="rider-table">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <form action="logout.php" method="POST" enctype='multipart/form-data'>
            <input type="submit" value="Logout" class="button">
        </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Carpool System</p>
    </footer>
</body>
</html>


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