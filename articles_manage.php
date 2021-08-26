<?php
$title = "Manage Articles";
require "templates/header.php";
require "templates/navigation.php";
require "templates/db_connect.php";
?>

    <section id='main'>
        <?php
        if ($_SESSION['name']) {

            $sql = 'SELECT * FROM articles ORDER BY news_id desc';
            $result = $db->query($sql);
            if ($db->error) {
                $message = $db->error;
            }

            echo "<a class='admin_btn' href='article_new.php'>New Article</a>
        <article id='main_1'>
        <h2>Manage Aritcles</h2>
        <table id='articles'>
        <tr>
        <td>#</td>
        <td>Headline</td>
        <td>Published</td>
        </tr>";




                        while(list($news_id,$headline,$news_item,$date_published,$media_contact,$phone_contact)=$result->fetch_row()){
                echo "<tr>

                      <td>$news_id</td>
                      <td><a href='article_show.php?news_id=$news_id'>$headline</a></td>
                      <td>$date_published</td>
                      <td><a href='article_update.php?news_id=$news_id'>Update</a></td>
                      <td><a href='article_delete.php?news_id=$news_id'>Delete</a></td>
            </tr>
";
            }
            echo "</table>
            </article>";

        }
        else {
            echo "<p>You're not allowed to be here...</p>";
        }
        ?>
    </section>
<?php require "templates/footer.php"; ?>