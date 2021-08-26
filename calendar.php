<?php
  $title = "Calendar";
  require "templates/header.php";
  require "templates/utilities.php";

  $month = $_GET['month'];
  $day = $_GET['day'];
  $year = $_GET['year'];

  if ( empty($month) ){
    $month = date( 'm' );
  }

  if ( empty($day) ){
    $day = date( 'j' );
  }

  if ( empty($year) ){
    $year = date( 'Y');
  }


  require "templates/navigation.php"; ?>

  <section id='main'>

    <article id='main_1'>
      <h2>Calendar</h2>

      <div id="calendar">

        <?php calendar($month, $year ); ?>

      </div>
    </article>

  </section>

<?php require "templates/footer.php"; ?>