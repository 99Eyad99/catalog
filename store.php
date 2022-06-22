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


?>
<link rel="stylesheet" type="text/css" href="layout/css/store.css">


<?php



// GET validation
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

         

            // check if ID is exist in database
          if(checkItem('ID' , 'store', $_GET['id'])==1){
              // start form view

               // create store object
              $store= new store();
              $store->set_all_by_ID($_GET['id']);

               // start html
              ?>

                        <div class="panner">
                   <img src="Admin/uploads/stores/<?php  echo $store->getImage();  ?>" >
                   <h2><?php  echo $store->getName();  ?></h2>



                </div>


<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
    	<a href="home.php" style="text-decoration: none;">Home</a>
    </li>
  </ol>
</nav>

<div class="item-side">
    

     <div class="container-fluid">
                       <div class="row">


<?php

$storeID = $store->getID();

$stmt = $con->prepare("SELECT * FROM `item` WHERE `store_ID`='$storeID' AND `status`='1' ");
$stmt->execute();
$count = $stmt->rowCount();
$items = $stmt->fetchAll();


if($count>0){
     foreach($items as $item){
     	?>

     	  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">


<!--- start card ---->
<a href="item.php?id=<?php echo $item['ID']; ?>">
		<div class="card" style="height: 98%; margin: 10px 0px 10px 0px;">
  <img class="card-img-top responsive" src="Admin/uploads/items/<?php echo $item['image'];  ?>" alt="Card image cap" >
  <div class="card-body">
    <h5 class="card-title"><?php echo $item['name'];  ?></h5>
    <label>Price : <?php echo $item['price'];  ?>$</label>

    
  </div>
</div>
</a>
<!--- end card ---->
                            
                           
           </div>
     	<?php
     }

 }else{
 	echo 'No added items yet';
 }



?>

                      


          </div>   


    </div>
</div>




              <?php
              // end html




           }




}











?>



<?php

include 'includes/footer.php';
?>