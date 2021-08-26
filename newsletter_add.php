<?php
  $title = "New Subscription";
  require "templates/header.php";
  require "templates/navigation.php";
  require "templates/db_connect.php";
?>

  <section id='main'>
    <article id="main_1">
      <h2>Add Subscription</h2>
    <?php
      if ($_SESSION['name']) {
        require "templates/newsletter.php";
      }
      else {
        echo "<p>You're not allowed to be here...</p>";
      }

    ?>
    </article>
  </section>
<?php require "templates/footer.php"; ?>