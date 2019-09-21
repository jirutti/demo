<?php
function exmaple4($n){
	if($n==1) return $n;
	else return $n* exmaple4 ($n-1);
}
$a =209324;
$_a = str_split($a);
$num= count($_a);
$ele_amnt = exmaple4 ($num);
$output = array();
	while(count($output) < $ele_amnt){
	shuffle($_a);
	$justnumber = implode("",$_a);
	if(!in_array( $justnumber , $output))
		$output[] = $justnumber;
}
sort($output);
print_r($output);
?>
