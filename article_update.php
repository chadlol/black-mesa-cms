<?php
ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$news_id = $_GET['news_id'];
$title = "Update Article";


$sql = "SELECT * FROM articles WHERE news_id = $news_id";
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}
list($news_id,$headline,$news_item,$date_published,$media_contact,$phone_contact)=$result->fetch_row();

$submit = $_POST['submit'];
if ($submit) {
    $headline = $_POST['headline'];
    $news_item = $_POST['news_item'];
    $media_contact = $_POST['media_contact'];
    $phone_contact = $_POST['phone_contact'];
    $headline = mysqli_real_escape_string($db, $_POST['headline']);
    $news_item = mysqli_real_escape_string($db, $_POST['news_item']);
    $media_contact = mysqli_real_escape_string($db, $_POST['media_contact']);
    $phone_contact = mysqli_real_escape_string($db, $_POST['phone_contact']);
    $sql = "UPDATE articles SET headline = '$headline', news_item = '$news_item', media_contact = '$media_contact', phone_contact = '$phone_contact' WHERE news_id = '$news_id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: article_show.php?news_id=$news_id");
}


?>
    <section id='main'>

        <article id='main_1'>
            <?php
            $update_article = <<<UA
            <form method="POST" action="article_new.php">

                <p><input type="text" name="headline" placeholder="Headline" value="$headline" required></p>

                <p> Content: <br/> <textarea name="news_item" rows="4" cols="36" required>$news_item</textarea> <br/></p>

                <p><input type="text" name="media_contact" placeholder="Media Contact" value="$media_contact" required></p>
                <p><input type="text" name="phone_contact" placeholder="Phone Contact" value="$phone_contact" required></p>

                <input type="submit" name="submit" value="Submit">
            </form>
            <p>Posted: $date_published</p>
UA;
            echo $update_article;
            mysqli_close($db);

            ?>
        </article>

    </section>


<?php require "templates/footer.php"; ?>