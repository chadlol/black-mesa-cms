<?php
ob_start();
session_start();
$title = "Login";
require "templates/header.php";
require "templates/db_connect.php";
require "templates/navigation.php";
$name = $_POST['name'];
$password = $_POST['password'];
$submit = $_POST['submit'];


?>

<section id='main'>

    <article id='main_1'>
        <h2>Login</h2>

        <?php

$logon = <<< EOL

        <form method="POST" action="login.php">
            <input type="text" name="name" value="$name" placeholder="Username" required>
            <input type="password" name="password" value="$password" placeholder="Password" required>
            <input type="submit" name="submit" value="Sign In">
        </form>

EOL;

        echo $logon;

        if ($submit) {
            $name = mysqli_real_escape_string($db, $_POST['name']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            $password = hash("sha256", $password);
            $sql = "SELECT * FROM users WHERE name='$name' AND password ='$password' ";
            $result = $db->query($sql);
            list($user_id, $name, $password) = $result->fetch_row();

            if ($user_id) {
                echo "Login successful <br>";
                $_SESSION['name'] = $name;
                ob_clean();
                header("Location: blog.php");

            }

            else {
                echo "<p style='color: red'>Login failed</p> <br>";
            }

        }

        ?>

    </article>

</section>

<?php require "templates/footer.php"; ?>