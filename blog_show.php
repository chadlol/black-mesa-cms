<?php
$title = "Blog Post";
require "templates/header.php";

require "templates/navigation.php";
require "templates/db_connect.php";
$blog_id = $_GET['blog_id'];
$sql = "SELECT * FROM blogs WHERE blog_id = $blog_id";
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}

list($blog_id, $b_title, $author, $content, $published) = $result->fetch_row();
?>

    <section id='main'>

        <article id='main_1'>
            <?php



            $blog_show = <<<BS
<div id="blog_show">
    <h2> $b_title </h2>
    <h4>$author</h4>
    <p>$content</p>
    <p>Published: $published</p>
</div>
BS;
            echo $blog_show;
            echo "<h3>Comments</h3>";


            $sql = "SELECT * FROM comments WHERE blog_id=$blog_id";
            $result = $db->query($sql);

            while (list($comment_id, $c_author, $comment, $rate, $c_date, $blog_id) = $result->fetch_row()) {

                echo "<div class='comments'>";

                echo "<h4>$c_author</h4>" . str_repeat("<img src='images/rate.png' alt='star'>", $rate);
                echo "<p>$comment</p>";
                echo "<p>$c_date</p>";
                echo "</div>";
            }

            $blog_id = $_GET['blog_id'];
            ?>
            <h4>Reply</h4>

            <div id="new_comment">
                <form method="POST" action="comment_new.php">
                    <input type="hidden" name="blog_id" value="<?php echo $blog_id ?>"/><br>
                    <input type="text" name="c_author" value="<?php echo $c_author ?>" placeholder="Username" required/><br>
                    <textarea name="comment" rows="5" cols="30" placeholder="Comment" required></textarea><br>

                    <select name="rate">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <?php
                        require_once('recaptchalib.php');
                        $publickey = '6LfRFPASAAAAAKpiPTzNDzh_eKDaBmIZLW3om0Kn'; // you got this from the signup page
                        echo recaptcha_get_html($publickey);
                    ?>
                    <input type="submit" name="submit" value="Submit Comment"/>

                </form>
            </div>


        </article>

    </section>

<?php require "templates/footer.php";

mysqli_close($db);?>