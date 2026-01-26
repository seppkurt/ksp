<?php
 // Zersplittet Array 
 $i=0; $uebergabe = explode("a",$setPositionen);
 foreach ($uebergabe as $x_und_y) {
   $punkte = explode("*",$x_und_y);
   $posp[$i][x]= $punkte[0]; $posp[$i][y]= $punkte[1]; $i++;
   }

 $tksp[fussre][x] = new_vektor($posp[1][x],$posp[0][x],0.44);
 $tksp[fussre][y] = new_vektor($posp[1][y],$posp[0][y],0.44);
 $tksp[untersre][x] = new_vektor($posp[1][x],$posp[2][x],0.42);
 $tksp[untersre][y] = new_vektor($posp[1][y],$posp[2][y],0.42);
 $tksp[obersre][x] = new_vektor($posp[2][x],$posp[3][x],0.44);
 $tksp[obersre][y] = new_vektor($posp[2][y],$posp[3][y],0.44);
 $tksp[obersli][x] = new_vektor($posp[5][x],$posp[4][x],0.44);
 $tksp[obersli][y] = new_vektor($posp[5][y],$posp[4][y],0.44);
 $tksp[untersli][x] = new_vektor($posp[5][x],$posp[6][x],0.42);
 $tksp[untersli][y] = new_vektor($posp[5][y],$posp[6][y],0.42);
 $tksp[fussli][x] = new_vektor($posp[6][x],$posp[7][x],0.44);
 $tksp[fussli][y] = new_vektor($posp[6][y],$posp[7][y],0.44);
 
 $tksp[handre][x] = new_vektor($posp[9][x],$posp[8][x],0.5);
 $tksp[handre][y] = new_vektor($posp[9][y],$posp[8][y],0.5);
 $tksp[uarmre][x] = new_vektor($posp[10][x],$posp[9][x],0.42);
 $tksp[uarmre][y] = new_vektor($posp[10][y],$posp[9][y],0.42);
 $tksp[oarmre][x] = new_vektor($posp[11][x],$posp[10][x],0.47);
 $tksp[oarmre][y] = new_vektor($posp[11][y],$posp[10][y],0.47);
 $tksp[oarmli][x] = new_vektor($posp[12][x],$posp[13][x],0.47);
 $tksp[oarmli][y] = new_vektor($posp[12][y],$posp[13][y],0.47);
 $tksp[uarmli][x] = new_vektor($posp[13][x],$posp[14][x],0.42);
 $tksp[uarmli][y] = new_vektor($posp[13][y],$posp[14][y],0.42);
 $tksp[handli][x] = new_vektor($posp[14][x],$posp[15][x],0.5);
 $tksp[handli][y] = new_vektor($posp[14][y],$posp[15][y],0.5);

 //schultermitte, hueftmitte als zwischenschritt
  $temp1 = neue_pos($posp[4][x],$posp[3][x],0.5); // li hueft x + re hueft x
  $temp2 = neue_pos($posp[4][y],$posp[3][y],0.5); // li hueft y + re hueft y
  $temp3 = neue_pos($posp[12][x],$posp[11][x],0.5); // li schult x + re schult x
  $temp4 = neue_pos($posp[12][y],$posp[11][y],0.5); // li schult y + re schult y
 $tksp[rumpf][x] = new_vektor($temp1,$temp3,0.44);
 $tksp[rumpf][y] = new_vektor($temp2,$temp4,0.44);

 $tksp[kopf][x] = round($posp[16][x],0);
 $tksp[kopf][y] = round($posp[16][y],0);  

 $tksps_x="tksp[kopf][x]=".$tksp[kopf][x]."&tksp[rumpf][x]=".$tksp[rumpf][x]."&tksp[oarmre][x]=".$tksp[oarmre][x]."&tksp[oarmli][x]=".$tksp[oarmli][x]."&tksp[uarmre][x]=".$tksp[uarmre][x]."&tksp[uarmli][x]=".$tksp[uarmli][x]."&tksp[handre][x]=".$tksp[handre][x]."&tksp[handli][x]=".$tksp[handli][x]."&tksp[obersre][x]=".$tksp[obersre][x]."&tksp[obersli][x]=".$tksp[obersli][x]."&tksp[untersre][x]=".$tksp[untersre][x]."&tksp[untersli][x]=".$tksp[untersli][x]."&tksp[fussre][x]=".$tksp[fussre][x]."&tksp[fussli][x]=".$tksp[fussli][x];
 $tksps_y="tksp[kopf][y]=".$tksp[kopf][y]."&tksp[rumpf][y]=".$tksp[rumpf][y]."&tksp[oarmre][y]=".$tksp[oarmre][y]."&tksp[oarmli][y]=".$tksp[oarmli][y]."&tksp[uarmre][y]=".$tksp[uarmre][y]."&tksp[uarmli][y]=".$tksp[uarmli][y]."&tksp[handre][y]=".$tksp[handre][y]."&tksp[handli][y]=".$tksp[handli][y]."&tksp[obersre][y]=".$tksp[obersre][y]."&tksp[obersli][y]=".$tksp[obersli][y]."&tksp[untersre][y]=".$tksp[untersre][y]."&tksp[untersli][y]=".$tksp[untersli][y]."&tksp[fussre][y]=".$tksp[fussre][y]."&tksp[fussli][y]=".$tksp[fussli][y];
 
 $ksp_x=round(($tksp[kopf][x]*7+$tksp[rumpf][x]*43+$tksp[oarmre][x]*3+$tksp[oarmli][x]*3+$tksp[uarmre][x]*2+$tksp[uarmli][x]*2+$tksp[handre][x]*1+$tksp[handli][x]*1+$tksp[obersre][x]*12+$tksp[obersli][x]*12+$tksp[untersre][x]*5+$tksp[untersli][x]*5+$tksp[fussre][x]*2+$tksp[fussli][x]*2)/100,0);
 $ksp_y=round(($tksp[kopf][y]*7+$tksp[rumpf][y]*43+$tksp[oarmre][y]*3+$tksp[oarmli][y]*3+$tksp[uarmre][y]*2+$tksp[uarmli][y]*2+$tksp[handre][y]*1+$tksp[handli][y]*1+$tksp[obersre][y]*12+$tksp[obersli][y]*12+$tksp[untersre][y]*5+$tksp[untersli][y]*5+$tksp[fussre][y]*2+$tksp[fussli][y]*2)/100,0);
 
 $goto_link="auswert.php?SHOW=1&KSP_x=$ksp_x&KSP_y=$ksp_y&Bildpfad=$Bildpfad&setPositionen=$setPositionen&".$tksps_x."&".$tksps_y; 
 
 header("location:$goto_link");
 
 function neue_pos($x1,$x2,$v_fakt) {
  $neue_posit = round( (($x1+$x2)*$v_fakt) ,0);
  return $neue_posit;
 }
 
 function new_vektor($StartX,$EndeX,$VFaktor) {
  $new_pos = round( (((1-$VFaktor)*$EndeX) + ($VFaktor*$StartX)) ,0);
  return $new_pos;
 }
?>