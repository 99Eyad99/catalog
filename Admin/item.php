<?php 

session_start();

include 'connect.php';
include 'includes/functions/fun.php';


// template
include 'includes/header.php';
include 'includes/navbar.php';


// clasess 
include 'classes/admin.php';
include 'classes/item.php';


?>

<link rel="stylesheet" type="text/css" href="layout/css/style.css">



<?php

if(isset($_SESSION['ID']) && checkItem('ID','admin',$_SESSION['ID'])==1){


    // create admin object
    $admin = new admin();
    $admin->setID_DB($_SESSION['ID']);


    // Get request that show each page
    $page = $_GET['page'];

    if($page == 'manage'){

             $stmt = $con->prepare("SELECT * FROM `item`");
             $stmt->execute();

             $count =  $stmt->rowCount();
             $items = $stmt->fetchAll();


// control functions

// disable request ------------ 

if(isset($_POST['disable'])){


    $itemID =$_POST['check'];


    foreach($itemID as $ID){

        $item = new item();
        $item->setID($ID);
        $admin->disableItem($item);
    } 
  
     header('location:item.php?page=manage');


   }




// end disable .................



// enable request ------------ 

if(isset($_POST['enable'])){

    $itemID = $_POST['check'];


    foreach($itemID as $ID){

        $item = new item();
        $item->setID($ID);
        $admin->enableItem($item);
    } 
  
   header('location:item.php?page=manage');

}

// end  enable request ------------ 


// start delete ------------ 

if(isset($_POST['delete'])){

    $itemID =$_POST['check'];



    foreach($itemID as $ID){

        $item = new item();
        $item->setID($ID);
        $admin->deleteItem($item);
    }
  
   header('location:item.php?page=manage');

}

// end  delete request ------------ 




// end control functions


             // start html
             ?>

                    <h1>Manage page </h1>


        <a href="item.php?page=add"><button type="button" class="btn btn-primary add-new" >Add new item <i class="fas fa-plus"></i></button></a>


        <div class="container-fluid">
            <div class="row">



                 <div class="col-lg-4 col-md-12 "><!--- start col --->

<form method="POST" action=""><!-- start form --->

        <div class="control-box">
            <div class="heading">
                <h3>Control</h3>
            </div>

            <button type="submit" class="btn btn-warning" name="disable">Disable<i class="fas fa-eye-slash"></i></button>

            <button type="submit" class="btn " name="enable" style="background-color: #27ae60; color: white;">Enable <i class="far fa-check-circle"></i></button>

              <button type="submit" onclick="Fonfrim()" name="delete" id="delete" class="btn btn-danger">Delete <i class="far fa-trash-alt"></i></button>

            

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
                     <th>Description</th>
                     <th>Price</th>
                     <th>Status</th>
                     <th>Control</th>
                </tr>
            </thead>

         
                
<?php


// start display stores info

// start loop

foreach($items as $item){
    ?> 

     <tr>
           <td><input type="checkbox" name="check[]" value="<?php echo $item['ID']; ?>"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>
                        <img src="uploads/items/<?php echo $item['image']; ?>" style="max-width: 100px;">
                    </td>
                    <td><?php echo $item['description']; ?></td> 
                    <td><?php echo $item['price']; ?></td> 
                 
                    <td>
                        <?php if($item['status']==1){
                            echo 'shown';
                        }else{
                            echo 'hided';
                        } ?>
        

                    </td>        
                    <td class="control">

                          <a href="?page=view&id=<?php echo $item['ID']; ?>">
                            <button type="button" class="btn btn-info">View <i class="far fa-eye"></i></button></a>

                        <a href="?page=edit&id=<?php echo $item['ID']; ?>"><button type="button" class="btn btn-success">Edit <i class="far fa-edit"></i></button></a>
                        



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
             // end html
    	
    

    
    // end manage
    }
    elseif($page == 'add'){
    	// start add

         // fetch stores information

           $stmt = $con->prepare("SELECT * FROM `store`");
           $stmt->execute();
           $count =  $stmt->rowCount();
            $stores = $stmt->fetchAll();


        // start form proccessing
        if(isset($_POST['add'])){


// image 
       
 $imgName = $_FILES['img']['name'];
 $imgSize = $_FILES['img']['size'];
 $img_tmpName= $_FILES['img']['tmp_name'];
 $imgType = $_FILES['img']['type'];
 //   -------------------------------

 // check if image type is allowed


 // --------------------------------


 if(allowedFilesType($imgType)==1){

    if($imgSize>0){
        // move image to the file
        $tmpName = rand(0,100000000).'_'.$imgName;
        move_uploaded_file($img_tmpName,'uploads/items/'.$tmpName);
    }

    $item = new item();
    $item->setName($_POST['name']);
    $item->setImage($tmpName);
    $item->setDescription($_POST['description']);
    $item->setPrice($_POST['price']);
    $item->setStore_ID($_POST['store']);

    if($admin->addItem($item)){

      alert('alert alert-success text-center','New store has been added succesfully' , 
      'margin:10px 0px 10px 10%; width:80%; padding:5px;');

      redirect('please do not make any action' , $s=8 , 'item.php?page=manage');
    }







 }else{

    alert('alert alert-danger text-center','Allowed image types is '.$allowed_type[0].' ,'
    .$allowed_type[1].' ,'.$allowed_type[2].' , '.$allowed_type[3].'',
'margin:10px 0px 10px 10%; width:80%; padding:5px;');

    


    

 }




         

   

         }
         // end form proccessing


   






        

if($count==0){
    ?><h3>There are no store please add store</h3><?php
}else{



        //start html
        ?>

        <h1>Add new item</h1>
<div class="add-form">
        <form method="POST" action="" enctype="multipart/form-data">

            <label for="name">Name</label>
            <input type="text" name="name" id='name' class="form-control" required>

            <label for="img">Image</label>
            <input type="file" name="img" id='img' class="form-control" required>

            <label for="desc">Description</label>
            <textarea type="text" name="description" id='desc' class="form-control" required></textarea>
            

            <label for="price">Price</label>
            <input type="text" name="price" id='price' class="form-control" required>

            <label for="select">Store</label>
            <select name="store" id="select" class="form-control" required>

                <?php

                foreach($stores as $store){
                    ?>
                    <option value="<?php echo $store['ID']; ?>"><?php echo $store['name']; ?></option>
                    <?php
                }

                ?>
                
            </select>

            
            <button type="submit" class="btn btn-primary" name="add">submit</button>


        </form>
</div>



        <?php
        // end html



   // end add
}
    


 
    }
    elseif($page == 'edit'){
    	// start edit

        
        // GET validation
        if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

         

            // check if ID is exist in database
          if(checkItem('ID' , 'item', $_GET['id'])==1){
              // start form view

               // create store object
              $item = new item;
              $item->set_all_by_ID($_GET['id']);

           // fetch stores
           $stmt = $con->prepare("SELECT * FROM `store`");
           $stmt->execute();
           $count =  $stmt->rowCount();
            $stores = $stmt->fetchAll();

            // start form proccessing
    if(isset($_POST['edit'])){

        

                
// image 
       
 $imgName = $_FILES['img']['name'];
 $imgSize = $_FILES['img']['size'];
 $img_tmpName= $_FILES['img']['tmp_name'];
 $imgType = $_FILES['img']['type'];
 //   -------------------------------

 // check if image type is allowed


 // --------------------------------


 if(allowedFilesType($imgType)==1){

    if($imgSize>0){
        // move image to the file
        $tmpName = rand(0,100000000).'_'.$imgName;
        move_uploaded_file($img_tmpName,'uploads/items/'.$tmpName);

        $item->setImage($tmpName);
    }

    if(!empty($_POST['name'])){
        $item->setName($_POST['name']);
        
    }

    if(!empty($_POST['description'])){
        $item->setDescription($_POST['description']);

    }

    if(!empty($_POST['price'])){
        $item->setPrice($_POST['price']);

    }

    if(!empty($_POST['store'])){
        $item->setStore_ID($_POST['store']);
    }  
  

    if($admin->editItem($item)){

      alert('alert alert-success text-center','Item edited succesfully' , 
      'margin:10px 0px 10px 10%; width:80%; padding:5px;');

      redirect('please do not make any action' , $s=8 , 'item.php?page=manage');
    }


                
            }else

            alert('alert alert-danger text-center','Allowed image types is '.$allowed_type[0].' ,'
            .$allowed_type[1].' ,'.$allowed_type[2].' , '.$allowed_type[3].'',
        'margin:10px 0px 10px 10%; width:80%; padding:5px;');
        

            }
        

}
// end form proccessing

              
        //start html
        ?>

<div class="Edit-form">
        <h1>Edit item</h1>
<div class="add-form">
        <form method="POST" action="" enctype="multipart/form-data">

            <label for="name">Name</label>
            <input type="text" name="name" id='name' class="form-control" value="<?php echo $item->getName(); ?>" >

            <label for="img">Image <span>Enter only if you want to change</span></label>
            <input type="file" name="img" id='img' class="form-control" >

            <label for="desc">Description <span>Enter only if you want to change</span></label>
            <textarea type="text" name="description" id='desc' class="form-control" ></textarea>
            

            <label for="price">Price </label>
            <input type="text" name="price" id='price' class="form-control" value="<?php echo $item->getPrice(); ?>">

            <label for="select">Store <span>Enter only if you want to change</span></label>
            <select name="store" id="select" class="form-control" required>

                <?php

                foreach($stores as $store){
                    ?>
                    <option value="<?php echo $store['ID']; ?>"><?php echo $store['name']; ?></option>
                    <?php
                }

                ?>
                
            </select>

            
            <button type="submit" class="btn btn-primary" name="edit">submit</button>


        </form>
</div>

</div>



        <?php
        // end html

              





          }


        } // end edit
         elseif($page == 'view'){
           // start view
         

            // GET validation
        if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']) ){

         

            // check if ID is exist in database
          if(checkItem('ID' , 'item', $_GET['id'])==1){
              // start form view

               // create store object
              $item = new item;
              $item->set_all_by_ID($_GET['id']);

            

              ?>

              <div class="container-fluid item_all">
                  <div class="row">


                    <div class="col-lg-8 col-md-6">

            <div class="item-view">
                  <img src="uploads/items/<?php  echo $item->getImage(); ?>"> 
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
                             <hr>
                            <h5>Stored in : <?php  

                              include 'classes/store.php';
                              $store = new store();
                              $store->set_all_by_ID($item->getStore_ID());

                             ; ?><span><?php  echo $store->getName(); ?></span></h5>


                        </div>
                        
                    </div>



           
                      


                  </div>
              </div>

              

              

              <?php

            }


        }
    

    // end view
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
