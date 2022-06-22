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

include 'Admin/classes/item.php';


?>
<link rel="stylesheet" type="text/css" href="layout/css/item.css">


<?php



// GET validation
if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

	   	$ID = $_GET['id'];

     // check if item is visible
    $stmt = $con->prepare("SELECT `status` FROM `item` WHERE  `ID`='$ID'");
    $stmt->execute();
    $status =  $stmt->fetch();
    $status =  $status['status'];

         

            // check if ID is exist in database
          if(checkItem('ID' , 'item', $_GET['id'])==1 && $status==1){

       


          	 // create item object
              $item= new item();
              $item->set_all_by_ID($_GET['id']);

              // start html
              ?>

<nav aria-label="breadcrumb ">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
    	<a href="home.php" style="text-decoration: none;">Home</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
    	<a href="store.php?id=<?php echo $item->getStore_ID(); ?>" style="text-decoration: none;">Store</a>
    </li>
</nav>


              <div class="container-fluid item_all">
                  <div class="row">


                    <div class="col-lg-8 col-md-6">

            <div class="item-view">
                  <img src="Admin/uploads/items/<?php  echo $item->getImage(); ?>"> 
              </div>
                        
                    </div>

    
                     <div class="col-lg-4 col-md-6" style="background-color:#34495e ;">



                        <div class="info">

                            <h2>Item infromation <i class="fas fa-info-circle"></i></h2>
                            <hr>

                            <h5>Item name : <span><?php  echo $item->getName(); ?></span></h5>
                            <hr>
                            <h5>Description : <span><?php  echo $item->getDescription(); ?></span></h5>
                            <hr>
                            <h5>Price : <span><?php  echo $item->getPrice(); ?>$</span></h5>
                                    

                        </div>
                        
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

