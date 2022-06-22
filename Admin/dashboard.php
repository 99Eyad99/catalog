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


if(isset($_SESSION['ID'])  && checkItem('ID','admin',$_SESSION['ID'])==1){




    
}else{
    header('location:login.php');
}



?>

<link rel="stylesheet" type="text/css" href="layout/css/dashboard.css">

<!--- google chart --->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     


<!--- google chart --->

<div class="container-fluid stat">
    <div class="row">

        <div class="col-sm-6">

            <div class="stat-store">
                Total stores
                <br>
                <span>   <?php echo clacItems('ID' , 'store'); ?> <i class="fas fa-store"></i></span>
                
                
            </div>
            
        </div>

         <div class="col-sm-6">
             

             <div class="stat-item">
                Total items 
                <br>
                <span><?php echo clacItems('ID' , 'item'); ?> <i class="fas fa-box-open"></i></span>
                        
            </div>
            
        </div>
        



    </div>
</div>




<!--- start visualization container --->

<div class="container-fluid visualization">
      <h2>Data visualization <i class="fas fa-chart-bar"></i></h2>
    <div class="row">



        <div class="col-sm-6">

            <div id="piechart"class="pieChart" style="background-color:#ecf0f1;"></div>


        </div>


         <div class="col-sm-6">
            
             <div id="col-chart"class="colChart" style="background-color:#ecf0f1;"></div>
             

         </div>
    

     </div>
</div>


<!--- end visualization container --->




<!--- start lastest added items container --->


  
<div class="container-fluid lastest">
     <h2>Lastest added items <i class="fas fa-box-open"></i></h2>
    <div class="row">



<?php

 // fetch lastest added 
  $stmt = $con->prepare("SELECT * FROM `item` ORDER BY `ID` DESC LIMIT 4");
  $stmt->execute();

  $items = $stmt->fetchAll();

  foreach($items as $item){
    ?>

          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">


<!--- start card ---->

        <div class="card" style="height: 98%; margin: 10px 0px 10px 0px;">
  <img class="card-img-top responsive" src="uploads/items/<?php echo $item['image'];  ?>" alt="Card image cap" >
  <div class="card-body">
    <h5 class="card-title"><?php echo $item['name'];  ?></h5>
    <label>Price : <?php echo $item['price'];  ?>$</label>

    
  </div>
</div>

<!--- end card ---->
                            
                           
           </div>
    <?php
  }


?>




     </div>
</div>




<!--- end lastest added items container --->


  








<?php
// fetch required data for visualization

$stmt = $con->prepare("SELECT `name`,`ID` FROM `store`");
$stmt->execute();
$data = $stmt->fetchAll();

$vis = array();

foreach($data as $d){


    $store_id = $d['ID'];

    $stmt = $con->prepare("SELECT `ID` FROM `item` WHERE `store_ID`='$store_id' ");
    $stmt->execute();

    $count = $stmt->rowCount();
    $name = $d['name'];

    $vis += [$name =>  $count];



}





// --------------------------------
?>


<script type="text/javascript">

    
    // google chart with php

    // pie chart

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([


          ['Store', 'Items count'],
            <?php

            
foreach($vis as $i => $key){
      echo "['".$i."',".$key."],";
}

?>
        ]); 

        var options = {
          title: 'Items distribution per store',
          backgroundColor:'#ecf0f1'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

  google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);






$(window).resize(function(){
  drawChart();
});

    


</script>







<script type="text/javascript">


        function drawColChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([


                     ['Items count', 'Store'],


                               <?php

            
foreach($vis as $i => $key){
      echo "['".$i."',".$key."],";
}

?>
  
        

             //  ['Iphone 11',  900],



                         ]);

            var options = {title: 'Items count in each store',backgroundColor:'#ecf0f1'}; 

            // Instantiate and draw the chart.
            var chart = new google.visualization.ColumnChart(document.getElementById('col-chart'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawColChart);
    




</script>

<?php







include 'includes/footer.php';


?>