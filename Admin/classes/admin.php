<?php


class admin{
    private $ID; 
    private $password;


    // start getters ------------------------------

    function getID(){
        return $this->ID;
    }

    function getPassword(){
        return $this->password;
    }

    // end getters .....................


    // start setters ----------------------

    function setID($pass){
        $this->password=$pass;
    }

    function setPassword($pass){
        $this->password=$pass;
    }

    // end setters .........................


    // start database


    // this function used to create an object depends on session ID 
    function setID_DB($ID){

        global $con;
        $stmt = $con->prepare("SELECT * FROM `admin` WHERE `ID`='$ID'");
        $stmt->execute();
        $data = $stmt->fetch();

        $this->ID = $data['ID'];
        $this->password = $data['password'];


    }


// start deal with store functions


    function addStore($store){

        // take store attrubite 
        $name = $store->getName();
        $image = $store->getImage();

    

        global $con;
        $stmt = $con->prepare("INSERT INTO `store`(`name`, `image`) 
        VALUES ('$name','$image')");
        $stmt->execute();
        
        return $stmt;

    }

        function editStore($store){

        // take store attrubite 
        $storeID = $store->getID();
        $name = $store->getName();
        $image = $store->getImage();

    
        global $con;
        $stmt = $con->prepare("UPDATE `store` SET `name`='$name',`image`='$image' WHERE `ID`='$storeID'");
        $stmt->execute();
        
        return $stmt;

    }

      function disableStore($store){

          $storeID = $store->getID();
    
        global $con;
        $stmt = $con->prepare("UPDATE `store` SET `status`='0' WHERE `ID`='$storeID'");
        $stmt->execute();
        
        return $stmt;



    }


      function enableStore($store){

          $storeID = $store->getID();
    
        global $con;
        $stmt = $con->prepare("UPDATE `store` SET `status`='1' WHERE `ID`='$storeID'");
        $stmt->execute();
        
        return $stmt;



    }

    function deleteStore($store){

        $storeID = $store->getID();
    
        global $con;
        $stmt = $con->prepare("DELETE FROM `store` WHERE `ID`='$storeID '");
        $stmt->execute();
        
        return $stmt;



    }

// end deal with store functions



// start deal with item functions


function addItem($item){

        // take item attrubite 
        $name = $item->getName();
        $image = $item->getImage();
        $description = $item->getDescription();
        $price = $item->getPrice();
        $storeID =  $item->getStore_ID();


        global $con;
        $stmt = $con->prepare("INSERT INTO `item`( `name`, `image`, `description`, `price` , `store_ID`) 
        VALUES ('$name','$image','$description','$price','$storeID')");
        $stmt->execute();
        
        return $stmt;

    }


    
    function editItem($item){

             // take item attrubite 
             $ID = $item->getID();
             $name = $item->getName();
             $image = $item->getImage();
             $description = $item->getDescription();
             $price = $item->getPrice();
             $storeID =  $item->getStore_ID();
    
        global $con;
        $stmt = $con->prepare("UPDATE `item` 
        SET`name`='$name',`image`='$image',`description`='$description',`price`='$price' ,`store_ID`='$storeID' 
        WHERE `ID`='$ID' ");
        $stmt->execute();
        
        return $stmt;

    }


    


    function disableItem($item){

      $itemID = $item->getID();

      global $con;
      $stmt = $con->prepare("UPDATE `item` SET `status`='0' WHERE `ID`='$itemID'");
      $stmt->execute();
      
      return $stmt;



  }


    
    function enableItem($item){

      $itemID = $item->getID();
  
      global $con;
      $stmt = $con->prepare("UPDATE `item` SET `status`='1' WHERE `ID`='$itemID' ");
      $stmt->execute();
      
      return $stmt;



  }



    function deleteItem($item){

        // take store attrubite 
        $ID = $item->getID();


        global $con;
        $stmt = $con->prepare("DELETE FROM `item` WHERE `ID`='$ID' ");
        $stmt->execute();
        
        return $stmt;

    }


// end deal with item functions



  

    







}










?>