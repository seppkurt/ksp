<html>
<head>
<title>KSP-Berechnung vom Bild</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php // JavaScript-Funktionen doitAll() und getXY() INCLUDE 
 include("jscript.htm"); 
?>
<link href="css/layout.css" rel="stylesheet" type="text/css">
</head>
<?php 
//--------------------------//
//Standardvariablen
 $abstand_x=0;
 $abstand_y=0;
// könnte für jedes Bild schon gespeichert sein??
// $bild05="341*363a330*311a389*215a287*141a267*167a326*227a315*332a330*382a294*96a258*111a226*172a179*191a145*189a101*192a72*180a51*177a123*205";
//--------------------------//

// Anzeige der Berechnung des KSP
// falls KSP übergeben wird, anzeigen
 $tue="";
 if (isset($KSP_x)) {
   $tue=";doitAll()";
 }

// Bildeigenschaften erfassen 
 if (isset($Bildpfad)) {
  $temp_size=getimagesize("$Bildpfad"); // Bildgrösse
  $bsize_x= $temp_size[0] + 30; // + Abstand vom linken Rand
  $bsize_y=$temp_size[1] + 80; // + Abstand vom oberen Rand
  $size_x=$temp_size[0];
  $size_y=$temp_size[1];  
 }

// Koordinaten der gelben Kreise(Layer)
// Tabelle berechnen
 $Breite=(2*$size_x + 4*20); // Breite der Tabelle (2*Bild_x + 4*Rand)

//Erstellen der Positionen für die gelben Kreise 
 $normPositionen="65*472a136*472a209*478a279*471a274*411a210*402a132*411a69*410a566*474a493*471a422*473a354*475a352*416a429*416a496*411a561*411a624*409";
 $z1=1+28+1+1+$size_y+1+1+1+18+18+1 +30;  // + ???
 $z2=1+28+1+1+$size_y+1+1+1+18+18+1 +1+18+1+1+18+18+1  +30+7; // + ??
 $br=$Breite/10; // eigentlich durch 9
 $new_normPositionen= 
 ($br*1)."*".$z2."a".($br*2)."*".$z2."a".($br*3)."*".$z2."a".($br*4)."*".$z2."a".($br*5)."*".$z2."a".($br*6)."*".$z2."a".($br*7)."*".$z2."a".($br*8)."*".$z2."a".
 ($br*1)."*".$z1."a".($br*2)."*".$z1."a".($br*3)."*".$z1."a".($br*4)."*".$z1."a".($br*5)."*".$z1."a".($br*6)."*".$z1."a".($br*7)."*".$z1."a".($br*8)."*".$z1."a".
 ($br*9)."*".$z1; // Kopf
 
// Anzeige der TKSP auf Bild / in Tabelle

 if ($SHOW==1) {
  $LayerPositionen=$setPositionen;
  }
 else {
  $LayerPositionen=$new_normPositionen;  
  }
$t1=$LayerPositionen;
$t2=$setPositionen;
$i=0; $uebergabe = explode("a",$LayerPositionen);
  foreach ($uebergabe as $x_und_y) {
    $punkte = explode("*",$x_und_y);
    $posp[$i][x]= $punkte[0]; 
    $posp[$i][y]= $punkte[1]; 
    $i++;
   } 
//Übergabeparameter für dynamisches Bild
 $tksps_x="tksp[kopf][x]=".$tksp[kopf][x]."&tksp[rumpf][x]=".$tksp[rumpf][x]."&tksp[oarmre][x]=".$tksp[oarmre][x]."&tksp[oarmli][x]=".$tksp[oarmli][x]."&tksp[uarmre][x]=".$tksp[uarmre][x]."&tksp[uarmli][x]=".$tksp[uarmli][x]."&tksp[handre][x]=".$tksp[handre][x]."&tksp[handli][x]=".$tksp[handli][x]."&tksp[obersre][x]=".$tksp[obersre][x]."&tksp[obersli][x]=".$tksp[obersli][x]."&tksp[untersre][x]=".$tksp[untersre][x]."&tksp[untersli][x]=".$tksp[untersli][x]."&tksp[fussre][x]=".$tksp[fussre][x]."&tksp[fussli][x]=".$tksp[fussli][x];
 $tksps_y="tksp[kopf][y]=".$tksp[kopf][y]."&tksp[rumpf][y]=".$tksp[rumpf][y]."&tksp[oarmre][y]=".$tksp[oarmre][y]."&tksp[oarmli][y]=".$tksp[oarmli][y]."&tksp[uarmre][y]=".$tksp[uarmre][y]."&tksp[uarmli][y]=".$tksp[uarmli][y]."&tksp[handre][y]=".$tksp[handre][y]."&tksp[handli][y]=".$tksp[handli][y]."&tksp[obersre][y]=".$tksp[obersre][y]."&tksp[obersli][y]=".$tksp[obersli][y]."&tksp[untersre][y]=".$tksp[untersre][y]."&tksp[untersli][y]=".$tksp[untersli][y]."&tksp[fussre][y]=".$tksp[fussre][y]."&tksp[fussli][y]=".$tksp[fussli][y];

 $dynbild_gr="<img border=\"1\" src=\"img_mann_gr.php?KSP_x=".$KSP_x."&KSP_y=".$KSP_y."&size_x=".$size_x."&size_y=".$size_y."&abstand_x=".$abstand_x."&abstand_y=".$abstand_y."&setPositionen=".$LayerPositionen."&".$tksps_x."&".$tksps_y."\">";
 $dynbild_jpg="<img border=\"1\" src=\"img_mann_jpg.php?KSP_x=".$KSP_x."&KSP_y=".$KSP_y."&size_x=".$size_x."&size_y=".$size_y."&abstand_x=".$abstand_x."&abstand_y=".$abstand_y."&setPositionen=".$LayerPositionen."&".$tksps_x."&".$tksps_y."&Bildpfad=".$Bildpfad."\">";
