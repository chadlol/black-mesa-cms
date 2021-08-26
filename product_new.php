<?php
ob_start();
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";
$title = "Add Product";
$prod_name = $_POST['prod_name'];
$prod_price = $_POST['prod_price'];
$prod_desc = $_POST['prod_desc'];
$submit = $_POST['submit'];

if ($submit) {
    $prod_name = mysqli_real_escape_string($db, $_POST['prod_name']);
    $prod_price = mysqli_real_escape_string($db, $_POST['prod_price']);
    $prod_desc = mysqli_real_escape_string($db, $_POST['prod_desc']);

    $sql = "INSERT INTO products (prod_id, prod_name, prod_price, prod_desc)
    VALUES (NULL, '$prod_name', '$prod_price', '$prod_desc')";
    $result = $db->query($sql);
    if ($db->error) {
        $message = $db->error;
    }
    $new_prod_id = $db->insert_id;


    $sql = "SELECT * FROM newsletter WHERE notify = 1";
    $result = $db->query($sql);
    $prod_desc = wordwrap($prod_desc, 70);
    $headers = "From: chadlol@chadlol.info\r\n";
    $headers .= "Content-type: text/html\r\n";
    $img = "images/products/prod_" . $new_prod_id . ".png";
    while(list($f_name, $l_name, $email, $newsletter, $notify)=$result->fetch_row()){

        $email_prod = "

        <h2>A new product as been posted at chadlol.info!</h2>
        <h2>$prod_name</h2>
        <img src='$img' alt='$prod_name'>
        <h3>$prod_price</h3>
        <p>$prod_desc</p>


        </body>
        </html>";



        mail( $email , "chadlol.info: New Product", $email_prod,  $headers);


    }


    mysqli_close($db);
    ob_clean();
    header("Location: product_show.php?prod_id=$new_prod_id");
}

?>
    <section id='main'>

        <article id='main_1'>
            <?php
            $new_product = <<<NP
            <form method="POST" action="product_new.php">

                <p><input type="text" name="prod_name" placeholder="Product Name" value="$prod_name" required></p>
                <p><input type="text" name="prod_price" placeholder="Product Price" value="$prod_price" required></p>

                <p> Content: <br/> <textarea name="prod_desc" rows="4" cols="36" required>$prod_desc</textarea> <br/></p>

                <input type="submit" name="submit" value="Submit">
            </form>
NP;
            if ($_SESSION['name']) {
                echo $new_product;
            }
            else {
                echo "No Login";
            }
            ob_end_flush();
            ?>
        </article>

    </section>
<?php require "templates/footer.php"; ?>