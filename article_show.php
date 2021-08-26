<?php
$title = "Article Post";
require "templates/header.php";
require "templates/navigation.php";
require "templates/db_connect.php";

$news_id = $_GET['news_id'];

$sql = "SELECT * FROM articles WHERE news_id = $news_id";
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}

list($news_id, $headline, $news_item, $date_published, $media_contact, $phone_contact) = $result->fetch_row();
?>

<section id='main'>
    <article id='main_1'>
        <?php
        $article_show = <<<AS
        <div id="blog_show">
            <h2> $headline </h2>
            <p>$news_item</p>

            <p>Published: $date_published<br>
            Media Contact: $media_contact<br>
            Phone Contact: $phone_contact</p>
        </div>
AS;
        mysqli_close($db);

        echo $article_show;
        ?>

    </article>
</section>
