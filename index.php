<!-- database connection code -->
<?php 
	
	$db = mysqli_connect('localhost', 'root', '', 'userinfo');

	if($db){
		// echo 'database connection established!';
	}else{
		echo 'database connection error.';
	}

	ob_start();

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>CRUD Operation!</title>
  </head>
  <body>
    

  	<div class="container py-5">
  		<div class="row">
  			<div class="col-md-5">


  				<!-- form -->
  				<h2 class="mb-3">Add a new user information</h2>
  				<form action="" method="POST" enctype="multipart/form-data">
  					<div class="form-group mb-3">
  						<input type="text" name="username" class="form-control" placeholder="Username">
  					</div>
  					<div class="form-group mb-3">
  						<input type="email" name="email" class="form-control" placeholder="Email">
  					</div>
  					<div class="form-group mb-3">
  						<input type="password" name="password" class="form-control" placeholder="Password">
  					</div>
  					<div class="form-group mb-3">
  						<small class="mb-2 d-inline-block">Please select your user type ... </small>
  						<select class="form-control" name="type">
  							<option value="0" selected>Student</option>
  							<option value="1">Teacher</option>
  						</select>
  					</div>
  					<button class="btn btn-md btn-info" type="submit" name="add_user">Add Information</button>
  				</form>


  				<!-- insert all the data into our database -->
  				<?php 

  					if(isset($_POST['add_user'])){
  						//echo 'button clicked...';

  						$username 		= $_POST['username'];
  						$email 			= $_POST['email'];
  						$password 		= $_POST['password'];
  						$type 			= $_POST['type'];

  						// echo $username.'  '.$email.'  '.$password.'  '.$type;

  						$sql2 = "INSERT INTO info (username, email, pass, userType) VALUES ('$username', '$email', '$password', '$type')";

  						$res2 = mysqli_query($db,$sql2);

  						if($res2){
  							header('Location: index.php');
  						}else{
  							echo '<div class="alert alert-danger" role="alert">User insert Error!</div>';
  						}




  					}

  				?>



  			</div>
  			<div class="col-md-6 offset-1">
  				<h2>All user information</h2>
  				<!-- table -->
  				<table class="table table-dark table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">UserName</th>
				      <th scope="col">Email</th>
				      <th scope="col">Password</th>
				      <th scope="col">User Type</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>

				  	<!-- read all info from database -->
				  	<?php 

				  		// step 01: query / sql
				  		// query->database
				  		// db feedback :: operation

				  		$sql = "SELECT * FROM info";
				  		$res = mysqli_query($db,$sql);

				  		$serial = 0;

				  		while($row = mysqli_fetch_assoc($res)){

				  			$id 		= $row['id'];
				  			$username 	= $row['username'];
				  			$email  	= $row['email'];
				  			$pass 		= $row['pass'];
				  			$type 		= $row['userType'];

				  			$serial++;

				  		?>
				  	<tr>
				      <th scope="row"><?php echo $serial;?></th>
				      <td><?php echo $username;?></td>
				      <td><?php echo $email;?></td>
				      <td><?php echo $pass;?></td>
				      <td>
				      	<?php 

				      	if($type == 0){
				      		echo 'Student';
				      	}else{
				      		echo 'Teacher';
				      	}

				      	?>
				      </td>
				      <td>
				      	<!-- edit -->
				      	<a href="" class="me-2">
				      		<i class="fa fa-edit text-light"></i>
				      	</a>
				      	<!-- delete -->
				      	<a href="index.php?delete_id=<?php echo $id;?>">
				      		<i class="fa fa-trash text-danger"></i>
				      	</a>
				      </td>
				    </tr>

				    <?php

				  		}


				  	?>


				   
				  </tbody>
				</table>
  			</div>
  		</div>
  	</div>


  	<!-- delete operation -->

  	<?php 

  		if(isset($_GET['delete_id'])){
  			$delete_id = $_GET['delete_id'];

  			$sql3 = "DELETE FROM info WHERE id='$delete_id'";
  			$res3 = mysqli_query($db,$sql3);
			if($res3){
				header('Location: index.php');
			}else{
				echo '<div class="alert alert-danger" role="alert">User delete Error!</div>';
			}

  		}


  	?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php ob_end_flush(); ?>

  </body>
</html>