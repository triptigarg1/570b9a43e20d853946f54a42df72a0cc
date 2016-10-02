<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/xml; charset=utf-8" /> 
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    
    <title>AMPed Search Results</title>
    <base href="home3.html">
  </head>
  <body>
     <?php include("top_header_start.php"); include("top_header_logo.php"); include("top_header_menu.php"); ?>
     
     <br>


<?php
    
    $PepName=$_POST['PepName'];
    $AASeq = $_POST['aaSeq'];
    
    $atcc = $_POST['atccNum'];
    //$MicType = $_POST['MicType'];
    $SpeNm = $_POST['SpeNm'];
    $Unique = $_POST['UnqId'];
    $FullSeq = $_POST['FullSeq'];
    $PDBId = $_POST['PDBId'];
    $StartSeq = $_POST['StartSeq'];
    $EndSeq = $_POST['EndSeq'];
    $AAseqType = $_POST['aaseqtype'];
    
	$hostname='xxxxxx';
	$usrnm='xxxxxx';
	$pwd='xxxxxx';
	$dbname='xxxxxx';

	
	// connect with the database
	$con = mysql_connect($hostname, $usrnm, $pwd) OR DIE (mysql_error());
	mysql_select_db($dbname);
	
	
	// select sql query
	$sqlp = "Select Peptide.AMP_ID, Accession_No, Name, AA_Sequence from Peptide";
	
	if($PepName != "") $cond[] = " Name Like '%$PepName%' ";
	if ($AASeq != "" && $FullSeq == 'on')
	{
		$cond[] = " AA_Sequence = '$AASeq' ";
	}
	elseif ($AASeq != "")
	{
		$cond[] = " AA_Sequence LIKE '%$AASeq%' ";
	}
	if ($StartSeq != "" && $EndSeq != "")
	{
		$cond[] = " AA_Sequence LIKE '$StartSeq%$EndSeq' ";
	}
	if($atcc != "") $cond[] = " Accession_No LIKE '%$atcc%' ";
	if($Unique != "") $cond[] = " Peptide.AMP_ID LIKE '%$Unique%' ";
	if($SpeNm != "") {
		$joinS = " Inner Join Fight_Against ON Fight_Against.AMP_ID = Peptide.AMP_ID Inner Join Microbe ON Microbe.Microbe_ID = Fight_Against.Microbe_ID ";
		$cond[] = " Species_Name LIKE '%$SpeNm%' ";
		}
		
	if($PDBId != "") {
		$join = " Inner Join 3D_Structure ON 3D_Structure.AMP_ID = Peptide.AMP_ID ";
		$cond[] = " 3D_Structure.PDB_ID LIKE '%$PDBId%' ";
		}
	
	
	$sqlp .= $joinS . $join . " Where " . implode('And', $cond);
	
	//echo $sqlp;
	$resultp = mysql_query($sqlp, $con) or die(mysql_error());	

$rowp = mysql_num_rows($resultp);
	if($rowp == 0)
	{
	echo '<div class="container">
          <div class="row">
            <div class="col-sm-12">
             <h4 style="text-align: left;">Search Results</h4><hr><br>
            </div></div>';
		echo '<div class="row"><div class="col-sm-12">';
		echo "No Results Found."; echo '</div></div></div>';
	}else
	{
	echo ' <div class="header-middle"><div class="container">
          <div class="row">
            <div class="col-sm-4">
             <h4 style="text-align: left;">Search Results</h4>
            </div>
	<div class="col-sm-8">
	<div class="shop-menu pull-right"> Results Found: '; echo $rowp; echo '</div></div></div></div></div><br>';
	echo '<div class="container">
	<div class="row">
	<div class="col-sm-2"> <h5> AMP ID </h5> </div>
	<div class="col-sm-2"> <h5> Accession Number </h5> </div>
	<div class="col-sm-3"> <h5> Peptide Name </h5> </div>
	<div class="col-sm-5"> <h5 style="text-align: left;"> AA_Sequence </h5> </div></div><hr>';
	while($rows=mysql_fetch_assoc($resultp)){
      echo '<div class="row">';
      echo '<div class="col-sm-2">'; echo '<p> <a href="detail_result.php?UQ_ID=';
      echo $rows['AMP_ID']; echo '">'; echo $rows['AMP_ID']; echo '</a></p></div>';
      echo '<div class="col-sm-2">'; echo '<p>';
      echo $rows['Accession_No']; echo '</p>';echo '</div>';
      echo '<div class="col-sm-3">';echo '<p>';
      echo $rows['Name']; echo '</p>';echo '</div>';
      echo '<div class="col-sm-5">'; echo '<p style="text-align: left;">';
      echo $rows['AA_Sequence']; echo '</p>';echo '</div>';
		echo '</div>';
		
      }
       echo '</div>';
	}



?>
<br>
<br>
<br>
<?php include("footer.php"); ?>

 </body>
</html>