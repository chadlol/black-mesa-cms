<?php
$title = "New Blog";

ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$b_title = $_POST['b_title'];
$author = $_POST['author'];
$content = $_POST['content'];
$submit = $_POST['submit'];

if ($submit) {
    $b_title = mysqli_real_escape_string($db, $_POST['b_title']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $content = mysqli_real_escape_string($db, $_POST['content']);

    $sql = "INSERT INTO blogs (blog_id, title, author, content, published)
    VALUES (NULL, '$b_title', '$author', '$content', NULL)";

    $result = $db->query($sql);
    if ($db->error) {
        $message = $db->error;
    }

    $new_blog_id = $db->insert_id;
    
    mysqli_close($db);
    ob_clean();
    header("Location: blog_show.php?blog_id=$new_blog_id");
}

?>
    <section id='main'>

        <article id='main_1'>
            <?php
            $new_blog = <<<NB
            <form method="POST" action="blog_new.php">

                <p><input type="text" name="b_title" placeholder="Title" value="$b_title" required></p>

                <p><input type="text" name="author" placeholder="Author" value="$author" required></p>

                <p> Message: <br/> <textarea name="content" rows="4" cols="36" required>$content</textarea> <br/></p>

                <input type="submit" name="submit" value="Submit">
            </form>
NB;
            if ($_SESSION['name']){
                echo $new_blog;
            }
            else {
                echo "No Login";
            }

            ob_end_flush();
            ?>
        </article>

    </section>


<?php require "templates/footer.php"; ?>