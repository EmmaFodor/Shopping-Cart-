<?php
//conectare baza de date
include("conectare_proiect.php");
//modificarea datelor
//se preia id din pagina de vizualizare
$error='';
if(!empty($_POST['id']))
{
	if(isset($_POST['submit']))
	{
		//verificam daca id-ul din URL este unul valid
		if(is_numeric($_POST['id']))
		{
			//preluam variabilele din URL/form
			$id=$_POST['id'];
			$prod_id=htmlentities($_POST['prod_id'],ENT_QUOTES);
			$cantitate=htmlentities($_POST['cantitate'],ENT_QUOTES);
			$client_id=htmlentities($_POST['client_id'],ENT_QUOTES);
			
			//verificam daca sunt completate
			if($prod_id=='' || $cantitate=='' || $client_id=='')
			{
				//daca sunt goale se afiseaza un mesaj
				$error='ERROR: Campuri goale!';
			}
			else
			{ 
				// daca nu sunt erori se face update 
				if ($stmt = $mysqli->prepare("UPDATE cos SET prod_id=?, cantitate=?, client_id=? WHERE cos_id='".$id."'"))
					{
						$stmt->bind_param("iii", $product_id, $quantity, $client_id);
						$stmt->execute();
						$stmt->close();
					}
			 // mesaj de eroare in caz ca nu se poate face update
			else
			{
				echo "ERROR: nu se poate executa update.";}
			}
			}
	//daca variabila 'id' nu este valida, afisam mesaj de eroare
	else
	{
		echo "id incorect!";
	}
    }
}
?>
<html>
<head>
<title><?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
</head>
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
<div>
<?php if ($_GET['id'] != '') { ?>
<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
<p>ID: <?php echo $_GET['id'];
if ($result = $mysqli->query("SELECT * FROM cos where cos_id='".$_GET['id']."'"))
{
	if ($result->num_rows > 0)
	{ 
		$row = $result->fetch_object();?></p>
		<strong>Produs ID: </strong> <input type="text" name="prod_id" value="<?php echo$row->prod_id;?>"/><br/>
		<strong>Cantitate: </strong> <input type="text" name="cantitate" value="<?php echo$row->cantitate;?>"/><br/>
		<strong>Client ID: </strong> <input type="text" name="client_id" value="<?php echo$row->client_id;
        }}}?>"/><br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_cos.php">Index</a>
</div>
</form>
</body>
</html>