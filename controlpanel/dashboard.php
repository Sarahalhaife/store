<?php
require("db.php");
session_start();
if(!isset($_SESSION['UserName'])or $_SESSION['role']!=1){
	
 header('Location:../login.php');
}


//include "header.php";
?>
<!DOCTYPE html>
<html>
<head> 
 <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
	<link href="css/custom.css" rel="stylesheet" />
</head>
<body>
<div id="wrapper" class="active">

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $_SESSION['UserName']; ?></a>
                </li>
                <li class="divider"></li>
                <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>                


    <div class="navbar-default sidebar" role="navigation">                  
        <div class="sidebar-nav">
            <ul class="nav" id="side-menu">   
                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> <span class="ttspan-fill">Dashboard</span></a>
                </li>
							
				
							<li>
                    <a href="users.php"><i class="fa fa-users fa-fw"></i> <span class="ttspan-fill">Users</span></a>
                </li>
				
							<li>
                    <a href="prodect.php"><i class="fa fa-newspaper-o fa-fw"></i> <span class="ttspan-fill">Prodect</span></a>
                </li>
				
							
            </ul>
        </div>
    </div>                             
</nav>  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-dashboard'></i> Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        
    
       
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
							<?php
							
							$sql="select * from user";
							$q=$con->prepare($sql);
							$q->execute();
							echo $q->rowcount();
							 
							
							?>
							
							</div>
                            <div>Users</div>
                        </div>
                    </div>
                </div>
                <a href="users.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
						
					<div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-newspaper-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">
							<?php
							
							$sql="select * from prodect";
							$q=$con->prepare($sql);
							$q->execute();
							echo $q->rowcount();
							 
							
							?>
							</div>
                            <div>prodect</div>
                        </div>
                    </div>
                </div>
                <a href="prodect.php">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
						
						
					
		
    </div>
    <!-- /.row -->
  
</div>         
</div>

<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>