<?php
include "../Controller/Registrationvalidation.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>New Registration Form</title>
</head>
<body>

<form method="post" action="">
    <table>

        <tr>
            <td colspan="3">
                <p style="color:red">* Required Field</p>
            </td>
        </tr>

        <tr>
            <td><label>Username:</label></td>
            <td>
                <input type="text" name="fullname">
                <?php echo $name; ?>
            </td>
            <td><span style="color:red">*</span></td>
        </tr>

        <tr>
         <td><label>Password:</label></td>
            <td>
                <input type="text" name="password">
                <?php echo $password; ?>
            </td>
            <td><span style="color:red">*</span></td>
        </tr>    

        <tr>
            <td><label>E-mail:</label></td>
            <td>
                <input type="text" name="email">
                <?php echo $email; ?>
            </td>
            <td><span style="color:red">*</span></td>
        </tr>

        <tr>
            <td><label>Website:</label></td>
            <td>
                <input type="text" name="website">
                <?php echo $website; ?>
            </td>
        </tr>

        <tr>
            <td><label>Comment:</label></td>
            <td>
                <textarea name="comment" rows="5" cols="40"></textarea>
                <?php echo $comment; ?>
            </td>
        </tr>

        <tr>
            <td><label>Gender:</label></td>
            <td>
                <input type="radio" name="gender" value="Female"> Female
                <input type="radio" name="gender" value="Male"> Male
                <input type="radio" name="gender" value="Other"> Other
                <?php echo $gender; ?>
            </td>
            <td><span style="color:red">*</span></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>

    </table>
</form>

</body>
</html>