<?php
require_once "ShoppingCart.php";?>
<HTML>
<HEAD>
<TITLE>Parfumuri</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
<div id="product-grid">
 <div class="txt-heading"><div class="txt-headinglabel">Produse</div>
</div>
 <?php
	 $shoppingCart = new ShoppingCart();
	 $query = "SELECT * FROM produse";
	 $product_array = $shoppingCart->getAllProduct($query);
	if (! empty($product_array)) {
		foreach ($product_array as $key => $value) {
					?>
			 <div class="product-item">
			 <form method="post" action="cos.php?action=add&code=<?php echo $product_array[$key]["cod"]; ?>">
			 <div class="product-image">
			 <img src="<?php echo $product_array[$key]["imagine"];?>"width="20%" height="25%">
			 <div>
				<strong><?php echo $product_array[$key]["denumire"];?></strong>
			 </div>
 <div class="product-price"><?php echo "$".$product_array[$key]["pret"]; ?></div>
 <div>
	 <input type="text" name="quantity" value="1" size="2" />
	 <input type="submit" value="Add to cart" class="btnAddAction" />
 </div>
 </form>
 </div>
 <?php
 }
 }
 ?>
</div>
</BODY>
</HTML>