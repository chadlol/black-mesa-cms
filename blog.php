<?php
$title = "Blog";
$blog_id = $_GET['blog_id'];
$confirm = $_GET['confirm'];
$message= "";
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";

$sql = 'SELECT * FROM blogs ORDER BY blog_id desc LIMIT 3';
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}
?>

<section id='main'>
  <?php
    if ($_SESSION['name']) {
      echo "<a class='admin_btn' href='blogs_manage.php'>Manage Blog</a>";
    }
  ?>
    <article id='main_1'>
        <h2>Newest Blogs</h2>


        <?php
        if ($_SESSION['name']) {
        echo "<h3><a href='blog_new.php'>New Post</a></h3>";
        }


        if ( $confirm == "deleted" ){
            $confirm = "Blog entry successfully deleted";
        }
        else {
            $confirm = "";
        }

        echo "<h4>$confirm</h4>";

        ?>
        <?php

          while(list($blog_id,$b_title,$author,$content,$published)=$result->fetch_row()){
            $content_sample = substr($content, 0, 250) . "...";
            echo "<div class='blog'>

              <h2><a href='blog_show.php?blog_id=$blog_id'>$b_title</a></h2>
              <p><b>$author</b></p>
              <p>$content_sample</p>
              <p>Posted: $published</p>
              <p>#: $blog_id</p>
              </div>";
        }


          ?>
      </article>
      <article id='articles'>
        <h2>Older Blogs</h2>
        <table>
          <tr>
            <td>#</td>
            <td>Title</td>
            <td>Author</td>
            <td>Published</td>
          </tr>
      <?php
        $sql = 'SELECT * FROM blogs ORDER BY blog_id desc LIMIT 3, 50';
        $result = $db->query($sql);

          while(list($blog_id,$b_title,$author,$content,$published)=$result->fetch_row()){
            $content_sample = substr($content, 0, 250) . "...";
          echo "<tr>

            <td>$blog_id</td>
                      <td><a href='blog_show.php?blog_id=$blog_id'>$b_title</a></td>
                      <td>$author</td>
                      <td>$published</td>
            </tr>";
        }


      ?>
      </table>
    </article>

</section>

<?php
  require "templates/footer.php";
  mysqli_close($db);
?>