<?php

 echo  "<form method='POST' action='contactus.php'>

        <p> <input type='text' name='fname' placeholder='First Name' value='$fname'></p>
        <p> <input type='text' name='lname' placeholder='Last Name' value='$lname'></p>
        <p> <input type='text' name='email' placeholder='Email' value='$email'></p>
        <p> <input type='text' name='phone' placeholder='Phone' value='$phone'></p>

        <p> Ask a question: <br/> <textarea class='' name='question' rows='4' cols='36'>$question</textarea> <br/></p>

        <p> Contact us by: <br/>
        Email: <input type='radio' name='contact' value='email' $e_mail>
        Phone: <input type='radio' name='contact' value='phone' $p_hone> </p>

        <p>Contact related to:
        <select name='related'>
          <option value='null'>Choose One</option>
          <option value='Employment'>Employment</option>
          <option value='Services'>Services</option>
          <option value='Products'>Products</option>
          <option value='Website'>Website</option>
          <option value='Other'>Other</option>
        </select> </p>

        <p>
        <input type='checkbox' name='newsletter' value='Newsletter' $newsletter>Subscribe to Newsletter<br>
        <input type='checkbox' name='notify' value='Notify' $notify>Notify me when new products are added</p>";
    require_once('recaptchalib.php');
    $publickey = '6LfRFPASAAAAAKpiPTzNDzh_eKDaBmIZLW3om0Kn'; // you got this from the signup page
    echo recaptcha_get_html($publickey);



echo "<input type='submit' name='submit' value='Submit'>
         </form>";


$sub_form = <<<END_OF_SUB

        <h2>Form Submission</h2>

        <p><b>Name: </b>$fname $lname</p>
        <p><b>Email: </b>$email</p>
        <p><b>Phone: </b>$phone</p>
        <p><b>Contact by: </b>$contact</p>
        <p><b>Related to: </b>$related</p>
        <p><b>Question: </b>$question</p>
END_OF_SUB;

if ( empty($errors) ){
    echo $sub_form;
}
?>