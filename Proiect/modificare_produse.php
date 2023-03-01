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
			$id=$_POST['id'];
			$denumire=htmlentities($_POST['denumire'],ENT_QUOTES);
			$brand=htmlentities($_POST['brand'],ENT_QUOTES);
			$cod=htmlentities($_POST['cod'],ENT_QUOTES);
			$pret=htmlentities($_POST['pret'],ENT_QUOTES);
			$cantitate=htmlentities($_POST['cantitate'],ENT_QUOTES);
			$stoc=htmlentities($_POST['stoc'],ENT_QUOTES);
			$descriere=htmlentities($_POST['descriere'],ENT_QUOTES);
			$categorie=htmlentities($_POST['categorie'],ENT_QUOTES);
			$imagine=htmlentities($_POST['imagine'],ENT_QUOTES);
			$stare=htmlentities($_POST['stare'],ENT_QUOTES);
			

			//verificam daca sunt completate
			if($denumire=='' || $brand=='' || $cod=='' || $pret=='' || $cantitate=='' || $stoc=='' || $descriere=='' || $categorie=='' || $imagine=='' || $stare =='')
			{
				//daca sunt goale se afiseaza un mesaj
				$error='ERROR: Campuri goale!';
			}
			else
			{ 
				// daca nu sunt erori se face update 
				if ($stmt = $mysqli->prepare("UPDATE produse SET denumire=?, brand=?, cod=?, pret=?, cant=?, stoc=?, descriere=?, categorie=?, imagine=?, stare=? WHERE produs_id='".$id."'"))
					{
						$stmt->bind_param("sssdsissss", $denumire, $brand, $cod, $pret, $cantitate, $stoc, $descriere, $categorie, $imagine, $stare);
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
if ($result = $mysqli->query("SELECT * FROM produse where produs_id='".$_GET['id']."'"))
{
	if ($result->num_rows > 0)
	{ 
		$row = $result->fetch_object();?></p>
		<strong>Denumire: </strong> <input type="text" name="denumire" value="<?php echo$row->denumire;?>"/><br/>
		<strong>Brand: </strong> <input type="text" name="brand" value="<?php echo$row->brand;?>"/><br/>
		<strong>Cod: </strong> <input type="text" name="cod" value="<?php echo$row->cod;?>"/><br/>
		<strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret;?>"/><br/>
		<strong>Cantitate: </strong> <input type="text" name="cantitate" value="<?php echo$row->cant;?>"/><br/>
		<strong>Stoc: </strong> <input type="text" name="stoc" value="<?php echo$row->stoc; ?>"/><br/>
		<strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo $row->descriere;?>"/><br/>
		<strong>Categorie: </strong> <input type="text" name="categorie" value="<?php echo$row->categorie; ?>"/><br/>
		<strong>Imagine: </strong> <input type="text" name="imagine" value="<?php echo$row->imagine; ?>"/><br/>
		<strong>Stare: </strong> <input type="text" name="stare" value="<?php echo$row->stare;}}}?>"/><br/>
        <br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_produse.php">Index</a>
</div>
</form>
</body>
</html>