<?php include('database.php'); ?>

<?php 
	if(isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

	<form method="post" action="insert.php">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>"></input>
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address ?>"></input>
		</div>
		<div class="input-group">
			<?php if($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;"> Update </button>
			<?php else: ?>	
				<button class="btn" type="submit" name="save">Save</button>
			<?php endif ?>
		</div>
	</form>

	<!-- Show the data in the table -->
	<?php $result = mysqli_query($db, "SELECT * FROM info"); ?>

	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		<?php while ($row = mysqli_fetch_array($result)) { ?>
			<tr>
				<td> <?php echo $row['name']; ?></td>
				<td> <?php echo $row['address']; ?></td>
				<td>
					<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
				</td>
				<td>
					<a href="insert.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>

</body>
</html>