<?php

session_start();
include '../dbcon.php';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true   )
{    

  //$user = $_SESSION['$user'];
    $username = $_SESSION['$username'];
  
  /*if(isset($_SESSION['opmc']) && $_SESSION['opmc'] == null   ){ 
  echo '<script type="text/javascript"> document.location = "index.html";</script>'; 
  }*/
}
else 
{     
    echo '<script type="text/javascript"> document.location = "index.html";</script>'; 
}
date_default_timezone_set("Asia/Colombo");


$CON = OracleConnection();



ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
ini_set('max_execution_time', '0'); // for infinite time of execution 



$q = $_GET['q'];


if ($q == "1" ){ 

$result="";


  $count=0;
  
  $province = $_POST['province'];
              
  $sql="SELECT DISTINCT RTOM_CODE FROM SLT_AREA WHERE PROVINCE='$province'";
  $stid =oci_parse($CON,$sql);
  oci_execute($stid);

  while($row=oci_fetch_array($stid)){

    $count++;
  
  }
  
  $result = $count;
  
  echo $result; 

         
  

  }



if($q == "2" ){

 $province = $_POST['province'];

 
    $sql="SELECT DISTINCT RTOM_CODE FROM SLT_AREA WHERE PROVINCE='".$province."'"; 
    $stid=oci_parse($CON,$sql);
    oci_execute($stid);


  while ($row = oci_fetch_array($stid))
  {
    
  $result .= '@'.$row['RTOM_CODE'];

  }
  
  echo $result;
  
}






if ($q == "3" ){

  $result ="";
  
  //---------------------------------------- megaline ----------------------------------------------//





   $sql1="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
    WHERE PROM_CLEARED IS NULL AND  CIRT_SERT_ABBREVIATION in ('V-VOICE COPPER','AB-CAB')";

    // $sql1="SELECT  
    // COUNT(*) AS REC_COUNT
    // FROM HRTR_RESULT a where USER_ANSWER ='Strongly agree'";
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql1.= " and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }


  
  $stid1=oci_parse($CON,$sql1);
    oci_execute($stid1);
    $row1 = oci_fetch_array($stid1);
    $result .= $row1['PROB_COUNT'].",";

    //echo $sql1;
  
  
  //-----------------------------------------broadband--------------------------------------------------//
  


   $sql2="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
            WHERE PROM_CLEARED IS NULL AND  CIRT_SERT_ABBREVIATION in ('BB-INTERNET COPPER','ADSL')";
   
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql2.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }

  //echo $sql2;
  $stid2=oci_parse($CON,$sql2);
    oci_execute($stid2);
    $row2 = oci_fetch_array($stid2);
    $result .= $row2['PROB_COUNT'].",";

//-----------------------------------------------PeoTV----------------------------------------------//




   $sql3="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
          WHERE PROM_CLEARED IS NULL AND  CIRT_SERT_ABBREVIATION in ('E-IPTV COPPER')";
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql3.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }
  //echo $sql3;
  $stid3=oci_parse($CON,$sql3);
    oci_execute($stid3);
    $row3 = oci_fetch_array($stid3);
    $result .= $row3['PROB_COUNT'].",";
  
  
//---------------------------------------------------ftth-------------------------------------//



 $sql4="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
WHERE PROM_CLEARED IS NULL AND  CIRT_SERT_ABBREVIATION in ('V-VOICE FTTH','AB-FTTH','E-IPTV FTTH','BB-INTERNET FTTH')";
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql4.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }


  //echo $sql4;
  $stid4=oci_parse($CON,$sql4);
    oci_execute($stid4);
    $row4 = oci_fetch_array($stid4);
    $result .= $row4['PROB_COUNT'].",";
  
//----------------------------------------------LTE-----------------------------------------//



 $sql5="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
        WHERE PROM_CLEARED IS NULL AND  CIRT_SERT_ABBREVIATION in ('V-VOICE','AB-WIRLESS ACCESS','BB-INTERNET')";
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql5.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }
  //echo $sql5;
  $stid5=oci_parse($CON,$sql5);
    oci_execute($stid5);
    $row5 = oci_fetch_array($stid5);
    $result .= $row5['PROB_COUNT'].",";
  

  //----------------------------------------------DATA-----------------------------------------//
  

  
   $sql6="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS  
            WHERE PROM_CLEARED IS NULL AND CIRT_SERT_ABBREVIATION LIKE 'D-%'";
   
    if(isset($_POST['rtom'])){

        $rtom = $_POST['rtom'];

        if($rtom != ''){

        $sql6.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        }

    }
  //echo $sql5;
  $stid6=oci_parse($CON,$sql6);
    oci_execute($stid6);
    $row6 = oci_fetch_array($stid6);
    $result .= $row6['PROB_COUNT'].",";
  
  
    
  // ------------------------------------------------total-------------------------------------------

    //$sql7 ="SELECT COUNT(PROM_NUMBER) AS PROB_COUNT  FROM OSS_FAULTS.REALTIME_FAULTS 
           //WHERE PROM_CLEARED IS NULL AND (CIRT_SERT_ABBREVIATION LIKE 'D-%' OR CIRT_SERT_ABBREVIATION in ('AB-CAB','V-VOICE FTTH','V-VOICE','BB-INTERNET','BB-INTERNET FTTH','E-IPTV COPPER','BB-INTERNET COPPER','E-IPTV FTTH','V-VOICE COPPER','ADSL'))";
   
    //if(isset($_POST['rtom'])){

        //$rtom = $_POST['rtom'];

        //if($rtom != ''){

        //$sql7.= "and PROM_REGN_CODE in (SELECT LEA_CODE FROM SLT_AREA  WHERE RTOM_CODE = '$rtom')";

        //}

    //}
  
    //$stid7=oci_parse($CON,$sql7);
    //oci_execute($stid7);
    //$row7 = oci_fetch_array($stid7);
    //$result .= $row7['PROB_COUNT'].",";
  
  
  
  echo $result;
    
  //-------------------------end get chart column data -----------------------------------//
  
}



  ?>
