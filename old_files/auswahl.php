<?php
//hole alle bilder aus verzeichnis
//mache array mit namen daraus
$myDir = dir("pixel/"); $i=0;
while($e = $myDir -> read()) {
	if($e != "." and $e != ".." and !is_dir($e) and (substr($e,strlen($e)-3) == "jpg"))
		$file_array[$i++]=$e;
	}
$myDir -> close();
//print_r(array_values($file_array));
?>

<html>
<head>
<title>K&ouml;rperschwerpunktberechnung-Bilderauswahl</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/layout.css" rel="stylesheet" type="text/css">

</head>
<body bgcolor="#FFCC00">
<h2>K&ouml;rperschwerpunktberechnung</h2>
<p>Suche Dir ein Bild aus, von welchem Du den KSP berechnen lassen willst!</p>
<form action="auswert.php" method="post" name="bildauswahl" id="bildauswahl">
  <table border="1" align="left" cellpadding="10" cellspacing="0">
<?php foreach ($file_array as $f) {		//zeige sie mit auswahlmögl an ?>
<tr align="center"><td><input type="radio" name="Bildpfad" value="pixel/<?php echo $f; ?>"></td>
	<td><img src="pixel/<?php echo $f; ?>" border="1"></td></tr>
<?php			} ?>
    <tr align="center"> 
      <td colspan="4"><input name="SHOW" type="hidden" value="0">
	  <input type="submit" name="Submit" value="Ausgew&auml;hltes Bild bearbeiten"></td>
    </tr>
  </table>
  </form>
</body>
</html>
