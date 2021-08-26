<?php
ob_start();
require "templates/db_connect.php";

$c_author = $_POST['c_author'];
$comment = $_POST['comment'];
$rate = $_POST['rate'];
$blog_id = $_POST['blog_id'];
$submit = $_POST['submit'];


require_once('recaptchalib.php');
$privatekey = "6LfRFPASAAAAAIXXGXl_NVOpfe2j6iWsSttmiQZT";
$resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
        "(reCAPTCHA said: " . $resp->error . ")");
} else {

if($submit){
    $c_author = mysqli_real_escape_string($db, $_POST['c_author']);
    $comment = mysqli_real_escape_string($db, $_POST['comment']);
    $sql = "INSERT INTO comments (comment_id, c_author, comment, rate, c_date, blog_id)
    VALUES (NULL, '$c_author', '$comment', '$rate', NULL, '$blog_id')";
    $result = $db->query($sql);
}
ob_clean();
header("Location: blog_show.php?blog_id=$blog_id");
}
mysqli_close($db);
?>