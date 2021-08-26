<?php
  $title = "Manage Products";
  require "templates/header.php";
  require "templates/navigation.php";
  require "templates/db_connect.php";
?>

  <section id='main'>
    <?php
      if ($_SESSION['name']) {

        $sql = 'SELECT * FROM blogs ORDER BY blog_id desc';
        $result = $db->query($sql);
        if ($db->error) {
          $message = $db->error;
        }

        echo "<a class='admin_btn' href='blog_new.php'>New Product</a>
        <article id='main_1'>
        <h2>Manage Blogs</h2>
        <table id='articles'>
        <tr>
        <td>#</td>
        <td>Title</td>
        <td>Author</td>
        <td>Content</td>
        <td>Published</td>
        </tr>";

        while(list($blog_id,$b_title,$author,$content,$published)=$result->fetch_row()){
          $content_sample = substr($content, 0, 250) . "...";
          echo "<tr>
              <td>$blog_id</td>
              <td><a href='blog_show.php?blog_id=$blog_id'>$b_title</a></td>
              <td>$author</td>
              <td>$content_sample</td>
              <td>$published</td>
              <td><a href='blog_update.php?blog_id=$blog_id'>Update</a></td>
              <td><a href='blog_delete.php?blog_id=$blog_id'>Delete</a></td>";
          echo "</tr>";
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