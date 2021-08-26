<?php
require "templates/db_connect.php";
require "templates/header.php";
require "templates/navigation.php";

$prod_id = $_GET['prod_id'];

$sql = "SELECT * FROM products WHERE prod_id = $prod_id";
$result = $db->query($sql);
list($prod_id,$prod_name,$prod_price,$prod_desc,$prod_time)=$result->fetch_row();
$sql = "SELECT AVG(review_rate), COUNT(review_id) FROM reviews WHERE prod_idFK=$prod_id";
$result = $db->query($sql); //problem here
list($rating, $reviews)=$result->fetch_row();
if ($db->error) {
	$message = $db->error;
}
?>
	<section id='main'>
		<article id='main_1'>



				<div id='prod_show'>
		<?php echo"	<img id='prod_img' src='images/products/prod_$prod_id.png' alt=''>
					<h2>$prod_name</h2>
					<h3>$prod_price</h3>";
            echo str_repeat("<img src='images/rate.png' alt='star'>", $rating) . "($reviews)";
			      echo "<br><p>$prod_desc</p>
            <p>Posted: $prod_time</p>
				</div>";

			echo "<h3 id='review_head'>Reviews</h3>";
			$sql = "SELECT * FROM reviews WHERE prod_idFK=$prod_id";
			$result = $db->query($sql);
			while(list($prod_idFK,$review_id,$review_name,$review_rate,$review_comment,$review_date)=$result->fetch_row()) {
				echo "<div class='reviews'>";

				echo "<h4>$review_name</h4>" . str_repeat("<img src='images/rate.png' alt='star'>", $review_rate);
				echo "<p>$review_comment</p>";
				echo "<p>$review_date</p>";
				echo "</div>";

			}

			?>

			<h4>Reply</h4>

			<div id="review_new">
				<form method="POST" action="review_new.php">
					<input type="hidden" name="prod_id" value="<?php echo $prod_id ?>"/><br>
					<input type="text" name="review_name" value="<?php echo $review_name ?>" placeholder="Username" required/><br>
					<textarea name="review_comment" rows="5" cols="30" placeholder="Comment" required></textarea><br>

					<select name="review_rate">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<?php
					require_once('recaptchalib.php');
					$publickey = '6LfRFPASAAAAAKpiPTzNDzh_eKDaBmIZLW3om0Kn'; // you got this from the signup page
					echo recaptcha_get_html($publickey);
					?>
					<input type="submit" name="submit" value="Submit Review"/>

				</form>
			</div>


		</article>
	</section>


<?php
require "templates/footer.php";
mysqli_close($db);
?>