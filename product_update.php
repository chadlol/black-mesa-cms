<?php
ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$prod_id = $_GET['prod_id'];



$sql = "SELECT * FROM products WHERE prod_id = $prod_id";
$result = $db->query($sql);
if ($db->error) {
    $message = $db->error;
}
list($prod_id,$prod_name,$prod_price,$prod_desc,$prod_time)=$result->fetch_row();

$submit = $_POST['submit'];
if ($submit) {
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $prod_desc = $_POST['prod_desc'];
    $prod_name = mysqli_real_escape_string($db, $_POST['prod_name']);
    $prod_price = mysqli_real_escape_string($db, $_POST['prod_price']);
    $prod_desc = mysqli_real_escape_string($db, $_POST['prod_desc']);
    $sql = "UPDATE products SET prod_name = '$prod_name', prod_price = '$prod_price' WHERE prod_id = '$prod_id'";
    $result = $db->query($sql);
    ob_clean();
    header("Location: product_show.php?prod_id=$prod_id");
}


?>
    <section id='main'>

        <article id='main_1'>
            <?php
            $update_product = <<<UP
            <form method="POST" action="product_new.php">

                <p><input type="text" name="prod_name" placeholder="Product Name" value="$prod_name" required></p>
                <p><input type="text" name="prod_price" placeholder="Product Price" value="$prod_price" required></p>

                <p> Content: <br/> <textarea name="prod_desc" rows="4" cols="36" required>$prod_desc</textarea> <br/></p>

                <input type="submit" name="submit" value="Submit">
            </form>
            <p>Posted: $prod_time</p>
UP;
            echo $update_product;
            mysqli_close($db);

            ?>
        </article>

    </section>


<?php require "templates/footer.php"; ?>