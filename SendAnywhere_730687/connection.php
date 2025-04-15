<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "field_project_batch_17";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn)
{
    echo "Not_Connected...!!!".mysqli_error_count();
}

?>