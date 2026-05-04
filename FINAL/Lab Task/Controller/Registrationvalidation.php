<?php 
include "../Model/db.php";
session_start();

$name = "";
$password = "";   // ✅ after username
$email = "";
$website = "";
$comment = "";
$gender = "";

$datafile = "../data.json";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // ✅ Input (password right after name)
    $name     = $_POST["fullname"] ?? "";
    $password = $_POST["password"] ?? "";
    $email    = $_POST["email"] ?? "";
    $website  = $_POST["website"] ?? "";
    $comment  = $_POST["comment"] ?? "";
    $gender   = $_POST["gender"] ?? "";

    // ✅ Validation
    if(!empty($name) && strlen($name) >= 3 && 
       !empty($password) && strlen($password) >= 6 &&
       !empty($email) && 
       !empty($gender))
    {
        $_SESSION["fullname"] = $name;
        setcookie("fullname", $name, time()+3600, "/");

        echo "Form Submitted Successfully <br>";

        // 🔐 Hash Password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // ✅ JSON Save
        $formdata = array(
            "Name" => $name,
            "Password" => $hashedPassword,
            "Email" => $email,
            "Website" => $website,
            "Comment" => $comment,
            "Gender" => $gender
        );

        if(file_exists($datafile))
        {
            $existdata = file_get_contents($datafile);
            $tempdata = json_decode($existdata, true);
        }
        else
        {
            $tempdata = array();
        }

        if(!is_array($tempdata))
        {
            $tempdata = array(); 
        }

        $tempdata[] = $formdata;
        $jsondata = json_encode($tempdata, JSON_PRETTY_PRINT);

        if(file_put_contents($datafile, $jsondata) !== false)
        {
            echo "Data Saved <br>";
        }
        else
        {
            echo "Please Try Again <br>";
        }

        // ✅ Database Insert (password after username)
        $database = new db();
        $connection = $database->connection();

        $query = "INSERT INTO users (username, password, email, website, comment, gender) 
                  VALUES ('$name', '$hashedPassword', '$email', '$website', '$comment', '$gender')";

        if(mysqli_query($connection, $query))
        {
            header("Location: ../View/login.php");
            exit();
        }
        else
        {
            echo "Database Error";
        }
    }
    else
    {
        echo "Please fill all required fields properly! (Password min 6 chars)";
    }

    // ✅ Session / Cookie check
    if(isset($_SESSION["fullname"]) || isset($_COOKIE["fullname"]))
    {
        echo "<br>Welcome Back";
    }
    else
    {
        echo "<br>Please submit again!";
    }
}
?>