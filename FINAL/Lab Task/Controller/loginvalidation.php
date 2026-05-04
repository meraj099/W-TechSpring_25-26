<?php
include "../Model/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = $_POST["name"] ?? "";
    $password = $_POST["password"] ?? "";

    // ✅ Basic Validation
    if (!empty($name) && !empty($password)) {

        $database = new db();
        $connection = $database->connection();

        // Get user from database
        $query = "SELECT * FROM users WHERE username='$name'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            $user = mysqli_fetch_assoc($result);

            // 🔐 Verify password (VERY IMPORTANT)
            if (password_verify($password, $user['password'])) {

                // ✅ Login success
                $_SESSION["fullname"] = $user['username'];
                setcookie("fullname", $user['username'], time()+3600, "/");

                echo "Login Successful <br>";
                echo "Welcome, " . $user['username'];

                
                 header("Location: ../View/dashboard.php");
                 exit();

            } else {
                echo "Invalid Password";
            }

        } else {
            echo "User not found";
        }

    } else {
        echo "Username and Password required!";
    }
}
?>