<?php
	require('config/config.php');
	require('config/db.php');
	
	//check for submit
	if(isset($_POST['delete'])){
		//get form data
		$delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

		$query = "DELETE FROM posts WHERE id = {$delete_id}";

		if(mysqli_query($conn, $query)){
			header('Location: ' .ROOT_URL. '');
		}
		else{
			echo "ERROR: " . mysqli_error($conn);
		}
	}

	//get id
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	//create query
	$query = 'SELECT * FROM posts WHERE id = ' . $id;

	//get result
	$result = mysqli_query($conn, $query);

	//Fetch Data
	$post = mysqli_fetch_assoc($result);

	// Free Result
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);
?>

	<?php include('inc/header.php'); ?>
		<div class="container">
			<a href="<?php echo ROOT_URL; ?>" class="btn btn-success btn-sm">Back</a>
			<h2><?php echo $post['title']; ?></h2>
			<small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
			<p><?php echo $post['body']; ?></p>
			<hr>
			<a class="btn btn-secondary" href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>">Edit Post</a>
			<form class="float-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn btn-secondary">
			</form>

		</div>
	<?php include('inc/footer.php'); ?>