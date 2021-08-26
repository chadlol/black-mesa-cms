<?php
  $title = "Admin Panel";
  require "templates/header.php";
?>

<?php require "templates/navigation.php"; ?>

  <section id='main'>

    <article id='main_1'>
      <h2>Admin Panel</h2>

      <?php
        if ($_SESSION['name']) {
          $admin_panel = <<< AP
            <p><a href='blogs_manage.php'>Manage Blog</a></p>
            <p><a href='articles_manage.php'>Manage Articles</a></p>
            <p><a href='products_manage.php'>Manage Products</a></p>
            <p><a href='newsletters_manage.php'>Manage Newsletter Subscriptions</a></p>
AP;
          echo $admin_panel;
        }
        else {
          echo "<p>No Login</p>";
        }

      ?>
    </article>

  </section>

<?php require "templates/footer.php"; ?>