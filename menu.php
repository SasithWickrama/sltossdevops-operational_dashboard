<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $username = $_SESSION['$username'];
} else {

  echo '<script type="text/javascript"> document.location = "index.html";</script>';
}
?>

<!DOCTYPE html>
<html>

<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">

  <link href="https://fonts.googleapis.com/css?family=ZCOOL+XiaoWei&display=swap" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>RTSU- Operational Management Dashboard</title>
  <link rel="shortcut icon" href="img/0028_CMO_IconLB_Reports-Dashboard_RGB.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">

  <!-- jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

  <style type="text/css">
    .nav-tabs {
      border-bottom: 2px solid #DDD;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
      border-width: 0;
    }

    .nav-tabs>li>a {
      border: none;
      color: #ffffff;
      background: #5a4080;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li>a:hover {
      border: none;
      color: #5a4080 !important;
      background: #5a4080;
    }

    .nav-tabs>li>a::after {
      content: "";
      background: #5a4080;
      height: 2px;
      position: absolute;
      width: 100%;
      left: 0px;
      bottom: -1px;
      transition: all 250ms ease 0s;
      transform: scale(0);
    }

    .nav-tabs>li.active>a::after,
    .nav-tabs>li:hover>a::after {
      transform: scale(1);
    }

    .tab-nav>li>a::after {
      background: #5a4080 none repeat scroll 0% 0%;
      color: #fff;
    }

    .tab-pane {
      padding: 15px 0;
    }

    .tab-content {
      padding: 20px
    }

    .nav-tabs>li {
      width: 25%;
      text-align: center;
    }

    .card {
      background: #FFF none repeat scroll 0% 0%;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      margin-bottom: 30px;
    }

    body {
      background: #EDECEC;
      padding: 5px
    }

    @media all and (max-width:724px) {
      .nav-tabs>li>a>span {
        display: none;
      }

      .nav-tabs>li>a {
        padding: 5px 5px;
      }
    }
  </style>

</head>

<body>

  <!--Main Navigation-->
  <header>


    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar" style="background-image: linear-gradient(to right,#f4ecf7,#d4e6f1);">
      <div class="container-fluid">
        <a style="font-size:15px;"></a>

        <a href="logout.php">Sign out</a>

      </div>
    </nav>


  </header>

  <main class="pt-5 mx-lg-12 h-100">


    <div class="d-flex flex-column h-100 min-vh-100 justify-content-center align-items-center" style="margin-top: 5%;">
      <h3>RTSU- Operational Management Dashboard-&nbsp;<?php echo $username; ?></h3>
      <a class="btn btn-warning btn-lg" style="margin-top: 5%;" href="
      <?php
      if ($_SESSION['$p_level'] == '1') {
        echo 'faultdb/dashboard.php';
      } else if ($_SESSION['$p_level'] == '2') {
        echo 'faultdb/dashboard_region.php';
      } else if ($_SESSION['$p_level'] == '3') {
        echo 'faultdb/dashboard_csro.php';
      }
      ?>" role="button">Pending Faults Details considering All WGs</a>
      <p></p>
      <a class="btn btn-warning btn-lg" href="
      <?php
      if ($_SESSION['$p_level'] == '1') {
        echo 'faultdb/dashboard_rtom.php';
      } else if ($_SESSION['$p_level'] == '2') {
        echo 'faultdb/dashboard_region_rtom.php';
      } else if ($_SESSION['$p_level'] == '3') {
        echo 'faultdb/dashboard_csro_rtom.php';
      }
      ?>" role="button">Pending Faults Details considering OPMC WGs only</a>
    </div>






  </main>

  <!--Footer-->
  <!-- <footer class="page-footer text-center font-small primary-color-dark darken-2 mt-4 wow fadeIn">

    <hr class="my-4">

    <div class="footer-copyright py-3">© 2021 Copyright: OSS DevOPS</div>

  </footer> -->
  <!--/.Footer-->


  <!-- Charts -->
  <script>
    window.onload = function() {



    }
  </script>

</body>

</html>