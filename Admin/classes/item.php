<?php


class item{

    private $ID;
    protected $name;
    protected $image;
    protected $description;
    protected $price;
    protected $status;
    protected $store_ID;



    function consract($ID,$name,$image,$description,$price,$status,$store_ID){

		$this->ID=$ID;
		$this->name=$name;
		$this->image=$image;
        $this->description=$description;
        $this->price=$price;
		$this->status=$status;
        $this->store=$store_ID;
		
	}



    // start getters ---------------------------

    function getID(){
        return $this->ID;
    }

    function getName(){
        return $this->name;
    }

    function getImage(){
        return $this->image;
    }

    function getDescription(){
        return $this->description;
    }

    function getPrice(){
        return $this->price;
    }

    function getStatus(){
        return $this->status;
    }

    function getStore_ID(){
        return $this->store_ID;
    }

    // end getters .............................





     // start setters ---------------------------

    function setID($ID){
        $this->ID=$ID;
    }

    
    function setName($name){
        $this->name=$name;
    }

    
    function setImage($image){
        $this->image=$image;
    }

    function setDescription($Description){
        $this->description=$Description;
    }

    function setPrice($price){
        $this->price=$price;
    }

    function setStatus($status){
        $this->status=$status;
    }

    function setStore_ID($Store_ID){
        $this->store_ID=$Store_ID;
    }

    // end setters ....................................



        function create_new_DB(){

        global $con;
        $stmt = $con->prepare("INSERT INTO `item`(`ID`, `name`, `image`, `description`, `price`, `status`, `store_ID`) VALUES ('$this->ID','$this->name','$this->image','$this->description','$this->price',
                               '$this->status',' $this->store_ID'))");
        $stmt->execute();
    }


    function set_all_by_ID($id){

        global $con;
        $stmt = $con->prepare("SELECT * FROM `item` WHERE `ID`='$id'");
        $stmt->execute();
        $data=  $stmt->fetch();

        $this->ID = $data['ID'];
        $this->name = $data['name'];
        $this->image= $data['image'];
        $this->description= $data['description'];
        $this->price = $data['price'];
        $this->status  = $data['status'];
        $this->store_ID = $data['store_ID'];


        
    }







}







?>