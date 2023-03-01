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
			$nume=htmlentities($_POST['nume'],ENT_QUOTES);
			$prenume=htmlentities($_POST['prenume'],ENT_QUOTES);
			$email=htmlentities($_POST['email'],ENT_QUOTES);
			$telefon=htmlentities($_POST['telefon'],ENT_QUOTES);
			$tara=htmlentities($_POST['tara'],ENT_QUOTES);
			$judet=htmlentities($_POST['judet'],ENT_QUOTES);
			$oras=htmlentities($_POST['oras'],ENT_QUOTES);
			$strada=htmlentities($_POST['strada'],ENT_QUOTES);
			$cod_postal=htmlentities($_POST['cod_postal'],ENT_QUOTES);
			

			//verificam daca sunt completate
			if($nume=='' || $prenume=='' || $email=='' || $telefon=='' || $tara=='' || $judet=='' || $oras =='' || $strada =='' || $cod_postal =='')
			{
				//daca sunt goale se afiseaza un mesaj
				$error='ERROR: Campuri goale!';
			}
			else
			{ 
				// daca nu sunt erori se face update 
				if ($stmt = $mysqli->prepare("UPDATE clienti SET nume=?, prenume=?, email=?, telefon=?, tara=?, judet=?, oras=?, strada=?, cod_postal=? WHERE client_id='".$id."'"))
					{
						$stmt->bind_param("ssssssssi", $nume, $prenume, $email, $telefon, $tara, $judet, $oras, $strada, $cod_postal);
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
if ($result = $mysqli->query("SELECT * FROM clienti where client_id='".$_GET['id']."'"))
{
	if ($result->num_rows > 0)
	{ 
		$row = $result->fetch_object();?></p>
		<strong>Nume: </strong> <input type="text" name="nume" value="<?php echo$row->nume;?>"/><br/>
		<strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo$row->prenume;?>"/><br/>
		<strong>Email: </strong> <input type="text" name="email" value="<?php echo$row->email;?>"/><br/>
		<strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo$row->telefon;?>"/><br/>
		<strong>Tara: </strong> <input type="text" name="tara" value="<?php echo$row->tara; ?>"/><br/>
		<strong>Judet: </strong> <input type="text" name="judet" value="<?php echo $row->judet;?>"/><br/>
		<strong>Oras: </strong> <input type="text" name="oras" value="<?php echo$row->oras; ?>"/><br/>
		<strong>Strada: </strong> <input type="text" name="strada" value="<?php echo$row->strada; ?>"/><br/>
		<strong>Cod postal: </strong> <input type="text" name="cod_postal" value="<?php echo$row->cod_postal;}}}?>"/><br/>
        <br/>
<input type="submit" name="submit" value="Submit" />
<a href="vizualizare_clienti.php">Index</a>
</div>
</form>
</body>
</html>