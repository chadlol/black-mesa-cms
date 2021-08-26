<?php



echo   "<form method='POST' action='index.php'>

        <input type='text' name='fname' placeholder='First Name' value='$fname' required>
        <input type='text' name='lname' placeholder='Last Name' value='$lname' required>
        <input type='text' name='email' placeholder='Email' value='$email' required><br>
        <input type='checkbox' name='newsletter' value='Newsletter' $newsletter>Email me news<br>
        <input type='checkbox' name='notify' value='Notify' $notify>Notify me when new products are added";

          require_once('recaptchalib.php');
          $publickey = '6LfRFPASAAAAAKpiPTzNDzh_eKDaBmIZLW3om0Kn'; // you got this from the signup page
          echo recaptcha_get_html($publickey);

echo   "<input type='submit' name='submit' value='Submit'>
		</form>";


if ($submit) {
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
	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
    $newsletter = $newsletter == "Newsletter" ?  true : false;
    $notify    = $notify    == "Notify"    ?  true : false;

	$sql = "INSERT INTO newsletter (f_name, l_name, email, newsletter, notify)
    VALUES ('$fname', '$lname', '$email', '$newsletter', '$notify')";
	$result = $db->query($sql);
	if ($db->error) {
		$message = $db->error;
	}

    $message = "Thank you for signing up for our newsletter";
    $admin_message = <<< INF
  NEW USER NEWSLETTER SIGNUP INFORMATION
    Name: $fname $lname
    Email: $email
    News: $newsletter
    Notify: $notify



INF;

    //$message = wordwrap($message, 70);
    $headers = "From: chadlol@chadlol.info" ;


    $user_send = mail( $email , "chadlol.info: Newsletter", $message,  $headers);

    $admin_send = mail( "chadohl@gmail.com, kkaren509@gmail.com, brikeyk@live.com", "chadlol.info: New Newsletter Signup", $admin_message, $headers );


}
}

?>