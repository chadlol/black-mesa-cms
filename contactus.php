<?php
    $title = "Contact Us";
    require "templates/db_connect.php";
    require "templates/header.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $contact = $_POST['contact'];
    $question = $_POST['question'];
    $newsletter = $_POST['newsletter'];
    $notify = $_POST['notify'];
    $submit = $_POST['submit'];
    $related = $_POST['related'];



    $errors = "";
    if ( !isset($fname) || $fname === ""){
        $errors .= " First Name is required<br/>";
    }
    if ( !isset($lname) || $lname === ""){
        $errors .= " Last Name required<br/>";
    }

    $e_mail = $contact == "email" ? 'checked="checked"' : "";
    $p_hone = $contact == "phone" ? 'checked="checked"' : "";

    $newsletter = $newsletter == "Newsletter" ?  "checked" : "";
    $notify    = $notify    == "Notify"    ?  "checked" : "";


    require "templates/navigation.php";
?>

<section id='main'>

    <article id='main_1'>
        <h2>Send Us A Message</h2>
<?php

$error_box = <<<END_OF_ERRORS
    <div id="error_box">$errors</div>
END_OF_ERRORS;

if ( isset($submit) ){
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

    echo $error_box;

    $fname = mysqli_real_escape_string($db, $_POST['fname']);
    $lname = mysqli_real_escape_string($db, $_POST['lname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $question = mysqli_real_escape_string($db, $_POST['question']);
    $admin = "chadohl@gmail.com\r\n";
    //$admin .= "BBC: karen.kelly@scc.spokane.edu\r\n";
    $header = "From: chadlol@chadlol.info";
    $header .= "BBC: karen.kelly@scc.spokane.edu";
    $newsletter = $newsletter == "checked" ?  true : false;
    $notify    = $notify    == "checked"    ?  true : false;

    $user_send = mail( $email , "chadlol.info: Question Submitted", "Thank you, your question has been submitted!",  $header);

    $admin_message = <<< INF
  NEW USER NEWSLETTER/QUESTION SIGNUP INFORMATION
    Name: $fname $lname
    Email: $email
    Question: $question
    News: $newsletter
    Notify: $notify
INF;


    $admin_send = mail( $admin, "chadlol.info: USER NEWSLETTER/QUESTION SIGNUP INFORMATION", $admin_message, $header);

    $sql = "INSERT INTO newsletter (f_name, l_name, email, newsletter, notify)
    VALUES ('$fname', '$lname', '$email', '$newsletter', '$notify')";
    $result = $db->query($sql);
    if ($db->error) {
        $message = $db->error;
    }
}

}



require "templates/contact_form.php";

?>
    </article>

</section>



<?php require "templates/footer.php";
mysqli_close($db);
?>
