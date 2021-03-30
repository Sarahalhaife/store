<?php
session_start();
$act["login"]="active";
$title="Store"; 
include "header.php";
require("controlpanel/db.php");

?>
<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/cover-img-1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner text-center">
				   					<h1>Login</h1>
				   					<h2 class="bread"><span><a href="index.php">Home</a></span> <span>Login</span></h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		
<?php
//هذا حق الرسائل التحذيريه
if(isset($_POST['send'])){
	
 if(isset($_POST['Name']))
 {
	 if(!empty($_POST['Name']))
 {
	$filterUser = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
             if(strlen($filterUser)<3) //يتاكد اذا كان الاسم اقل من 3 حروف يرجع له رسالة انه لازم يكون اكثر
             {
                  $errors['NameCheck']="<span style='color:red'><b>Must Your Name More than 3 Word </b></span>";
             } 
	 
}
else
{
			$errors['Name']="<span style='color:red'><b>Must Insert Your name</b></span>";
}
 }
  if(isset($_POST['E-mail']))
 {
	 if(!empty($_POST['E-mail']))
	 {
 $filterEmail = filter_var($_POST['E-mail'], FILTER_SANITIZE_EMAIL);//يتاكد اذا كان ايميل
             if( filter_var($filterEmail, FILTER_VALIDATE_EMAIL)!=true)
             {
                $errors['E-mailCheak'] ="<span style='color:red'><b>Must Insert Email</b></span>";
             }
	 }
         else
          $errors['E-mail']="<span style='color:red'><b>Must Insert Your Email</b></span>";
          
}		

 if(empty($_POST['Password']))
{
			$errors['Password']="<span style='color:red'><b>Must Insert Your Password</b></span>";
           
}		

	
	 if(!isset($errors))
			{
				echo "<script>alert('done');</script>";
			}
			$sql="select * from user where
                                name=:x1
                         
                        ";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST['Name']));
							if($q->rowcount())
								  {    

                     echo '<script>alert("this user is using ")</script>';  
         
            }
                else 
            {
				
				//$salt="45poklj".$_POST["Password"];
				//$hash= hash('sha512',$salt);
				$pass=password_hash($_POST["Password"], PASSWORD_DEFAULT);
				$sql="insert into user(name,password,email) values (:x1,:x2,:x3)";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST["Name"],"x2"=>$pass,
							"x3"=>$_POST["E-mail"]));
							
				$sql="select * from user where
                                name=:x1  and
                                password=:x2
                         
                        ";
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST['Name'],"x2"=>$pass));
							if($q->rowcount()){
          
                   
 
            header('Location: index.php');
                 
	 
            exit();
        }	
			}
		

}



if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['go']))
{
	if(isset($_POST['names']))
{
		if(!empty($_POST['names']))
{
	$CheckUser = filter_var($_POST['names'],FILTER_SANITIZE_STRING);
             if(strlen($CheckUser)<3) //يتاكد اذا كان الاسم اقل من 3 حروف يرجع له رسالة انه لازم يكون اكثر
             {
                  $errors['NameCheck']="<span style='color:red'><b>Must Your Name More than 3 Word </b></span>";
             } 
			 setcookie('name',$_POST['names'],time()+3600 , '/');
	
}
			else	 
			$errors['names']="<span style='color:red'><b>Must Insert Your Email</b></span>";
           
}
 		
	
		if(empty($_POST['Password1']))
{
			$errors['Password1']="<span style='color:red'><b>Must Insert Your Password </b></span>";
           
		    
}
else{
	setcookie('Pass',$_POST['Password1'],time()+3600 , '/');
}
	
  // $hashPassword=sha1($password);
 
  
     	$sql="select * from user where
                                name=:x1
                         and
                          
                               active=1";
						
							$q=$con->prepare($sql);
							$q->execute(array("x1"=>$_POST['names']));
							if($q->rowcount())
							{
								$row=$q->fetch();
								  $pass=$row['password'];
								  $v= password_verify( $_POST['Password1'],$pass );
								  if($v)
								  {
								if($row['permission']==1)
								{
									$_SESSION['UserName']=$_POST['names'];
									$_SESSION['role']=1;
									header("LOCATION:controlpanel/dashboard.php");
								
									
								}
								else
								{
									
									$_SESSION['UserName']=$_POST['names'];
									$_SESSION['role']=0;
									//header("LOCATION:index.php");
								}
									
							}
							else
							 {
								 echo "<script>alert('Wrong user name or Password');</script>";
							 }
							}
							 
							
						
}}



	
	
	
	
	
	


?>



			<div id="colorlib-contact">
					<div class="modal-content modal-info">
						
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
								<div class="login-bottom">
										<h3>Sign up for free</h3>
										<form action="" method="post">
                                        <div class="sign-up">
                                         	<h4>Name :</h4>
<input type="text" name="Name" >
<?php if(isset($errors['Name'])) echo $errors['Name'] ?>
<?php if(isset($errors['NameCheck'])) echo $errors['NameCheck'] ?>


                                                   </div>
											<div class="sign-up">
												<h4>Email :</h4>
					<input type="email" name="E-mail" style="padding-bottom:14px;padding-right:135px;border:1px solid #E7E7E7;margin-top:7px;margin-bottom:20px;" value=""  >
                    	<?php if(isset($errors['E-mail'])) echo $errors['E-mail'] ?>
                    	<?php if(isset($errors['E-mailCheak'])) echo $errors['E-mailCheak'] ?>
											</div>
											<div class="sign-up">
						<h4>Password :</h4>
						<input type="password" name="Password" value=""  >
 						<?php if(isset($errors['Password'])) echo $errors['Password'] ?>						
				</div>
		   
<div class="sign-up">
<input type="submit" value="REGISTER NOW" name="send"  >
											</div>
											
										</form>
									</div>
									<div class="login-right">
								<h3>Sign in with your account</h3>
										 <form action="#" method="post">
		<div class="sign-up">
                                         	<h4>Name :</h4>
<input type="text" name="names" >
<?php if(isset($errors['names'])) echo $errors['names'] ?>
<?php if(isset($errors['NamesCheck'])) echo $errors['NamesCheck'] ?>


                                                   </div>			
         										
											<div class="sign-in">
								<h4>Password :</h4>
								<input type="password" name="Password1" value=""   >
								<?php if(isset($errors['Password1'])) echo $errors['Password1'] ?>	
         											
											</div>
											
											</div>
											
                                   <div class="form-group text-center">
			<input type="submit" value="SIGNIN" name="go" class="btn btn-primary">
								   </div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<br>
		<p align='center'>By logging in you agree to our Terms and Conditions and Privacy Policy...</p>
		</div>
						</div>
					</div>
				
			
<?php

include "footer.php";
?>
	