?>
<body bgcolor="#FFCC00" text="#000000" onLoad="
MM_dragLayer('knoechelre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('knoechelli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('fussli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('fussre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('huefteli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('hueftere','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('ellenbli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('ellenbre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('schulterli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'')
MM_dragLayer('schulterre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'')
MM_dragLayer('handgelre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('handgelli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('fingerre','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('fingerli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('kniere','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('knieli','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'');
MM_dragLayer('kopf','',0,0,0,0,true,false,-1,-1,-1,-1,false,false,0,'',false,'')">
<?php //echo $t1,"<br>",$t2;  ?>
<div id="KSP" style="position:absolute; left:<?php echo $KSP_x; ?>px; top:<?php echo $KSP_y; ?>px; width:7px; height:7px; z-index:22; background-color: #66FF00; layer-background-color: #66FF00; border: 0px none #000000;"> <img src="pixel/transparent.gif" width="7" height="7"></div>
<div id="fussli" style="position:absolute; left:<?php echo $posp[8][x]; ?>px; top:<?php echo $posp[8][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linker Fuss" alt="kreis.gif"></div>
<div id="fussre" style="position:absolute; left:<?php echo $posp[0][x]; ?>px; top:<?php echo $posp[0][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechter Fuss" alt="kreis.gif"></div>
<div id="knoechelli" style="position:absolute; left:<?php echo $posp[9][x]; ?>px; top:<?php echo $posp[9][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linker Knoechel" alt="kreis.gif"></div>
<div id="knoechelre" style="position:absolute; left:<?php echo $posp[1][x]; ?>px; top:<?php echo $posp[1][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechter Knoechel" alt="kreis.gif"></div>
<div id="knieli" style="position:absolute; left:<?php echo $posp[10][x]; ?>px; top:<?php echo $posp[10][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linkes Knie" alt="kreis.gif"></div>
<div id="kniere" style="position:absolute; left:<?php echo $posp[2][x]; ?>px; top:<?php echo $posp[2][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechtes Knie" alt="kreis.gif"></div>
<div id="huefteli" style="position:absolute; left:<?php echo $posp[11][x]; ?>px; top:<?php echo $posp[11][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linke Huefte" alt="kreis.gif"></div>
<div id="hueftere" style="position:absolute; left:<?php echo $posp[3][x]; ?>px; top:<?php echo $posp[3][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechte Huefte" alt="kreis.gif"></div>
<div id="schulterli" style="position:absolute; left:<?php echo $posp[12][x]; ?>px; top:<?php echo $posp[12][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linke Schulter" alt="kreis.gif"></div>
<div id="schulterre" style="position:absolute; left:<?php echo $posp[4][x]; ?>px; top:<?php echo $posp[4][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechte Schulter" alt="kreis.gif"></div>
<div id="ellenbli" style="position:absolute; left:<?php echo $posp[13][x]; ?>px; top:<?php echo $posp[13][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linker Ellenbogen" alt="kreis.gif"></div>
<div id="ellenbre" style="position:absolute; left:<?php echo $posp[5][x]; ?>px; top:<?php echo $posp[5][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechter Ellenbogen" alt="kreis.gif"></div>
<div id="handgelli" style="position:absolute; left:<?php echo $posp[14][x]; ?>px; top:<?php echo $posp[14][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linkes Handgelenk" alt="kreis.gif"></div>
<div id="handgelre" style="position:absolute; left:<?php echo $posp[6][x]; ?>px; top:<?php echo $posp[6][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechtes Handgelenk" alt="kreis.gif"></div>
<div id="fingerli" style="position:absolute; left:<?php echo $posp[15][x]; ?>px; top:<?php echo $posp[15][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="linke Fingerspitzen" alt="kreis.gif"></div>
<div id="fingerre" style="position:absolute; left:<?php echo $posp[7][x]; ?>px; top:<?php echo $posp[7][y];$Hoehe1; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="rechte Fingerspitzen" alt="kreis.gif"></div>
<div id="kopf" style="position:absolute; left:<?php echo $posp[16][x]; ?>px; top:<?php echo $posp[16][y];$Hoehe2; ?>px; width:10px; height:10px; z-index:3"> <img src="pixel/kreis.gif" width="10" height="10" title="Kopf" alt="kreis.gif"></div>
<table width="<?php echo $Breite; ?>">
	<tr>
		<td colspan="2" class="ksp">
			 <h4>Das KSP-M&auml;nnchen und dessen Berechnung</h4>
		 </td>
	</tr>
	<tr>
		<td class="ksp"><img src="<?php echo $Bildpfad; ?>"  border="1" alt="zu berechnendes Bild"></td>
		<td class="ksp"><?php echo $dynbild_jpg;?></td>
	</tr>
	<tr>
		<td colspan="2" class="ksp">
			 <table width="100%" border="1" cellpadding="2" cellspacing="02" class="ksp">
				  <tr>
					    <td width="11%" class="ksp-pkt">Fussspitze<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Kn&ouml;chel<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Knie<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">H&uuml;fte<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Schulter<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Ellenbogen<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Handgelenk<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Fingerspitzen<br>
						      li</td>
					    <td width="11%" class="ksp-pkt">Kopf<br>
					      </td>
				    </tr>
				  <tr>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
				    </tr>
				  <tr>
					    <td class="ksp-pkt">Fussspitze re</td>
					    <td class="ksp-pkt">Kn&ouml;chel re</td>
					    <td class="ksp-pkt">Knie re</td>
					    <td class="ksp-pkt">H&uuml;fte re</td>
					    <td class="ksp-pkt">Schulter re</td>
					    <td class="ksp-pkt">Ellenbogen re</td>
					    <td class="ksp-pkt">Handgelenk re</td>
					    <td class="ksp-pkt">Fingerspitzen re</td>
					    <td class="ksp-pkt">&nbsp;</td>
				    </tr>
				  <tr>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
					    <td class="ksp-pkt">&nbsp;</td>
				    </tr>
			  </table>
		 </td>
	</tr>
	<tr>
		<td colspan="2" class="ksp">
			 <form action="berechne.php" method="post" name="form" onSubmit="MM_callJS('doitAll()')">
				  <input type="hidden" name="setPositionen" size="50" value="<?php echo $LayerPositionen; ?>"> 
					<input type="hidden" name="Bildpfad" value="<?php echo $Bildpfad; ?>" > 
					<p>Um den KSP zu berechnen, ziehe die gelben Punkte aus der unteren Tabelle auf die jeweiligen K&ouml;rperpunkte(Gelenke) auf dem LINKEN Foto. Welcher Punkt wie &quot;heisst&quot;, erf&auml;hrst du indem du mit der Maus &uuml;ber ihn gehst.</p>
				  <p>Dann klicke auf <a href="javascript:doitAll()">Berechnen und Zeichnen</a>!</p>
				  <p>Jetzt sollte auf der rechten Seite,  ein Strichmann pber das Ausgangsbild gezechnet erscheinen, dort ist der kleinere Kreis der KSP und die noch kleineren  Punkte auf den Gliedma&szlig;en sind die Teilk&ouml;rperschwerpunkte.</p>
	   </form>
			 <p><a href="auswahl.php">zur&uuml;ck zu Bildauswahl</a></p>
			 <p>Alle mit diesem Tool erstellten Bilder unterliegen den Copyrightbestimmungen und sind nicht ohne Erlaubnis zu ver&ouml;ffentlichen!<br>
		 	Noch Fragen, dann schreib an                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <a href="mailto:skurt@gmx.de">Sebastian</a>!</p>
		  <p>Vielen Dank an Jaro, Sero, Moppa und Ronny!</p>
		 </td>
	</tr>
	<tr>
		<td colspan="2">
			 <table border="0" align="center" cellpadding="10" cellspacing="2">
				  <tr>
					    <td colspan="3" align="center" class="ksp"><p>Hier nochmal alle Bilder in der &Uuml;bersicht</p>
				    	<p>man nat&uuml;rlich jedes Bild auch Speichern, dazu einfach mit der rechten Maustaste darauf klicken und dann  &quot;Bild speichern unter...&quot; w&auml;hlen. </p></td>
				    </tr>
				  <tr>
					    <td class="ksp">Ausgangsbild</td>
					    <td class="ksp">nur KSP-Ger&uuml;st</td>
					    <td class="ksp">Ausgangsbild mit KSP-Ger&uuml;st</td>
				    </tr>
				  <tr>
					    <td class="ksp"><img src="<?php echo $Bildpfad; ?>"  border="1" alt="zu berechnendes Bild"></td>
					    <td class="ksp"><?php echo $dynbild_gr;?></td>
					    <td class="ksp"><?php echo $dynbild_jpg;?></td>
				    </tr>
			  </table>
		 </td>
	</tr>
</table>
</body>
</html>
