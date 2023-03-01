<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare inregistrari</title>
<meta http-equiv="Content-Type" content=""text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela Produse</h1>
<p><b>Toate inregistrarile din produse</b></p>
<?php
//conectare baza de date
include("conectare_proiect.php");
//se preiau inregistrarile din baza de date
if($result=$mysqli->query("SELECT * FROM produse ORDER BY produs_id"))
{
	//afisare inregistrari pe ecran
	if($result->num_rows>0)
	{
		//afisarea inregistrarilor intr-o tabela
		echo "<table border='1' cellpadding='10'>";
		
		//antetul tabelului
		echo "<tr>
		        <th>ID</th>
				<th>Denumire</th>
				<th>Brand</th>
				<th>Cod</th>
				<th>Pret</th>
				<th>Cantitate</th>
				<th>Stoc</th>
				<th>Descriere</th>
				<th>Categorie</th>
				<th>Imagine</th>
				<th>Stare</th>
				<th></th>
			  </tr>";
	 while($row=$result->fetch_object())
	 {
		 //definirea unei linii pentru fiecare inregistrare
		 echo "<tr>";
		 echo "<td>".$row->produs_id."</td>";
		 echo "<td>".$row->denumire."</td>"; 
		 echo "<td>".$row->brand."</td>";
		 echo "<td>".$row->cod."</td>";
		 echo "<td>".$row->pret."</td>";
		 echo "<td>".$row->cant."</td>";
		 echo "<td>".$row->stoc."</td>";
		 echo "<td>".$row->descriere."</td>";
		 echo "<td>".$row->categorie."</td>";
		 echo "<td>".$row->imagine."</td>";
		 echo "<td>".$row->stare."</td>";
		 echo "<td><a href='modificare_produse.php?id=".$row->produs_id."'>Modificare</a></td>";
		 echo "<td><a href='stergere_produse.php?id=".$row->produs_id."'>Stergere</a></td>";
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
<a href="inserare_produse.php">Adaugarea unei noi inregistrari</a>
<a href="index_admin.html">Inapoi la pagina principala</a>
</body>
</html>