<?php
ob_start();
require "templates/db_connect.php";

$review_name = $_POST['review_name'];
$review_comment = $_POST['review_comment'];
$review_rate = $_POST['review_rate'];
$prod_id = $_POST['prod_id'];
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
		$review_name = mysqli_real_escape_string($db, $_POST['review_name']);
		$review_comment = mysqli_real_escape_string($db, $_POST['review_comment']);
		$sql = "INSERT INTO reviews (prod_idFK, review_id, review_name, review_rate, review_comment, review_date)
    VALUES ('$prod_id', NULL, '$review_name', '$review_rate', '$review_comment', NULL)";
		$result = $db->query($sql);
	}
	ob_clean();
	header("Location: product_show.php?prod_id=$prod_id");
}
mysqli_close($db);
?>