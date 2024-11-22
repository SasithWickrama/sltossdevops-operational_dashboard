
<?php 

include '../dbcon.php';

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{    
   $username = $_SESSION['$rtom'];
  
    
}else{
  
  echo '<script type="text/javascript"> document.location = "../index.html";</script>'; 
}
?>






<!DOCTYPE html>
<html>
<head>
	<title></title>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

<script type="text/javascript" src="js/popper.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>


	<div>
		         <div >
                  RTOM wise total fault count
                  <input type="text"  style="width: 100%;" placeholder="Enter Service ID" name="province" id="province" value="<?php echo  htmlentities($username);?>" >
                </div>
                <!--Card content-->
                <div  id="chrtDiv"></div>
	</div>








<script type="text/javascript">
	

window.onload = function(){


    createCharts();

}

function createCharts(){
  
  // $("#btnviewdata").css("display", "none");
  var province = document.getElementById('province').value;
  $('#chrtDiv').html('');
          
  // if(course == ''){
    
  //   alert('Please Select Course');
  //   $("#btnviewdata").css("display", "block");
    
  //   return false;
    
  // }
  
  $.ajax({
      type: "POST",
      data: {province:province},
      url: "./function.php?q=1",
      success: function(recCount){
  
      // if(recCount==0){
        
      //   alert('No Data Found')
      //   $("#btnviewdata").css("display", "block");
        
      // }
      
    
      for(var n=1; n<=recCount; n++){
        
        $('#chrtDiv').append('<div style="text-align:center; font-weight:bold; font-size:15px;" id="chrtQues'+n+'" class="mb-3" ></div>'+
                  '<div id="chartcontainer'+n+'" style="width:80%; margin-left:6%">'+
                  '<canvas id="chartCanves'+n+'">'+'</canvas></div><br/><br/>');
      }
      
      
      if(parseFloat(n-1)==recCount){
        
        getChartData();
            
      }

    }
  });
  
  

}





function getChartData(){
  
  var province = document.getElementById('province').value;
  var numrec=0;

  $.ajax({
           type: "POST",
           data: {province:province},
           url: "./function.php?q=2",
           success: function(resdata){

      var resArr = resdata.split('@')

      for(var i=1; i<resArr.length; i++){
        
        dArr = resArr[i].split('@');
        
        var rtom = dArr[0];
        // var question = dArr[1];
        
        $('#chrtQues'+i).html(rtom);
        
        $.ajax({
           type: "POST",
           data: {province:province,rtom:rtom},
           url: "./function.php?q=3",
           success: function(res){
             
              numrec++;
             
            loadchart(res,province,numrec,rtom);
          
            // if(parseFloat(i-1) == parseFloat(numrec)){
          
            //   $("#btnviewdata").css("display", "block");

            // }
           }
        });
        
      }
      
    }
    }); 
  
}



function loadchart(res,province,id,rtom){

var dataArr = new Array();

var resArr = res.split(',');

for(var i=0; i<resArr.length; i++){

  dataArr.push(resArr[i]);

}

var ctx = document.getElementById("chartCanves"+id);
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Strongly Agree","Agree", "Neutral","Disagree","Strongly Disagree"],
        datasets: [{
            label: '# of Votes',
            data: dataArr,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
               
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
              
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
  



// var ctx = document.getElementById("chartCanves"+id).getContext('2d');
   
// var labels = ["Strongly Agree","Agree", "Neutral","Disagree","Strongly Disagree"];
//  dataset = [ 
//                 {
//                   type: 'bar',
//                   data: dataArr,                    
//                   backgroundColor: [
//                       '#76d7c4',
//                       '#f0b27a',
//                       '#bb8fce',
//                       '#2237e6',
//                       '#2c3e50'
//                   ]
//                 }
//             ];

// var options = {
//     scales: {
//       xAxes: [{
//         //stacked: true,
//         barPercentage: 0.5
//       }],
//       yAxes: [{
//         //stacked: true
//         barPercentage: 0.5
//       }]
//     }
// };

// var content = {
//     type: 'bar',
//     data: {
//         labels: labels,
//         datasets: dataset
//     },options
// };

// new Chart(ctx, content);


}

</script>





</body>
</html>