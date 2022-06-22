<?php


class store{
	private $ID;
	protected $name;
	protected $image;
	protected $status;
	//protected $items = array();



	// start getters -----------------------------------------

	function consract($ID,$name,$image,$status,$items){
		$this->ID=$ID;
		$this->name=$name;
		$this->image=$image;
		$this->status=$status;
		$this->items=$items;

	}

	function getID(){
		return $this->ID;
	}

	function getName(){
		return $this->name;
	}

	function getImage(){
		return $this->image;
	}

	function getStatus(){
		return $this->status;
	}
/*
	function getItems(){
		return $this->items;
	}
*/

	// end getters ....................................

	

	// start setters -------------------------------

	function setID($ID){
		$this->ID=$ID;
	}

	function setName($name){
		$this->name=$name;
	}
/*
	function setItem($item){
		$this->items[] = $item;
	}
*/


	function setImage($image){
		$this->image = $image;
	}

	function setStatus($status){
		$this->status =$status;
	}

		// end setters -------------------------------

	

	function create_new_DB(){

        global $con;
        $stmt = $con->prepare("INSERT INTO 
		                       `store`(`name`, `image`, `status`) 
		                                 VALUES ('$this->name','$this->image','$this->status')");
        $stmt->execute();
    }


    function set_all_by_ID($id){

        global $con;
        $stmt = $con->prepare("SELECT * FROM `store` WHERE `ID`='$id'");
        $stmt->execute();
        $data=  $stmt->fetch();

        $this->ID = $data['ID'];
        $this->name = $data['name'];
        $this->image= $data['image'];
        $this->status  = $data['status'];


        
    }







}
















?>