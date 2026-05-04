<?php
class db {

    function connection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "section_r";

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if ($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        return $connection;
    }

    // ✅ Insert form data WITH password
    function insertForm($connection, $tablename, $name, $password, $email, $website, $comment, $gender)
    {
        // 🔐 Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $tablename (username, password, email, website, comment, gender)
                VALUES ('$name', '$hashedPassword', '$email', '$website', '$comment', '$gender')";

        if ($connection->query($sql)) {
            return true;
        } else {
            echo "SQL Error: " . $connection->error;
            return false;
        }
    }

    // ✅ Get user for login
    function getUser($connection, $tablename, $name)
    {
        $sql = "SELECT * FROM $tablename WHERE username='$name'";
        $result = $connection->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>