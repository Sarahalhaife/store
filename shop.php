<?php
$title="Store"; 
$act["shop"]="active";
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
				   					<h1>Products</h1>
				   					<h2 class="bread"><span><a href="index.html">Home</a></span> <span>Shop</span></h2>
				   				</div>
				   			</div>
				   		</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>



		<?php
		
		/*
		$hbd= @mysql_connect('localhost','root','');
		mysql_select_db('store');
		mysql_query('SET NAMES "utf8"');
		
		if(!isset($_GET['page']))
			$page=1;
		else
			$page=(int)$_GET['page'];
		
		$records_at_page=12;
		$q=mysql_query('SELECT * FROM prodect'); 
		

		$records_count =@mysql_num_rows($q);
		@mysql_free_result($q);
		
		$pages_count  = (int)ceil($records_count / $records_at_page);
		
		if(($page > $pages_count) || ($page <=0)){
			mysql_close($hbd);
			die('NO More Pages');
		}
		
		$start=($page -1) * $records_at_page;
		$end=$records_at_page;
		
		if($records_count != 0){
			$q=mysql_query("SELECT * FROM prodect LIMIT $start,$end");
			while($o=mysql_fetch_object($q)){
				echo $o -> img.'<br/>';
			}
		}
		
		echo '<br/>';
		
		//print out links
		for($i=1;$i <=$pages_count;$i++){
			if($page==$i)
				echo $page;
			else
				echo '<a href="shop.php?page='.$i.'">'.$i.'</a>';
			
			if($i != $pages_count)
				echo ' - ';
		}
		
		mysql_close($hbd);  
		 
		*/
		?>
		<div class="colorlib-shop">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-push-2">
						<div class="row row-pb-lg">
								
								<?php
								$sql="SELECT * FROM `prodect` where active=1";
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
		
		
	<!-------------------------------------------
							<div class="col-md-4 text-center">

	<div class="product-entry">
									<div class="product-img" style="background-image: url(controlpanel/images/);">
										<p class="tag"><span class="new">New</span></p>
										<div class="cart">
											<p>
												<span class="addtocart"><a href="cart.php"><i class="icon-shopping-cart"></i></a></span> 
												
											</p>
										</div>
									</div>
									<div class="desc">
										<h3><a href="product-detail.html"></a></h3>
										<p class="price"><span></span></p>
									</div>
								</div>
</div-->
<?php

}
		
		?>
		
					
					
					</div>
				</div>
			</div>
		</div>
    </div>
<?php
require "footer.php";
?>
