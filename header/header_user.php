<!DOCTYPE html>
<html>
<head>
<?php
	session_start();
	include ('koneksi.php');

?>
	<title>Djono Silver</title>
	<link rel="stylesheet" type="text/css" href="../djonosilver/bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="../djonosilver/bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="../djonosilver/bootstrap/js/jquery.maskMoney.min.js"></script>
    <script type="text/javascript" src="../djonosilver/bootstrap/js/bootstrap.js"></script>
	<script>
$(document).ready(function(){
    $(".close").click(function(){
        $("#myAlert").alert("close");
    });
});

</script>
</head>
<body>
<div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Djono Silver</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                  <!--   <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> -->
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                <li><a class="dropdown-toggle" role="button" href="logout.php"> Login  </a></li>
                <li><a class="dropdown-toggle" role="button" href="daftar.php">  Daftar  </a></li>
                <li><a class="dropdown-toggle" role="button" href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <div class="row">
                <div class="col-xs-2 col-md-12">
                    <a class="thumbnail">
                        <img class="img-responsive" src="img/logo.jpg">
                        
                    </a>
                </div>
        </div></div>
    <div class="col-md-10">
</div></body>