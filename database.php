<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', 'mysql', 'api_test');

	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	// Save
	if (isset($_POST['save'])) {
		$name	 = $_POST['name'];
		$address = $_POST['address'];
		
		if (empty($name)) {
			$_SESSION['message'] = "Please fill the blank form";
		} else {
			mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')");
			$_SESSION['message'] = "Address saved";
		}
		header('location: index.php');
	}

	// Update
	if (isset($_POST['update'])) {
		$id   	 = $_POST['id'];
		$name 	 = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id='$id'");
		$_SESSION['message'] = "Address updated!";
		header('location: index.php');
	}

	// Delete
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM info WHERE id=$id");
		$_SESSION['message'] = "Address deleted!";
		header('location: index.php');
	} 

?>