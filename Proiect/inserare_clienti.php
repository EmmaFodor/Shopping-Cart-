<?php
include("conectare_proiect.php");
$error='';
if(isset($_POST['submit']))
{
    //preluam datele de pe formular
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
        //insert
        if($stmt=$mysqli->prepare("INSERT into clienti(nume, prenume, email, telefon, tara, judet, oras, strada, cod_postal) VALUES (?,?,?,?,?,?,?,?,?)"))
        {
            $stmt->bind_param("ssssssssi", $nume, $prenume, $email, $telefon, $tara, $judet, $oras, $strada, $cod_postal);
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
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Prenume: </strong> <input type="text" name="prenume" value=""/><br/>
        <strong>Email: </strong> <input type="text" name="email" value=""/><br/>
        <strong>Telefon: </strong> <input type="text" name="telefon" value=""/><br/>
        <strong>Tara: </strong> <input type="text" name="tara" value=""/><br/>
        <strong>Judet: </strong> <input type="text" name="judet" value=""/><br/>
        <strong>Oras: </strong> <input type="text" name="oras" value=""/><br/>
        <strong>Strada: </strong> <input type="text" name="strada" value=""/><br/>
        <strong>Cod postal: </strong> <input type="text" name="cod_postal" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizare_clienti.php">Index</a>
    </div>
</form>
</body>
</html>