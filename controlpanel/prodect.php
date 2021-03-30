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
            <a class="dropdown-toggle" data-toggle="dropdown" href="">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href=""><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION['UserName']; ?></a>
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
            <h1 class="page-header"><i class='fa fa-tasks'></i>Prodect</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
<!--===============================================================================-->
<!--===============================================================================-->
<!--===============================================================================-->
<!--===============================================================================-->
	<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
		
		$name=$_FILES['img']['name']; //خاص بالصوره
		$type=$_FILES['img']['type'];
		$tmp=$_FILES['img']['tmp_name'];
		$size=$_FILES['img']['size'];
		$error=$_FILES['img']['error'];
		 
		if(!empty($name))
        {
			$dest_file=rand(1,10000).'_'.$name;
			$mytypes=array("png","jpg","jpeg","gif");
			$ext=explode(".",$name);
			$ext=strtolower(end($ext));
				$imge_db="images/$name";
			if(in_array($ext,$mytypes)){
				if($size<=2000000)
				{
					
					move_uploaded_file($tmp,"images/$dest_file");
					
			    }
							
				else
					{
						
			$errors['imgsize']="<span style='color:red'><b>Maximum size:2M</b></span>";
						
					}
			}
			else{
				
			$errors['imgtype']="<span style='color:red'><b>Invalid Type</b></span>";
				
			}
		}
		else
		{	
			$errors['imgname']="<span style='color:red'><b>Choose File</b></span>";	
		}
		
		if(empty($_POST['Price'])) //خاص ب السعر
		{
		$errors['Price']="<span style='color:red'><b>Must Insert Price</b></span>";
		}
		
		
		if(empty($_POST['name'])) //خاص بالوصف
        {
		$errors['name']="<span style='color:red'><b>Must Insert name</b></span>";
		}
		
		if(!isset($errors))
			{
				echo "<script>alert('done');</script>";
			}
		
		
		if(!isset($errors) && (!isset($_GET['action']) || $_GET['action']!="edit"))
		{
			$sql="insert into prodect(img,price,name,user_id) values (:x1,:x2,:x3,:x4)";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$dest_file,"x2"=>$_POST["Price"],"x3"=>$_POST["name"],"x4"=>$_POST["member"]));
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
		 $sql="UPDATE
                                prodect
                              SET 
                                  img=:x1,
                                  price=:x2,
                                  name=:x3,
								  user_id=:x4,
								  date=now()
                                  WHERE 
                                    id=:x5 ";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$dest_file,"x2"=>$_POST["Price"],"x3"=>$_POST["name"],"x4"=>$_POST["member"],"x5"=>$_GET["id"]));
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
		  	$sql="select img,price,name from prodect where id=:x";
		$q=$con->prepare($sql);
		$q->execute(array("x"=>$_GET["id"]));
		$info=$q->fetch();
		 
       	  break;
          case "delete":
		  $sql="delete from  prodect where id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-danger'>one row  Deleted</h3>";
		  
       	  break;
    	  case "active":
		   $sql="update  prodect set active=1 where id=:x";
							$q=$con->prepare($sql);
							$q->execute(array("x"=>$_GET["id"]));
		  if($q->rowcount()==1)
			  echo "<h3 class='alert alert-info'>one row  active</h3>";
		  
       	  break;
       
    	  case "inactive":
		   $sql="update  prodect set active=0 where  id=:x";
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
	
	
	
	<div id="fullscreen_bg" class="fullscreen_bg"/>

 <form class="form-signin" method="post" enctype="multipart/form-data">
	<div class="container" style='width:970px'>
    <div class="row">
        <div class="col-12-sx">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
		<h3 class="text-center"><i class='fa fa-plus-circle'></i> Add New Prodect</h3>
        
        <div class="panel-body">   
        
		
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags" required></span>
				</span>
				<input type="file" class="form-control" name="img" <?php if (isset($info['img'])) echo "value=".$info['img'];?> />
				<?php if(isset($errors['imgname'])) echo $errors['imgname'] ?>
				<?php if(isset($errors['imgtype'])) echo $errors['imgtype'] ?>
				<?php if(isset($errors['imgsize'])) echo $errors['imgsize'] ?>
				
			</div>
		</div>
		
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="Price" placeholder="Price"  <?php if (isset($info['price'])) echo "value=".$info['price'];?> required />
				<?php if(isset($errors['Price'])) echo $errors['Price'] ?>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				<input type="text" class="form-control" name="name" placeholder="Name The Prodect"  <?php if (isset($info['name'])) echo "value=".$info['name'];?> required />
				<?php if(isset($errors['name'])) echo $errors['name'] ?>
			</div>
		</div>
			<div class="form-group">
			<div class="input-group">
				
					<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span>
				</span>
				 <select name="member" >
                               <option <?php if (isset($info['member'])) echo "value=".$info['member'];?>>...</option>
                               <?php 
                               	$sql="select * from user where permission=1";
	         	$q=$con->prepare($sql);
	         	$q->execute();
                                 foreach($q->fetchall() as $user)
                                 {
                                     echo "<option value='".$user['id']."'>".$user['name']. "</option>";
                                 }
                               ?>
                           </select>
			</div>
		</div>
			</div>
		</div>
		
	
		
			<input class="btn btn-lg btn-primary btn-block" type="submit" value='Save' name='save'>
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
		<i class="fa fa-tasks fa-fw"></i> Prodects
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
			<th>id</th>
			<th>price</th>
			<th >img</th>
			<th >date</th>
			<th >Name The Prodects</th>
			<th colspan='' style='text-align:center'>Actions</th>
	 </tr>
	</thead>
	<tbody>
			  <?php
	
	
	$sql="select * from prodect";
		$q=$con->prepare($sql);
		$q->execute();
			//echo $q->rowcount();
		if($q->rowcount())
		{
			foreach($q->fetchall() as $row )
			{
				$id=$row["id"];//[0]
				$price=$row["price"];//[1]
				$img=$row["img"];
				$date=$row["date"];//[0]
				$name=$row["name"];
				echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$price</td>";
			
				
				 echo "<td>";

         echo "<img src='images/".$row['img']." '  width=50px alt =''/>";
		
         
		  echo "</td>";
				echo "<td>$date</td>";
				echo "<td>$name</td>";
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
<!--===============================================================================-->
<!--===============================================================================-->
<!--===============================================================================-->
<!--===============================================================================-->
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