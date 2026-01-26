<!--

Powered by: Uploader Version 1.1 (http://www.phpscriptcenter.com/uploader.php)

-->
<?php

///////////////////////////////////////////////
//                                           //
// Uploader v.1.1                            //
// ----------------------------------------- //
// by Graeme (webmaster@phpscriptcenter.com) //
// http://www.phpscriptcenter.com            //
//                                           //////////////////////////////
// PHP Script CENTER offers no warranties on this script.                //
// The owner/licensee of the script is solely responsible for any        //
// problems caused by installation of the script or use of the script    //
//                                                                       //
// All copyright notices regarding Uploader, must remain                 //
// intact on the scripts and in the HTML for the scripts.                //
//                                                                       //
// (c) Copyright 2001 PHP Script CENTER                                  //
//                                                                       //
// For more info on Uploader,                                            //
// see http://www.phpscriptcenter.com/uploader.php                       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

require("setup.php");

if($doupload) {

if($ADMIN[RequirePass] == "Yes") {
if($password != "$ADMIN[Password]") {
?>
<P><CENTER><B><FONT FACE="Verdana">Error</FONT></B></CENTER></P>
<TABLE WIDTH="450" BORDER="0" align="center"
CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="100%" BGCOLOR="#000000">
    <TABLE WIDTH="450" BORDER="0" CELLSPACING="1" CELLPADDING="2">
      <TR>
        <TD COLSPAN="2" BGCOLOR="#ffffff">
        <FONT COLOR="#000000" SIZE="-1" FACE="Verdana">Invalid Password</FONT></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<P><CENTER><FONT SIZE="-2" FACE="Verdana"><B>Powered by:</B> <A HREF="http://www.phpscriptcenter.com/uploader.php" TARGET="_blank">Uploader</A> Version 1.1</FONT></CENTER>
</BODY>
</HTML>
<?php
exit();
}
}

$num = 0;
while($num < $ADMIN[UploadNum]) {
$num++;


$picture = "fileup$num"."_name";
$picture1 = $$picture;
$picture2 = "fileup$num";
$picture3 = $$picture2;

if($picture3 != "none") {
$filesizebtyes = filesize($picture3);

$ok = 1;
if($filesizebtyes < 10) {
$error .= "Error uploading (file size lower than 10 bytes) for file $num<BR>";
$ok = 2;
}



if(file_exists("$ADMIN[directory]/$picture1") OR $ok == 2) {
$error .="File name already exists for file $num<BR>";
} else {
copy ($picture3, "$ADMIN[directory]/$picture1");
$error .="File $num has been uploaded<BR>";

$maxW = 300; // maximale breite des thumbnails
$maxH = 300; // maximale höhe des thumbnails

$myDir = dir("pixel/"); $i=0;
while($e = $myDir -> read()) {
	if($e != "." and $e != ".." and !is_dir($e) and (substr($e,strlen($e)-3) == "jpg"))
		$file_array[$i++]=$e;
	}
foreach($file_array as $file) {
	$size[$file] = getimagesize("pixel/".$file); // bildgröße
	$factor = max($size[$file][0]/$maxW,$size[$file][1]/$maxH); // verkleinerungsfaktor
	$newW = round($size[$file][0]/$factor,0);
	$newH = round($size[$file][1]/$factor,0);
	$s=$newW."x".$newH;
	$k="k".$file;
	exec("convert -geometry $s $file $k");
}
$myDir -> close();

}
}
}

if(!$error) {
$error .= "No files have been selected for upload";
}


?>
<P><CENTER><B><FONT FACE="Verdana">Status</FONT></B></CENTER></P>

<TABLE WIDTH="450" BORDER="0" align="center"
CELLPADDING="0" CELLSPACING="0">
  <TR>
    <TD WIDTH="100%" BGCOLOR="#000000">
    <TABLE WIDTH="450" BORDER="0" CELLPADDING="2" CELLSPACING="1">
      <TR>
        <TD COLSPAN="2" BGCOLOR="#ffffff">
        <FONT COLOR="#000000" SIZE="-1" FACE="Verdana"><?php echo $error; ?></FONT></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<P><CENTER><FONT SIZE="-2" FACE="Verdana"><B>Powered by:</B> <A HREF="http://www.phpscriptcenter.com/uploader.php" TARGET="_blank">Uploader</A> Version 1.1</FONT></CENTER>
</BODY>
</HTML>
<?php
exit();

} else {

$num = 0;
while($num < $ADMIN[UploadNum]) {
$num++;
$html .= "<TR>
        <TD WIDTH=\"25%\" BGCOLOR=\"#295e85\">
        <FONT COLOR=\"#ffffff\" SIZE=\"-1\" FACE=\"Verdana\">File $num:</FONT></TD> 
        <TD WIDTH=\"75%\" BGCOLOR=\"#ffffff\">
        <INPUT NAME=\"fileup$num\" TYPE=\"file\" SIZE=\"25\">
</TD> ";
}

?>
<FORM ENCTYPE="multipart/form-data" ACTION="index.php?doupload=Datei%20hochladen" METHOD="POST">
<P><CENTER><B><FONT FACE="Verdana">Upload</FONT></B></CENTER></P>

<P><CENTER><TABLE WIDTH="450" BORDER="0" CELLSPACING="0" CELLPADDING="0">
  <TR>
    <TD WIDTH="100%" BGCOLOR="#000000">
    <TABLE WIDTH="450" BORDER="0" CELLSPACING="1" CELLPADDING="2">
      <TR>
        <TD COLSPAN="2" BGCOLOR="#295e85">
        <B><FONT COLOR="#ffffff" SIZE="-1" FACE="Verdana">Datei ausw&auml;hlen (nur JPG und nicht zu gross!)</FONT></B></TD>
         
      </TR><?php echo $html; ?>
    </TABLE></TD>
  </TR>
</TABLE></CENTER></P>
<?php
if($ADMIN[RequirePass] == "Yes") {
?>
<P><CENTER><TABLE BORDER="0" CELLSPACING="0"  CELLPADDING="0">
  <TR>
    <TD WIDTH="100%" BGCOLOR="#000000">
    <TABLE BORDER="0" CELLSPACING="1" CELLPADDING="2">
      <TR>
        <TD BGCOLOR="#295e85">
        <B><FONT COLOR="#ffffff" SIZE="-1" FACE="Verdana">Passwort<br>
        (bitte per email erfragen)<br>
        skurt@gmx.de
        </FONT></B></TD> 
        <TD BGCOLOR="#ffffff">
        <INPUT NAME="password" TYPE="password" SIZE="25">
</TD> 
      </TR>
      <TR>
      	<TD colspan="2" align="center" BGCOLOR="#295e85"><input name="doupload" type="submit" value="Datei hochladen"></TD>
     	</TR>
    </TABLE></TD>
  </TR>
</TABLE></CENTER></P>
<?php
}
?>
</FORM>

<P><CENTER><FONT SIZE="-2" FACE="Verdana"><B>Powered by:</B> <A HREF="http://www.phpscriptcenter.com/uploader.php" TARGET="_blank">Uploader</A> Version 1.1</FONT></CENTER>
<?php
exit();
}
?>
