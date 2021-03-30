<?php
session_start();
$act["index"]="active";
$title="Store"; 
include "header.php";
require("controlpanel/db.php");
?>
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
			   	<li style="background-image: url(images/img_bg_1.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Men's</h1>
					   					<h2 class="head-2">Jeans</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New stylish shirts, pants &amp; Accessories</span></p>
					   					<p><a href="shop.php" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			   	<li style="background-image: url(images/img_bg_2.jpg);">
			   		<div class="overlay"></div>
			   		<div class="container-fluid">
			   			<div class="row">
				   			<div class="col-md-6 col-md-offset-3 col-md-pull-2 col-sm-12 col-xs-12 slider-text">
				   				<div class="slider-text-inner">
				   					<div class="desc">
					   					<h1 class="head-1">Huge</h1>
					   					<h2 class="head-2">Sale</h2>
					   					<h2 class="head-3">Collection</h2>
					   					<p class="category"><span>New stylish shirts, pants &amp; Accessories</span></p>
					   					<p><a href="shop.php" class="btn btn-primary">Shop Collection</a></p>
				   					</div>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="colorlib-featured-product">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<a href="shop.php" class="f-product-1" style="background-image: url(images/item-1.jpg);">
							<div class="desc">
								<h2>Fahion <br>for <br>men</h2>
							</div>
						</a>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<a href="shop.php" class="f-product-2" style="background-image: url(images/item-2.jpg);">
									<div class="desc">
										<h2>New <br>Arrival <br>Dress</h2>
									</div>
								</a>
							</div>
							<div class="col-md-6">
								<a href="shop.php" class="f-product-2" style="background-image: url(images/item-4.jpg);">
									<div class="desc">
										<h2>Sale</h2>
									</div>
								</a>
							</div>
							<div class="col-md-12">
								<a href="shop.php" class="f-product-2" style="background-image: url(images/item-3.jpg);">
									<div class="desc">
										<h2>Shoes <br>for <br>men</h2>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>New Arrival</span></h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
				
		<?php
		//----------------------------------------------------------------------------------------------
		//----------------------------------------------------------------------------------------------
								$sql="SELECT * FROM `prodect` where
                              active=1 order by id DESC LIMIT 3";
		$q=$con->prepare($sql);
		$q->execute();
		$info=$q->fetchall();
		foreach($info as $value){
?> <form method="post" action="cart.php?action=add&id=<?php echo  $value["id"]; ?>">
   <div class="col-md-4 text-center">

	<div class="product-entry">
       
        <div class="product-img" style="background-image: url(controlpanel/images/<?= $value['img']?>);">
		
           	
			
           
             <input type="hidden" name="hidden_name" value="<?php echo $value['name'];?>" >
            <input type="hidden" name="hidden_price" value="<?php echo  $value['price'];?>" >
            <input type="hidden" name="hidden_img" value="<?php echo  $value['img'];?>">
			
				<div class="cart">
         <input type="submit" name="addToCard" value="Add To Cart" class="addtocart"><a href="cart.php"></a>
          </div>
         </div>
		 <div class="desc">
										<h3><a href="product-detail.html"><?= $value['name']?></a></h3>
										<p class="price"><span><?="$".$value['price'].".00"?></span></p>
										 <input type="text" name="quantity"  placeholder="" value="1">
									</div>
        </div>
    </div>
        </form>
					<?php

}
		
		?>
		</div>			
		</div>			
		</div>			
		<div id="colorlib-intro" class="colorlib-intro" style="background-image: url(images/cover-img-1.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="intro-desc">
							<div class="text-salebox">
								<div class="text-lefts">
									<div class="sale-box">
										<div class="sale-box-top">
											<h2 class="number">Shop</h2>
											
										</div>
										<h2 class="text-sale">Now</h2>
									</div>
								</div>
								<div class="text-rights">
									<h3 class="title">Just hurry up limited offer!</h3>
									<p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
									<p><a href="shop.php" class="btn btn-primary">Shop Now</a> </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
						<h2><span>Our Products</span></h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
				<?php
		//----------------------------------------------------------------------------------------------
		//----------------------------------------------------------------------------------------------
								$sql="SELECT * FROM `prodect` where
                              active=1 order by id ASC LIMIT 3";
		$q=$con->prepare($sql);
		$q->execute();
		$info=$q->fetchall();
		foreach($info as $value){
?>
					<form method="post" action="cart.php?action=add&id=<?php echo  $value["id"]; ?>">
   <div class="col-md-4 text-center">

	<div class="product-entry">
       
        <div class="product-img" style="background-image: url(controlpanel/images/<?= $value['img']?>);">
		
           	
			
           
             <input type="hidden" name="hidden_name" value="<?php echo $value['name'];?>" >
            <input type="hidden" name="hidden_price" value="<?php echo  $value['price'];?>" >
            <input type="hidden" name="hidden_img" value="<?php echo  $value['img'];?>">
			
				<div class="cart">
         <input type="submit" name="addToCard" value="Add To Cart" class="addtocart"><a href="cart.php"></a>
          </div>
         </div>
		 <div class="desc">
										<h3><a href="product-detail.html"><?= $value['name']?></a></h3>
										<p class="price"><span><?="$".$value['price'].".00"?></span></p>
										 <input type="text" name="quantity"  placeholder="" value="1">
									</div>
        </div>
    </div>
        </form>
					<?php

}
		
		?>
		</div>			
		</div>			
		</div>			
					

		

		
<?php
require "footer.php";
?>
