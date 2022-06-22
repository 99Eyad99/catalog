<?php

session_start();

include 'connect.php';
include 'includes/functions/fun.php';

// template
include 'includes/header.php';
include 'includes/navbar.php';

// clasess 
include 'classes/admin.php';
include 'classes/store.php';


?>
<link rel="stylesheet" type="text/css" href="layout/css/style.css">


<?php


if(isset($_SESSION['ID']) && checkItem('ID','admin',$_SESSION['ID'])==1){
     
    // create admin object
    $admin = new admin();
    $admin->setID_DB($_SESSION['ID']);


  


    // Get request that show each page
    $page = $_GET['page'];


    if($page=='manage'){
        // start manage page

        $stmt = $con->prepare("SELECT * FROM `store`");
        $stmt->execute();


$count =  $stmt->rowCount();
$stores = $stmt->fetchAll();



// disable request ------------ 

if(isset($_POST['disable'])){


     $storeID =$_POST['check'];


     foreach($storeID as $ID){

         $store = new store();
         $store->setID($ID);
         $admin->disableStore($store);
     } 
   
      header('location:store.php?page=manage');


    }

 



// end disable .................



// enable request ------------ 

if(isset($_POST['enable'])){

     $storeID =$_POST['check'];


     foreach($storeID as $ID){

         $store = new store();
         $store->setID($ID);
         $admin->enableStore($store);
     } 
   
    header('location:store.php?page=manage');

}

// end  enable request ------------ 


// start delete ------------ 

if(isset($_POST['delete'])){

     $storeID =$_POST['check'];

     foreach($storeID as $ID){

         $store = new store();
         $store->setID($ID);
         $admin->deleteStore($store);
     }
   
    header('location:store.php?page=manage');

}

// end  delete request ------------ 







        ?>
        <h1>Manage page </h1>


        <a href="store.php?page=add"><button type="button" class="btn btn-primary add-new" >Add new store <i class="fas fa-plus"></i></button></a>


        <div class="container-fluid">
            <div class="row">



                 <div class="col-lg-4 col-md-12"><!--- start col --->

<form method="POST" action=""><!-- start form --->

        <div class="control-box">
            <div class="heading">
                <h3>Control</h3>
            </div>

            <button type="submit" class="btn btn-warning" name="disable">Disable <i class="fas fa-eye-slash"></i></button>

            <button type="submit" class="btn " name="enable" style="background-color: #27ae60; color: white;">Enable <i class="far fa-check-circle"></i></button>

              <button type="submit" onclick="Fonfrim()" name="delete" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></button>

            

        </div>
     
                    
                </div>
                <!--- end col --->
                



 
                <div class="col-lg-8 col-md-12"><!--- start col --->

                    <div class="table-responsive table-frame" style="height:400px">

        <table class="table  manage_table" >
            <thead>
                <tr>
                     <th><input type="checkbox" name="select all" id="select-all"></th>
                    <th>Name</th>
                     <th>Image</th>
                    <th>Items count</th>
                    <th>Status</th>
                    <th>Control</th>
                </tr>

                
            </thead>

         
                
<?php


// start display stores info

// start loop

foreach($stores as $store){
    ?> 

     <tr>
           <td><input type="checkbox" name="check[]" value="<?php echo $store['ID']; ?>"></td>
                    <td><?php echo $store['name']; ?></td>
                    <td>
                        <img src="uploads/stores/<?php echo $store['image']; ?>" style="max-width: 100px;">
                    </td>
                    <td>1</td> 
                    <td>
                        <?php if($store['status']==1){
                            echo 'shown';
                        }else{
                            echo 'hided';
                        } ?>

                        

                    </td>        
                    <td class="control">

                          <a href="store.php?page=view&id=<?php echo $store['ID']; ?>">
                            <button type="button" class="btn btn-info">View <i class="far fa-eye"></i></button></a>

                        <a href="?page=edit&id=<?php echo $store['ID']; ?>"><button type="button" class="btn btn-success">Edit <i class="far fa-edit"></i></button></a>
                        



                    </td>      
                </tr>

    <?php

}
// end loop





?>
                
            </tbody>


 
        </table>

</div>

</form><!-- end form --->
                    
                </div>
                <!--- end col --->




            </div>
        </div>





        




       <?php
     // end manage page
    }elseif($page=='add'){
        // start manage page


// start add store

if(isset($_POST['add'])){


 // image 
        
 $imgName = $_FILES['img']['name'];
 $imgSize = $_FILES['img']['size'];
 $img_tmpName= $_FILES['img']['tmp_name'];
 $imgType = $_FILES['img']['type'];
 //   -------------------------------
   

    
    $error = array();

    if(empty($_POST['name'])){

        $error[] = 	alert('alert alert-danger text-center','Name is empty' , 
                          'margin:10px 0px 10px 10%; width:80%; padding:5px;');

    }
    
    // that means there is no image
    if($imgSize == 0){
        $error[] = 	alert('alert alert-danger text-center','Please add an image' , 
        'margin:10px 0px 10px 10%; width:80%; padding:5px;');
    }else{
        
        // move image to the file
        $tmpName = rand(0,100000000).'_'.$imgName;
        move_uploaded_file($img_tmpName,'uploads/stores/'.$tmpName);
    }

    if(count($error)>0){
        foreach($error as $e){
            echo $e;
        }
    }
    
    
    if(count($error)==0){

       
        // create store object
        $store = new store();
        // set input data
        $store->setName($_POST['name']);
        $store->setImage($tmpName);

        // admin add store
        if($admin->addStore($store)){

            alert('alert alert-success text-center','New store has been added succesfully' , 
                  'margin:10px 0px 10px 10%; width:80%; padding:5px;');

            redirect('please do not make any action' , $s=8 , 'store.php?page=manage');





        }








    }





   



}

 




// end add store
?>


<h1>Add new store</h1>
<div class="add-form">
        <form method="POST" action="" enctype="multipart/form-data">

            <label for="name">Name</label>
            <input type="text" name="name" id='name' class="form-control" required>

            <label for="img">Image</label>
            <input type="file" name="img" id='img' class="form-control" required>

            <button type="submit" class="btn btn-primary" name="add">submit</button>


        </form>
</div>





       <?php

        // end add page
    }elseif($page=='edit'){
        // start manage page

        // GET validation
        if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

         

              // check if ID is exist in database
            if(checkItem('ID' , 'store', $_GET['id'])==1){
                // start form view

                 // create store object
                $store = new store;
                $store->set_all_by_ID($_GET['id']);


                // start edit form proccessing

                if(isset($_POST['edit'])){


                                        

                    if(!empty($_POST['name'])){
                        $store->setName($_POST['name']);

                    }


                    if(!empty($_FILES['img']['size'])>0){
                        // image info
                      $imgName = $_FILES['img']['name'];
                      $imgSize = $_FILES['img']['size'];
                      $img_tmpName= $_FILES['img']['tmp_name'];
                      $imgType = $_FILES['img']['type'];

                      // move image to the file
                       $tmpName = rand(0,100000000).'_'.$imgName;
                       move_uploaded_file($img_tmpName,'uploads/stores/'.$tmpName);

                        $store->setImage($tmpName);


                    }

                    if($admin->editStore($store)){

                         alert('alert alert-success text-center','store has been edited succesfully' , 
                  'margin:10px 0px 10px 10%; width:80%; padding:5px;');

                    redirect('please do not make any action' , $s=8 , 'store.php?page=manage');

                    }





                }

                // end edit form proccessing




                ?>

                <h1>Edit store</h1>


     <div class="Edit-form">
        <form method="POST" action=""enctype="multipart/form-data" >

            <label for="name">Name </label>
            <input type="text" name="name" id='name' class="form-control" 
            value="<?php echo $store->getName(); ?>" required>

            <label for="img">Image <span>Enter only if you want to change</span></label>
            <input type="file" name="img" id='img' class="form-control" >

            <button type="submit" class="btn btn-primary" name="edit">submit</button>


        </form>
</div>



                <?php
                // end form view
            }
            // end check if ID is exist in database




        }
          // end GET validation ----------------




       // end add page
    }
    elseif($page == 'view'){  // start view page

       

        if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

         

              // check if ID is exist in database
            if(checkItem('ID' , 'store', $_GET['id'])==1){
                

                 // create store object
                $store = new store;
                $store->set_all_by_ID($_GET['id']);
                
                // start html
                ?>

                <div class="panner">
                   <img src="uploads/stores/<?php  echo $store->getImage();  ?>">
                   <h2><?php  echo $store->getName();  ?></h2>



                </div>

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

          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">


<!--- start card ---->
<a href="item.php?page=view&id=<?php echo $item['ID']; ?>">
        <div class="card" style="height: 98%; margin: 10px 0px 10px 0px;">
  <img class="card-img-top responsive" src="uploads/items/<?php echo $item['image'];  ?>" alt="Card image cap" >
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





    // end view page
    }







}else{
    header('location:login.php');
}









?>

<script type="text/javascript" src="layout/js/selectAll.js"></script>
<script type="text/javascript">


function Fonfrim() {
  confirm("Are you sure");
}


    

</script>
<?php


include 'includes/footer.php';




?>