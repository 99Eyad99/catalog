<?php

include 'includes/header.php';
include 'connect.php';
include 'includes/functions/fun.php';





?>
<link rel="stylesheet" type="text/css" href="layout/css/login.css">

<div class="form-frame">

	<?php

// form proccessing

if(isset($_POST['submit'])){


	$ID = filter_var($_POST['ID'],FILTER_SANITIZE_NUMBER_INT);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);

	$erorr = 0;

	if(empty($ID)){
		alert('alert alert-danger text-center','ID is empty' , 'margin:10px 0px 10px 10%; width:80%; padding:5px;');
		$erorr = 1;
	}

	if(empty($password)){
		alert('alert alert-danger text-center','Password is empty' , 'margin:10px 0px 10px 10%; width:80%; padding:5px;');
		$erorr = 1;
	}

	if($erorr == 0){


		$password = sha1($password);


		$stmt = $con->prepare("SELECT * FROM `admin` WHERE `ID`='$ID' AND `password`='$password' ");
        $stmt->execute();
        $row = $stmt->fetch();

        if($stmt->rowCount()==1){
			
            session_start();
        	$_SESSION['ID'] = $row['ID'];
			
        	header('location:dashboard.php');

        }else{

        	alert('alert alert-danger text-center','incorrect data' , 'margin:10px 0px 10px 10%; width:80%; padding:5px;');

        }



	}







}


// end proccessing







?>


<form method="POST" action="">
	<h1 class="text-center">Login <i class="fas fa-user-lock"></i></h1>

		<label for="ID">ID</label>
		<input type="text" name="ID" id="ID" class="form-control" required>

		<label for="pass">Password</label>
		<input type="password" name="password" id="pass" class="form-control" required>

		<button type="submit" class="btn btn-primary" name="submit">submit</button>

		
</form>

</div>



	
	




<?php

include 'includes/footer.php';




?>