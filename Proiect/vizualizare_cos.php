<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare Inregistrari</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela cos</h1>
<p><b>Toate inregistrarile din tabela cos</b</p><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
//conectare baza de date
include("conectare_proiect.php");
//se preiau inregistrarile din baza de date
if($result=$mysqli->query("SELECT * FROM cos ORDER BY cos_id"))
{
	//afisare inregistrari pe ecran
	if($result->num_rows>0)
	{
		//afisarea inregistrarilor intr-o tabela
		echo "<table border='1' cellpadding='10'>";
		
		//antetul tabelului
		echo "<tr>
		        <th>Cos ID</th>
				<th>Produs ID</th>
				<th>Cantitate</th>
				<th>Client ID</th>
			  </tr>";
	 while($row=$result->fetch_object())
	 {
		 //definirea unei linii pentru fiecare inregistrare
		 echo "<tr>";
		 echo "<td>".$row->cos_id."</td>";
		 echo "<td>".$row->prod_id."</td>"; 
		 echo "<td>".$row->cantitate."</td>";
		 echo "<td>".$row->client_id."</td>";
		 echo "<td><a href='modificare_cos.php?id=".$row->cos_id."'>Modificare</a></td>";
		 echo "<td><a href='stergere_cos.php?id=".$row->cos_id."'>Stergere</a></td>";
		 echo "</tr>";
	 }
	 echo "</table>";
	}
	//daca nu sunt inregistrari se afiseaza un rezultat de eroare
	else
	{
		echo "Nu sunt inregistrari in tabela!";
	}
}
//eroare in caz de insucces in interogare
else
{
	echo "Error:".$mysqli->error();
}
//se inchide
$mysqli->close();
?>
<a href="inserare_cos.php">Adaugarea unei nou cos</a>
<a href="index_admin.html">Inapoi la pagina principala</a>
</body>
</html>