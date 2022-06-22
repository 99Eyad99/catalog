<?php





include 'Admin/connect.php';
include 'Admin/includes/functions/fun.php';


session_start();
if(isset($_SESSION['ID']) && checkItem('ID','admin',$_SESSION['ID'])==1){
	include 'includes/navbar.php';
}

// template
include 'includes/header.php';

// clasess 

include 'Admin/classes/store.php';

// fetch stores

$stmt = $con->prepare("SELECT * FROM `store` WHERE `status`='1' ");
        $stmt->execute();

$count =  $stmt->rowCount();
$stores = $stmt->fetchAll();

?>

<link rel="stylesheet" type="text/css" href="layout/css/home.css">




<main>


	<div class="container-fluid content">
		<div class="row">

<?php

// display sotres loop ---------------
if($count>0){
foreach ($stores as $store) {


	?>
<!--- start colum ---->
<div class="col-lg-2 col-md-3 col-sm-6 col-12" style="min-width: 200px;">

<!--- start card ---->
<a href="store.php?id=<?php echo $store['ID']; ?>">
		<div class="card" style="height: 98%; margin: 10px 0px 10px 0px;">
  <img class="card-img-top" src="Admin/uploads/stores/<?php echo $store['image'];  ?>" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title"><?php echo $store['name'];  ?></h5>

  </div>
</div>
</a>
<!--- end card ---->
				
			

			</div><!--- end colum ---->
	<?php
}
// end loop ......................

}// end if count ......................





?>

			

		</div>
	</div>
	



</main>


<?php

include 'includes/footer.php';
?>