<?php
ob_start();
$title = "Home";
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$newsletter = $_POST['newsletter'];
$notify = $_POST['notify'];
$submit = $_POST['submit'];
require "templates/db_connect.php";

require "templates/header.php";
?>

<?php require "templates/navigation.php"; ?>

<section id='main'>

    <img id="main_img" src="images/main_img.jpg" alt="Scientists">

    <article id='main_1'>
        <h2>Welcome to Black Mesa</h2>
        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vehicula ligula sed diam sodales condimentum. Sed mollis tortor id posuere sodales. Nullam a scelerisque nisi. Aenean tincidunt accumsan orci, non porttitor ligula sodales eget. Integer ultrices feugiat enim sed placerat. Donec faucibus posuere dictum. Etiam urna nisi, ultrices et posuere sit amet, luctus vitae augue. Sed sed dui augue. Proin porttitor neque velit, at euismod magna porta sit amet. Vestibulum hendrerit venenatis augue, vel venenatis sem rutrum quis. Etiam et ornare massa, vitae congue nulla. Donec eu sem elit. Nunc non velit rutrum, iaculis dui in, porttitor risus. Vestibulum faucibus turpis id eros tincidunt aliquet.</p>
    </article>
    <article id='main_2'>
        <h2>Newsletter</h2>

				<?php
				require "templates/newsletter.php"
				?>

    </article>
    <article id='main_3'>
        <h2>Jobs</h2>
        <p>Donec gravida arcu eget purus vulputate, sed malesuada diam fringilla. Praesent ultrices a risus non pellentesque. Suspendisse potenti. Pellentesque malesuada ipsum nulla, non tempus sapien varius eu. Nam eget porttitor lectus. Nunc ultrices malesuada dapibus. Ut sollicitudin mattis nisi. Morbi in interdum diam. Phasellus augue felis, scelerisque quis fringilla in, euismod vulputate enim.</p>
    </article>
</section>

<?php

require "templates/footer.php";
ob_end_flush();
mysqli_close($db);

?>


