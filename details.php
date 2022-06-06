<? php


// connect to database
$conn = mysqli_connect('localhost', 'root', 'negro', 'ninja_pizza');

// check connection
if (!$conn) {
    echo 'Connnection error: ' . mysqli_connect_error();
}


// include 'config/db_connect.php';



	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			// success
			header('Location: index.php');
		} {
			// failure
			echo 'query error: ' . mysqli_error($conn);
		}
	}

	// check GET request id param
	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM pizzas WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$pizza = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

		// print_r($pizza); // FOR TESTING
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details</title>
</head>
<body>

	<?php include 'templates/header.php';?>

	<!-- <h2>dDETAILS</h2>  FOR TESTING -->

	<div class="container center grey-text">
		<?php if ($pizza): ?>

			<h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
			<p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
			<p><?php echo date($pizza['created_at']); ?></p>
			<h5>Ingredients: </h5>
			<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

			<!-- DELETE FORM -->
			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

			<?php else: ?>

			<h5>No such Pizza exists!</h5>

		<?php endif;?>
	</div>

<?php include 'templates/footer.php';?>

</body>
</html>