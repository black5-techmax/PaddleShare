    <?php
    session_start();

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
        <title>Register - Paddle_Share</title>
        <link rel="stylesheet" href="styles1.css">
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
                    <li><a href="index.html">Home</a></li>
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
            <li><a href="login.php">Login</a></li>
            <li><a href="about.html">About Us</a></li>
            <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>


        <main>
            <div class="auth-container">
                <h2>Register</h2>
                <form id="register-form" action = "" method = "POST" enctype='multipart/form-data' name = "myForm" onsubmit = " return formValidation()">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="fname" placeholder="Enter your First name">

                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="lname" placeholder="Enter your Last name">

                    <label for="register-email">Email:</label>
                    <input type="email" id="register-email" name="email" placeholder="Enter your Email">

                    <label for="register-phone">Phone:</label>
                    <input type="tel" id="register-phone" name="phone" placeholder="Enter your Phone Number">

                    <label for="register-password">Password:</label>
                    <input type="password" id="register-password" name="pass" placeholder="Create a Password"> 
        
                    <div class="checkbox-container">
                    <label for="login-password">Show Password:</label>
                    <span id="togglePassword" class="eye-icon">👁️</span>
                    </div>

                    <label for='vehicleImage'>Upload Driver Image:</label>

                    <input type='file' id='dri_image' name='dri_image' accept='image/*' required>
                    <div class="checkbox-container">
                        <input type="checkbox" id="terms" name="terms" name="chkbox" required>
                        <label for="terms"> Accept the <a href="register.php">terms and conditions</a>.</label>
                    </div>
                    
                    <div class="button-container">
                        <button type="submit" name="submit">Register</button>
                        <button type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </main>

        <footer>
            <div class="copyright">
                <p>&copy; 2025 Paddle-Share. All rights reserved.</p>
            </div>
        </footer>
    </body>
    </html>
    <script>
        function formValidation()
        {
            let a = document.forms["myForm"]["fname"].value;
            let b = document.forms["myForm"]["lname"].value;
            let c = document.forms["myForm"]["email"].value;
            let d = document.forms["myForm"]["phone"].value;
            let e = document.forms["myForm"]["pass"].value;
            // let f = document.forms["myForm"]["dri_image"].value;
            // let g = document.forms["myForm"]["chkbox"].value;

            if(a == "")
            {
                alert("First Name cannot be Empty.");
                return false;
            }
            if(b == "")
            {
                alert("Last Name cannot be Empty.");
                return false;
            }
            if(c == "")
            {
                alert("Email cannot be Empty.");
                return false;
            }
            //Phone_No section....
            if(d == "")
            {
                alert("Phone Number cannot be Empty.");
                return false;
            }
            if(d.length > 10)
            {
                alert("Phone Number shouldn't have more than 10 digits.");
                return false;
            }
            //Password section...

            if(e == "")
            {
                alert("Password cannot be Empty.");
                return false;
            }
            if(e.length < 8)
            {
                alert("Password should be atleast of 8 characters.");
                return false;
            }
            if(e.length > 8)
            {
                alert("Password should not exceed 8 characters.");
                return false;
            }
            if(e.search(/[0-9]/)==-1)
            {
                alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' NUMERIC CHARECTER")
                return false;
            }
            
            if(e.search(/[a-z]/)==-1)
            {
                alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' LOWER CASE CHARECTER")
                return false;
            }
            
            if(e.search(/[A-Z]/)==-1)
            {
                alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' UPPER CASE CHARECTER")
                return false;
            }
            
            if(e.search(/[+\&\%\@]/)==-1)
            {
                alert("PASSWORD SHOULD CONTAIN ALTEAST 'ONE' SPECIAL CHARECTER")
                return false;
            }
        }
    </script>


    <script>
        function myFunction() 
        {
        var x = document.getElementById("register-password");
            if (x.type === "password") 
            {
            x.type = "text";
            } 
            else 
            {
            x.type = "password";
            }
    }
    </script>

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

    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['pass'];
        $dri_img = $_POST['dri_image'];
        $filename = $_FILES['dri_image']['name'];
        $temp_name = $_FILES['dri_image']['tmp_name'];
        $folder = 'img/'.$filename;
        move_uploaded_file($temp_name, $folder);

        if(isset($_POST['submit']))
        {
            if($fname!="" && $lname!=""  && $email!="" && $phone!="" && $password!="")
            {

                $checkEmail = "SELECT * FROM acc_registration WHERE Email = '$email'";
                $checkEmailResult = mysqli_query($conn, $checkEmail);
        
                if(mysqli_num_rows($checkEmailResult) > 0)
                {
                    echo "<script>alert('Email already exists. Please use a different email address.');</script>";
                }
                else
                {
                    $sql = "INSERT INTO acc_registration (`First_Name`, `Last_Name`, `Email`, `Phone_No`, `Password`, `img_src`) VALUES ('$fname', '$lname', '$email', '$phone', '$password', '$folder')";
                    $data = mysqli_query($conn, $sql);

                    if ($data)
                    {
                        $mail = new PHPMailer(true);
                        try
                        {                   //Enable verbose debug output
                            $mail->isSMTP();            

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
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->addAddress($email);
                            // https://drive.google.com/file/d/1jdjM45hANYld1JiBnGI68i2rcUJa7bzy/view?usp=drive_link
                            $mail->Subject = 'Account Created Succesfully.';
                            $mail->Body = '<center><img src="https://media-hosting.imagekit.io/5ecbc15bc86b4d52/cover.jpeg?Expires=1838383873&Key-Pair-Id=K2ZIVPTIP2VGHC&Signature=0NK~P2SzTF-ZREilM-KTzidwuEExwoFdhGbolG-FJYbg5hU0~IVTysRyITja8LmWjWglN4MidQOKfcUo5VsSiLqBoVUeEQoomyCmyOsOW-hXKXuB0L0ay08B2ss1xbSC2CByb28cDnFfMe6p7jWh2WX~~a-SvUP0326dzRQWjZqKYI-QHfo8D76yeIcw~HK0siCeaF8WFBeu6yCzBqt49zelKc6LHo4Ky3VisJWPx3JAf-rhFYNmWt-NmT6Fl0HumZOMHGZHKvOD6T3yoo6VsR52h0wyOOKl6zuke7b1qo126A-qpNtmQwRR-qsbPbNkqihbafTD3X2ncS17eWgLWQ__" style="border-radius:10px;" alt="Pool Buddy" height="200px"><br><h3 style="font-family: Trebuchet MS, sans-serif;">Hello '.$fname.'.</h3>
                                        <h3 style="font-family: Trebuchet MS, sans-serif;">We are happy to let you know that your account has been successfully created.</h3>
                                        <h3 style="font-family: Trebuchet MS, sans-serif;">>You can now log in to our <a href="https://paddleshare.freevar.com/login.php">website</a> using your registered email and password.</h3>
                                        <h3 style="font-family: Trebuchet MS, sans-serif;">Thanks for joining our community! We are excited to have you with us and look forward to helping you get the most out of your rides.<br>
                                        Best regards,<br>
                                        PaddleShare Team.
                                        </h3>
                                        <h2 style="font-family: Brush Script MT, cursive;">Happy Riding 🚗</h2>
                                        <h6 style="font-family: Trebuchet MS, sans-serif;">If you did not create this account or have any questions, please feel free to <a href="https://yourwebsite.com/contact">contact</a> our support team.</h6>';
                            $mail->send();

                        }
                        catch (Exception $e)
                        {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        echo "
                        <script>
                            alert('Account Registration Successfully Done.');
                        </script>
                        ";
                    }
                    else
                    {
                        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                    }
                }
            }
            else
            {
                echo "Enter the Details..!!!";
            }
        }
    }
    ?>

    <!-- <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('login-password'); // Corrected the ID here
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    </script> -->

    <script>
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordField = document.getElementById('register-password');
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.textContent = type === 'password' ? '👁️' : '🙈';
            });
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