<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Vizualizare inregistrari</title>
<meta http-equiv="Content-Type" content=""text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela datepers</h1>
<p><b>Toate inregistrarile din datepers</b></p>
<?php
//conectare baza de date
include("conectare_proiect.php");
//se preiau inregistrarile din baza de date
if($result=$mysqli->query("SELECT * FROM clienti ORDER BY client_id"))
{
	//afisare inregistrari pe ecran
	if($result->num_rows>0)
	{
		//afisarea inregistrarilor intr-o tabela
		echo "<table border='1' cellpadding='10'>";
		
		//antetul tabelului
		echo "<tr>
		        <th>ID</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Email</th>
				<th>Telefon</th>
				<th>Tara</th>
				<th>Judet</th>
				<th>Oras</th>
				<th>Strada</th>
				<th>Cod postal</th>
				<th>Utilizator ID</th>
				<th></th>
			  </tr>";
	 while($row=$result->fetch_object())
	 {
		 //definirea unei linii pentru fiecare inregistrare
		 echo "<tr>";
		 echo "<td>".$row->client_id."</td>";
		 echo "<td>".$row->nume."</td>"; 
		 echo "<td>".$row->prenume."</td>";
		 echo "<td>".$row->email."</td>";
		 echo "<td>".$row->telefon."</td>";
		 echo "<td>".$row->tara."</td>";
		 echo "<td>".$row->judet."</td>";
		 echo "<td>".$row->oras."</td>";
		 echo "<td>".$row->strada."</td>";
		 echo "<td>".$row->cod_postal."</td>";
		 echo "<td>".$row->utilizator_id."</td>";
		 echo "<td><a href='modificare_clienti.php?id=".$row->client_id."'>Modificare</a></td>";
		 echo "<td><a href='stergere_clienti.php?id=".$row->client_id."'>Stergere</a></td>";
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
<a href="inserare_clienti.php">Adaugarea unei noi inregistrari</a>
<a href="index_admin.html">Inapoi la pagina principala</a>
</body>
</html>