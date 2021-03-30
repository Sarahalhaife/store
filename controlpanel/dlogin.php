<?php 
session_start();
$act["login"]="active";
$title="dLogin"; 
require("db.php");
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php  echo $title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">
	
	
	
	
<!-- New -->
<link href="css/bootstrap (2).css" rel="stylesheet" type="text/css" media="all" />
<!-- pignose css -->
<link href="css/pignose.layerslider (2).css" rel="stylesheet" type="text/css" media="all" />


<!-- //pignose css -->
<link href="css/style (2).css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="colorlib-loader"></div>

	<div id="page">
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="index.php">Store</a></div>
						</div>
		
<?php
//هذا حق الرسائل التحذيريه
	


//check if the user coming from post 
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['go']))
{
	if(isset($_POST['name']))
{
		if(!empty($_POST['name']))
{
	$CheckUser = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
             if(strlen($CheckUser)<3) //يتاكد اذا كان الاسم اقل من 3 حروف يرجع له رسالة انه لازم يكون اكثر
             {
                  $errors['NameCheck']="<span style='color:red'><b>Must Your Name More than 3 Word </b></span>";
             } 
}
			else	 
			$errors['name']="<span style='color:red'><b>Must Insert Your Email</b></span>";
           
}
 		
	
		if(empty($_POST['password']))
{
			$errors['password']="<span style='color:red'><b>Must Insert Your Password </b></span>";
           
		    
}
	
  // $hashPassword=sha1($password);
 
  
     	$sql="select * from  user   where
                                name=:x1
                        
                         and
                               active=1";
							  
		$q=$con->prepare($sql);
		$q->execute(array("x1"=>$_POST['name']));
		$info=$q->fetch();
        $pass=$info['password'];
        
//if count >0 this mean the Database contain record about this username
   if( $q->rowcount())
   { 
     $v= password_verify( $_POST['password'],$pass );
		if($v){
        $_SESSION['UserName']=$_POST['name']; 
        $_SESSION['ID']=$info['id'] ;
      header('Location: dashboard.php');
       exit();
    }}
	else 
	{
		
		  header("Location: dlogin.php");
		  exit();
	}




}}

?>

	<div id="colorlib-contact">
					<div class="modal-content modal-info">
						
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
								<div class="login-bottom">
										<h3>Hello In The Controlpanel</h3>
									
									</div>
									<div class="login-right">
								<h3>Sign in with your account</h3>
										 <form action="" method="post">
										 <div class="sign-in">
							<h4>name :</h4>
		<input type="text" name='name' value="" style="padding-bottom:14px;padding-right:135px;border:1px solid #E7E7E7;margin-top:7px;margin-bottom:20px;"  >
                            <?php if(isset($errors['name'])) echo $errors['name'] ?>	
                             <?php if(isset($errors['NameCheck'])) echo $errors['NameCheck'] ?>							
         										</div>
											<div class="sign-in">
								<h4>Password :</h4>
								<input type="password" name='password' value="" style="padding-bottom:14px;padding-right:135px;border:1px solid #E7E7E7;margin-top:7px;margin-bottom:20px;"   >
								<?php if(isset($errors['password'])) echo $errors['password'] ?>	
         											
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
		<!--p align='center'>By logging in you agree to our Terms and Conditions and Privacy Policy...</p-->
		</div>
						</div>
					</div>	
					<?php

include "footer.php";
?>
					