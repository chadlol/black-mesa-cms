<?php
ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$blog_id = $_GET['blog_id'];
  $title = "Update Blog";


$sql = "SELECT * FROM blogs WHERE blog_id = $blog_id";
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}
list($blog_id,$b_title,$author,$content,$published) = $result->fetch_row();

$submit = $_POST['submit'];
    if ($submit) {
        $b_title = $_POST['blog_title'];
        $author = $_POST['author'];
        $content = $_POST['content'];
        $b_title = mysqli_real_escape_string($db, $_POST['b_title']);
        $author = mysqli_real_escape_string($db, $_POST['author']);
        $content = mysqli_real_escape_string($db, $_POST['content']);
        $sql = "UPDATE blogs SET title = '$b_title', author = '$author', content = '$content' WHERE blog_id = $blog_id";
        $result = $db->query($sql);
        ob_clean();
        header("Location: blog_show.php?blog_id=$blog_id");
    }


?>
    <section id='main'>

        <article id='main_1'>
            <?php
            $update_blog = <<<UB
            <form method="POST" action="blog_update.php?blog_id=$blog_id">

                <p><input type="text" name="blog_title" placeholder="Title" value="$b_title" required></p>

                <p><input type="text" name="author" placeholder="Author" value="$author" required></p>

                <p> Message: <br/> <textarea name="content" rows="4" cols="36" required>$content</textarea> <br/></p>

                <input type="submit" name="submit" value="Submit">
            </form>
UB;
            echo $update_blog;
            mysqli_close($db);

            ?>
        </article>

    </section>


<?php require "templates/footer.php"; ?>