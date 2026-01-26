<?php
 $abstand_x=9; 
 $abstand_y=43; 
 $i=0; $uebergabe = explode("a",$setPositionen);
   foreach ($uebergabe as $x_und_y) {
     $punkte = explode("*",$x_und_y);
     $posp[$i][x]= $punkte[0]-$abstand_x; 
     $posp[$i][y]= $punkte[1]-$abstand_y; 
     $i++;
   }

 header("Content-type: image/png");
 
 //$Bild = @ImageCreate($size_x,$size_y);
 $Bild = imagecreatefromjpeg($Bildpfad);
 ImageColorAllocate ($Bild,200,200,200); //grau
 ImagesetThickness($Bild,3);
 $Schwarz=ImageColorAllocate($Bild,0,0,0);
 $Weiss=ImageColorAllocate($Bild,255,255,255);
 
 $Farbe=$Weiss;
 
 imagestring($Bild,3,10,10,$Text, $Farbe);

 //Alle Linien als Start- und Endpunkt
 imageLine($Bild,$posp[6][x],$posp[6][y],$posp[7][x],$posp[7][y],$Farbe); //fuss_li
 imageLine($Bild,$posp[1][x],$posp[1][y],$posp[0][x],$posp[0][y],$Farbe); //fuss_re
 imageLine($Bild,$posp[5][x],$posp[5][y],$posp[6][x],$posp[6][y],$Farbe); //unters_li
 imageLine($Bild,$posp[2][x],$posp[2][y],$posp[1][x],$posp[1][y],$Farbe); //unters_re
 imageLine($Bild,$posp[4][x],$posp[4][y],$posp[5][x],$posp[5][y],$Farbe); //obers_li
 imageLine($Bild,$posp[3][x],$posp[3][y],$posp[2][x],$posp[2][y],$Farbe); //obers_re
 imageLine($Bild,$posp[14][x],$posp[14][y],$posp[15][x],$posp[15][y],$Farbe); //hand_li
 imageLine($Bild,$posp[9][x],$posp[9][y],$posp[8][x],$posp[8][y],$Farbe); //hand_re
 imageLine($Bild,$posp[13][x],$posp[13][y],$posp[14][x],$posp[14][y],$Farbe); //uarm_li
 imageLine($Bild,$posp[10][x],$posp[10][y],$posp[9][x],$posp[9][y],$Farbe); //uarm_re
 imageLine($Bild,$posp[12][x],$posp[12][y],$posp[13][x],$posp[13][y],$Farbe); //oarm_li
 imageLine($Bild,$posp[11][x],$posp[11][y],$posp[10][x],$posp[10][y],$Farbe); //oarm_re
 //Rumpf
 imageLine($Bild,$posp[3][x],$posp[3][y],$posp[4][x],$posp[4][y],$Farbe);//huefte
 imageLine($Bild,$posp[11][x],$posp[11][y],$posp[12][x],$posp[12][y],$Farbe);//schulter
 
 $temp1=($posp[11][x]+$posp[12][x])/2;
 $temp2=($posp[11][y]+$posp[12][y])/2;
 $temp3=($posp[3][x]+$posp[4][x])/2;
 $temp4=($posp[3][y]+$posp[4][y])/2;
 
 imageLine($Bild,$temp1,$temp2,$temp3,$temp4,$Farbe);//rumpf (schulter zu huefte)
 imageLine($Bild,$temp1,$temp2,$posp[16][x],$posp[16][y],$Farbe);//rumpf zu kopf
 
 //Kopf
 imageArc($Bild,$posp[16][x],$posp[16][y],30,40,0,360,$Farbe);
 
 //TKSPs 
 $groesse=4; // Grösse der TKSPs
 imageArc($Bild,$tksp[kopf][x]-$abstand_x,$tksp[kopf][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[rumpf][x]-$abstand_x,$tksp[rumpf][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[oarmli][x]-$abstand_x,$tksp[oarmli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[oarmre][x]-$abstand_x,$tksp[oarmre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[uarmli][x]-$abstand_x,$tksp[uarmli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[uarmre][x]-$abstand_x,$tksp[uarmre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[handli][x]-$abstand_x,$tksp[handli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[handre][x]-$abstand_x,$tksp[handre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[obersli][x]-$abstand_x,$tksp[obersli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[obersre][x]-$abstand_x,$tksp[obersre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[untersli][x]-$abstand_x,$tksp[untersli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[untersre][x]-$abstand_x,$tksp[untersre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[fussli][x]-$abstand_x,$tksp[fussli][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 imageArc($Bild,$tksp[fussre][x]-$abstand_x,$tksp[fussre][y]-$abstand_y,$groesse,$groesse,0,360,$Farbe);
 
 //KSP
 imageArc($Bild,$KSP_x-$abstand_x,$KSP_y-$abstand_y,10,10,0,360,$Farbe);
 
 ImagePng($Bild);
?>