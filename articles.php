<?php
$title = "Articles";
require "templates/header.php";
require "templates/navigation.php";
require "templates/db_connect.php";
?>

<section id='main'>
    <?php
    if ($_SESSION['name']) {
        echo "<a class='admin_btn' href='articles_manage.php'>Manage Articles</a>";
    }

    $sql = 'SELECT * FROM articles ORDER BY news_id desc LIMIT 4';
    $result = $db->query($sql);
    if ($db->error) {
        $message = $db->error;
    }

    ?>

    <article id='main_1'>
        <h2>Featured Articles</h2>

        <?php
        while(list($news_id,$headline,$news_item,$date_published,$media_contact,$phone_contact)=$result->fetch_row()){
            $article = <<< END_ARTICLE
            <div class='show_article'>
                <h3><a href='article_show.php?news_id=$news_id'>$headline</a></h3>
                <p>$news_item</p>
                <p>
                #$news_id<br>
                Published: $date_published<br>
                Media Contact: $media_contact<br>
                Phone Contact: $phone_contact</p>
            </div>
END_ARTICLE;
            echo $article;

        }

        ?>
    </article>
    <article id='articles'>
        <h2>Older Articles</h2>
        <table>
            <tr>
                <td>#</td>
                <td>Headline</td>
                <td>News Item</td>
                <td>Published</td>
            </tr>

        <?php
        $sql = 'SELECT * FROM articles ORDER BY news_id desc LIMIT 4, 50';
        $result = $db->query($sql);

        while(list($news_id,$headline,$news_item,$date_published,$media_contact,$phone_contact)=$result->fetch_row()){
            $news_item_sample = substr($news_item, 0, 50) . "...";
            echo "<tr>

            <td>$news_id</td>
                      <td><a href='article_show.php?news_id=$news_id'>$headline</a></td>
                      <td>$news_item_sample</td>
                      <td>$date_published</td>
            </tr>";
        }


        ?>
        </table>
    </article>

</section>

<?php require "templates/footer.php";

mysqli_close($db);?>