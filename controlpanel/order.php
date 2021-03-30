<?php
session_start();
if(!isset($_SESSION['UserName'])or $_SESSION['role']!=1){
	
 header('Location:../login.php');
}
require("db.php");

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
                <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['UserName']; ?></a>
                </li>
                <li class="divider"></li>
                <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>                

<?php
        if($_SERVER['REQUEST_METHOD']=="POST")
 {
	
	 if(empty($_POST['cname']))
			$errors['cname']="<span style='color:red'><b>Enter Your Name</b></span>";
		
		if(empty($_POST['password']))  
			$errors['password']="<span style='color:red'><b>Enter Your Password</b></span>";
			
			if(empty($_POST['u_id']))  
			$errors['u_id']="<span style='color:red'><b>Enter Your User ID</b></span>";
		
		
		if(!isset($errors) && (!isset($_GET['action']) || $_GET['action']!="edit"))
		{
			$sql="INSERT INTO `order`( `payment`, `password`, `u_id`) VALUES (:x1,:x2,:x3)";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST["cname"],"x2"=>$_POST["password"],"x3"=>$_POST["u_id"]));
							if($q->rowcount())
							{
							  echo "<h4 class='alert alert-success'>One Row Inserted</h4>";
							}
						   else
						 {
								echo "<script>alert('error');</script>";
						 }
		}
		else if(isset($_POST['save']) && !isset($errors) && $_GET['action']=="edit")
		{
		 $sql="UPDATE `order` SET `payment`=:x1,`password`=:x2,`u_id`=:x3
                                  WHERE 
                                    id=:x4 ";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST["cname"],"x2"=>$_POST["password"],"x3"=>$_POST["u_id"],"x4"=>$_GET["id"]));
		                  if($q->rowcount())
						  {   $_GET['action']=" ";
							  echo "<h4 class='alert alert-success'>One Row updated</h4>";
							
		                      echo "<a href='?action=' class='btn btn-success'>reset <i class='fa fa-edit'> </i></a> ";
                           }}
		
 }
   if(isset($_GET['action'],$_GET['id']))
   {
	   switch($_GET['action']){
		  case "edit":
		  	$sql="SELECT * FROM `order` where id=:x";
		$q=$con->prepare($sql);
		$q->execute(array("x"=>$_GET["id"]));
		$info=$q->fetch();
		 
       	  break;
          case "delete":
		  $sql="DELETE FROM `order` where id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-danger'>one row  Deleted</h3>";
		  
       	  break;
    			  
		   
	   }
	   
	   
   }

?>

    <div class="navbar-default sidebar" role="navigation">                  
        <div class="sidebar-nav">
            <ul class="nav" id="side-menu">   
                 <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> <span class="ttspan-fill">Dashboard</span></a>
                </li>
							<li>
                    <a href="order.php"><i class="fa fa-tasks fa-fw"></i> <span class="ttspan-fill">Orders</span></a>
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
            <h1 class="page-header"><i class='fa fa-tasks'></i>Orders</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<?php
 
 

?>		
 <div id="fullscreen_bg" class="fullscreen_bg"/>
 <form class="form-signin" method="POST">
	<div class="container" >
    <div class="row">
        <div class="col-12-sx">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
				<h3 class="text-center"><i class='fa fa-plus-circle'></i> Add New Order</h3>
        
        <div class="panel-body">   
        
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="cname" placeholder="Payment" <?php if (isset($info['cname'])) echo "value=".$info['cname'];?> />
				<?php if(isset($errors['cname'])) echo $errors['cname'] ?>
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="password" class="form-control" name="password" placeholder="Password" <?php if (isset($info['password'])) echo "value=".$info['password'];?> />
				<?php if(isset($errors['password'])) echo $errors['password'] ?>
			</div>
		</div>
		
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				 <select name="u_id" >
                               <option value="0">User ID</option>
                               <?php 
                               	$sql="select * from user";
	         	$q=$con->prepare($sql);
	         	$q->execute();
                                 foreach($q->fetchall() as $user)
                                 {
                                     echo "<option value='".$user['id']."'>".$user['name']. "</option>";
                                 }
                               ?>
                           </select>
			</div>
		
		
		
			 <input class="btn btn-lg btn-primary btn-block" type="submit" value='Save' name='save'/> 
      </div>
       </div>
        </div>
    </div>
</div>
</form>
</div> 
   
    <div class="row">
        <div class="col-xs-12">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-tasks fa-fw"></i> Categories
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                Actions
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#">Action</a>
                                </li>
                                <li><a href="#">Another action</a>
                                </li>
                                <li><a href="#">Something else here</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
<!-- /.panel-heading -->
<div class="panel-body">
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
<table class="table table-bordered table-hover table-striped" >
<thead >
	<tr >
		<th>id</th>
		<th>date</th>
		<th >payment</th>
		<th >password</th>
			<th >user id</th>
		<th colspan='' style='text-align:center'>Actions</th>
</tr>
</thead>
<tbody>
	<?php
	
	
	$sql="SELECT * FROM `order`";
		$q=$con->prepare($sql);
		$q->execute();
			
								
							

							
			foreach($q->fetchall() as $row )
			{
				$id=$row["id"];//[0]
				$date=$row["date"];//[1]
				$payment=$row["payment"];
				
				$password=$row["password"];//[0]
				$u_id=$row["u_id"];
				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$date</td>";
				echo "<td>$payment</td>";
				echo "<td>$password</td>";
				
				echo "<td>$u_id</td>";
				echo "<td>";
				echo "<a href='?action=edit&id=$id' class='btn btn-success'> <i class='fa fa-edit'> </i></a> ";
				echo "<a id='delete' href='?action=delete&id=$id' class='btn btn-danger'> <i class='fa fa-trash'></i> </a> ";
				echo "</td>";
				echo "</tr>";
				
			}
		
							
				
	?>
</tbody>
</table>
</div>
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
                            <!-- /.table-responsive -->
                        </div>
                       
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          
        </div>
        <!-- /.col-lg-8 -->
       
    </div>
    <!-- /.row -->
</div>         
</div>

<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
<script>
$(function () {
    'use strict';
$('#delete').click(function(){
    return confirm('Are You Sure!!!');
});
});
</script>
</body>
</html>