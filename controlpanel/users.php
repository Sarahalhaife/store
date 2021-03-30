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
				
							
        </div>
    </div>                             
</nav>  

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class='fa fa-users'></i> USERS</h1>
        </div>
        <!-- /.col-lg-12 -->
		
    </div>
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<!--======================================================================-->	
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
 {
	
	 if(empty($_POST['cname']))
			$errors['cname']="<span style='color:red'><b>Enter Your Name</b></span>";
		
		if(empty($_POST['password']))  
			$errors['password']="<span style='color:red'><b>Enter Your Password</b></span>";
			
			if(empty($_POST['mobile']))  
			$errors['mobile']="<span style='color:red'><b>Enter Your Mobile</b></span>";
		
		if(empty($_POST['Adderss']))  
			$errors['Adderss']="<span style='color:red'><b>Enter Your Adderss</b></span>";
		
		if(empty($_POST['Email']))  
			$errors['Email']="<span style='color:red'><b>Enter Your Email</b></span>";
		
		//if(empty($_POST['permission']))  
			//$errors['permission']="<span style='color:red'><b>Enter Your Permission</b></span>";
		
		if(!isset($errors) && (!isset($_GET['action']) || $_GET['action']!="edit"))
		{		$hash=password_hash($_POST["password"],PASSWORD_DEFAULT);
			$sql="INSERT INTO `user`( `name`, `password`, `mobile`, `address`, `email`,`permission`) VALUES (:x1,:x2,:x3,:x4,:x5,:x6)";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST["cname"],"x2"=>$hash,"x3"=>$_POST["mobile"],
							"x4"=>$_POST["Adderss"],"x5"=>$_POST["Email"],"x6"=>$_POST["permission"]));
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
		$hash =password_hash($_POST["password"],PASSWORD_DEFAULT);
				
		 $sql="UPDATE `user` SET
                                 `name`=:x1,
                                  `mobile`=:x2,
                                 `address`=:x3,
                                  `password`=:x4,
                                  `email`=:x5,
								 `permission`=:x6
                                  WHERE 
                                    id=:x7";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST["cname"],"x2"=>$_POST["mobile"],"x3"=>$_POST["Adderss"],"x4"=>$hash,"x5"=>$_POST["Email"],"x6"=>$_POST["permission"],"x7"=>$_GET["id"]));
		                  if($q->rowcount())
						  {
							  echo "<h4 class='alert alert-success'>One Row updated</h4>";
		                        $_GET['action']="";
                           }}
		
 }
   if(isset($_GET['action'],$_GET['id']))
   {
	   switch($_GET['action']){
		  case "edit":
		  	$sql="select name,password,mobile,address,email,permission from user where id=:x";
		$q=$con->prepare($sql);
		$q->execute(array("x"=>$_GET["id"]));
		$info=$q->fetch();
		 
       	  break;
          case "delete":
		  $sql="delete from  user where id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-danger'>one row  Deleted</h3>";
		  
       	  break;
    	  case "active":
		   $sql="update  user set active=1 where id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-info'>one row  active</h3>";
		  
       	  break;
       
    	  case "inactive":
		   $sql="update  user set active=0 where  id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-danger'>one row  inactive</h3>";
		  
     
       	  break;  		  
		  
		  default:
          	//echo "<script>alert('Error')</script>";		  
		   
	   }
	   
	   
	   
   }

?>

    <form class="form-signin" method="post" enctype="multipart/form-data">
	<div class="container" style='width:970px'>
    <div class="row">
        <div class="col-12-sx">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
		<h3 class="text-center"><i class='fa fa-plus-circle'></i>Add New User</h3>
        
        <div class="panel-body">   
        
		
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="text" class="form-control" name="cname" placeholder="Name" <?php if (isset($info['name'])) echo "value=".$info['name'];?> />
					<?php if(isset($errors['cname'])) echo $errors['cname'] ?>
				
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="password" class="form-control" name="password" placeholder="password" <?php if (isset($info['password'])) echo "value=".$info['password'];?> />
				<?php if(isset($errors['password'])) echo $errors['password'] ?>
				
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="text" class="form-control" name="mobile" placeholder="mobile" <?php if (isset($info['mobile'])) echo "value=".$info['mobile'];?> />
				<?php if(isset($errors['mobile'])) echo $errors['mobile'] ?>
				
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="text" class="form-control" name="Adderss" placeholder="Adderss" <?php if (isset($info['address'])) echo "value=".$info['address'];?> />
				<?php if(isset($errors['Adderss'])) echo $errors['Adderss'] ?>
			
			</div>
			<br/>	
			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="email" class="form-control" name="Email" placeholder="Email" <?php if (isset($info['email'])) echo "value=".$info['email'];?> />
				<?php if(isset($errors['Email'])) echo $errors['Email'] ?>
				
				
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="number" class="form-control" name="permission" placeholder="Permission" <?php if (isset($info['permission'])) echo "value=".$info['permission'];?> />
				<?php if(isset($errors['permission'])) echo $errors['permission'] ?>
				
				
			</div>
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
                    <i class="fa fa-users fa-fw"></i> Users
                    <div class="pull-right">
                       
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
                                            <th>ID</th>
                                            <th>User Name</th>
											<!--<th>password</th>-->
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th colspan='' style='text-align:center'>Permission</th>
                                            <th colspan='' style='text-align:center'>Actions</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
          <?php
	
	
	$sql="select * from user";
		$q=$con->prepare($sql);
		$q->execute();
		
		if($q->rowcount())
		{
			foreach($q->fetchall() as $row )
			{
				$id=$row["id"];//[0]
				$name=$row["name"];//[1]
				//$pass=$row["password"];
				$mobile=$row["mobile"];//[0]
				$addre=$row["address"];
				$email=$row["email"];
			    $per=$row["permission"];
				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$name</td>";
				//echo "<td>$pass</td>";
				echo "<td>$mobile</td>";
				echo "<td>$addre</td>";
				echo "<td>$email</td>";
				echo "<td>";
				if($per==1)
					echo "<b>Admin</b>";
				else
					echo "<b>User</b>";
				echo "</td>";
				echo "<td>";
				echo "<a href='?action=edit&id=$id' class='btn btn-success'> <i class='fa fa-edit'> </i></a> ";
				echo "<a id='delete' href='?action=delete&id=$id' class='btn btn-danger'> <i class='fa fa-trash'></i> </a> ";
		
				
				if($row['active']==0) 
				echo "<a href='?action=active&id=$id' class='btn btn-primary'><i class='fa fa-check'></i> </a> ";
			   else
				echo "<a href='?action=inactive&id=$id' class='btn btn-warning'><i class='fa fa-close'></i> </a> ";
				
	
				echo "</td>";
				echo "</tr>";
				
			}
		}
				
	?>
                                    </tbody>
                                </table>
                            </div>
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