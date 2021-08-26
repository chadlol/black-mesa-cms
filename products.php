<?php
$title = "Products";
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$confirm = $_GET['confirm'];

  $sql = 'SELECT prod_id, prod_name, prod_price FROM products';
  $result = $db->query($sql);
  if ($db->error) {
    $message = $db->error;
  }


?>

<section id='main'>
    <?php
    if ($_SESSION['name']) {
    echo "<a class='admin_btn' href='products_manage.php'>Manage Products</a>";
    }
    ?>
    <article id='main_1'>
        <h2>Products</h2>
        <?php
        if ( $confirm == "deleted" ){
        $confirm = "Product successfully deleted";
        }
        else {
        $confirm = "";
        }

        echo "<h4>$confirm</h4>";

        while(list($prod_id,$prod_name,$prod_price)=$result->fetch_row()){
          $thumbnail = "images/products/thumb_" . $prod_id . ".png";
          $product = <<< PROD
            <a href='product_show.php?prod_id=$prod_id'><div class='product'>
              <img src='$thumbnail' alt=''>
              <h4>$prod_name</h4>
              <h5>$$prod_price</h5>

            </div></a>
PROD;
          echo $product;
        }

      ?>
    </article>

</section>

<?php require "templates/footer.php"; ?>