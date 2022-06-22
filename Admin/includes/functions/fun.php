<?php

function alert($type,$txt , $style){

    echo '<div class="'.$type.'" style="'.$style.'"> <strong>'.$txt.'</strong> </div>';

}

function redirect($msg , $s=2 , $where){

    echo '<div class="alert alert-danger text-center" style="margin:10px 0px 10px 10%; width:80%; padding:5px;">'.$msg.'</div>';
    echo '<div class="alert alert-info text-center" style="margin:10px 0px 10px 10%; width:80%; padding:5px;">
           you will be redirected after '.$s.' seconds </div>';
    header("refresh:$s;url=$where");

};

function checkItem($item , $table , $val){

    global $con;
    $stmt = $con->prepare("SELECT 
    $item 
FROM $table
WHERE 
 $item = '$val' ");

$stmt->execute();
$count = $stmt->rowCount();

return $count;


}

function clacItems($item , $table){

    global $con;
    $stmt = $con->prepare(" SELECT $item FROM $table ");

$stmt->execute();
$count = $stmt->rowCount();

return $count;

}

function fetch_by_ID($id , $table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE `ID`=$id");
    $stmt->execute();

    return $stmt->fetch();

}

// check if image type is allowed
function allowedFilesType($fileType){

    $allowed_type = ['PNG','JPG','JPEG','webP'];
    $allow =1;
   
    foreach($allowed_type as $type){
        if($type == $fileType){
           $allow =0;
   
        }
    }
   
    return  $allow;

}
     

 










?>