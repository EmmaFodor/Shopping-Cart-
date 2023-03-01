<?php
require_once "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare ...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
// pt membrii inregistrati
$member_id=$_SESSION['loggedin'];
$shoppingCart = new ShoppingCart();
if (! empty($_GET["action"])) {
 switch ($_GET["action"]) {
	 case "add":
	 if (! empty($_POST["quantity"])) {

			$productResult = $shoppingCart->getProductByCode($_GET["code"]);
			$cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["produs_id"], $member_id);

	if (! empty($cartResult)) {
		 // Modificare cantitate in cos
		 $newQuantity = $cartResult[0]["cantitate"] + $_POST["quantity"];
		 $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["cos_id"]);
		} 
	else {
		 // Adaugare in tabelul cos
		 $shoppingCart->addToCart($productResult[0]["produs_id"], $_POST["quantity"], $member_id);
	}
  }
	break;
	case "remove":
		 // Sterg o sg inregistrare
		 $shoppingCart->deleteCartItem($_GET["id"]);
		 break;
	case "empty":
		 // Sterg cosul
		 $shoppingCart->emptyCart($member_id);
		 break;
 }
}
?>
<HTML>
<HEAD>
<TITLE>creare cos permanent in PHP</TITLE>
	<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>
	 <div id="shopping-cart">
	 <div class="txt-heading">
	 <div class="txt-heading-label">Cos Cumparaturi</div>
		<a id="btnEmpty" href="cos.php?action=empty">
			<img src="empty-cart.png" width="25px" height="25px" alt="empty-cart" title="Empty Cart" />
		</a>
	</div>
<?php
$cartItem = $shoppingCart->getMemberCartItem($member_id);
if (! empty($cartItem)) {
	$item_total = 0;
 ?>
<table cellpadding="15" cellspacing="1">
 <tbody>
	<tr>
		 <th style="text-align: left;"><strong>Nume</strong></th>
		 <th style="text-align: left;"><strong>Cod</strong></th>
		 <th style="text-align: right;"><strong>Cantitate</strong></th>
		 <th style="text-align: right;"><strong>Pret</strong></th>
		 <th style="text-align: center;"><strong>Action</strong></th>
	</tr>
<?php
 foreach ($cartItem as $item) {
	 echo "<table border='1' cellpadding='15'>";
 ?>
<tr>
 <td
	style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["denumire"]; ?></strong></td>
 <td
	style="text-align: left; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cod"]; ?></td>
 <td
	style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cantitate"]; ?></td>
 <td
	style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo "$".$item["pret"]; ?></td>
 <td
	style="text-align: center; border-bottom: #F0F0F0 1px solid;">
		<a href="cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>"class="btnRemoveAction"><img src="icon-delete.png" width="30px" height="30px" alt="icon-delete" title="Remove Item" /></a></td>
</tr>
<?php
	$item_total += ($item["pret"] * $item["cantitate"]);
 }
 ?>
<tr>
	 <td colspan="3" align=right><strong>Total:</strong></td>
	 <td align=right><?php echo "$".$item_total; ?></td>
	 <td></td>
 </tr>
 </tbody>
 </table>
 <?php
}
?>
</div>
<div><a href="magazin.php">Alegeti alt produs</a></div>
<div><a href="logout.php">Abandonati sesiunea de cumparare</a></div>
<?php //require_once "product-list.php"; ?>

</BODY>
</HTML>
