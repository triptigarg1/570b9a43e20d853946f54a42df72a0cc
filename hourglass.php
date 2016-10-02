
<html>
  <body>
	
	<form method="post" action="http://localhost/hourglass.php">
	<h4>Enter the Number 
	<input type="number" name="number1"></h4>
 	<h4>Enter the Percentage 
	<input type="number" name="percent1"></h4>
	<input style="height: 40px; width: 55px;" value="Submit" name="Submit" type="submit"><br>
	</form>
	<br>
	<br>

<?php

$q="\\";
$r="_";
$s="/";
$n = $_POST["number1"];	
$p = $_POST["percent1"];
$z = $n;
$f_bottom=0;
$bottom_cap=0;
$top_cap=0;
$count=0;


// display the user input value and output
echo "Input: " . $n . "&nbsp" . $p . "% <br> Output: <br>";

// check input values and display error
if ($n<=1){
	echo "Enter Number greater than 1";
	exit;
}

if ($p>100 || $p <1){
	echo "Enter Percentage between 1 to 100";
	exit;
}

//calculate number of x for bottom bulb
for ($g=$n; $g>=0; $g--){
	$f_bottom=$f_bottom+$g; 
}

//calculate the total capacity of the bulb
$bottom_cap=$f_bottom;  
$f_bottom=(1-($p/100))*$f_bottom;

// calculate number of x for top bulb
$f_top=$bottom_cap - $f_bottom;
$top_cap=$bottom_cap;
echo "<br>";



// draw the top line
for($l=0; $l<=$n; $l++){
	echo $r;
}
echo "<br>";


// draw the top bulb
for($i=0; $i<=$n-1; $i++)
	{   
	for($j=1; $j<=$i; $j++)           
    	echo "&nbsp";           
    for($k=1; $k<=$n+1-$i; $k++)            
    	if($k == 1){
	 		echo $q; 
	 	}
	 	else{
// decide to display sand and space	
	 		if($top_cap>$f_top){
	 			echo "&nbsp ";
	 			$top_cap=$top_cap-1;
	 		}	
	 		else{
	 			echo "x";
	 		}	
	 	}
        for($j=($k-1); $j>0; $j--)        
        	if($j == 1){
	 			echo $s; 
	 		}
	 		else{
	 			// echo "&nbsp";
	 		}           
	echo "<br>"; 
}


// draw the bottom bulb
for ($d=2; $d<=$n+1; $d++){
	for ($a=$z; $a>=0; $a--){
	if($a == 1){
	 	echo $s;
	 }
	 else{
	 	echo  "&nbsp" ;
    }
	}
	for ($b=$d; $b>=1; $b--){
		if($b == 1){
	 		echo $q; 
	 	}
	 	else{
//display the sand and space	 
	 		$bottom_cap=$bottom_cap-1;
	 		if($bottom_cap >= $f_bottom){
	 			echo "&nbsp " ;
	 		}
	 		else {
	 			echo "x";
	 		}
	 	} 
	}
	$z--;
	echo "<br>";
}
// coded by Tripti Garg
?>

</body>
</html>