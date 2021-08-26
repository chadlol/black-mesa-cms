<?php
ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$title = "New Article";
$headline = $_POST['headline'];
$news_item = $_POST['news_item'];
$media_contact = $_POST['media_contact'];
$phone_contact = $_POST['phone_contact'];
$submit = $_POST['submit'];

if ($submit) {
    $headline = mysqli_real_escape_string($db, $_POST['headline']);
    $news_item = mysqli_real_escape_string($db, $_POST['news_item']);
    $media_contact = mysqli_real_escape_string($db, $_POST['media_contact']);
    $phone_contact = mysqli_real_escape_string($db, $_POST['phone_contact']);

    $sql = "INSERT INTO articles (news_id, headline, news_item, date_published, media_contact, phone_contact)
    VALUES (NULL, '$headline', '$news_item', NULL, '$media_contact', '$phone_contact')";
    $result = $db->query($sql);
    if ($db->error) {
        $message = $db->error;
    }
    $new_news_id = $db->insert_id;


    $sql = "SELECT * FROM newsletter WHERE newsletter = 1";
    $result = $db->query($sql);
    $news_item = wordwrap($news_item, 70);
    $headers = "From: chadlol@chadlol.info" ;
    while(list($f_name, $l_name, $email, $newsletter, $notify)=$result->fetch_row()){

        $email_article = <<< EA
        A new article has been posted on chadlol.info!
        Headline: $headline

        News Item:
        $news_item


EA;

        mail( $email , "chadlol.info: New Article", $email_article,  $headers);


    }


    mysqli_close($db);
    ob_clean();
    header("Location: article_show.php?news_id=$new_news_id");
}

?>
<section id='main'>

        <article id='main_1'>
            <?php
            $new_article = <<<NA
            <form method="POST" action="article_new.php">

                <p><input type="text" name="headline" placeholder="Headline" value="$headline" required></p>

                <p> Content: <br/> <textarea name="news_item" rows="4" cols="36" required>$news_item</textarea> <br/></p>

                <p><input type="text" name="media_contact" placeholder="Media Contact" value="$media_contact" required></p>
                <p><input type="text" name="phone_contact" placeholder="Phone Contact" value="$phone_contact" required></p>

                <input type="submit" name="submit" value="Submit">
            </form>
NA;
            if ($_SESSION['name']) {
            echo $new_article;
            }
            else {
                echo "No Login";
            }
            ob_end_flush();
            ?>
</article>

</section>
<?php require "templates/footer.php"; ?>