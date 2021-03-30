<?php
$act["cart"]="active";
$title="Store"; 
include "header.php";
require("controlpanel/db.php");
 session_start();

  
 if(isset($_POST["addToCard"]))  
 {  
      if(isset($_SESSION["cart"]))  
      {  
           $item_array_id = array_column($_SESSION["cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["cart"]);  
                $item_array = array(  
                     'item_id'             =>     $_GET["id"],  
                     'item_name'           =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'       =>     $_POST["quantity"],
                     'item_img'            =>     $_POST["hidden_img"]
                );  
                $_SESSION["cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("المنتج قد اضيف سابقاًً")</script>';  
                echo '<script>window.location="shop.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'             =>     $_POST["hidden_name"],  
                'item_price'            =>     $_POST["hidden_price"],  
                'item_quantity'         =>     $_POST["quantity"],
                'item_img'              =>     $_POST["hidden_img"]
           );  
           $_SESSION["cart"][0] = $item_array;  
      }  
 }  

 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["cart"][$keys]);  
                     echo '<script>alert("One Product Deleted")</script>';  
                
                }  
           }  
      }  
 }  
?>
		<aside id="colorlib-hero" class="breadcrumbs">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/cover-img-1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
				   				
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row row-pb-md">
					<div class="col-md-10 col-md-offset-1">
						<div class="process-wrap">
							<div class="process text-center active">
								<p><span>01</span></p>
								<h3>Shopping Cart</h3>
							</div>
							<div class="process text-center">
								<p><span>02</span></p>
								<h3>Checkout</h3>
							</div>
							<div class="process text-center">
								<p><span>03</span></p>
								<h3>Order Complete</h3>
							</div>
						</div>
					</div>
				</div>


				<div class="row row-pb-md">
					<div class="col-md-10 col-md-offset-1">
						<div class="product-name">
							<div class="one-forth text-center">
								<span>Product Details</span>
							</div>
							<div class="one-eight text-center">
								<span>Price</span>
							</div>
							<div class="one-eight text-center">
								<span>Quantity</span>
							</div>
							<div class="one-eight text-center">
								<span>Total</span>
							</div>
							<div class="one-eight text-center">
								<span>Remove</span>
							</div>
						</div>
						<div class="product-cart">
						 <?php   
                          if(!empty($_SESSION["cart"]) )  
                          {  
                               $total = 0;  
                               foreach($_SESSION["cart"] as $keys => $values)  
                               {  
                                   if ($values["item_quantity"] > 0){
                          ?> 
						     
                         	<div class="product-cart">
							<div class="one-forth">
								<div class="product-img" style="background-image: url(controlpanel/images/<?php  echo $values["item_img"];  ?>);">
								</div>
								<div class="display-tc">
									<h3><?php echo $values["item_name"]; ?></h3>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$ <?php echo $values["item_price"]; ?></span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="<?php echo $values["item_quantity"]; ?>" min="1" max="100">
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<span class="price">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></span>
								</div>
							</div>
							<div class="one-eight text-center">
								<div class="display-tc">
									<a  href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>" class="closed"></a>
								</div>
							</div>
						</div>
					
                              
                              
                          
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               } } 
                          ?>  
                        	 

                          
						  </div>
						  
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="total-wrap">
							<div class="row">
								<div class="col-md-8">
									<form action="#">
										<div class="row form-group">
											<div class="col-md-9">
												<input type="text" name="quantity" class="form-control input-number" placeholder="Your Coupon Number...">
											</div>
											<div class="col-md-3">
												<input type="submit" value="Apply Coupon" class="btn btn-primary">
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-3 col-md-push-1 text-center">
									<div class="total">
									
										<div class="grand-total">
											<p><span><strong>Total:</strong></span> <span><?php echo number_format($total, 2); ?></span></p>
										</div>
										 <?php  
                          }  
                          ?> 
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	

<?php

require "footer.php";
?>


