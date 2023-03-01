<?php
include("conectare_proiect.php");
$error='';
if(isset($_POST['submit']))
{
    //preluam datele de pe formular
    $produs_id=htmlentities($_POST['produs_id'],ENT_QUOTES);
    $quantity=htmlentities($_POST['quantity'],ENT_QUOTES);
	$client_id=htmlentities($_POST['client_id'],ENT_QUOTES);

    //verificam daca sunt completate
    if($produs_id=='' || $quantity=='' || $client_id=='')
    {
        //daca sunt goale se afiseaza un mesaj
        $error='ERROR: Campuri goale!';
    }
    else
    {
        //insert
        if($stmt=$mysqli->prepare("INSERT into cos(prod_id, cantitate, client_id) VALUES (?,?,?)"))
        {
            $stmt->bind_param("iii", $produs_id, $quantity, $client_id);
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
        <strong>Produs ID: </strong> <input type="text" name="produs_id" value=""/><br/>
        <strong>Cantitate: </strong> <input type="text" name="quantity" value=""/><br/>
        <strong>Client ID: </strong> <input type="text" name="client_id" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="vizualizare_cos.php">Index</a>
    </div>
</form>
</body>
</html>