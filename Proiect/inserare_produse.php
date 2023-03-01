<?php
include("conectare_proiect.php");
$error='';
if(isset($_POST['submit']))
{
    //preluam datele de pe formular
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
        //insert
        if($stmt=$mysqli->prepare("INSERT into produse(denumire, brand, cod, pret, cant, stoc, descriere, categorie, imagine, stare) VALUES (?,?,?,?,?,?,?,?,?,?)"))
        {
            $stmt->bind_param("sssdsissss", $denumire, $brand, $cod, $pret, $cantitate, $stoc, $descriere, $categorie, $imagine, $stare);
            $stmt->execute();
            $stmt->close();
        }
        //eroare la inserare
        else
        {
            echo "ERROR: Nu se poate executa insert";
        }
    }
}
//se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php echo "Inserare inregistrare";?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php echo "Inserare inregistrare";?></h1>
<?php
if($error!=''){echo "<div style='padding:4px; border:1px solid red; color:red'>".$error."</div>";}?>
<form action="" method="post">
    <div>
        <strong>Denumire: </strong> <input type="text" name="denumire" value=""/><br/>
        <strong>Brand: </strong> <input type="text" name="brand" value=""/><br/>
		<strong>Cod: </strong> <input type="text" name="cod" value=""/><br/>
        <strong>Pret: </strong> <input type="text" name="pret" value=""/><br/>
        <strong>Cantitate: </strong> <input type="text" name="cantitate" value=""/><br/>
        <strong>Stoc: </strong> <input type="text" name="stoc" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
        <strong>Categorie: </strong> <input type="text" name="categorie" value=""/><br/>
        <strong>Imagine: </strong> <input type="text" name="imagine" value=""/><br/>
        <strong>Stare: </strong> <input type="text" name="stare" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizare_produse.php">Index</a>
    </div>
</form>
</body>
</html>