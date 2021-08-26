<?php
$title = "Manage Products";
require "templates/header.php";
require "templates/navigation.php";
require "templates/db_connect.php";
?>

    <section id='main'>
        <?php
        if ($_SESSION['name']) {

            $sql = 'SELECT * FROM products ORDER BY prod_id desc';
            $result = $db->query($sql);
            if ($db->error) {
                $message = $db->error;
            }

            echo "<a class='admin_btn' href='product_new.php'>New Product</a>
        <article id='main_1'>
        <h2>Manage Products</h2>
        <table id='articles'>
        <tr>
        <td>#</td>
        <td>Products</td>
        <td>Price</td>
        <td>Posted</td>
        </tr>";

            while(list($prod_id,$prod_name,$prod_price,$prod_desc,$prod_time)=$result->fetch_row()){
                echo "<tr>

                      <td>$prod_id</td>
                      <td><a href='product_show.php?prod_id=$prod_id'>$prod_name</a></td>
                      <td>$prod_price</td>
                      <td>$prod_time</td>
                      <td><a href='product_update.php?prod_id=$prod_id'>Update</a></td>
                      <td><a href='product_delete.php?prod_id=$prod_id'>Delete</a></td>
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