<?php
	require('config/config.php');
	require('config/db.php');
	
	//check for submit
	if(isset($_POST['submit'])){
		//get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);

		$query = "UPDATE posts SET
					title = '$title',
					author = '$author',
					body = '$body'
					WHERE id = {$update_id}";

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
			<a class="btn btn-success btn-sm" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Back</a>
			<h1>Edit Post</h1>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
				</div>
				<div class="form-group">
					<label>Author</label>
					<input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
				</div>
				<div class="form-group">
					<textarea name="body" class="form-control"><?php echo $post['body']; ?></textarea>
				</div>
				<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
				<input type="submit" name="submit" value="Submit" class="btn btn-">
			</form>
		</div>
	<?php include('inc/footer.php'); ?>